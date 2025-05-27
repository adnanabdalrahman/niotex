<?php

namespace App\Services;

use App\Models\Adresse;
use App\Models\Artikel;
use App\Models\Artikelgruppe;
use App\Models\ArtikelLieferant;
use App\Models\Basisempfindlichkeit;
use App\Models\Produktgruppe;
use App\Models\Warengruppe;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class MMServices
{
    protected string $baseUrl;
    protected string $mm221_path;
    protected string $mm341_path;
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
        $this->mm352_path = config('sap.mm341_path');
    }


    /**
     * MM-31-1 Materialstammdaten
     * SAP -> CEOS
     */
    public function mm_31_01_materialstammdaten($data): ?array
    {

        /*
        todo CEOSArtikeluntergruppe => Artikel.ArtikelUntergruppeID (int) → cis.ArtikelUntergruppe.KZUnterArtikelgruppe
       - todo compare combination
           KZWarengruppe => CEOSWarengruppe
           KZArtikelgruppe => CEOSArtikelgruppe
           KZUnterArtikelgruppe => CEOSArtikeluntergruppe
           then get the ArtikelUntergruppeID
       - NULL ACCEPTED

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
        $data['ArtLieferantenfaehigJN'] = 0;
        $data['ArtVerkaufsfaehigJN'] = 0;
        $data['ArtSkontofaehigJN'] = 0;

        try {
            $artikel = Artikel::updateOrCreate(
                ['Artikelnummer' => $data['Material']],
                [
                    'Artikelnummer' => $data['Material'],
                    'ArtBezeichnung1' => $data['Materialkurztext'], // ArtMatchcode
                    'ArtBezeichnung2' => $data['Bezeichnung1'] . "|" . $data['Bezeichnung2'],
                    'Artikel.KZArtMengeneinheit1 ' => $data['Basismengeneinheit'],
                    'ArtAltJN' => $data['LVorm'],
                    'Artikel.ArtIndividualC5' => $data['BKSchluessel'],
                    'KZWarengruppe' => $data['CEOSWarengruppe'],
                    'KZArtikelgruppe' => $data['CEOSArtikelgruppe'],
                    'ArtikelUntergruppeID' => Null, //todo should later be built
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
        } catch (\Throwable $e) {
            Log::error('mm_31_01_materialstammdaten Save Artikel Error:' . $e->getMessage(),
                ['Material' => $data['Material']]);
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
        } catch (\Throwable $e) {
            Log::error('mm_31_01_materialstammdaten Save Basisempfindlichkeit Error' . $e->getMessage(),
                ['Material' => $data['Material']]);
            return null;
        }

        //  Lieferschein (Hersteller)
        $adresse = Adresse::where('AdressNummer', $data['Hersteller'])->first();
        if ($adresse === null) {
            Log::error('mm_31_01_materialstammdaten Kein Adresse für Lieferschein gefunden',
                ['AdressNummer' => $data['Hersteller']]);
            return null;
        }
        $interneAdressnummer = $adresse->InterneAdressnummer;
        try {
            $artikelLieferant = ArtikelLieferant::updateOrCreate(
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
        } catch (\Exception $e) {
            Log::error('mm_31_01_materialstammdaten Lieferschein Error', ['Material' => $data['Material']]);
            return null;
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

    public function mm_34_01_umlagerungsreservierung()
    {
        //Todo where comes the trigger from Blau exist anpassungen
        // source data from CEOS mapping
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
            - ist ReqDate gleich TourDate (Bedarfstermin ) ?
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
        $data = [
            "TourId" => "123456",
            "ReservNo" => "",
            "MoveStloc" => "H001",
            "MoveStlocSearch" => "",
            "to_Items" => [
                [
                    "Material" => "10041633",
                    "EntryQnt" => "1",
                    "EntryUom" => "ST",
                    "ReqDate" => "/Date(1747094400000)/",
                    "TourId" => "123456"
                ],
                [
                    "Material" => "112600005",
                    "EntryQnt" => "1",
                    "EntryUom" => "ST",
                    "ReqDate" => "/Date(1747094400000)/",
                    "TourId" => "123456"
                ]
            ]
        ];
        return app(SapApiClient::class)->post($this->mm341_path, $data);
    }

    /**
     * MM-22-1 Abfrage nach Lagerbestände
     * Get stock Level from SAP.
     * @param string $materials
     * @param string $storage
     * @return JsonResponse
     */
    public function mm_22_01_lagerbestaende(string $materials, string $storage): JsonResponse
    {
        $data = "?\$filter=Material eq '{$materials}' and Storage eq '{$storage}'";
        try {
            $response = app(SapApiClient::class)->get($this->mm221_path, $data);
            return response()->json($response, 200);
        } catch (Exception|NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    /**
     * @throws Exception
     */
    public function mm_35_02_materialverbrauch()
    {
        // todo data mapping
        /*
            Belegdatum = date vorgangsTable (lieferscheindatum)
            Materialnummer = varchar(18)
            Bewegungsart = varchar(3) 261  vorgangsart
            Lager = varchar(4)  muss gebaut werden
            monturNR (Suchbegriff1) = varchar(20)
            Menge = position
            Mengeneinheit = Artikel
            TourID  =  Benötigte Menge
            Liegenschaft = varchar(9)
            SD-Verkaufsbeleg/Auftrag
            SD-Verkaufs-belegsposition/Auftragsposition
            Materialbeleg
            Fehlertext
        */
        $data = [
            "Belegdatum" => "123456",
            "Materialnummer" => "",
            "Bewegungsart" => "H001",
            "Suchbegriff1" => "",
            "Menge" => "",
            "Mengeneinheit" => "",
            "TourID" => "",
            "Liegenschaft" => "",
            "SD-Verkaufsbeleg/Auftrag" => "",  //muss gebaut werden
            "SD-Verkaufs-belegsposition/Auftragsposition" => "",
            "Materialbeleg" => "",
            "Fehlertext" => "",

        ];
        return app(SapApiClient::class)->post($this->mm341_path, $data);
    }


}
