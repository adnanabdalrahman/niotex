<?php

namespace App\Services;

use App\Models\Adresse;
use App\Models\Artikel;
use App\Models\Artikelgruppe;
use App\Models\ArtikelKunde;
use App\Models\ArtikelLieferant;
use App\Models\Basisempfindlichkeit;
use App\Models\Position;
use App\Models\Position3Menge;
use App\Models\Produktgruppe;
use App\Models\Vorgang;
use App\Models\Warengruppe;
use Carbon\Carbon;
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


    protected string $mm331a_path;


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
        $this->mm331a_path = config('sap.mm341_path');
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
        $data['ArtLieferantenfaehigJN'] = 1;
        $data['ArtVerkaufsfaehigJN'] = 0;
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
                    'ArtBezeichnung1' => $data['Materialkurztext'], // ArtMatchcode
                    'ArtBezeichnung2' => $data['Bezeichnung1'] . "|" . $data['Bezeichnung2'],
                    'KZArtMengeneinheit1' => $data['Basismengeneinheit'],
                    'ArtAltJN' => $data['LVorm'],
                    'ArtIndividualC5' => $data['BKSchluessel'],
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
        } catch (\Throwable $e) {
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
        $vorgang = Vorgang::where('VorNummer', $data['Vorgangnummer'])->first();

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


        $tourId = $vorgang->VorIndividualD5;
        $reservNo = $vorgang->VorIndividualD6;

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
                //todo Clarify if continue or Out
                continue;
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
            "MoveStloc" => "H001",
            "to_Items" => $to_Items
        ];
        Log::info("mm_34_01_umlagerungsreservierung sent Data", $data);

        $response = app(SapApiClient::class)->post($this->mm341_path, $data);

        $reservNo = $response['d']['ReservNo'] ?? null;

        if ($reservNo !== null) {
            $vorgang->VorStatus = '100100';
            $vorgang->save();
            Log::info("mm_34_01_umlagerungsreservierung Status erfolgreich geändert ", [
                'Vorgangnummer' => $vorgang->VorIndividualD5,
                'reservNo' => $reservNo,
            ]);
            return true;
        }
        return false;
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


    /**
     * @throws Exception
     */
    public function mm_33_01_a_Leistungsbestaetigung()
    {
        // todo data mapping
        /*
        TourID
        Lifnr
        Nachunternehmer Kreditor
        Slgnr
        Liegenschaft
        Kvtyp
        Kontierungstyp
        Vbeln
        SD-Vertriebsbeleg
        Posnr
        SD-Vertriebsbelegsposition
        Material
        Materialnummer
        ShortText
        Materialkurztext / Leistungskurztetxt
        Quantity
        Leistungsmenge
        PoUnit
        Mengeneinheit
        Interface
        KZ MM-33-1a oder b
        PoNumber
        Bestellnummer
        PoItem
        Bestellposition
        Netpr
        Aktueller Preis in SAP
        Peinh
        Preiseinheit in SAP
        CeosData
        Kennzeichen Datensatz aus CEOS
        Goodsmovement
        Materialbeleg
        GoodsmvmtLine
        Materialbelegpos.
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


    public function mm_37_1_NuLeistungspositionen($data): ?array
    {

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

                $artikel = Artikel::where('ArtikelNummer', $position['materialnummer'])->first();
                if ($artikel === null) {
                    Log::error('mm_37_1_NuLeistungspositionen Artikel nicht gefunden: ' . $position['materialnummer']);
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
                    //No => create new one .
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
