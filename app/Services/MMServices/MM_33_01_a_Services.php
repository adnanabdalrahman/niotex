<?php

namespace App\Services\MMServices;

use App\Exceptions\DBSaveException;
use App\Exceptions\InvalidSapResponseException;
use App\Exceptions\ResourceNotFoundException;
use App\Models\Adresse;
use App\Models\Artikel;
use App\Models\Position;
use App\Models\Position3Menge;
use App\Models\Position5Individual;
use App\Models\Vorgang;
use App\Services\SapApiClient;
use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;


class MM_33_01_a_Services
{
    protected string $mm331_path;

    public function __construct()
    {
        $this->mm331_path = config('sap.mm331_path');
    }


    /**
     * CEOSWEB-->CEOS-->SAP
     * @throws Exception|Throwable
     */
    public function mm_33_01_a_NuLeistungsbestaetigung($requestData): ?array
    {
        $vorgang = Vorgang::where('VorNummer', $requestData['Vorgangnummer'])
            ->where('VorGruppe', $requestData['VorGruppe']) // NU
            ->first();
        if ($vorgang === null) {
            throw new ResourceNotFoundException('Kein Vorgang gefunden',
                ["InterneAdressnummer" => $requestData['Vorgangnummer']]
            );
        }
        $adresse = Adresse::where('InterneAdressnummer', $vorgang->VorAuftraggeber)->first();
        if ($adresse === null) {
            throw new ResourceNotFoundException('Keine Adresse für den Vorgang gefunden.',
                ["InterneAdressnummer" => $vorgang->VorAuftraggeber]
            );
        }

        $positions = Position::where('InterneVorgangsnummer', $vorgang->InterneVorgangsnummer)
            ->select([
                'InternePositionsnummer',
                'InterneArtikelnummer',
                'PosTyp',
            ])->get();

        if ($positions->isEmpty()) {
            throw new ResourceNotFoundException('Keine Positionen für den Vorgang gefunden.',
                ["InterneVorgangsnummer" => $vorgang->InterneVorgangsnummer]
            );
        }

        $artikelCollection = Artikel::whereIn(
            'InterneArtikelnummer',
            $positions->pluck('InterneArtikelnummer')->unique()
        )->select([
            'InterneArtikelnummer',
            'Artikelnummer',
            'ArtBezeichnung1',
        ])->get()->keyBy('InterneArtikelnummer');

        $position3Mengen = Position3Menge::whereIn(
            'InternePositionsnummer',
            $positions->pluck('InternePositionsnummer')->unique()
        )->select([
            'InternePositionsnummer',
            'PosMenge1',
        ])->get()->keyBy('InternePositionsnummer');
        $position5IndividualCollection = Position5Individual::whereIn(
            'InternePositionsnummer',
            $positions->pluck('InternePositionsnummer')->unique()
        )->select([
            'InternePositionsnummer',
            'PosIndividualC2',
        ])->get()->keyBy('InternePositionsnummer');
        $to_Items = [];
        /** @var Position $position */
        foreach ($positions as $position) {
            if ((int)$position->PosTyp === 2) {
                continue;
            }
            $artikel = $artikelCollection[$position->InterneArtikelnummer] ?? null;
            if ($artikel === null) {
                throw new ResourceNotFoundException('Kein Artikel für die Position gefunden.',
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
                throw new ResourceNotFoundException('Keine Position5Individual-Daten für die Position gefunden.',
                    [
                        'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
                        'Position' => $position->InternePositionsnummer,
                        'InterneArtikelnummer' => $position->InterneArtikelnummer
                    ]);
            }

            $to_Items[] = [
                'TourId' => (string)$requestData['tourId'],
                'Lifnr' => $adresse->AdressNummer,
                'Slgnr' => $vorgang->VorIndividualC3,
                'Vgart' => $position5Individual->PosIndividualC2,
                'Vbeln' => '',
                'Posnr' => '',
                'Material' => (string)(int)$artikel->Artikelnummer,
                'ShortText' => $artikel->ArtBezeichnung1 ?? "",
                "Quantity" => (string)(int)$position3Menge->PosMenge1,
                //"Netpr" => $artikelKunde->AkuLetzterVK,
                "Peinh" => '1',
                "CeosData" => "X",
                "Goodsmovement" => "",
                "GoodsmvmtLine" => "",
                "PoUnit" => "",
                "PoNumber" => (string)(int)$vorgang->VorIndividualD6,
                "PoItem" => $vorgang->VorIndividualC5 ?? "",
            ];
        }
        $requestData = [
            "TourId" => (string)$requestData['tourId'],
            "Interface" => 'A',
            "Lifnr" => $adresse->AdressNummer,
            "PoNumber" => (string)(int)$vorgang->VorIndividualD6,
            "Datv" => $this->formatSapDate($vorgang->VorIndividualT1 ?? null),
            "Datb" => $this->formatSapDate($vorgang->VorIndividualT2 ?? null),
            "to_items" => $to_Items
        ];

        Log::info("mm_33_01_a_NuLeistungsbestaetigung sent Data", $requestData);
        $result = app(SapApiClient::class)->post($this->mm331_path, $requestData);
        Log::info('mm_33_01_a_NuLeistungsbestaetigung received Response', $result);

        if (!isset($result['d']) ||
            !isset($result['d']['TourId']) ||
            !isset($result['d']['to_items']['results']) ||
            !is_array($result['d']['to_items']['results'])
        ) {
            throw new InvalidSapResponseException('Ungültige SAP-Antwort.');
        }
        try {
            $vorgang->VorStatus = 100300;
            $vorgang->save();
        } catch (Throwable $e) {
            throw new DBSaveException('Fehler beim Speichern des Vorgangsstatus: ' . $e->getMessage());
        }

        $receivedPositionsArray = $result['d']['to_items']['results'];
        $sendPositionsArray = [];
        foreach ($receivedPositionsArray as $key => $position) {
            if (!isset($position['GoodsmvmtLine'], $position['Goodsmovement'])) {
                throw new InvalidSapResponseException('SAP-Positionsantwort ist unvollständig.',
                    ['position' => $position]
                );
            }
            $sendPositionsArray[$key]['GoodsmvmtLine'] = $position['GoodsmvmtLine'];
            $sendPositionsArray[$key]['Goodsmovement'] = $position['Goodsmovement'];
        }
        return [
            'Header' => [
                'tourId' => $result['d']['TourId'],
            ],
            'Positions' => $sendPositionsArray,
        ];

    }

    private function formatSapDate(?string $date): ?string
    {
        if (empty($date)) {
            return null;
        }
        return '/Date(' . strtotime($date) * 1000 . ')/';
    }
}
