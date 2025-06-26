<?php

namespace App\Services;

use App\Models\Adresse;
use App\Models\Artikel;
use App\Models\Artikelgruppe;
use App\Models\ArtikelKunde;
use App\Models\ArtikelLager;
use App\Models\ArtikelLieferant;
use App\Models\ArtikelUntergruppe;
use App\Models\Basisempfindlichkeit;
use App\Models\Position;
use App\Models\Position3Menge;
use App\Models\Produktgruppe;
use App\Models\Vorgang;
use App\Models\Warengruppe;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;


class MMServices
{
    protected string $baseUrl;
    protected string $mm221_path;
    protected string $mm341_path;
    protected string $mm331_path;
    protected string $mm352_path;

    protected array $auth;

    public function __construct()
    {
        $this->baseUrl = config('sap.base_url');
        $this->auth = [
            'client_id' => config('sap.client_id'),
            'client_secret' => config('sap.client_secret'),
        ];

        $this->mm221_path = config('sap.mm221_path');
        $this->mm341_path = config('sap.mm341_path');
        $this->mm352_path = config('sap.mm352_path');
        $this->mm331_path = config('sap.mm331_path');
    }


    /**
     * MM-31-1 Materialstammdaten
     * SAP -> CEOS
     */
    public function mm_31_01_materialstammdaten($data): ?array
    {

        /*
       Basismengeneinheit =>  Artikel.KZArtMengeneinheit1 (m:1)→cis.Mengeneinheit.KZMengeneinheit
       - saved as it is
       // todo mapping to our Mengeneinheit Skipatron = KG--> Coes = kg //LE fehlt: noch klären VE fehlt: hinzufügen
       - todo should exist in Mengeneinheit.KZMengeneinheit Validation
       - NULL ACCEPTED
   -----------------------------------------------------------------------------
       todo
       HIBEzuHAWA1 =>  String (18)
       HIBEzuHAWA2 => String (18)
       HIBEzuHAWA3 => String (18)
        */

        //trim Artikelnummer
        $data['Material'] = ltrim($data['Material'], '0');

        //Validate Warengruppe
        $validateWarengruppe = Warengruppe::where('KZWarengruppe', $data['CEOSWarengruppe'])->first();
        if ($validateWarengruppe === null) {
            Log::error('Kein Warengruppe für diese Material ', $data);
            return null;
        }

        //Validate KZWarengruppe+KZArtikelgruppe
        $validateArtikelGruppe = Artikelgruppe::where('KZArtikelgruppe', $data['CEOSArtikelgruppe'])
            ->where('KZWarengruppe', $data['CEOSWarengruppe'])
            ->first();
        if ($validateArtikelGruppe === null) {
            Log::error('Kein Artikelgruppe für diese Material ', $data);
            return null;
        }

        //Validate Produktgruppe saved as it comes directly - NULL ACCEPTED
        $validateProduktgruppe = Produktgruppe::where('KZProduktgruppe', $data['Produktgruppe'])->first();
        if ($validateProduktgruppe === null) {
            Log::info('Kein Produktgruppe für diese Material ', $data);
        }

        $artikelUntergruppe = ArtikelUntergruppe::where('KZUnterArtikelgruppe', $data['CEOSArtikeluntergruppe'])
            ->where('KZWarengruppe', $data['CEOSWarengruppe'])
            ->where('KZArtikelgruppe', $data['CEOSArtikelgruppe'])
            ->first();

        $data['ArtikelUntergruppeID'] = null;
        if ($artikelUntergruppe !== null) {
            $data['ArtikelUntergruppeID'] = $artikelUntergruppe->ArtikelUntergruppeID;
        }
        //EAN Splitt
        $artEAN1 = substr($data['EANNummerSAP'], 0, 8); // first 8 characters
        $artEAN2 = substr($data['EANNummerSAP'], 8, 8);

        $data['NRPreisbasis'] = 1;
        $data['MwstNummer'] = 3;
        $data['ArtVerkaufspreis1'] = 0;
        $data['ArtMaterialkosten'] = 0;
        $data['ArtSondereinzelkosten'] = 0;
        $data['ArtStkAuftragLagerbuchung'] = 0;
        $data['ArtFremdFertigungskosten'] = 0;
        $data['ArtFertigungskosten'] = 0;
        //    ------------------------------------
        $data['ArtRabattfaehigJN'] = 0;
        $data['ArtSeriennummernfaehigJN'] = 0;
        $data['ArtStuecklisteJN'] = 0;
        $data['ArtProvisionsfaehigJN'] = 0;
        $data['ArtLieferantenfaehigJN'] = 1;
        $data['ArtVerkaufsfaehigJN'] = 1;
        $data['ArtSkontofaehigJN'] = 0;

        if ($data['LVorm'] === null) {
            $data['LVorm'] = 0;
        } else {
            $data['LVorm'] = 1;
        }

        try {
            $artikel = Artikel::updateOrCreate(
                ['Artikelnummer' => $data['Material']],
                [
                    'Artikelnummer' => $data['Material'],
                    'ArtMatchcode' => $data['Material'],
                    'ArtBezeichnung1' => $data['Materialkurztext'], // ArtMatchcode
                    'ArtBezeichnung2' => $data['Bezeichnung1'] . "|" . $data['Bezeichnung2'],
                    'KZArtMengeneinheit1' => $data['Basismengeneinheit'],
                    'ArtAltJN' => $data['LVorm'],
                    'ArtIndividualC5' => $data['BKSchluessel'],
                    'KZWarengruppe' => $data['CEOSWarengruppe'],
                    'KZArtikelgruppe' => $data['CEOSArtikelgruppe'],
                    'ArtikelUntergruppeID' => $data['ArtikelUntergruppeID'],
                    'KZProduktgruppe' => $data['Produktgruppe'],
                    'ArtEAN1' => $artEAN1,
                    'ArtEAN2' => $artEAN2,
                    // default values for CEOS
                    'NRPreisbasis' => $data['NRPreisbasis'],
                    'MwstNummer' => $data['MwstNummer'],
                    'ArtVerkaufspreis1' => $data['ArtVerkaufspreis1'],
                    'ArtMaterialkosten' => $data['ArtMaterialkosten'],
                    'ArtSondereinzelkosten' => $data['ArtSondereinzelkosten'],
                    'ArtStkAuftragLagerbuchung' => $data['ArtStkAuftragLagerbuchung'],
                    'ArtFremdFertigungskosten' => $data['ArtFremdFertigungskosten'],
                    'ArtFertigungskosten' => $data['ArtFertigungskosten'],
                    'ArtRabattfaehigJN' => $data['ArtRabattfaehigJN'],
                    'ArtSeriennummernfaehigJN' => $data['ArtSeriennummernfaehigJN'],
                    'ArtStuecklisteJN' => $data['ArtStuecklisteJN'],
                    'ArtProvisionsfaehigJN' => $data['ArtProvisionsfaehigJN'],
                    'ArtLieferantenfaehigJN' => $data['ArtLieferantenfaehigJN'],
                    'ArtVerkaufsfaehigJN' => $data['ArtVerkaufsfaehigJN'],
                ]
            );
            $interneArtikelNummer = $artikel['InterneArtikelnummer'];
        } catch (Exception $e) {
            Log::error(
                'mm_31_01_materialstammdaten Save Artikel Error:' . $e->getMessage(),
                ['Material' => $data['Material']]
            );
            return null;
        }

        // add Basisempfindlichkeit
        try {
            Basisempfindlichkeit::updateOrCreate(
                ['InterneArtikelNummer' => $interneArtikelNummer],
                [
                    'InterneArtikelNummer' => $interneArtikelNummer,
                    'BasisempfindlichkeitSkala' => $data['Basisempfindlichkeit'],
                ]
            );
        } catch (Exception $e) {
            Log::error(
                'mm_31_01_materialstammdaten Save Basisempfindlichkeit Error' . $e->getMessage(),
                ['Material' => $data['Material']]
            );
            return null;
        }

        //  Lieferschein (Hersteller)
        if ($data['Hersteller'] !== null) {
            $adressnummer = ltrim($data['Hersteller'], '0');

            $adresse = Adresse::where('AdressNummer', $adressnummer)->first();
            if ($adresse === null) {
                Log::error(
                    'mm_31_01_materialstammdaten Kein Adresse für Lieferschein gefunden',
                    ['AdressNummer' => $adressnummer]
                );
                return null;
            }
            $interneAdressnummer = $adresse->InterneAdressnummer;
            try {
                ArtikelLieferant::updateOrCreate(
                    [
                        'InterneAdressnummer' => $interneAdressnummer,
                        'InterneArtikelnummer' => $interneArtikelNummer
                    ],
                    [
                        'InterneAdressnummer' => $interneAdressnummer,
                        'InterneArtikelnummer' => $interneArtikelNummer,
                        'AliBestellnummer' => $data['Herstellerteilenummer'],
                        'AliLetzterEK' => 0,
                        'AliLetzteMenge1' => 0,
                        'AliLetzteMenge2' => 0,
                        'AliLetzterRabatt1' => 0,
                        'AliLetzterRabatt2' => 0,
                        'AliLetzterRabatt3' => 0,
                        'AliLetzterRabattWert1' => 0,
                        'AliLetzterRabattWert2' => 0,
                        'AliMindestbestellmenge' => 0,
                    ]
                );
            } catch (Exception $e) {
                Log::error(
                    "mm_31_01_materialstammdaten Lieferschein Error: " . $e->getMessage(),
                    ['Material' => $data['Material']]
                );
                return null;
            }
        }

        return [
            'interneArtikelnummer' => $interneArtikelNummer,
            'Material' => $data['Material'],
        ];
    }

