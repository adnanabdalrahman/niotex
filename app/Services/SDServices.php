<?php

namespace App\Services;

use App\Models\Adresse;
use App\Models\Artikel;
use App\Models\Vorgang;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class SDServices
{
    protected string $baseUrl;
    protected string $sd0102_path;
    protected string $sd0301_path;


    protected array $auth;

    public function __construct()
    {
        $this->baseUrl = config('sap.base_url');
        $this->auth = [
            'client_id' => config('sap.client_id'),
            'client_secret' => config('sap.client_secret'),
        ];
        $this->sd0102_path = config('sap.sd0102_path');
        $this->sd0301_path = config('sap.sd0301_path');
    }

    /**
     * SAP -> CEOS
     * SD-01-01 Beauftragung
     */
    public function sd_0101_beauftragung_vorgang($requestData): ?array
    {
        // todo Important Adresse.Sperrkennzeichen is 1 (gesperrt) darf keinen Auftrag anlegen.
        /*
            'vbeln' → Verkaufsbeleg Vorgang.VorIndividualC1
            'auart' → Vorgang.VorIndividualC2
            'kunnr' → Adresse.AdressNummer → Adresse.InterneAdressnummer(zu speichernde nummer in: Vorgang.VorAuftraggeber)
            'vdatu' → Vorgang.VorLieferung-WunschDatum Wunschlieferdatum
            'zzlgsnr' → Vorgang.VorIndividualC3 Liegenschaftsnummer
            'genrCeos' → Vorgang.VorIndividualD4
            'txtZ012' → Vorgang2Text.VorNotiz Bemerkung zur Liegenschaft
            'txtZ013' → Vorgang.VorStichwort für Reparaturaufträge Ausstattung / Austauschgrund
        */
        try {
            return DB::transaction(function () use (&$requestData) {
                //  get InterneAdressnummer by 'kunnr' to save it in Vorgang.VorAuftraggeber
                $adresse = Adresse::where('AdressNummer', $requestData['kunnr'])->first();
                if ($adresse) {
                    $data['VorAuftraggeber'] = $adresse->InterneAdressnummer; // Kunnr
                    $data['VorLieferanschrift'] = $adresse->InterneAdressnummer;
                    $data['VorRechnungsanschrift'] = $adresse->InterneAdressnummer;
                    $data['VorSammelRechnungsanschrift'] = $adresse->InterneAdressnummer;
                } else {
                    Log::error("Kein Adresse für Vorgang gefunden");
                    return null;
                }

                //vdatu
                $data['VorLieferungWunschDatum'] = Carbon::parse($requestData['vdatu'])->format('Ymd');
                $data['VorStichwort'] = $requestData['txtZ013'] ?? 'MONTAGEAUFTRAG';
                $data['VorIndividualC1'] = $requestData['vbeln'];
                $data['VorIndividualC2'] = $requestData['auart'];
                $data['VorIndividualC3'] = $requestData['zzlgsnr'];
                $data['VorIndividualD4'] = $requestData['genrCeos'];// GebäudeNr
                $data['VorNotiz'] = $requestData['txtZ012'];

                $data['VorArt'] = 'A';
                $data['VorUnterArt'] = 'R';  // char 1
                $data['VorGruppe'] = 'RE'; //  -- Montage/Liefer/Rechnung: 'RE' / Vertr ge: 'WIE' ? / Rahmenauftr ge: 'AB'
                $data['VNkArt'] = '100000';
                $data['VorStatus'] = '100100'; //-- 100000 Nicht gedruckt / 100010 Angebot / 100100 Auftragsbestätigung

                $vorgang = new VorgangService();
                $vorgang = $vorgang->createVorgang($data);
                if ($vorgang !== null) {
                    return [
                        'InterneVorgangsnummer' => $vorgang['InterneVorgangsnummer'],
                        'VorNummer' => $vorgang['VorNummer'],
                        'VorGruppe' => $vorgang['VorGruppe'],
                        'Verkaufsbeleg' => $requestData['vbeln'],
                    ];
                }
                Log::error('sd_0101_beauftragung_vorgang creation Failed');
                return null;
            });
        } catch (Throwable $e) {
            Log::error('sd_0101_beauftragung_vorgang' . $e->getMessage());
            return null;
        }
    }

    public function sd_0101_beauftragung_positions($positions, $vorgangDataArray): ?array
    {
        //todo important delete all position if one fails also vorgang
        /*
        matnr  Materialnummer => Position.InterneArtikelnummer   (FK):Artikel.Artikelnummer→Artikel.InterneArtikelnummer
        kondm  Materialgruppe => Position5Individual.PosIndividualC3  (FK):Position5Individual.InterneVorgangsnumer&InternePositionsnummer]→Position.InterneVorgangsnumer&InternePositionsnummer
        posnr  Verkaufsbelegposition => Position5Individual.PosIndividualD1
        kwmeng Menge/Positionsmenge erledigt => Position3Menge.PosMenge1  (FK):Position3Menge.InterneVorgangsnumer&InternePositionsnummer]→Position.InterneVorgangsnumer&InternePositionsnummer
        vrkme Mengeneinheit => Position3Menge.PosKZMengeneinheit1  FK):Mengeneinheit.KZMengeneinheit
        posErl Position erledigt => 1 = erledigt 2  = // todo Calrify now ignore
        txtZ002 Bemerkung NU / Monteur => Position2Text.PosZusatztextLieferschein    (FK): Position2Text.InterneVorgangsnumer&InternePositionsnummer→Position.InterneVorgangsnumer&InternePositionsnummer
        txtZ009 Info zur Montage SAP => Position2Text.PosZusatztext  (FK):Position2Text.InterneVorgangsnumer&InternePositionsnummer]→Position.InterneVorgangsnumer&InternePositionsnummer
        txtZ010 Info zur Montage CEOS => Position2Text.PosNotiz   (FK):Position2Text.InterneVorgangsnumer&InternePositionsnummer→Position.InterneVorgangsnumer&InternePositionsnummer

        kwmengO Menge offen => //todo clarify later with Johannes ignore
        aufnr Kontierungsobjekt =>  Ignorieren
        vorgn Vorgangsnummer CEOS => Vorgang.VorNummer (FK):Position.InterneVorgangsnummer→Vorgang.InterneVorgangsnummer // todo clarify in header
        VBELN => From Header
        VORGNINT => InterneVorgangsnummer
         */

        $data['InterneVorgangsnummer'] = $vorgangDataArray['InterneVorgangsnummer'];
        $data['VorNummer'] = $vorgangDataArray['VorNummer'];
        $data['VorGruppe'] = $vorgangDataArray['VorGruppe'];
        $data['Verkaufsbeleg'] = $vorgangDataArray['Verkaufsbeleg'];
        $data['current_date'] = date('Ymd');
        $positionsArray = [];
        foreach ($positions as $key => $position) {
            $data['Artikelnummer'] = ltrim($position['matnr'], '0');
            $data['key'] = $key;
            $data['PosIndividualC3'] = $position['kondm'];
            $data['PosIndividualD1'] = $position['posnr'];
            $data['PosZusatztextLieferschein'] = $position['txtZ002'];
            $data['PosZusatztext'] = $position['txtZ009'];
            $data['PosNotiz'] = $position['txtZ010'];

            $data['PosMenge1'] = $position['kwmeng'];
            $data['PosKZMengeneinheit1'] = $position['vrkme'];

            $data['PosWMengeGesamt1'] = $position['kwmeng'];
            $data['PosWMengeAuftrag1'] = $position['kwmeng'];
            $data['PosWMengeAbrechnung1'] = $position['kwmeng'];
            $data['PosWMengeLieferung1'] = $position['kwmeng'];
            $data['PosWMengeVersand1'] = $position['kwmeng'];
            $data['PosWMengeGut1'] = $position['kwmeng'];
            $data['PosWMengeRechnung1'] = $position['kwmeng'];

            $positions = new PositionService();
            $positionsArray[] = $positions->createPosition($data);
        }
        if (!empty($positionsArray)) {
            return $positionsArray;
        }
        Log::error('sd_0101_beauftragung_positions Positions Creation Failed');
        return null;
    }


    /**
     * SD-01-02 Beauftragung Rueckmeldung
     */
    public function sd_0102_beauftragung_rueckmeldung($request)
    {
        try {
            $data = [];
            $vorgang = Vorgang::where('InterneVorgangsnummer', $request->InterneVorgangsnummer)->first();
            if ($vorgang === null) {
                Log::error(
                    "sd_0102_beauftragung_rueckmeldung Kein Vorgang gefunden",
                    ['Vorgangnummer' => $request->InterneVorgangsnummer]
                );
                return null;
            }
            $adresse = Adresse::where('InterneAdressnummer', $vorgang->VorAuftraggeber)->first();
            if ($adresse === null) {
                Log::error(
                    "Kein Adresse für Vorgang gefunden",
                    ['Vorgangnummer' => $request->InterneVorgangsnummer]
                );
                return null;
            }
            $data['Kunnr'] = $adresse->AdressNummer;

            $data['Vbeln'] = (string)$vorgang->VorIndividualC1;
            $data['Auart'] = (string)$vorgang->VorIndividualC2;
            $data['Vdatu'] = Carbon::parse($vorgang->VorLieferungWunschDatum)->format('Y-m-d');
            $data['Zzlgsnr'] = (string)$vorgang->VorIndividualC3;
            $data['GenrCeos'] = (string)(int)$vorgang->VorIndividualD4;
            $data['TxtZ013'] = (string)$vorgang->VorStichwort;

            $vorNotiz = '';
            $vorgang2Text = DB::connection('sqlsrv2')->table('cis.Vorgang2Text')
                ->where('InterneVorgangsnummer', $request->InterneVorgangsnummer)->first();

            if ($vorgang2Text !== null) {
                $vorNotiz = (string)$vorgang2Text->VorNotiz;
            }
            $data['TxtZ012'] = $vorNotiz;

            //---------------------------------------------------------------------------------------------
            $positions = DB::connection('sqlsrv2')->table('cis.Position')
                ->where('InterneVorgangsnummer', $request->InterneVorgangsnummer)->get();
            $positionArray = [];
            foreach ($positions as $position) {

                $artikel = Artikel::where('InterneArtikelnummer', $position->InterneArtikelnummer)->first();
                if (is_null($artikel)) {
                    Log::error(
                        "Artikel für Position nicht gefunden",
                        [
                            'Vorgangnummer' => $request->InterneVorgangsnummer,
                            'InterneArtikelnummer' => $position->InterneArtikelnummer,
                            'InternePositionsnummer' => $position->InternePositionsnummer,
                        ]
                    );
                    return null;
                }

                $position5Individual = DB::connection('sqlsrv2')->table('cis.Position5Individual')
                    ->where('InterneVorgangsnummer', $request->InterneVorgangsnummer)
                    ->where('InternePositionsnummer', $position->InternePositionsnummer)
                    ->first();
                if (is_null($position5Individual)) {
                    Log::error(
                        "Position5Individual nicht gefunden",
                        [
                            'Vorgangnummer' => $request->InterneVorgangsnummer,
                            'InternePositionsnummer' => $position->InternePositionsnummer,
                        ]
                    );
                    return null;
                }
                $position3Menge = DB::connection('sqlsrv2')->table('cis.Position3Menge')
                    ->where('InterneVorgangsnummer', $request->InterneVorgangsnummer)
                    ->where('InternePositionsnummer', $position->InternePositionsnummer)
                    ->first();
                if (is_null($position3Menge)) {
                    Log::error(
                        "Position3Menge nicht gefunden",
                        [
                            'Vorgangnummer' => $request->InterneVorgangsnummer,
                            'InternePositionsnummer' => $position->InternePositionsnummer,
                        ]
                    );
                    return null;
                }
                $position2Text = DB::connection('sqlsrv2')->table('cis.Position2Text')
                    ->where('InterneVorgangsnummer', $request->InterneVorgangsnummer)
                    ->where('InternePositionsnummer', $position->InternePositionsnummer)
                    ->first();
                if (is_null($position2Text)) {
                    Log::error(
                        "Position2Text nicht gefunden",
                        [
                            'Vorgangnummer' => $request->InterneVorgangsnummer,
                            'InternePositionsnummer' => $position->InternePositionsnummer,
                        ]
                    );
                    return null;
                }

                $data['to_Items'][] = [
                    'Matnr' => $artikel->Artikelnummer,
                    'PosErl' => (string)1, // todo later
                    'KwmengO' => (string)0,  //todo later
                    'Vorgn' => (string)$vorgang->VorNummer,
                    'Vbeln' => (string)$vorgang->VorIndividualC1,
                    'VorgnInt' => (string)$vorgang->InterneVorgangsnummer ?? '',
                    'Kondm' => (string)$position5Individual->PosIndividualC3,
                    'Posnr' => (string)(int)$position5Individual->PosIndividualD1,
                    'Kwmeng' => (string)$position3Menge->PosMenge1,
                    'Vrkme' => (string)$position3Menge->PosKZMengeneinheit1,
                    'TxtZ002' => (string)$position2Text->PosZusatztextLieferschein ?? '',
                    'TxtZ009' => (string)$position2Text->PosZusatztext ?? '',
                    'TxtZ010' => (string)$position2Text->PosNotiz ?? '',
                ];
            }
            Log::info('sd-01-02 Sent data', $data);
            $result = app(SapApiClient::class)->post($this->sd0102_path, $data);
            if ($result === null) {
                Log::error('sd-01-02 Error received');
                return null;
            }
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return null;
        }
        return $result;
    }


    /**
     * SAP → CEOS
     * Übergabe Rechnung aus einem Mietvertrag an CEOS
     * SD-02-01 Mietvertragsrechnungen
     */
    public function sd_0201_mietvertragsrechnungen($requestData): ?array
    {
        $header = $requestData['header'];
        $kunnr = ltrim($header['kunnr'], '0');
        $adresse = Adresse::where('AdressNummer', $kunnr)->first();
        if ($adresse === null) {
            Log::error(
                "sd_0201_mietvertragsrechnungen Kein Adresse für Vorgang gefunden",
                ['kunnr' => $requestData['kunnr']]
            );
            return null;
        }
        $carbonFkdat = Carbon::parse((string)$header['fkdat']);
        $carbonVorIndividualT1 = Carbon::parse((string)$header['datumvon']);
        $carbonVorIndividualT2 = Carbon::parse((string)$header['datumbis']);

        $fkdat = $carbonFkdat->format('Ymd');
        $datumvon = $carbonVorIndividualT1->format('Ymd');
        $datumbis = $carbonVorIndividualT2->format('Ymd');

        $vorgangData['VorIndividualT1'] = $datumvon;
        $vorgangData['VorIndividualT2'] = $datumbis;

        $vorgangData['VorIndividualC1'] = $header['vbeln'];
        $vorgangData['VorDatumRechnung'] = $fkdat;
        $vorgangData['VorDatumAuftragseingang'] = $fkdat;


        $vorgangData['VorIndividualC7'] = $header['zuonr'];
        $vorgangData['VorIndividualC3'] = $header['zzlgsnr'];
        $vorgangData['VorAuftraggeber'] = $adresse->InterneAdressnummer;
        $vorgangData['VorIndividualD4'] = $adresse->VorIndividualD4 ?? ''; // GebäudeNr

        $vorgangData['VorArt'] = 'A';
        $vorgangData['VorUnterArt'] = 'R';  // char 1
        $vorgangData['VorGruppe'] = 'WH'; //  -- Montage/Liefer/Rechnung: 'RE' / Vertr ge: 'WIE' ? / Rahmenauftr ge: 'AB'
        $vorgangData['VNkArt'] = '100000';
        $vorgangData['VorStatus'] = '100400'; //-- 100000 Nicht gedruckt / 100010 Angebot / 100100 Auftragsbestätigung


        $vorgangData['VorNettowert'] = $header['netwr'];
        $vorgangData['VorNettowertMwst1'] = $header['netwr'];
        $vorgangData['VorNettoPlusZusatzkosten'] = $header['netwr'];
        $vorgangData['VorNettoMinusRabatt'] = $header['netwr'];
        $vorgangData['VorNettoMinusAKonto'] = $header['netwr'];
        $vorgangData['VorNettowertRabattfaehig'] = $header['netwr'];
        $vorgangData['VorRabattfaehigMwst1'] = $header['netwr'];
        $vorgangData['VorSkontofaehigMwst1'] = $header['netwr'];

        $vorgangData['VorMwstSatz1'] = 3;
        $vorgangData['VorMwstSatzProzent1'] = 19;
        $vorgangData['VorBruttowert'] = $header['mwsbk'];
        $vorgangData['VorSkontofaehigBrutto'] = $header['mwsbk'];

        $vorgangData['VorWBruttowertGesamt'] = $header['mwsbk'];
        $vorgangData['VorWBruttowertAuftrag'] = $header['mwsbk'];
        $vorgangData['VorWBruttowertAbrechnung'] = $header['mwsbk'];
        $vorgangData['VorWBruttowertLieferung'] = $header['mwsbk'];
        $vorgangData['VorWBruttowertVersand'] = $header['mwsbk'];
        $vorgangData['VorWBruttowertGut'] = $header['mwsbk'];
        $vorgangData['VorWBruttowertRechnung'] = $header['mwsbk'];
        $vorgangData['VorWNettoPlusZusatzGesamt'] = $header['netwr'];
        $vorgangData['VorWNettoPlusZusatzAuftrag'] = $header['netwr'];
        $vorgangData['VorWNettoPlusZusatzAbrechnung'] = $header['netwr'];
        $vorgangData['VorWNettoPlusZusatzLieferung'] = $header['netwr'];
        $vorgangData['VorWNettoPlusZusatzVersand'] = $header['netwr'];
        $vorgangData['VorWNettoPlusZusatzGut'] = $header['netwr'];
        $vorgangData['VorWNettoPlusZusatzRechnung'] = $header['netwr'];
        $vorgangData['VorWNettoMinusRabattGesamt'] = $header['netwr'];
        $vorgangData['VorWNettoMinusRabattAuftrag'] = $header['netwr'];
        $vorgangData['VorWNettoMinusRabattAbrechnung'] = $header['netwr'];
        $vorgangData['VorWNettoMinusRabattLieferung'] = $header['netwr'];
        $vorgangData['VorWNettoMinusRabattVersand'] = $header['netwr'];
        $vorgangData['VorWNettoMinusRabattGut'] = $header['netwr'];
        $vorgangData['VorWNettoMinusRabattRechnung'] = $header['netwr'];
        $vorgangData['VorWNettoMinusAKontoAbrechnung'] = $header['netwr'];
        $vorgangData['VorWNettoMinusAKontoLieferung'] = $header['netwr'];
        $vorgangData['VorWNettoMinusAKontoRechnung'] = $header['netwr'];
        $vorgangData['VorWNettowertGesamt'] = $header['netwr'];
        $vorgangData['VorWNettowertAuftrag'] = $header['netwr'];
        $vorgangData['VorWNettowertAbrechnung'] = $header['netwr'];
        $vorgangData['VorWNettowertLieferung'] = $header['netwr'];
        $vorgangData['VorWNettowertVersand'] = $header['netwr'];
        $vorgangData['VorWNettowertGut'] = $header['netwr'];
        $vorgangData['VorWNettowertRechnung'] = $header['netwr'];
        $vorgangData['VorWNettowertMwst1Gesamt'] = $header['netwr'];
        $vorgangData['VorWNettowertMwst1Auftrag'] = $header['netwr'];
        $vorgangData['VorWNettowertMwst1Abrechnung'] = $header['netwr'];
        $vorgangData['VorWNettowertMwst1Lieferung'] = $header['netwr'];
        $vorgangData['VorWNettowertMwst1Versand'] = $header['netwr'];
        $vorgangData['VorWNettowertMwst1Gut'] = $header['netwr'];
        $vorgangData['VorWNettowertMwst1Rechnung'] = $header['netwr'];

        $vorgang = new VorgangService();
        $vorgang = $vorgang->createVorgang($vorgangData, 1);
        if ($vorgang === null) {
            Log::error('sd_0201_mietvertragsrechnungen Vorgang Creation Failed');
            return null;
        }
        //------------------------------------------------------------------------------------
        $positions = $requestData['positions'];

        $positionData['InterneVorgangsnummer'] = $vorgang['InterneVorgangsnummer'];
        $positionData['VorNummer'] = $vorgang['VorNummer'];
        $positionData['VorGruppe'] = $vorgang['VorGruppe'];
        $positionsArray = [];
        foreach ($positions as $key => $position) {
            $positionData['PosIndividualD1'] = $position['posnr'];
            $positionData['Artikelnummer'] = ltrim($position['matnr'], '0');

            $positionData['PosKZMengeneinheit1'] = 'ST';
            $positionData['PosMenge1'] = $position['fkimg'];
            $positionData['PosWMengeGesamt1'] = $position['fkimg'];
            $positionData['PosWMengeAuftrag1'] = $position['fkimg'];
            $positionData['PosWMengeAbrechnung1'] = $position['fkimg'];
            $positionData['PosWMengeLieferung1'] = $position['fkimg'];
            $positionData['PosWMengeVersand1'] = $position['fkimg'];
            $positionData['PosWMengeGut1'] = $position['fkimg'];
            $positionData['PosWMengeRechnung1'] = $position['fkimg'];

            $einzelPreis = $position['netwr'] / $position['fkimg'];

            $positionData['PosGesamteinzelpreis'] = $einzelPreis;
            $positionData['PosDBEinzel'] = $einzelPreis;
            $positionData['PosPreisEinzel'] = $einzelPreis;
            $positionData['PosWEinzelpreisMinusRabatt'] = $einzelPreis;

            $positionData['key'] = $key;

            $positions = new PositionService();
            $positionsArray[] = $positions->createPosition($positionData);
        }
        if (!empty($positionsArray)) {
            return [
                'header' => [
                    'InterneVorgangsnummer' => $vorgang['InterneVorgangsnummer'],
                    'VorNummer' => $vorgang['VorNummer'],
                    'VorGruppe' => $vorgang['VorGruppe'],
                ],
                'positions' => $positionsArray
            ];
        }
        Log::error('sd_0201_mietvertragsrechnungen Positions Creation Failed');
        return null;
    }


    /**
     * CEOSWeb -> CEOS --> SAP
     * SD-03-01 Dienstleistungsrechnung
     */
    public function sd_0301_dienstleistungsrechnung($request): ?array
    {
        try {
            $data = [];
            $vorgang = Vorgang::where('InterneVorgangsnummer', $request->InterneVorgangsnummer)->first();
            if ($vorgang === null) {
                Log::error(
                    "sd_0301_dienstleistungsrechnung Kein Vorgang gefunden",
                    ['InterneVorgangsnummer' => $request->InterneVorgangsnummer]
                );
                return null;
            }
            $adresse = Adresse::where('InterneAdressnummer', $vorgang->VorAuftraggeber)->first();
            if ($adresse === null) {
                Log::error(
                    "Kein Adresse für Vorgang gefunden",
                    ['InterneVorgangsnummer' => $request->InterneVorgangsnummer]
                );
                return null;
            }
            $data['Kunnr'] = $adresse->AdressNummer;
            $data['Auart'] = (string)$vorgang->VorIndividualC2;
            $data['Zzlgsnr'] = (string)$vorgang->VorIndividualC3;
            $data['Vorgn'] = (string)$vorgang->VorNummer;
            $data['VorgnInt'] = (string)$vorgang->InterneVorgangsnummer;
            $carbonAbrVon = Carbon::parse((string)$vorgang->VorIndividualT1);
            $data['AbrVon'] = $carbonAbrVon->format('Ymd');
            $carbonAbrBis = Carbon::parse((string)$vorgang->VorIndividualT2);
            $data['AbrBis'] = $carbonAbrBis->format('Ymd');
            //---------------------------------------------------------------------------------------------
            $positions = DB::connection('sqlsrv2')->table('cis.Position')
                ->where('InterneVorgangsnummer', $request->InterneVorgangsnummer)->get();

            foreach ($positions as $position) {
                $artikel = Artikel::where('InterneArtikelnummer', $position->InterneArtikelnummer)->first();
                if (is_null($artikel)) {
                    Log::error(
                        "sd_0301_dienstleistungsrechnung Artikel für Position nicht gefunden",
                        [
                            'Vorgangnummer' => $request->InterneVorgangsnummer,
                            'InterneArtikelnummer' => $position->InterneArtikelnummer,
                            'InternePositionsnummer' => $position->InternePositionsnummer,
                        ]
                    );
                    return null;
                }

                $position5Individual = DB::connection('sqlsrv2')->table('cis.Position5Individual')
                    ->where('InterneVorgangsnummer', $request->InterneVorgangsnummer)
                    ->where('InternePositionsnummer', $position->InternePositionsnummer)
                    ->first();
                if (is_null($position5Individual)) {
                    Log::error(
                        "Position5Individual nicht gefunden",
                        [
                            'Vorgangnummer' => $request->InterneVorgangsnummer,
                            'InternePositionsnummer' => $position->InternePositionsnummer,
                        ]
                    );
                    return null;
                }
                $position3Menge = DB::connection('sqlsrv2')->table('cis.Position3Menge')
                    ->where('InterneVorgangsnummer', $request->InterneVorgangsnummer)
                    ->where('InternePositionsnummer', $position->InternePositionsnummer)
                    ->first();
                if (is_null($position3Menge)) {
                    Log::error(
                        "Position3Menge nicht gefunden",
                        [
                            'Vorgangnummer' => $request->InterneVorgangsnummer,
                            'InternePositionsnummer' => $position->InternePositionsnummer,
                        ]
                    );
                    return null;
                }
                $position2Text = DB::connection('sqlsrv2')->table('cis.Position2Text')
                    ->where('InterneVorgangsnummer', $request->InterneVorgangsnummer)
                    ->where('InternePositionsnummer', $position->InternePositionsnummer)
                    ->first();
                if (is_null($position2Text)) {
                    Log::error(
                        "Position2Text nicht gefunden",
                        [
                            'Vorgangnummer' => $request->InterneVorgangsnummer,
                            'InternePositionsnummer' => $position->InternePositionsnummer,
                        ]
                    );
                    return null;
                }
                $data['to_ServItems'][] = [
                    'Matnr' => $artikel->Artikelnummer,
                    'Kwmeng' => (string)$position3Menge->PosMenge1,
                    'Vrkme' => (string)$position3Menge->PosKZMengeneinheit1,
                    'Vorgn' => (string)$vorgang->VorNummer,
                    'VorgnInt' => (string)$vorgang->InterneVorgangsnummer,
                ];
            }
            Log::info('sd-03-01 Sent data', $data);
            $result = app(SapApiClient::class)->post($this->sd0301_path, $data);
            if ($result === null) {
                Log::error('sd-03-01 Error received');
                return null;
            }
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return null;
        }
        return $result;
    }


    /**
     * SAP → CEOS
     * SD-03-02 fakturierte Dienstleistungsrechnung
     */
    public function sd_03_02_fakturiertedienstleistungsrechnung($requestData): ?array
    {
        $interneVorgangsnummer = $requestData['header']['vorgangsnummerInt'];
        $header = $requestData['header'];
        $vorgang = Vorgang::where('InterneVorgangsnummer', $interneVorgangsnummer)->first();
        if ($vorgang === null) {
            Log::error(
                "sd_03_02_fakturiertedienstleistungsrechnung Kein Vorgang gefunden",
                ['InterneVorgangsnummer' => $interneVorgangsnummer]
            );
            return null;
        }

        $adresse = Adresse::where('InterneAdressnummer', $vorgang->VorAuftraggeber)->first();
        if ($adresse === null) {
            Log::error("sd_03_02_fakturiertedienstleistungsrechnung Kein Adresse für Vorgang gefunden");
            return null;
        }

        $vorgangData['VorAuftraggeber'] = $adresse->InterneAdressnummer;
        $vorgangData['VorLieferanschrift'] = $adresse->InterneAdressnummer;
        $vorgangData['VorRechnungsanschrift'] = $adresse->InterneAdressnummer;
        $vorgangData['VorSammelRechnungsanschrift'] = $adresse->InterneAdressnummer;


        $carbonVorIndividualT1 = Carbon::parse((string)$header['datumvon']);
        $carbonVorIndividualT2 = Carbon::parse((string)$header['datumbis']);

        $datumvon = $carbonVorIndividualT1->format('Ymd');
        $datumbis = $carbonVorIndividualT2->format('Ymd');

        $vorgangData['VorIndividualT1'] = $datumvon;
        $vorgangData['VorIndividualT2'] = $datumbis;

        $vorgangData['VorIndividualC1'] = $header['fakturanummer'];
        $vorgangData['VorIndividualC7'] = $header['vorlagebeleg'];
        $vorgangData['VorIndividualC3'] = $header['liegenschaft'];
        $vorgangData['VorRechnungsNummer'] = $vorgang->VorRechnungsnummer ?? '';

        $vorgangData['VorArt'] = 'A';
        $vorgangData['VorUnterArt'] = 'R';
        $vorgangData['VorGruppe'] = 'HKA';
        $vorgangData['VNkArt'] = '100000';
        $vorgangData['VorStatus'] = '100400'; //-- 100000 Nicht gedruckt / 100010 Angebot / 100100 Auftragsbestätigung

        $vorgangData['VorNettowert'] = $header['nettowert'];
        $vorgangData['VorNettowertMwst1'] = $header['nettowert'];
        $vorgangData['VorNettoPlusZusatzkosten'] = $header['nettowert'];
        $vorgangData['VorNettoMinusRabatt'] = $header['nettowert'];
        $vorgangData['VorNettoMinusAKonto'] = $header['nettowert'];
        $vorgangData['VorNettowertRabattfaehig'] = $header['nettowert'];
        $vorgangData['VorRabattfaehigMwst1'] = $header['nettowert'];
        $vorgangData['VorSkontofaehigMwst1'] = $header['nettowert'];
        $vorgangData['VorMwstSatz1'] = 3;
        $vorgangData['VorMwstSatzProzent1'] = 19; //todo nicht immer 19  -> gesamtsteuerbetrag = 0
        $vorgangData['VorBruttowert'] = $header['gesamtsteuerbetrag'];
        $vorgangData['VorSkontofaehigBrutto'] = $header['gesamtsteuerbetrag'];
        $vorgangData['VorWBruttowertGesamt'] = $header['gesamtsteuerbetrag'];
        $vorgangData['VorWBruttowertAuftrag'] = $header['gesamtsteuerbetrag'];
        $vorgangData['VorWBruttowertAbrechnung'] = $header['gesamtsteuerbetrag'];
        $vorgangData['VorWBruttowertLieferung'] = $header['gesamtsteuerbetrag'];
        $vorgangData['VorWBruttowertVersand'] = $header['gesamtsteuerbetrag'];
        $vorgangData['VorWBruttowertGut'] = $header['gesamtsteuerbetrag'];
        $vorgangData['VorWBruttowertRechnung'] = $header['gesamtsteuerbetrag'];
        $vorgangData['VorWNettoPlusZusatzGesamt'] = $header['nettowert'];
        $vorgangData['VorWNettoPlusZusatzAuftrag'] = $header['nettowert'];
        $vorgangData['VorWNettoPlusZusatzAbrechnung'] = $header['nettowert'];
        $vorgangData['VorWNettoPlusZusatzLieferung'] = $header['nettowert'];
        $vorgangData['VorWNettoPlusZusatzVersand'] = $header['nettowert'];
        $vorgangData['VorWNettoPlusZusatzGut'] = $header['nettowert'];
        $vorgangData['VorWNettoPlusZusatzRechnung'] = $header['nettowert'];
        $vorgangData['VorWNettoMinusRabattGesamt'] = $header['nettowert'];
        $vorgangData['VorWNettoMinusRabattAuftrag'] = $header['nettowert'];
        $vorgangData['VorWNettoMinusRabattAbrechnung'] = $header['nettowert'];
        $vorgangData['VorWNettoMinusRabattLieferung'] = $header['nettowert'];
        $vorgangData['VorWNettoMinusRabattVersand'] = $header['nettowert'];
        $vorgangData['VorWNettoMinusRabattGut'] = $header['nettowert'];
        $vorgangData['VorWNettoMinusRabattRechnung'] = $header['nettowert'];
        $vorgangData['VorWNettoMinusAKontoAbrechnung'] = $header['nettowert'];
        $vorgangData['VorWNettoMinusAKontoLieferung'] = $header['nettowert'];
        $vorgangData['VorWNettoMinusAKontoRechnung'] = $header['nettowert'];
        $vorgangData['VorWNettowertGesamt'] = $header['nettowert'];
        $vorgangData['VorWNettowertAuftrag'] = $header['nettowert'];
        $vorgangData['VorWNettowertAbrechnung'] = $header['nettowert'];
        $vorgangData['VorWNettowertLieferung'] = $header['nettowert'];
        $vorgangData['VorWNettowertVersand'] = $header['nettowert'];
        $vorgangData['VorWNettowertGut'] = $header['nettowert'];
        $vorgangData['VorWNettowertRechnung'] = $header['nettowert'];
        $vorgangData['VorWNettowertMwst1Gesamt'] = $header['nettowert'];
        $vorgangData['VorWNettowertMwst1Auftrag'] = $header['nettowert'];
        $vorgangData['VorWNettowertMwst1Abrechnung'] = $header['nettowert'];
        $vorgangData['VorWNettowertMwst1Lieferung'] = $header['nettowert'];
        $vorgangData['VorWNettowertMwst1Versand'] = $header['nettowert'];
        $vorgangData['VorWNettowertMwst1Gut'] = $header['nettowert'];
        $vorgangData['VorWNettowertMwst1Rechnung'] = $header['nettowert'];

        $vorgang = new VorgangService();
        $vorgang = $vorgang->createVorgang($vorgangData);
        if ($vorgang === null) {
            Log::error('sd_0201_mietvertragsrechnungen Vorgang Creation Failed');
            return null;
        }
        //------------------------------------------------------------------------------------
        $positions = $requestData['positions'];

        $positionData['InterneVorgangsnummer'] = $vorgang['InterneVorgangsnummer'];
        $positionData['VorNummer'] = $vorgang['VorNummer'];
        $positionData['VorGruppe'] = $vorgang['VorGruppe'];
        $positionsArray = [];

        foreach ($positions as $key => $position) {
            $positionData['Artikelnummer'] = ltrim($position['material'], '0');

            $positionData['PosKZMengeneinheit1'] = 'ST';
            $positionData['PosMenge1'] = $position['menge'];
            $positionData['PosWMengeGesamt1'] = $position['menge'];
            $positionData['PosWMengeAuftrag1'] = $position['menge'];
            $positionData['PosWMengeAbrechnung1'] = $position['menge'];
            $positionData['PosWMengeLieferung1'] = $position['menge'];
            $positionData['PosWMengeVersand1'] = $position['menge'];
            $positionData['PosWMengeGut1'] = $position['menge'];
            $positionData['PosWMengeRechnung1'] = $position['menge'];
            $positionData['key'] = $key;
            $positionData['PosIndividualD1'] = $position['positionsnummer'];


            $einzelPreis = $position['nettowertposition'] / $position['menge'];
            $positionData['PosGesamteinzelpreis'] = $einzelPreis;
            $positionData['PosDBEinzel'] = $einzelPreis;
            $positionData['PosPreisEinzel'] = $einzelPreis;
            $positionData['PosWEinzelpreisMinusRabatt'] = $einzelPreis;

            $positions = new PositionService();
            $position = $positions->createPosition($positionData);
            if ($position === null) {
                return null;
            }
            $positionsArray[] = $position;
        }
        if (!empty($positionsArray)) {
            return [
                'header' => [
                    'InterneVorgangsnummer' => $vorgang['InterneVorgangsnummer'],
                    'VorNummer' => $vorgang['VorNummer'],
                    'VorGruppe' => $vorgang['VorGruppe'],
                ],
                'positions' => $positionsArray
            ];
        }
        Log::error('sd_0201_mietvertragsrechnungen Positions Creation Failed');
        return null;
    }
}
