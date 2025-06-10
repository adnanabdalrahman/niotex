<?php

namespace App\Services;

use App\Models\Adresse;
use App\Models\Artikel;
use App\Models\NummernkreisVorgang;
use App\Models\Preisbasis;
use App\Models\Vorgang;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class SDServices
{
    protected string $baseUrl;
    protected string $sd0102_path;


    protected array $auth;

    public function __construct()
    {
        $this->baseUrl = config('sap.base_url');
        $this->auth = [
            'client_id' => config('sap.client_id'),
            'client_secret' => config('sap.client_secret'),
        ];
        $this->sd0102_path = config('sap.sd0102_path');
    }

    /**
     * SD-01-01 Beauftragung
     */
    public function sd_0101_beauftragung_vorgang($header): ?array
    {

        // todo Important Adresse.Sperrkennzeichen is 1 (gesperrt) darf keinen Auftrag anlegen.
        // create Vorgang for beleg
        // create positionen für this Vorgang
        // MaterialGruppen in positionen   => Vorgang.VorGruppe
        /*
            'vbeln' => Verkaufsbeleg Vorgang.VorIndividualC1
            'auart' => Vorgang.VorIndividualC2
            'kunnr' => Adresse.AdressNummer(was empfangene nummer) -> Adresse.InterneAdressnummer(zu speichernde nummer in: Vorgang.VorAuftraggeber)
            'vdatu' => Vorgang.VorLieferung-WunschDatum Wunschlieferdatum
            'zzlgsnr' =>  Vorgang.VorIndividualC3 Liegenschaftsnummer
            'genrCeos' =>  Vorgang.VorIndividualD4
            'txtZ012' => Vorgang2Text.VorNotiz Bemerkung zur Liegenschaft
            'txtZ013' => Vorgang.VorStichwort  Für Reparaturaufträge Ausstattung / Austauschgrund

            VorNummer = NummernkreisVorgang.VNkAktuellerWert
            1- select by VorArt A	VorGruppe RE	VNkArt 100000
            2 - get NummernkreisVorgang.VNkAktuellerWert
            3-  save it in  in Vorgang.VorNummer
            after create a Vorgang
            4 change  NummernkreisVorgang.VNkAktuellerWert to NummernkreisVorgang.VNkAktuellerWert + 1
        */


        try {
            return DB::transaction(function () use (&$header) {
                $header['vdatu'] = Carbon::parse($header['vdatu'])->format('Ymd');

                //  get InterneAdressnummer by 'kunnr' to save it in Vorgang.VorAuftraggeber
                $adresse = Adresse::where('AdressNummer', $header['kunnr'])->first();

                if ($adresse) {
                    $header['VorAuftraggeber'] = $adresse->InterneAdressnummer;
                    $header['VorLieferanschrift'] = $adresse->InterneAdressnummer;
                    $header['VorRechnungsanschrift'] = $adresse->InterneAdressnummer;
                    $header['VorSammelRechnungsanschrift'] = $adresse->InterneAdressnummer;
                } else {
                    Log::error("Kein Adresse für Vorgang gefunden");
                    return null;
                }

                $nummernkreisVorgang = NummernkreisVorgang::where('VorArt', 'A')
                    ->where('VorGruppe', 'RE')
                    ->where('VNkArt', '100000')
                    ->lockForUpdate()
                    ->first();

                if ($nummernkreisVorgang) {
                    $vorgang = Vorgang::
                    where('VorArt', 'A')
                        ->where('VorGruppe', 'RE')
                        ->where('VorNummer', $nummernkreisVorgang->VNkAktuellerWert)
                        ->first();
                    if ($vorgang) {
                        $header['VorNummer'] = $nummernkreisVorgang->VNkAktuellerWert + 1;
                    } else {
                        $header['VorNummer'] = $nummernkreisVorgang->VNkAktuellerWert;
                    }
                } else {
                    Log::error("Kein nummernkreisVorgang für Vorgang gefunden");
                    return null;
                }
                //txtZ013 - VorStichwort if NULL
                $header['txtZ013'] = $header['txtZ013'] ?? 'MONTAGEAUFTRAG';
                $header['VorArt'] = 'A';
                $header['VorUnterArt'] = 'R';  // char 1

                $header['VorGruppe'] = 'RE'; //  -- Montage/Liefer/Rechnung: 'RE' / Vertr ge: 'WIE' ? / Rahmenauftr ge: 'AB'
                $header['VorTeillieferungsNummer'] = '0'; //
                $header['VorStatus'] = '100100'; //-- 100000 Nicht gedruckt / 100010 Angebot / 100100 Auftragsbestätigung
                $header['MwstTypID'] = '3';
                $header['VorMwstTyp'] = '1';
                $header['VorWaehrungskurs'] = '1';
                $header['VorParallelkurs'] = '1';
                $header['VorWechselkurs'] = '1';
                $header['VorWaehrungskursFixiertJN'] = '0';
                $header['KZWaehrung'] = 'EUR';
                $header['VorLieferungTrennenJN'] = '0';
                $header['VorLagerumbuchungJN'] = '0';
                $header['VorEinzelnePreiseJN'] = '1';
                $header['VorLagerbuchungJN'] = '1';
                $header['VorUebertragenJN'] = '0';
                $header['VorVersandEMailJN'] = '0';
                $header['VorGeneriertJN'] = '0';
                $header['VorGesperrtJN'] = '0';
                $header['VorFilialExportJN'] = '0';
                $header['VorVertreterEingelesenJN'] = '0';
                $header['VorWHTfaehigJN'] = '0';
                $header['VorBruttoJN'] = '0';
                //---------------------------------------------------------------------------
                // NULLABLE but should be filled
                $header['VorHauptauftrag'] = '0';
                $header['KZSprache'] = 'DE';
                $now = date('Ymd');

                $header['VorAnlageAm'] = $now;
                $header['VorDatumAuftragsbestaetigung'] = $now;
                $header['VorDatumAuftragseingang'] = $now;


                $header['VorRechnungsanschriftAnsprechpartnerID'] = NULL; // TODO clarify later with Pante
                $header['VorLieferanschriftAnsprechpartnerID'] = NULL; // TODO clarify late with Pante
                $header['VorBetrefftextZeile1'] = NULL; // TODO clarify late with Pante (Important for miclas)
                $header['VorBetrefftextZeile2'] = NULL; // TODO clarify late with Pante (Important for miclas)


                $header['VorAnzahlDezimalstellen'] = '2';
                $vorgang = Vorgang::create([
                    'VorIndividualC1' => $header['vbeln'],
                    'VorIndividualC2' => $header['auart'],
                    'VorAuftraggeber' => $header['VorAuftraggeber'], // Kunnr
                    'VorLieferungWunschDatum' => $header['vdatu'],
                    'VorIndividualC3' => $header['zzlgsnr'],
                    'VorIndividualD4' => $header['genrCeos'], // GebäudeNr
                    'VorStichwort' => $header['txtZ013'],

                    // CEOS FIELDS
                    'VorArt' => $header['VorArt'],
                    'VorGruppe' => $header['VorGruppe'],
                    'VorUnterArt' => $header['VorUnterArt'],
                    'VorNummer' => $header['VorNummer'],

                    'VorTeillieferungsNummer' => $header['VorTeillieferungsNummer'],
                    'VorStatus' => $header['VorStatus'],
                    'MwstTypID' => $header['MwstTypID'],
                    'VorMwstTyp' => $header['VorMwstTyp'],
                    'VorWaehrungskurs' => $header['VorWaehrungskurs'],
                    'VorParallelkurs' => $header['VorParallelkurs'],
                    'VorWechselkurs' => $header['VorWechselkurs'],
                    'VorWaehrungskursFixiertJN' => $header['VorWaehrungskursFixiertJN'],
                    'KZWaehrung' => $header['KZWaehrung'],
                    'VorLieferungTrennenJN' => $header['VorLieferungTrennenJN'],
                    'VorLagerumbuchungJN' => $header['VorLagerumbuchungJN'],
                    'VorEinzelnePreiseJN' => $header['VorEinzelnePreiseJN'],
                    'VorLagerbuchungJN' => $header['VorLagerbuchungJN'],
                    'VorUebertragenJN' => $header['VorUebertragenJN'],
                    'VorVersandEMailJN' => $header['VorVersandEMailJN'],
                    'VorGeneriertJN' => $header['VorGeneriertJN'],
                    'VorGesperrtJN' => $header['VorGesperrtJN'],
                    'VorFilialExportJN' => $header['VorFilialExportJN'],
                    'VorVertreterEingelesenJN' => $header['VorVertreterEingelesenJN'],
                    'VorWHTfaehigJN' => $header['VorWHTfaehigJN'],
                    'VorBruttoJN' => $header['VorBruttoJN'],
                    'KZSprache' => $header['KZSprache'],
                    'VorAnzahlDezimalstellen' => $header['VorAnzahlDezimalstellen'],

                    'VorLieferanschrift' => $header['VorLieferanschrift'],
                    'VorRechnungsanschrift' => $header['VorRechnungsanschrift'],
                    'VorSammelRechnungsanschrift' => $header['VorSammelRechnungsanschrift'],
                    'VorHauptauftrag' => $header['VorHauptauftrag'],

                    'VorAnlageAm' => $header['VorAnlageAm'],
                    'VorDatumAuftragsbestaetigung' => $header['VorDatumAuftragsbestaetigung'],
                    'VorDatumAuftragseingang' => $header['VorDatumAuftragseingang'],
                    'VorRechnungsanschriftAnsprechpartnerID' => $header['VorRechnungsanschriftAnsprechpartnerID'],
                    'VorLieferanschriftAnsprechpartnerID' => $header['VorLieferanschriftAnsprechpartnerID'],
                    'VorBetrefftextZeile1' => $header['VorBetrefftextZeile1'],
                    'VorBetrefftextZeile2' => $header['VorBetrefftextZeile2'],
                ]);

                // Add 1 to $nummernkreisVorgang->VNkAktuellerWert;
                NummernkreisVorgang::where('VorArt', 'A')
                    ->where('VorGruppe', 'RE')
                    ->where('VNkArt', '100000')
                    ->update(['VNkAktuellerWert' => $header['VorNummer'] + 1]);

                DB::connection('sqlsrv2')->table('cis.Vorgang2Text')->insertGetId([
                    'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
                    'VorNotiz' => $header['txtZ012']
                ]);

                DB::connection('sqlsrv2')->table('cis.Vorgang3Zahlung')->insertGetId([
                    'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
                    'VorSonderkonditionenJN' => 0,
                    'VorBonusAbrechnungJN' => 0,
                    'VorZbdVariabelJN' => 0,
                ]);

                DB::connection('sqlsrv2')->table('cis.Vorgang4Versand')->insertGetId([
                    'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
                    'VorTransportversicherungJN' => 0,
                    'VorVersandPrivatZustJN' => 0,
                ]);

                DB::connection('sqlsrv2')->table('cis.Vorgang5Angebot')->insertGetId([
                    'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
                    'VorAngebotVerfolgenJN' => 1,
                    'VorAbschlussOutlookIsTask' => 0,
                    'VorWiederVorlageOutlookIsTask' => 0,
                ]);

                DB::connection('sqlsrv2')->table('cis.Vorgang6Wiederhol')->insertGetId([
                    'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
                    'VorWiederholMonat' => 0,
                    'VorWiederholKennzeichen' => 0,
                    'VorDruckKennzeichen' => 0,
                ]);

                DB::connection('sqlsrv2')->table('cis.VorgangWert')->insertGetId([
                    'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
                    'VorWBruttowertGesamt' => 0,
                    'VorWBruttowertAuftrag' => 0,
                    'VorWBruttowertAbrechnung' => 0,
                    'VorWBruttowertLieferung' => 0,
                    'VorWBruttowertVersand' => 0,
                    'VorWBruttowertGut' => 0,
                    'VorWBruttowertRechnung' => 0,
                    'VorWNettoPlusZusatzGesamt' => 0,
                    'VorWNettoPlusZusatzAuftrag' => 0,
                    'VorWNettoPlusZusatzAbrechnung' => 0,
                    'VorWNettoPlusZusatzLieferung' => 0,
                    'VorWNettoPlusZusatzVersand' => 0,
                    'VorWNettoPlusZusatzGut' => 0,
                    'VorWNettoPlusZusatzRechnung' => 0,
                    'VorWNettoMinusRabattGesamt' => 0,
                    'VorWNettoMinusRabattAuftrag' => 0,
                    'VorWNettoMinusRabattAbrechnung' => 0,
                    'VorWNettoMinusRabattLieferung' => 0,
                    'VorWNettoMinusRabattVersand' => 0,
                    'VorWNettoMinusRabattGut' => 0,
                    'VorWNettoMinusRabattRechnung' => 0,
                    'VorWNettoMinusAKontoAbrechnung' => 0,
                    'VorWNettoMinusAKontoLieferung' => 0,
                    'VorWNettoMinusAKontoRechnung' => 0,
                    'VorWNettowertGesamt' => 0,
                    'VorWNettowertAuftrag' => 0,
                    'VorWNettowertAbrechnung' => 0,
                    'VorWNettowertLieferung' => 0,
                    'VorWNettowertVersand' => 0,
                    'VorWNettowertGut' => 0,
                    'VorWNettowertRechnung' => 0,
                    'VorWNettowertMwst1Gesamt' => 0,
                    'VorWNettowertMwst1Auftrag' => 0,
                    'VorWNettowertMwst1Abrechnung' => 0,
                    'VorWNettowertMwst1Lieferung' => 0,
                    'VorWNettowertMwst1Versand' => 0,
                    'VorWNettowertMwst1Gut' => 0,
                    'VorWNettoEKGesamt' => 0,
                    'VorWNettoEKAuftrag' => 0,
                    'VorWNettoEKAbrechnung' => 0,
                    'VorWNettoEKLieferung' => 0,
                    'VorWNettoEKVersand' => 0,
                    'VorWNettoEKGut' => 0,
                    'VorWNettoEKRechnung' => 0,
                    'VorWNettoEKOhneNKGesamt' => 0,
                    'VorWNettoEKOhneNKVTGesamt' => 0,
                    'VorWNettoEKVTGesamt' => 0,
                    'VorWNettoEKVTAuftrag' => 0,
                    'VorWNettoEKVTAbrechnung' => 0,
                    'VorWNettoEKVTLieferung' => 0,
                    'VorWNettoEKVTVersand' => 0,
                    'VorWNettoEKVTGut' => 0,
                    'VorWNettoEKVTRechnung' => 0,
                    'VorWGewichtGesamt' => 0,
                    'VorWGewichtAuftrag' => 0,
                    'VorWGewichtAbrechnung' => 0,
                    'VorWGewichtLieferung' => 0,
                    'VorWGewichtVersand' => 0,
                    'VorWGewichtGut' => 0,
                    'VorWGewichtRechnung' => 0,
                ]);

                return [
                    'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
                    'VorNummer' => $header['VorNummer'],
                    'VorGruppe' => $header['VorGruppe'],
                    'Verkaufsbeleg' => $header['vbeln'],
                ];
            });
        } catch (Throwable $e) {
            Log::error('sd_0101_beauftragung_vorgang' . $e->getMessage());
            return null;
        }
    }

    public function sd_0101_beauftragung_positions($positions, $vorgangDataArray): ?array
    {
        $interneVorgangsnummer = $vorgangDataArray['InterneVorgangsnummer'];
        $vorNummer = $vorgangDataArray['VorNummer'];
        $vorGruppe = $vorgangDataArray['VorGruppe'];
        $verkaufsbeleg = $vorgangDataArray['Verkaufsbeleg'];
        $now = date('Ymd');

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
        VORGN_INT => InterneVorgangsnummer
         */
        $positionsResultArray = array();
        foreach ($positions as $key => $position) {
            try {
                $position['matnr'] = ltrim($position['matnr'], '0');
                $interneArtikelnummer = Artikel::where('Artikelnummer', $position['matnr'])->first();
                if ($interneArtikelnummer === null) {
                    Log::error(
                        "Material für Vorgang nicht gefunden",
                        [
                            'Material' => $position['matnr'],
                            'Vorgangnummer' => $vorNummer
                        ]
                    );
                    return null;
                }
                $preisbasis = Preisbasis::where('NRPreisbasis', $interneArtikelnummer->NRPreisbasis)->first();

                //todo convert to model
                $internePositionsnummer = DB::connection('sqlsrv2')->table('cis.Position')->insertGetId([
                    'InterneVorgangsnummer' => $interneVorgangsnummer,
                    'PosVorgaenger' => 0,
                    'PosHaupt' => 0,
                    'PosEbene' => 0,
                    'PosNummer' => $key + 1,
                    'PosNummernText' => $key + 1,

                    'InterneArtikelnummer' => $interneArtikelnummer->InterneArtikelnummer,
                    'KZArtikelgruppe' => $interneArtikelnummer->KZArtikelgruppe,
                    'KZWarengruppe' => $interneArtikelnummer->KZWarengruppe,
                    'ArtikelUntergruppeID' => $interneArtikelnummer->ArtikelUntergruppeID,
                    'KZProduktgruppe' => $interneArtikelnummer->KZProduktgruppe,
                    'PosBezeichnung1' => $interneArtikelnummer->ArtBezeichnung1,
                    'KZKalkulationGruppe' => $interneArtikelnummer->KZKalkulationGruppe,

                    'PosNeueSeite' => 0,
                    'PosSeriennummernfaehigJN' => 1,
                    'PosChargenfaehigJN' => 1,
                    'PosAutoAbbuchenJN' => 0,
                    'PosAutoZubuchenJN' => 0,
                    'PosGebuchtJN' => 0,
                    'PosErledigtJN' => 0,
                    'PosLagerbuchungJN' => 1,
                    'PosFremdfertigungJN' => 0,
                    'PosLieferantenfaehigJN' => 0,
                    'PosFertigungsfaehigJN' => 0,
                    'PosUrsprungsnachweisJN' => 0,
                    'PosEKInNachkalkulationJN' => 0,
                    'PosAnlageAm' => $now,
                ]);

                $position1Wert = DB::connection('sqlsrv2')->table('cis.Position1Wert')->insertGetId([
                    'InterneVorgangsnummer' => $interneVorgangsnummer,
                    'InternePositionsnummer' => $internePositionsnummer,
                    'PosRabattfaehig' => 1,
                    'PosRabattUnterpositionJN' => 0,
                    'PosRabattPosition1' => 0,
                    'PosRabattPosition2' => 0,
                    'PosRabattPosition3' => 0,
                    'PosRabattAdresse' => 0,
                    'PosRabattWert1' => 0,
                    'PosRabattWert2' => 0,
                    'NRPreisbasis' => $interneArtikelnummer->NRPreisbasis,
                    'PosPreisfaktor' => $preisbasis->Preisfaktor,
                    'PosPreisProME2' => 0,
                    'PosPreisEinzel' => 0,
                    'PosPreisUnterposition' => 0,
                    'PosPreisUnterposLager' => 0,
                    'PosPreisPosition' => 0,
                    'PosGesamteinzelpreis' => 0,
                    'PosGesamtpreisVorRabatt' => 0,
                    'PosGesamtpreis' => 0,
                    'PosPreisEinkauf' => 0,
                    'PosPreisEinkaufOriginal' => 0,
                    'PosPreisEinkaufUnterposition' => 0,
                    'PosPreisEinkaufVT' => 0,
                    'PosPreisEinkaufUnterpositionVT' => 0,
                    'PosGesamteinzelpreisEK' => 0,
                    'PosGesamtpreisEK' => 0,
                    'PosGesamteinzelpreisEKVT' => 0,
                    'PosGesamtpreisEKVT' => 0,
                    'PosPreisVerbindlichkeit' => 0,
                    'PosRundungsfaktorVK' => 0,
                    'PosAbzugEK' => 0,
                    'MwstNummer' => 3,                    //-- ?
                    'PosMwstProzent' => 19,                 //-- ?
                    'PosVerschnitt' => 0,
                    'PosDBEinzel' => 0,
                    'PosDBGesamt' => 0,
                    'PosDBProzent' => 0,
                    'PosDBAufschlag' => 0,
                    'PosSkontofaehigJN' => 1,
                ]);
                DB::connection('sqlsrv2')->table('cis.Position2Text')->insertGetId([
                    'InterneVorgangsnummer' => $interneVorgangsnummer,
                    'InternePositionsnummer' => $internePositionsnummer,
                    'PosZusatztextLieferschein' => $position['txtZ002'],
                    'PosZusatztext' => $position['txtZ009'],
                    'PosNotiz' => $position['txtZ010'],
                    'PosBezeichnung2' => $interneArtikelnummer->ArtBezeichnung2,
                ]);


                DB::connection('sqlsrv2')->table('cis.Position3Menge')->insertGetId([
                    'InterneVorgangsnummer' => $interneVorgangsnummer,
                    'InternePositionsnummer' => $internePositionsnummer,
                    'PosMenge1' => $position['kwmeng'],
                    'PosKZMengeneinheit1' => $position['vrkme'],
                    'PosMengeAuftrag1' => 0,
                    'PosMengeLieferung1' => 0,
                    'PosMengeAbrechnung1' => 0,
                    'PosMengeRechnung1' => 0,
                    'PosMengeVersand1' => 0,
                    'PosMengeAusschuss1' => 0,
                    'PosMenge2' => 0, // todo Clarify with johannes
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


                DB::connection('sqlsrv2')->table('cis.Position4Lieferung')->insertGetId([
                    'InterneVorgangsnummer' => $interneVorgangsnummer,
                    'InternePositionsnummer' => $internePositionsnummer,
                    'PosLiefertermineJN' => 0,
                    'PosVerladenJN' => 0,
                    'PosMahnstufe' => 0,
                    'PosMahnstufeBestaetigung' => 0,
                    'PosMahnfolgetage' => 0,
                    'PosMahnfolgetageBestaetigung' => 0,
                ]);


                DB::connection('sqlsrv2')->table('cis.Position5Individual')->insertGetId([
                    'InterneVorgangsnummer' => $interneVorgangsnummer,
                    'InternePositionsnummer' => $internePositionsnummer,
                    'PosIndividualC3' => $position['kondm'],
                    'PosIndividualD1' => $position['posnr'],
                    'PosIndividualD7' => NULL, // todo  @ErweiterungVertragsNr from Johannes text
                    'PosIndividualC7' => $vorGruppe . ' ' . $vorNummer,

                ]);


                DB::connection('sqlsrv2')->table('cis.Position6Stueckliste')->insertGetId([
                    'InterneVorgangsnummer' => $interneVorgangsnummer,
                    'InternePositionsnummer' => $internePositionsnummer,
                    'PosStkAufAusgabeJN' => 1,
                    'PosStkBesAusgabeJN' => 1,
                    'PosStkKalkulationsstopJN' => 0,
                    'PosStkBestellbeistellungJN' => 0,
                    'PosStkKundenbeistellungJN' => 0,
                    'PosStkKundenbeistellabgangJN' => 0,
                    'PosStkPseudobaugruppeJN' => 0,
                    'PosStkManuellJN' => 0,
                    'PosStkDispotermin' => 0,
                    'PosStkDispodifferenz' => 0,
                ]);

                DB::connection('sqlsrv2')->table('cis.Position7Zusatz')->insertGetId([
                    'InterneVorgangsnummer' => $interneVorgangsnummer,
                    'InternePositionsnummer' => $internePositionsnummer,
                    'PosErsatzteilJN' => 0,
                    'PosPraeferenzJNA' => 0,
                    'PosPraeferenzDynamischJN' => 0,
                    'PosPraeferenzWert' => 0,
                    'PosServiceJN' => 0,
                    'PosAusNachkalkulationJN' => 0,
                    'PosMTZFixiertJN' => 0,
                    'PosBuchungsfreigabeJN' => 0,
                ]);

                DB::connection('sqlsrv2')->table('cis.PositionWert')->insertGetId([
                    'InterneVorgangsnummer' => $interneVorgangsnummer,
                    'InternePositionsnummer' => $internePositionsnummer,
                    'PosWPreisPositionGesamt' => 0,
                    'PosWPreisPositionAuftrag' => 0,
                    'PosWPreisPositionAbrechnung' => 0,
                    'PosWPreisPositionLieferung' => 0,
                    'PosWPreisPositionVersand' => 0,
                    'PosWPreisPositionGut' => 0,
                    'PosWPreisPositionRechnung' => 0,
                    'PosWGesamtpreisVorRabattGes' => 0,
                    'PosWGesamtpreisVorRabattAuf' => 0,
                    'PosWGesamtpreisVorRabattAbr' => 0,
                    'PosWGesamtpreisVorRabattLief' => 0,
                    'PosWGesamtpreisVorRabattVers' => 0,
                    'PosWGesamtpreisVorRabattGut' => 0,
                    'PosWGesamtpreisVorRabattRec' => 0,
                    'PosWGesamtpreisGesamt' => 0,
                    'PosWGesamtpreisAuftrag' => 0,
                    'PosWGesamtpreisAbrechnung' => 0,
                    'PosWGesamtpreisLieferung' => 0,
                    'PosWGesamtpreisVersand' => 0,
                    'PosWGesamtpreisGut' => 0,
                    'PosWGesamtpreisRechnung' => 0,
                    'PosWGesamtpreisEKGesamt' => 0,
                    'PosWGesamtpreisEKAuftrag' => 0,
                    'PosWGesamtpreisEKAbrechnung' => 0,
                    'PosWGesamtpreisEKLieferung' => 0,
                    'PosWGesamtpreisEKVersand' => 0,
                    'PosWGesamtpreisEKGut' => 0,
                    'PosWGesamtpreisEKRechnung' => 0,
                    'PosWGesamtpreisEKVTGesamt' => 0,
                    'PosWGesamtpreisEKVTAuftrag' => 0,
                    'PosWGesamtpreisEKVTAbrechnung' => 0,
                    'PosWGesamtpreisEKVTLieferung' => 0,
                    'PosWGesamtpreisEKVTVersand' => 0,
                    'PosWGesamtpreisEKVTGut' => 0,
                    'PosWGesamtpreisEKVTRechnung' => 0,
                    'PosWEinzelpreisMinusRabatt' => 0,
                    'PosWMengeGesamt1' => $position['kwmeng'],
                    'PosWMengeAuftrag1' => $position['kwmeng'],
                    'PosWMengeAbrechnung1' => $position['kwmeng'],
                    'PosWMengeLieferung1' => $position['kwmeng'],
                    'PosWMengeVersand1' => $position['kwmeng'],
                    'PosWMengeGut1' => $position['kwmeng'],
                    'PosWMengeRechnung1' => $position['kwmeng'],
                ]);

                $positionsResultArray[] = [
                    'InternePositionsnummer' => $internePositionsnummer,
                    'posnr' => $position['posnr'],
                    'InterneVorgangsnummer' => $interneVorgangsnummer,
                    'vbeln' => $verkaufsbeleg,
                    'vorgn' => $vorNummer,
                ];
            } catch (Throwable $e) {
                Log::error('sd_0101_beauftragung_positions Error:' . $e->getMessage());
                return null;
            }
        }
        return $positionsResultArray;
    }


    /**
     * SD-01-02 Beauftragung Rueckmeldung
     */

    public function sd_0102_beauftragung_rueckmeldung($request)
    {
        try {
            $data = [];
            $vorgang = Vorgang::where('InterneVorgangsnummer', $request->InterneVorgangsnummer)->first();
            if (is_null($vorgang)) {
                return null;
            }
            $adresse = Adresse::where('InterneAdressnummer', $vorgang->VorAuftraggeber)->first();
            if ($adresse) {
                $data['Kunnr'] = $adresse->AdressNummer;
            } else {
                Log::error(
                    "Kein Adresse für Vorgang gefunden",
                    ['Vorgangnummer' => $request->InterneVorgangsnummer]
                );
                return null;
            }
            $data['Vbeln'] = (string)$vorgang->VorIndividualC1;
            $data['Auart'] = (string)$vorgang->VorIndividualC2;
            $data['Vdatu'] = Carbon::parse($vorgang->VorLieferungWunschDatum)->format('Y-m-d');
            $data['Zzlgsnr'] = (string)$vorgang->VorIndividualC3 ?? '';
            $data['GenrCeos'] = (string)(int)$vorgang->VorIndividualD4;
            $data['TxtZ013'] = (string)$vorgang->VorStichwort ?? '';

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
     * SD-02-01 Mietvertragsrechnungen
     */
    public function sd_0201_mietvertragsrechnungen(): array
    {
        // create Vorgang with same vorNummer that they sent
        // create positionen für this Vorgang
        return ['vorNummer' => '12301'];
    }


    /**
     * SAP -> CEOS
     * SD-03-01 Dienstleistungsabrechnung
     */
    public function sd_0301_dienstleistungsabrechnung($validated): array
    {
        // create Vorgang with same vorNummer that they sent
        // create positioned für this Vorgang
        return ['vorNummer' => '12301'];
    }
}
