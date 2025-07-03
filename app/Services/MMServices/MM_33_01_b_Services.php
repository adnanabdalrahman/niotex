<?php

namespace App\Services\MMServices;

use App\Models\Adresse;
use App\Models\Artikel;
use App\Models\ArtikelKunde;
use App\Models\Position;
use App\Models\Position3Menge;
use App\Models\Position5Individual;
use App\Models\Preisbasis;
use App\Models\Vorgang;
use App\Services\PositionServices\Position1WertService;
use App\Services\SapApiClient;
use Exception;
use Illuminate\Support\Facades\DB;
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
            ->where('VorGruppe', 'NU')
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
            Log::error('Keine Positionen vorhanden');
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
                'Vgart' => 'M_RM',//todo clarify with VIVAWEST $vorgang->VorGruppe,
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
            //$this->handleReceivedData();
            $receivedVorgangInfo = $result['d']['to_items']['results'];
            $vorgang->VorIndividualC6 = $receivedVorgangInfo['PoNumber'] ?? null;
            $vorgang->VorIndividualC5 = $receivedVorgangInfo['PoItem'] ?? null;
            $vorgang->save();
        }
        if (isset($result['d']['to_items']['results'])) {
            $receivedPositions = $result['d']['to_items']['results'];
            $notExistArrayAndCreated = [];
            foreach ($receivedPositions as $key => $receivedPosition) {
                if (in_array($receivedPosition['Material'], $artikelNummerArray)) {
                    $artikel = Artikel::where('Artikelnummer', $receivedPosition['Material'])->first();
                    $position = Position::where(
                        'InterneVorgangsnummer', $vorgang->InterneVorgangsnummer,
                    )->where(
                        'InterneArtikelnummer', $artikel->InterneArtikelnummer,
                    )->first();

                    $position5Individual = Position5Individual::where
                    ('InternePositionsnummer', $position->InternePositionsnummer)->first();
                    if ($position5Individual === null) {
                        DB::connection('sqlsrv2')->table('cis.Position5Individual')->insertGetId([
                            'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
                            'InternePositionsnummer' => $position->InternePositionsnummer,
                            'PosIndividualD1' => $receivedPosition['Posnr'] ?? null,
                            'PosIndividualC1' => $receivedPosition['PoNumber'] ?? null,
                            'PosIndividualC2' => $receivedPosition['PoItem'] ?? null,
                            'PosIndividualC4' => $receivedPosition['PoUnit'] ?? null,
                            'PosIndividualC7' => $vorgang->VorGruppe . ' ' . $vorgang->VorNummer,
                        ]);
                        //todo change it with update or create using model
                    } else {
                        $position5Individual->PosIndividualD1 = $receivedPosition['Posnr'] ?? null;
                        $position5Individual->PosIndividualC1 = $receivedPosition['PoNumber'] ?? null;
                        $position5Individual->PosIndividualC2 = $receivedPosition['PoItem'] ?? null;
                        $position5Individual->PosIndividualC4 = $receivedPosition['PoUnit'] ?? null;
                        $position5Individual->save();
                    }


                    $gesamtPreis = $receivedPosition['Netpr'] * $receivedPosition['Quantity'];
                    $preisbasis = Preisbasis::where('NRPreisbasis', $artikel->NRPreisbasis)->first();

                    /* Position1Wert */
                    $positionData['InterneVorgangsnummer'] = $vorgang->InterneVorgangsnummer;
                    $positionData['PosGesamteinzelpreis'] = $receivedPosition['Netpr'];
                    $positionData['PosDBEinzel'] = $receivedPosition['Netpr'];
                    $positionData['PosPreisEinzel'] = $receivedPosition['Netpr'];
                    $positionData['NRPreisbasis'] = $receivedPosition['Peinh'];
                    $positionData['PosPreisfaktor'] = $preisbasis->Preisfaktor;
                    $positionData['PosPreisPosition'] = $gesamtPreis;
                    $positionData['PosGesamtpreisVorRabatt'] = $gesamtPreis;
                    $positionData['PosGesamtpreis'] = $gesamtPreis;
                    $positionData['PosDBGesamt'] = $gesamtPreis;

                    $position1Wert = new Position1WertService($position->InterneVorgangsnummer);
                    if ($position1Wert->savePosition1Wert($positionData) === null) {
                        return null;
                    }

                    $position3Menge = Position3Menge::updateOrCreate(
                        ['InternePositionsnummer' => $position->InternePositionsnummer],
                        [
                            'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
                            'InternePositionsnummer' => $position->InternePositionsnummer,
                            'PosMenge1' => $receivedPosition['Quantity'],
                            'PosKZMengeneinheit1' => 0,
                            'PosMengeLieferung1' => 0,
                            'PosMengeAbrechnung1' => 0,
                            'PosMengeRechnung1' => 0,
                            'PosMengeVersand1' => 0,
                            'PosMengeAusschuss1' => 0,
                            'PosMenge2' => 0,
                            'PosMengeAuftrag2' => 0,
                            'PosMengeLieferung2' => 0,
                            'PosMengeAbrechnung2' => 0,
                            'PosMengeRechnung2' => 0,
                            'PosMengeVersand2' => 0,
                            'PosMengeAusschuss2' => 0,
                            'PosMultiplikator' => 0,
                            'PosMultiplikatorAuftrag' => 0,
                            'PosMultiplikatorLieferung' => 0,
                            'PosMultiplikatorAbrechnung' => 0,
                            'PosMultiplikatorRechnung' => 0,
                            'PosMultiplikatorVersand' => 0,
                            'PosBundleMenge1' => 0,
                            'PosBundleMenge2' => 0,
                        ]);

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
                    $existArrayAndUpdated[] = $position->InternePositionsnummer;
                } else {
                    $requestData['InterneVorgangsnummer'] = $vorgang->InterneVorgangsnummer;
                    $requestData['VorGruppe'] = $vorgang->VorGruppe;
                    $requestData['VorNummer'] = $vorgang->VorNummer;

                    $requestData['Artikelnummer'] = ltrim($receivedPosition['Material'], '0');


                    $positionNummerArray = array_map('intval', $positionNummerArray); // convert strings to integers for comparison
                    $nextNumber = max($positionNummerArray);
                    while (in_array($nextNumber, $positionNummerArray)) {
                        $nextNumber++;
                    }
                    $requestData['key'] = $nextNumber;
                    $positionNummerArray[] = $nextNumber;

                    $requestData['PosIndividualD1'] = $receivedPosition['Posnr'];
                    $requestData['PosMenge1'] = $receivedPosition['Quantity'];
                    $requestData['PosTyp'] = 2;
                    $requestData['PosKZMengeneinheit1'] = 'LE';

                    $requestData['PosWMengeGesamt1'] = $receivedPosition['Quantity'];
                    $requestData['PosWMengeAuftrag1'] = $receivedPosition['Quantity'];
                    $requestData['PosWMengeAbrechnung1'] = $receivedPosition['Quantity'];
                    $requestData['PosWMengeLieferung1'] = $receivedPosition['Quantity'];
                    $requestData['PosWMengeVersand1'] = $receivedPosition['Quantity'];
                    $requestData['PosWMengeGut1'] = $receivedPosition['Quantity'];
                    $requestData['PosWMengeRechnung1'] = $receivedPosition['Quantity'];

                    $gesamtPreis = $receivedPosition['Netpr'] * $receivedPosition['Quantity'];

                    $requestData['PosGesamteinzelpreis'] = $receivedPosition['Netpr'];
                    $requestData['PosDBEinzel'] = $receivedPosition['Netpr'];
                    $requestData['PosPreisEinzel'] = $receivedPosition['Netpr'];
                    $requestData['PosWEinzelpreisMinusRabatt'] = $receivedPosition['Netpr'];

                    $requestData['PosPreisPosition'] = $gesamtPreis;
                    $requestData['PosGesamtpreis'] = $gesamtPreis;
                    $requestData['PosDBGesamt'] = $gesamtPreis;

                    $newPosition = new PositionService();
                    $newPosition = $newPosition->createPosition($requestData);
                    if ($newPosition === null) {
                        Log::error('creation Failed');
                        return null;
                    }
                    $notExistArrayAndCreated[] = $newPosition['InternePositionsnummer'];
                }

            }
            dd($notExistArrayAndCreated, $existArrayAndUpdated, $result);

        }


        /*
"Lifnr" => "6020020"
"TourId" => "3025"
"Interface" => "B"
"PoNumber" => "4700056981"
"PoItem" => "00010"

//"Goodsmovement" => ""
//"Vgart" => "M_RM"
//"TourId" => "3025"
//"GoodsmvmtLine" => "0000"
//"Lifnr" => "6020020"
//"Slgnr" => "510003001"
//"Vbeln" => ""

"CeosData" => "X"

"Posnr" => "000000"     $position5Individual->PosIndividualD1
"Material" => "99900021"  Position Artikelnummer
"Quantity" => "36.000" (string)(int)$position3Menge->PosMenge1
"Netpr" => "12.790" $artikelKunde->AkuLetzterVK,
"ShortText" => "Neumontage und Regeltausch Wasserzähle" $artikelKunde->AkuArtikelBezeichnung1
"Peinh" => "1"$artikelKunde->AkuArtikelBezeichnung1

"PoUnit" => ""
"PoNumber" => "4700056980"   $position5Individual->PosIndividualC1
"PoItem" => "00010" $position5Individual->PosIndividualC2

}
*/

    }


}