    //MM_34_01 Umlagerungsreservierung

    /**
     * MM-34-1 Umlagerungsreservierung
     * Receive material data from SAP.
     *
     * @throws Exception
     */

    public function mm_34_01_umlagerungsreservierung($data): ?bool
    {
        // todo source data from CEOS mapping
        // what to do with the received data??

        /*
            Basistermin für die Reservierung
            Materialnummer
            Benötigte Menge
            Mengeneinheit
            Tour ID für die Bearbeitung
            Empfangener Lagerort (oder)
            Empfangener Lagerort wird ermittelt (CHAR 20 Datenfeld, da die Ermittlung des Lagerortes auch über die Kreditorennummer des Nachunternehmers oder die Anmeldekennung des eigenen Handwerkers in SAP erfolgen kann)
            Statusfeld für Rückmeldung SAP an CEOS mit Reservierungsnummer
            Statusfeld für Fehlertext falls Verbuchung nicht funktioniert hat


            Tour ID für die Bearbeitung  => TourID
            Reservierungsnummer (lieferscheinnr) => ReservationNumber
            Materialnummer Artikelstammsatz => Material
            EmpfangenderLagerort => ReceivingStorage
            Empfangener Lagerort wird ermittelt  => SupplierStorage
            Benötigte Menge => NeededAmount
            Mengeneinheit => UoM
            Nachrichtentext => Remark
            Bedarfstermin => TourDate  ReqDate()

            // todo
            - to clerify from Vivawest
            - was ist MoveStloc in Payload ?
            - was ist MoveStlocSearch in Payload ?
            - ist ReqDate gleich TourDate (Bedarfstermin) ?
            Wieso ist die Payload nicht mit den vereinbarten Schnittstellenfeldern zugeordnet?


            - Datumsformat von uns wird so geschickt: 2025-03-31 09:41:05.000
            - wo ist Nachrichtentext in Payload?
            - Warum TourId und Bedarfstermin in jeder position ?
            - Response is von uns nicht brauchbar ist das eine Empfangsbestätigung? Wo steht zB die Fehlermeldung falls vorhanden.


            TourID
            Nachrichtentext
             "MoveStloc":"H001",
            {
                Material
                Menge
                Mengeneinheit
                Bedarfstermin
            },
            {
                Material
                Menge
                Mengeneinheit
                Bedarfstermin
            }

        response success => ReservNo
        response Error =>
                {
            "error": {
                "code": "0050569259751EE4BA9710043F8A5115",
                "message": {
                    "lang": "de",
                    "value": "Im Rahmen der Datenservices ist ein unbekannter interner Serverfehler aufgetreten"
                },
                "innererror": {
                    "transactionid": "36A6D97C62BB0240E006810DB73F35AF",
                    "timestamp": "20250522140226.5639860",
                    "Error_Resolution": {
                        "SAP_Transaction": "For backend administrators: run transaction /IWFND/ERROR_LOG on SAP Gateway hub system and search for entries with the timestamp above for more details",
                        "SAP_Note": "See SAP Note 1797736 for error analysis (https://service.sap.com/sap/support/notes/1797736)"
                    }
                }
            }
        }

*/
        $vorgang = Vorgang::where('VorNummer', $data['Vorgangnummer'])
            ->where('VorGruppe', 'RE') // todo After Test return to M_LG
            ->first();

        if ($vorgang === null) {
            Log::error(
                'mm_34_01_umlagerungsreservierung Kein Vorgang vorhanden',
                ['Vorgangnummer' => $data['Vorgangnummer']]
            );
            return null;
        }

        //todo later get date from Blau (now Fake + 10 days)
        $milliseconds = now()->addDays(10)->timestamp * 1000;
        $tourDate = "/Date({$milliseconds})/";

        $tourId = '1025'; // todo after test return to $vorgang->VorIndividualD5;
        // get all Positions
        $positions = Position::where('InterneVorgangsnummer', $vorgang->InterneVorgangsnummer)->get();

        $to_Items = [];
        foreach ($positions as $position) {
            if ($position->InterneArtikelnummer === null) {
                Log::error(
                    'mm_34_01_umlagerungsreservierung Kein InterneArtikelnummer in Position gefunden',
                    [
                        'InterneVorgangsnummer' => $data['Vorgangnummer'],
                        'Position' => $position->InternePositionsnummer
                    ]
                );
                return null;
            }
            //get Artikelnummer by $position->InterneArtikelnummer.
            $artikel = Artikel::find($position->InterneArtikelnummer);

            if ($artikel === null) {
                Log::error(
                    'mm_34_01_umlagerungsreservierung Kein Artikel für Position gefunden',
                    [
                        'InterneVorgangsnummer' => $data['Vorgangnummer'],
                        'Position' => $position->InternePositionsnummer,
                        'InterneArtikelnummer' => $position->InterneArtikelnummer
                    ]
                );
                //todo Clarify if continue or Out
                continue;
            }

            $position3Menge = Position3Menge::where('InternePositionsnummer', $position->InternePositionsnummer)
                ->where('InterneVorgangsnummer', $vorgang->InterneVorgangsnummer)
                ->first();
            $to_Items[] = [
                'Material' => $artikel->Artikelnummer,
                "EntryQnt" => (string)(int)$position3Menge->PosMenge1,
                "EntryUom" => 'ST', //todo should from DB but not Stck , ST
                "ReqDate" => $tourDate,
            ];
        }

        $data = [
            "TourId" => (string)(int)$tourId,
            "Remark" => "Test Remark", //todo later from Florian MAX 50 also in Florian page Max 50
            "MoveStloc" => "",
            "to_Items" => $to_Items
        ];
        Log::info("mm_34_01_umlagerungsreservierung sent Data", $data);
        $response = app(SapApiClient::class)->post($this->mm341_path, $data);
        Log::info("mm_34_01_umlagerungsreservierung received Data", $response);


        $reservNo = $response['d']['ReservNo'] ?? null;
        $reservNo = ltrim($reservNo, '0');
        $lager = $response['d']['MoveStloc'] ?? null;

        if ($reservNo !== null) {
            $vorgang->VorStatus = 100100;
            $vorgang->VorIndividualD6 = $reservNo;
            $vorgang->save();
            return $response;
        }
        return null;
    }

