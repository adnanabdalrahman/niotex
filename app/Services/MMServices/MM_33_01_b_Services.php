<?php

namespace App\Services\MMServices;

use App\Models\Adresse;
use App\Models\Artikel;
use App\Models\ArtikelKunde;
use App\Models\Position;
use App\Models\Position3Menge;
use App\Models\Preisbasis;
use App\Models\Vorgang;
use App\Services\PositionService;
use App\Services\PositionServices\Position1WertService;
use App\Services\PositionServices\Position3MengeService;
use App\Services\PositionServices\Position5IndividualService;
use App\Services\PositionServices\PositionWertService;
use App\Services\SapApiClient;
use Exception;
use Illuminate\Support\Facades\Log;


class MM_33_01_b_Services
{
    protected string $mm331_path;

    public function __construct()
    {
        $this->mm331_path = config('sap.mm331_path');
    }

    /**
     * MM_33_01b NU-Auftragspaket
     * CEOSWEB-->CEOS-->SAP
     * @throws Exception
     */
    public function mm_33_01_b_NuAuftragspaket($requestData): ?array
    {
        $vorgang = Vorgang::where('VorNummer', $requestData['Vorgangnummer'])
            ->where('VorGruppe', $requestData['VorGruppe']) //NU
            ->first();

        if ($vorgang === null) {
            Log::error(
                'mm_33_01_b_NuAuftragspaket Kein Vorgang vorhanden',
                ['Vorgangnummer' => $requestData['Vorgangnummer']]
            );
            return null;
        }
        $adresse = Adresse::where('InterneAdressnummer', $vorgang->VorAuftraggeber)->first();
        if ($adresse === null) {
            Log::error("mm_33_01_b_NuAuftragspaket Kein Adresse für Vorgang gefunden");
            return null;
        }

        $tourId = '3025';
        // get all Positions
        $positions = Position::where('InterneVorgangsnummer', $vorgang->InterneVorgangsnummer)->get();
        if ($positions->isEmpty()) {
            Log::error('mm_33_01_b_NuAuftragspaket Keine Positionen vorhanden');
            return null;
        }
        $to_Items = [];
        $artikelNummerArray = [];
        $positionNummerArray = [];
        foreach ($positions as $position) {
            $positionNummerArray[] = $position->PosNummer;

            //get Artikelnummer by $position->InterneArtikelnummer.
            $artikel = Artikel::find($position->InterneArtikelnummer);
            $artikelNummerArray[] = $artikel->Artikelnummer;

            if ($artikel === null) {
                Log::error(
                    'mm_33_01_b_NuAuftragspaket Kein Artikel für Position gefunden',
                    [
                        'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
                        'Position' => $position->InternePositionsnummer,
                        'InterneArtikelnummer' => $position->InterneArtikelnummer
                    ]
                );
                return null;
            }
            $position3Menge = Position3Menge::where('InternePositionsnummer', $position->InternePositionsnummer)
                ->where('InterneVorgangsnummer', $vorgang->InterneVorgangsnummer)
                ->first();
            $to_Items[] = [
                "TourId" => (string)(int)$tourId,
                'Lifnr' => $adresse->AdressNummer,
                'Slgnr' => $vorgang->VorIndividualC3,
                'Vgart' => 'M_RM',//todo clarify with VIVAWEST $vorgang->VorGruppe, erklärt Vor_Gruppe
                'Vbeln' => '',
                'Posnr' => '',
                'Material' => (string)(int)$artikel->Artikelnummer,
                'ShortText' => $artikel->ArtBezeichnung1 ?? "",
                "Quantity" => (string)(int)$position3Menge->PosMenge1,
                "Peinh" => '1',//always 1 //todo clarify from pante
                "CeosData" => "X",
                "Goodsmovement" => "",
                "GoodsmvmtLine" => "",
                "PoUnit" => "",
                "PoNumber" => "",
                "PoItem" => "",
            ];
        }

        $sendData = [
            "TourId" => (string)(int)$tourId,
            "Interface" => 'B',
            "Lifnr" => $adresse->AdressNummer,
            "to_items" => $to_Items
        ];
        Log::info("mm_33_01_b_NuAuftragspaket sent Data", $sendData);
        $result = app(SapApiClient::class)->post($this->mm331_path, $sendData);
        if ($result == null) {
            return null;
        }

        if (isset($result['d'])) {
            $receivedVorgangInfo = $result['d'];
            $vorgang->VorIndividualC6 = $receivedVorgangInfo['PoNumber'];
            $vorgang->VorIndividualC5 = $receivedVorgangInfo['PoItem'];
            $vorgang->save();
        }
        if (isset($result['d']['to_items']['results'])) {
            $receivedPositions = $result['d']['to_items']['results'];
            $notExistArrayAndCreated = [];
            $existArrayAndUpdated = [];
            foreach ($receivedPositions as $key => $receivedPosition) {
                //todo later with PosInt
                $artikel = Artikel::where('Artikelnummer', $receivedPosition['Material'])->first();
                $position = Position::where(
                    'InterneVorgangsnummer', $vorgang->InterneVorgangsnummer,
                )->where(
                    'InterneArtikelnummer', $artikel->InterneArtikelnummer,
                )->first();

                $positionData['InterneVorgangsnummer'] = $vorgang->InterneVorgangsnummer;
                $positionData['VorNummer'] = $vorgang->VorNummer;
                $positionData['PosIndividualD1'] = $receivedPosition['Posnr'];
                $positionData['PosIndividualC1'] = $receivedPosition['PoNumber'];
                $positionData['PosIndividualC2'] = $receivedPosition['PoItem'];
                $positionData['PosIndividualC4'] = $receivedPosition['PoUnit'];
                $positionData['PosIndividualC5'] = $receivedPosition['Quantity'];
                $positionData['PosIndividualC7'] = $vorgang->VorGruppe . ' ' . $vorgang->VorNummer;

                $preisbasis = Preisbasis::where('NRPreisbasis', $receivedPosition['Peinh'])->first();
                $positionData['NRPreisbasis'] = $receivedPosition['Peinh'];
                $positionData['PosPreisfaktor'] = $preisbasis->Preisfaktor;

                $positionData['PosMenge1'] = $receivedPosition['Quantity'];
                $positionData['PosKZMengeneinheit1'] = 'LE';

                $gesamtPreis = $receivedPosition['Netpr'] * $receivedPosition['Quantity'];
                $positionData['externGesamtPreis'] = $gesamtPreis;
                $positionData['externEinzelPreis'] = $receivedPosition['Netpr'];
                $positionData['externMenge'] = $receivedPosition['Quantity'];

                if (in_array($receivedPosition['Material'], $artikelNummerArray)) {
                    $position5Individual = new Position5IndividualService($position->InternePositionsnummer);
                    if ($position5Individual->savePosition5Individual($positionData) === null) {
                        return null;
                    }

                    /* Position1Wert */
                    $position1Wert = new Position1WertService($position->InternePositionsnummer);
                    if ($position1Wert->savePosition1Wert($positionData) === null) {
                        return null;
                    }

                    /* PositionWert */
                    $positionWert = new PositionWertService($position->InternePositionsnummer);
                    $positionWert->savePositionWert($positionData);


                    $position3Menge = new Position3MengeService($position->InternePositionsnummer);
                    if ($position3Menge->savePosition3Menge($positionData) === null) {
                        return null;
                    }
                    $existArrayAndUpdated[] = $position->InternePositionsnummer;

                    //todo bestätigung von Pantie
                    $dataArtikel = [
                        'InterneArtikelnummer' => $artikel->InterneArtikelnummer,
                        'InterneAdressnummer' => $adresse->InterneAdressnummer,
                        'AkuArtikelBezeichnung1' => $receivedPosition['ShortText'],
                        'NRPreisbasis' => $receivedPosition['Peinh'],
                        'AkuLetzterVK' => $gesamtPreis,
                        //-----------------------------------------------------
                        'AkuLetzterRabattWert1' => 0,
                        'AkuLetzterRabattWert2' => 0,
                        'AkuLetzteMenge1' => 0,
                        'AkuLetzteMenge2' => 0,
                        'AkuLetzterRabatt1' => 0,
                        'AkuLetzterRabatt2' => 0,
                        'AkuLetzterRabatt3' => 0,
                    ];

                    $artikelKunde = ArtikelKunde::updateOrCreate(
                        ['InterneArtikelnummer' => $artikel->InterneArtikelnummer,
                            'InterneAdressnummer' => $adresse->InterneAdressnummer
                        ],
                        $dataArtikel
                    );
                } else {
                    $positionData['PosTyp'] = 2;

                    //PosNr
                    $positionNummerArray = array_map('intval', $positionNummerArray);
                    $nextNumber = max($positionNummerArray);
                    while (in_array($nextNumber, $positionNummerArray)) {
                        $nextNumber++;
                    }

                    $positionNummerArray[] = $nextNumber;

                    $positionData['PosNummer'] = $nextNumber + 1;
                    $positionData['PosNummernText'] = $nextNumber + 1;
                    $newPosition = new PositionService();
                    $newPosition = $newPosition->createPosition($positionData, $artikel);
                    if ($newPosition === null) {
                        Log::error('creation Failed');
                        return null;
                    }
                    $notExistArrayAndCreated[] = $newPosition['InternePositionsnummer'];
                }
            }
            return [
                'NichtOptionalePositionen' => $existArrayAndUpdated,
                'OptionalePositionen' => $notExistArrayAndCreated,
            ];
        }
        return null;
    }
}
