<?php

namespace App\Services\MMServices;

use App\Exceptions\DBSaveException;
use App\Exceptions\InvalidSapResponseException;
use App\Exceptions\ResourceNotFoundException;
use App\Models\Adresse;
use App\Models\Artikel;
use App\Models\ArtikelKunde;
use App\Models\Position;
use App\Models\Position3Menge;
use App\Models\Position5Individual;
use App\Models\Preisbasis;
use App\Models\Vorgang;
use App\Services\PositionService;
use App\Services\PositionServices\Position1WertService;
use App\Services\PositionServices\Position2TextService;
use App\Services\PositionServices\Position3MengeService;
use App\Services\PositionServices\Position4LieferungService;
use App\Services\PositionServices\Position5IndividualService;
use App\Services\PositionServices\Position6StuecklisteService;
use App\Services\PositionServices\Position7ZusatzService;
use App\Services\PositionServices\PositionWertService;
use App\Services\SapApiClient;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class MM_33_01_b_Services
{
    protected string $mm331_path;

    public function __construct(
        protected PositionService             $positionService,
        protected Position2TextService        $position2TextService,
        protected Position3MengeService       $position3MengeService,
        protected Position4LieferungService   $position4LieferungService,
        protected Position5IndividualService  $position5IndividualService,
        protected Position6StuecklisteService $position6StuecklisteService,
        protected Position7ZusatzService      $position7ZusatzService,
        protected Position1WertService        $position1WertService,
        protected PositionWertService         $positionWertService,
    )
    {
        $this->mm331_path = config('sap.mm331_path');
    }

    /**
     * MM_33_01b NU-Auftragspaket
     * CEOSWEB-->CEOS-->SAP
     * @throws Exception
     * @throws Throwable
     */
    public function mm_33_01_b_NuAuftragspaket($requestData): ?array
    {
        $vorgang = Vorgang::where('VorNummer', $requestData['Vorgangnummer'])
            ->where('VorGruppe', $requestData['VorGruppe']) //NU
            ->first();

        if ($vorgang === null) {
            throw new ResourceNotFoundException('Kein Vorgang gefunden.',
                ['Vorgangnummer' => $requestData['Vorgangnummer']]
            );
        }
        $adresse = Adresse::where('InterneAdressnummer', $vorgang->VorAuftraggeber)->first();
        if ($adresse === null) {
            throw new ResourceNotFoundException('Keine Adresse für den Vorgang gefunden.',
                ["InterneAdressnummer" => $vorgang->VorAuftraggeber]
            );
        }

        // get all Positions
        $positions = Position::where('InterneVorgangsnummer', $vorgang->InterneVorgangsnummer)->get();
        if ($positions->isEmpty()) {
            throw new ResourceNotFoundException('Keine Positionen für den Vorgang gefunden.',
                ["InterneVorgangsnummer" => $vorgang->InterneVorgangsnummer]
            );
        }
        $to_Items = [];
        $positionNummerArray = [];

        $artikelCollection = Artikel::whereIn('InterneArtikelnummer',
            $positions->pluck('InterneArtikelnummer')
        )->get()->keyBy('InterneArtikelnummer');

        $position3Mengen = Position3Menge::whereIn('InternePositionsnummer',
            $positions->pluck('InternePositionsnummer')
        )->get()->keyBy('InternePositionsnummer');


        $position5IndividualCollection = Position5Individual::whereIn('InternePositionsnummer',
            $positions->pluck('InternePositionsnummer')
        )->get()->keyBy('InternePositionsnummer');

        foreach ($positions as $position) {
            $positionNummerArray[] = $position->PosNummer;

            //get Artikelnummer by $position->InterneArtikelnummer.
            $artikel = $artikelCollection[$position->InterneArtikelnummer] ?? null;
            if ($artikel === null) {
                throw new ResourceNotFoundException('Kein Artikel für Position gefunden',
                    [
                        'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
                        'Position' => $position->InternePositionsnummer,
                        'InterneArtikelnummer' => $position->InterneArtikelnummer
                    ]);
            }
            $position3Menge = $position3Mengen[$position->InternePositionsnummer] ?? null;
            if ($position3Menge === null) {
                throw new ResourceNotFoundException('Keine Mengenangabe für die Position gefunden.',
                    [
                        'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
                        'Position' => $position->InternePositionsnummer,
                        'InterneArtikelnummer' => $position->InterneArtikelnummer
                    ]);
            }
            $position5Individual = $position5IndividualCollection[$position->InternePositionsnummer] ?? null;
            if ($position5Individual === null) {
                throw new ResourceNotFoundException('Keine Vgart-Daten für die Position gefunden.',
                    [
                        'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
                        'Position' => $position->InternePositionsnummer,
                        'InterneArtikelnummer' => $position->InterneArtikelnummer
                    ]);
            }
            $to_Items[] = [
                "TourId" => (string)$requestData['tourId'],
                'Lifnr' => $adresse->AdressNummer,
                'Slgnr' => $vorgang->VorIndividualC3,
                'Vgart' => $position5Individual->PosIndividualC2,
                'Vbeln' => '',
                'Posnr' => '',
                'PosInt' => $position->InternePositionsnummer,
                'Material' => (string)(int)$artikel->Artikelnummer,
                'ShortText' => $artikel->ArtBezeichnung1 ?? "",
                "Quantity" => (string)(int)$position3Menge->PosMenge1,
                "Peinh" => '1',
                "CeosData" => "X",
                "Goodsmovement" => "",
                "GoodsmvmtLine" => "",
                "PoUnit" => "",
                "PoNumber" => "",
                "PoItem" => "",
            ];
        }

        $sendData = [
            "TourId" => (string)$requestData['tourId'],
            "Interface" => 'B',
            "Lifnr" => $adresse->AdressNummer,
            "Datv" => null,
            "Datb" => null,
            "to_items" => $to_Items
        ];

        Log::info("mm_33_01_b_NuAuftragspaket sent Data", $sendData);
        $result = app(SapApiClient::class)->post($this->mm331_path, $sendData);
        if ($result == null) {
            return null;
        }

        return DB::transaction(function () use (
            $result,
            $vorgang,
            $adresse,
            $positionNummerArray
        ) {
            if (isset($result['d'])) {
                $receivedVorgangInfo = $result['d'];
                $vorgang->VorIndividualC5 = $receivedVorgangInfo['PoItem'];
                $vorgang->VorIndividualD6 = $receivedVorgangInfo['PoNumber'];
                $vorgang->save();
            }

            if (
                !isset($result['d']['to_items']['results']) ||
                !is_array($result['d']['to_items']['results'])
            ) {
                throw new InvalidSapResponseException('Ungültige SAP-Antwort.');
            }

            $receivedPositions = $result['d']['to_items']['results'];
            Log::info('received_data', $result);
            $notExistArrayAndCreated = [];
            $existArrayAndUpdated = [];

            $artikelCollection = Artikel::whereIn('Artikelnummer',
                collect($receivedPositions)->pluck('Material'))->get()->keyBy('Artikelnummer');

            $preisbasisCollection = Preisbasis::whereIn('NRPreisbasis',
                collect($receivedPositions)->pluck('Peinh'))->get()->keyBy('NRPreisbasis');
            $existingPositions = Position::whereIn('InternePositionsnummer', collect($receivedPositions)
                ->pluck('PosInt')
                ->filter()
            )->get()->keyBy('InternePositionsnummer');

            $positionNummerArray = array_map('intval', $positionNummerArray);
            $currentMaxPosition = empty($positionNummerArray) ? 0 : max($positionNummerArray);
            $currentDate = date('Ymd');

            foreach ($receivedPositions as $receivedPosition) {
                if (!isset(
                    $receivedPosition['Material'],
                    $receivedPosition['Quantity'],
                    $receivedPosition['Netpr'],
                    $receivedPosition['Peinh'],
                    $receivedPosition['PosInt']
                )) {
                    throw new InvalidSapResponseException('SAP-Positionsantwort ist unvollständig.',
                        ['position' => $receivedPosition]
                    );
                }
                $artikel = $artikelCollection[$receivedPosition['Material']] ?? null;
                if ($artikel === null) {
                    throw new ResourceNotFoundException('Artikel nicht gefunden.',
                        ['Material' => $receivedPosition['Material']]
                    );
                }
                $preisbasis = $preisbasisCollection[$receivedPosition['Peinh']] ?? null;
                if ($preisbasis === null) {
                    throw new ResourceNotFoundException('Preisbasis nicht gefunden.',
                        ['NRPreisbasis' => $receivedPosition['Peinh']]
                    );
                }
                $quantity = $receivedPosition['Quantity'];
                $netPrice = $receivedPosition['Netpr'];
                $gesamtNettoPreis = $netPrice * $quantity;

                $positionData = [
                    'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
                    'VorNummer' => $vorgang->VorNummer,
                    'PosIndividualC1' => $receivedPosition['Posnr'],
                    'PosIndividualC5' => $quantity,
                    'NRPreisbasis' => $receivedPosition['Peinh'],
                    'PosPreisfaktor' => $preisbasis->Preisfaktor,
                    'PosMenge1' => $quantity,
                    'PosKZMengeneinheit1' => 'LE',
                    'externGesamtPreis' => $gesamtNettoPreis,
                    'externEinzelPreis' => $netPrice,
                    'externMenge' => $quantity,
                    'current_date' => $currentDate,
                ];

                if ((int)$receivedPosition['PosInt'] !== 0) {
                    $position = $existingPositions[$receivedPosition['PosInt']] ?? null;
                    if ($position === null) {
                        throw new ResourceNotFoundException('Position nicht gefunden.',
                            ['PosInt' => $receivedPosition['PosInt']]
                        );
                    }
                    $internePositionsnummer = $position->InternePositionsnummer;
                    try {
                        $this->position5IndividualService->updatePosition5Individual($positionData, $internePositionsnummer);
                        $this->positionWertService->updatePositionWert($positionData, $internePositionsnummer);
                        $this->position1WertService->updatePosition1Wert($positionData, $internePositionsnummer);
                        $this->position3MengeService->updatePosition3Menge($positionData, $internePositionsnummer);
                    } catch (Throwable $e) {
                        throw new DBSaveException('Fehler beim Speichern der Position: ' . $e->getMessage());
                    }
                    $existArrayAndUpdated[] = $internePositionsnummer;
                    ArtikelKunde::updateOrCreate(
                        [
                            'InterneArtikelnummer' => $artikel->InterneArtikelnummer,
                            'InterneAdressnummer' => $adresse->InterneAdressnummer,
                        ],
                        [
                            'InterneArtikelnummer' => $artikel->InterneArtikelnummer,
                            'InterneAdressnummer' => $adresse->InterneAdressnummer,
                            'AkuArtikelBezeichnung1' => $receivedPosition['ShortText'],
                            'NRPreisbasis' => $receivedPosition['Peinh'],
                            'AkuLetzterVK' => $gesamtNettoPreis,
                            'AkuLetzterRabattWert1' => 0,
                            'AkuLetzterRabattWert2' => 0,
                            'AkuLetzteMenge1' => 0,
                            'AkuLetzteMenge2' => 0,
                            'AkuLetzterRabatt1' => 0,
                            'AkuLetzterRabatt2' => 0,
                            'AkuLetzterRabatt3' => 0,
                        ]
                    );
                    continue;
                }
                $positionData['PosTyp'] = 2;
                $currentMaxPosition++;
                $positionData['PosNummer'] = $currentMaxPosition;
                $positionData['PosNummernText'] = $currentMaxPosition;
                try {
                    $newPosition = $this->positionService->createPosition($positionData, $artikel);
                } catch (Throwable $e) {
                    throw new DBSaveException('Fehler beim Speichern der Position: ' . $e->getMessage());
                }
                $notExistArrayAndCreated[] = $newPosition['InternePositionsnummer'];
            }
            return [
                'NichtOptionalePositionen' => $existArrayAndUpdated,
                'OptionalePositionen' => $notExistArrayAndCreated,
            ];
        });
    }
}