    /**
     * MM-22-1 Abfrage nach Lagerbestände
     * Get stock Level from SAP.
     * @param string $interneArtikelnummer
     * @param string $lager
     * @return array|null
     */
    public function mm_22_01_lagerbestaende(string $artikelnummer, string $lager): ?array
    {
        $data = "?\$filter=Material eq '{$artikelnummer}' and Storage eq '{$lager}'  and Plant eq '1270'";
        try {
            $response = app(SapApiClient::class)->get($this->mm221_path, $data);
            if ($response === null) {
                Log::error('mm_22_01_lagerbestaende Error Response', $response);
            }

            if (isset($response['d']['results'][0]['Amount'])) {
                $amount = ($response['d']['results'][0]['Amount']);
                $artikel = Artikel::where('Artikelnummer', $artikelnummer)->first();
                ArtikelLager::updateOrCreate(
                    [
                        'interneArtikelnummer' => $artikel->InterneArtikelnummer
                    ],
                    [
                        'AlaPhysikalischeMenge1' => $amount,
                    ]
                );
            } else {
                Log::error('mm_22_01_lagerbestaende Kein Amount gefunden', $response);
                return null;
            }
        } catch (Exception|NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            Log::error('mm_22_01_lagerbestaende' . $e->getMessage());
            return null;
        }
        return [
            'artikelnummer' => $artikelnummer,
            'amount' => $amount
        ];
    }


    /**
     * @throws Exception
     */
    public function mm_35_02_materialverbrauch($data)
    {
        $vorgang = Vorgang::where('VorNummer', $data['Vorgangnummer'])
            ->where('VorGruppe', 'RE') //todo return to M_LG
            ->first();

        if ($vorgang === null) {
            Log::error(
                'mm_35_02_materialverbrauch Kein Vorgang vorhanden',
                ['Vorgangnummer' => $data['Vorgangnummer']]
            );
            return null;
        }
        $adresse = Adresse::where('InterneAdressnummer', $vorgang->VorAuftraggeber)->first();
        if ($adresse === null) {
            Log::error("mm_35_02_materialverbrauch Kein Adresse für Vorgang gefunden");
            return null;
        }

        $tourId = '1025';//todo later $vorgang->VorIndividualD5;
        //todo later get date from Blau (now Fake + 10 days)
        $milliseconds = now()->addDays(10)->timestamp * 1000;
        $tourDate = "/Date({$milliseconds})/";

        $positions = Position::where('InterneVorgangsnummer', $vorgang->InterneVorgangsnummer)->get();
        if ($positions->isEmpty()) {
            Log::error('Keine Positionen vorhanden');
            return null;
        }
        $to_Items = [];
        foreach ($positions as $position) {
            $artikel = Artikel::find($position->InterneArtikelnummer);

            if ($artikel === null) {
                Log::error(
                    'mm_35_02_materialverbrauch Kein Artikel für Position gefunden',
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
                'MoveDate' => $tourDate, //todo clarify if correct (should from Ceos comes)
                'Material' => (string)(int)$artikel->Artikelnummer,
                "MoveType" => "261",
                "Storage" => '',// todo clarify later
                "DynamicStorage" => $adresse->AdressNummer,
                "EntryQnt" => (string)(int)$position3Menge->PosMenge1,
                "EntryUom" => "ST",
                'Vbeln' => '',
                'Posnr' => '',
                'Slgnr' => $vorgang->VorIndividualC3,
                'Vgart' => 'M_RM', // 'M',//todo clarify with VIVAWEST $vorgang->VorGruppe,
                "TourId" => $tourId,
            ];
        }

        $data = [
            "TourId" => (string)(int)$tourId,
            "MoveDate" => $tourDate,
            "to_Items" => $to_Items
        ];
        Log::info("mm_35_02_materialverbrauch sent Data", $data);
        $response = app(SapApiClient::class)->post($this->mm352_path, $data);
        return $response;
    }

    /**
     * @throws Exception
     */
    public function mm_33_01_a_Leistungsbestaetigung($data)
    {
        $vorgang = Vorgang::where('VorNummer', $data['Vorgangnummer'])
            ->where('VorGruppe', 'NU')
            ->first();

        if ($vorgang === null) {
            Log::error(
                'mm_33_01_a_Leistungsbestaetigung Kein Vorgang vorhanden',
                ['Vorgangnummer' => $data['Vorgangnummer']]
            );
            return null;
        }
        $adresse = Adresse::where('InterneAdressnummer', $vorgang->VorAuftraggeber)->first();
        if ($adresse === null) {
            Log::error("mm_33_01_a_Leistungsbestaetigung Kein Adresse für Vorgang gefunden");
            return null;
        }

        $tourId = $vorgang->VorIndividualD5;

        $positions = Position::where('InterneVorgangsnummer', $vorgang->InterneVorgangsnummer)->get();
        if ($positions->isEmpty()) {
            Log::error('Keine Positionen vorhanden');
            return null;
        }
        $to_Items = [];
        foreach ($positions as $position) {
            if ($position->PosTyp == 2) {
                continue;
            }

            $artikel = Artikel::find($position->InterneArtikelnummer);
            /*
             *              todo clarify

                      $artikelKunde = ArtikelKunde::where('InterneArtikelnummer', $artikel->InterneArtikelnummer)
                          ->where('InterneAdressnummer', $adresse->InterneAdressnummer)
                          ->first();
                      if ($artikelKunde === null) {
                          Log::error(
                              'mm_33_01_a_Leistungsbestaetigung Kein ArtikelKunde gefunden',
                              ['InterneArtikelnummer' => $artikel->InterneArtikelnummer]
                          );
                          return null;
                      }
          */
            if ($artikel === null) {
                Log::error(
                    'mm_33_01_a_Leistungsbestaetigung Kein Artikel für Position gefunden',
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
                'TourId' => (string)(int)$tourId,
                'Lifnr' => $adresse->AdressNummer,
                'Slgnr' => $vorgang->VorIndividualC3,
                'Vgart' => 'M_RM', // 'M',//todo clarify with VIVAWEST $vorgang->VorGruppe,
                'Vbeln' => '',
                'Posnr' => '',
                'Material' => (string)(int)$artikel->Artikelnummer,
                'ShortText' => $artikel->ArtBezeichnung1 ?? "",
                "Quantity" => (string)(int)$position3Menge->PosMenge1,
                //"Netpr" => $artikelKunde->AkuLetzterVK,
                "Peinh" => '1',//always 1 //todo clarify from pante
                "CeosData" => "X",
                "Goodsmovement" => "",
                "GoodsmvmtLine" => "",
                "PoUnit" => "",
                "PoNumber" => "",
                "PoItem" => '',
            ];
        }

        $data = [
            "TourId" => (string)(int)$tourId,
            "Interface" => 'A',
            "Lifnr" => $adresse->AdressNummer,
            "PoNumber" => $vorgang->VorIndividualC6,
            "to_items" => $to_Items
        ];
        Log::info("mm_33_01_a_Leistungsbestaetigung sent Data", $data);
        return app(SapApiClient::class)->post($this->mm331_path, $data);
    }


    /**
     * @throws Exception
     */
    public function mm_33_01_b_NuAuftragspaket($data): ?array
    {
        $vorgang = Vorgang::where('VorNummer', $data['Vorgangnummer'])
            ->where('VorGruppe', 'NU')
            ->first();

        if ($vorgang === null) {
            Log::error(
                'mm_33_01_b_NuAuftragspaket Kein Vorgang vorhanden',
                ['Vorgangnummer' => $data['Vorgangnummer']]
            );
            return null;
        }
        $adresse = Adresse::where('InterneAdressnummer', $vorgang->VorAuftraggeber)->first();
        if ($adresse === null) {
            Log::error("mm_33_01_b_NuAuftragspaket Kein Adresse für Vorgang gefunden");
            return null;
        }

        $tourId = $vorgang->VorIndividualD5;

        // get all Positions
        $positions = Position::where('InterneVorgangsnummer', $vorgang->InterneVorgangsnummer)->get();
        if ($positions->isEmpty()) {
            Log::error('Keine Positionen vorhanden');
            return null;
        }
        $to_Items = [];
        foreach ($positions as $position) {
            //get Artikelnummer by $position->InterneArtikelnummer.
            $artikel = Artikel::find($position->InterneArtikelnummer);
            /*
             todo clarify
                        $artikelKunde = ArtikelKunde::where('InterneArtikelnummer', $artikel->InterneArtikelnummer)
                            ->where('InterneAdressnummer', $adresse->InterneAdressnummer)
                            ->first();
                        if ($artikelKunde === null) {
                            Log::error(
                                'mm_33_01_b_NuAuftragspaket Kein ArtikelKunde gefunden',
                                ['InterneArtikelnummer' => $artikel->InterneArtikelnummer]
                            );
                            return null;
                        }
            */
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
                //"Netpr" => $artikelKunde->AkuLetzterVK,
                "Peinh" => '1',//always 1 //todo clarify from pante
                "CeosData" => "X",
                "Goodsmovement" => "",
                "GoodsmvmtLine" => "",
                "PoUnit" => "",
                "PoNumber" => "",
                "PoItem" => "",
            ];
        }

        $data = [
            "TourId" => (string)(int)$tourId,
            "Interface" => 'B',
            "Lifnr" => $adresse->AdressNummer,
            "to_items" => $to_Items
        ];
        Log::info("mm_33_01_b_NuAuftragspaket sent Data", $data);
        return app(SapApiClient::class)->post($this->mm331_path, $data);
    }


    public function mm_37_1_NuLeistungspositionen($data): ?array
    {
        //todo with pantie DatumBis muss auch gespeichert
        try {
            $adressnummer = $data['header']['kreditor'];
            $adresse = Adresse::where('AdressNummer', $adressnummer)->first();
            if ($adresse === null) {
                Log::error('mm_37_1_NuLeistungspositionen Adresse nicht gefunden: ' . $adressnummer);
                return null;
            }

            $gueltigVon = Carbon::parse($data['header']['gueltigVon'])->format('Ymd');
            $gueltigBis = Carbon::parse($data['header']['gueltigBis'])->format('Ymd');
            $artikelKundeIds = [];
            foreach ($data['positions'] as $position) {
                //getInterneArtikelnummer
                $artikelNummer = ltrim($position['materialnummer'], '0');
                $artikel = Artikel::where('ArtikelNummer', $artikelNummer)->first();
                if ($artikel === null) {
                    Log::error('mm_37_1_NuLeistungspositionen Artikel nicht gefunden: ' . $artikelNummer);
                    return null;
                }

                //set artikel as Inactive
                if ($position['loeschkennzeichen'] !== null) {
                    $artikel->ArtAltJN = 1;
                    $artikel->save();
                }

                $dataArtikel = [
                    'AkuBestellnummer' => $position['kontraktnummer'],
                    'AkuArtikelBezeichnung2' => $position['kontraktposition'],
                    'InterneArtikelnummer' => $artikel->InterneArtikelnummer,
                    'InterneAdressnummer' => $adresse->InterneAdressnummer,
                    'AkuArtikelBezeichnung1' => $position['materialkurztext'],
                    'NRPreisbasis' => $position['preismengeneinheit'],
                    'AkuLetzterVK' => $position['preis'],
                    'AkuIndividualT1' => $gueltigVon,
                    'AkuIndividualT2' => $gueltigBis,

                    //-----------------------------------------------------
                    'AkuLetzterRabattWert1' => 0,
                    'AkuLetzterRabattWert2' => 0,
                    'AkuLetzteMenge1' => 0,
                    'AkuLetzteMenge2' => 0,
                    'AkuLetzterRabatt1' => 0,
                    'AkuLetzterRabatt2' => 0,
                    'AkuLetzterRabatt3' => 0,
                ];


                $artikelKunde = ArtikelKunde::where('InterneArtikelnummer', $artikel->InterneArtikelnummer)
                    ->where('InterneAdressnummer', $adresse->InterneAdressnummer)
                    ->first();
                //check if exist before or not :
                if ($artikelKunde === null) {
                    //No => create new one.
                    $artikelKunde = ArtikelKunde::create($dataArtikel);
                } else {
                    //yes =>  check if Gültigab(AkuIndividualT1) tha same or not
                    $akuIndividualT1 = Carbon::parse($artikelKunde->AkuIndividualT1)->format('Ymd');

                    if ($gueltigVon == $akuIndividualT1) {
                        // if same we should change only the Preis
                        $artikelKunde->AkuLetzterVK = $position['preis'];
                        $artikelKunde->save();
                    } else {
                        // if not, check if AkuVKNeuDatum,AkuVKNeu Empty or not
                        if ($artikelKunde->AkuVKNeu === null) {
                            // if Empty => add Gültigab in AkuVKNeuDatum and New Preis(Preis) in AkuVKNeu
                            $artikelKunde->AkuVKNeu = $position['preis'];
                            $artikelKunde->AkuVKNeuDatum = $gueltigVon;
                            $artikelKunde->save();
                        } else {
                            // if not Empty => Move current AkuVKNeu To AkuLetzterVK and save new one in AkuVKNeu the update Gültig ab
                            $artikelKunde->AkuLetzterVK = $artikelKunde->AkuVKNeu;
                            $artikelKunde->AkuIndividualT1 = $artikelKunde->AkuVKNeuDatum;
                            $artikelKunde->AkuVKNeu = $position['preis'];
                            $artikelKunde->AkuVKNeuDatum = $gueltigVon;
                            $artikelKunde->save();
                        }

                    }
                }
                $artikelKundeIds[] = $artikelKunde->ArtikelKundeID;
            }
        } catch (\Throwable $e) {
            Log::error(
                'mm_37_1_NuLeistungspositionen Save  Error' . $e->getMessage(),
            );
            return null;
        }
        return [
            'artikelKundeIds' => $artikelKundeIds,
        ];
    }
}
