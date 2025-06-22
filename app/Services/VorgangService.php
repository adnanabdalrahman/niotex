<?php

namespace App\Services;

use App\Models\NummernkreisVorgang;
use App\Models\Vorgang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class VorgangService
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('sap.base_url');
    }

    public function createVorgang($data): ?array
    {
        try {
            $nummernkreisVorgang = NummernkreisVorgang::where('VorArt', $data['VorArt'])
                ->where('VorGruppe', $data['VorGruppe'])
                ->where('VNkArt', $data['VNkArt'])
                ->lockForUpdate()
                ->first();

            if ($nummernkreisVorgang) {
                $vorgang = Vorgang::
                where('VorArt', $data['VorArt'])
                    ->where('VorGruppe', $data['VorGruppe'])
                    ->where('VorNummer', $nummernkreisVorgang->VNkAktuellerWert)
                    ->first();
                if ($vorgang) {
                    $data['VorNummer'] = $nummernkreisVorgang->VNkAktuellerWert + 1;
                } else {
                    $data['VorNummer'] = $nummernkreisVorgang->VNkAktuellerWert;
                }
            } else {
                Log::error("Kein nummernkreisVorgang für Vorgang gefunden");
                return null;
            }

            //---------------------------------------------------------------------------
            return DB::transaction(function () use (&$data) {
                $vorgang = Vorgang::create([
                    'VorArt' => $data['VorArt'],
                    'VorGruppe' => $data['VorGruppe'],
                    'VorUnterArt' => $data['VorUnterArt'],
                    'VorNummer' => $data['VorNummer'],
                    'VorStatus' => $data['VorStatus'],

                    'VorLieferungWunschDatum' => $data['VorLieferungWunschDatum'] ?? null,
                    'VorAuftraggeber' => $data['VorAuftraggeber'], // Kunnr
                    'VorIndividualD4' => $data['VorIndividualD4'] ?? null, // GebäudeNr
                    'VorLieferanschrift' => $data['VorLieferanschrift'] ?? null,
                    'VorRechnungsanschrift' => $data['VorRechnungsanschrift'] ?? null,
                    'VorSammelRechnungsanschrift' => $data['VorSammelRechnungsanschrift'] ?? null,
                    'VorDatumRechnung' => $data['VorDatumRechnung'] ?? null,
                    'VorIndividualT1' => $data['VorIndividualT1'] ?? null,
                    'VorIndividualT2' => $data['VorIndividualT2'] ?? null,


                    // TODO clarify late with Pante (Important for miclas),
                    'VorRechnungsanschriftAnsprechpartnerID' => $data['VorRechnungsanschriftAnsprechpartnerID'] ?? null,
                    'VorLieferanschriftAnsprechpartnerID' => $data['VorLieferanschriftAnsprechpartnerID'] ?? null,
                    'VorBetrefftextZeile1' => $data['VorBetrefftextZeile1'] ?? null,
                    'VorBetrefftextZeile2' => $data['VorBetrefftextZeile2'] ?? null,

                    'VorIndividualC1' => $data['VorIndividualC1'] ?? null,
                    'VorIndividualC2' => $data['VorIndividualC2'] ?? null,
                    'VorIndividualC3' => $data['VorIndividualC3'] ?? null,
                    'VorIndividualC7' => $data['VorIndividualC7'] ?? null,

                    'VorStichwort' => $data['VorStichwort'] ?? null,

                    'VorTeillieferungsNummer' => $data['VorTeillieferungsNummer'] ?? '0',
                    'MwstTypID' => $data['MwstTypID'] ?? 3,
                    'VorMwstTyp' => $data['VorMwstTyp'] ?? 1,
                    'VorWaehrungskurs' => $data['VorWaehrungskurs'] ?? 1,
                    'VorParallelkurs' => $data['VorParallelkurs'] ?? 1,
                    'VorWechselkurs' => $data['VorWechselkurs'] ?? 1,
                    'VorWaehrungskursFixiertJN' => $data['VorWaehrungskursFixiertJN'] ?? 0,
                    'KZWaehrung' => $data['KZWaehrung'] ?? 'EUR',
                    'VorLieferungTrennenJN' => $data['VorLieferungTrennenJN'] ?? '0',
                    'VorLagerumbuchungJN' => $data['VorLagerumbuchungJN'] ?? '0',
                    'VorEinzelnePreiseJN' => $data['VorEinzelnePreiseJN'] ?? '1',
                    'VorLagerbuchungJN' => $data['VorLagerbuchungJN'] ?? '1',
                    'VorUebertragenJN' => $data['VorUebertragenJN'] ?? '0',
                    'VorVersandEMailJN' => $data['VorVersandEMailJN'] ?? '0',
                    'VorGeneriertJN' => $data['VorGeneriertJN'] ?? '0',
                    'VorGesperrtJN' => $data['VorGesperrtJN'] ?? '0',
                    'VorFilialExportJN' => $data['VorFilialExportJN'] ?? '0',
                    'VorVertreterEingelesenJN' => $data['VorVertreterEingelesenJN'] ?? '0',
                    'VorWHTfaehigJN' => $data['VorWHTfaehigJN'] ?? '0',
                    'VorBruttoJN' => $data['VorBruttoJN'] ?? '0',
                    'KZSprache' => $data['KZSprache'] ?? 'DE',
                    'VorAnzahlDezimalstellen' => $data['VorAnzahlDezimalstellen'] ?? '2',
                    'VorHauptauftrag' => $data['VorHauptauftrag'] ?? '0',
                    'VorAnlageAm' => $data['VorAnlageAm'] ?? date('Ymd'),
                    'VorDatumAuftragsbestaetigung' => $data['VorDatumAuftragsbestaetigung'] ?? date('Ymd'),
                    'VorDatumAuftragseingang' => $data['VorDatumAuftragseingang'] ?? date('Ymd'),
                ]);
                // Add 1 to $nummernkreisVorgang->VNkAktuellerWert;
                NummernkreisVorgang::where('VorArt', $data['VorArt'])
                    ->where('VorGruppe', $data['VorGruppe'])
                    ->where('VNkArt', $data['VNkArt'])
                    ->update(['VNkAktuellerWert' => $data['VorNummer'] + 1]);

                DB::connection('sqlsrv2')->table('cis.Vorgang2Text')->insertGetId([
                    'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
                    'VorNotiz' => $data['VorNotiz'] ?? null
                ]);

                DB::connection('sqlsrv2')->table('cis.Vorgang3Zahlung')->insertGetId([
                    'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
                    'VorSonderkonditionenJN' => $data['VorSonderkonditionenJN'] ?? 0,
                    'VorBonusAbrechnungJN' => $data['VorBonusAbrechnungJN'] ?? 0,
                    'VorZbdVariabelJN' => $data['VorZbdVariabelJN'] ?? 0,
                ]);

                DB::connection('sqlsrv2')->table('cis.Vorgang4Versand')->insertGetId([
                    'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
                    'VorTransportversicherungJN' => $data['VorTransportversicherungJN'] ?? 0,
                    'VorVersandPrivatZustJN' => $data['VorVersandPrivatZustJN'] ?? 0,
                ]);

                DB::connection('sqlsrv2')->table('cis.Vorgang5Angebot')->insertGetId([
                    'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
                    'VorAngebotVerfolgenJN' => $data['VorAngebotVerfolgenJN'] ?? 1,
                    'VorAbschlussOutlookIsTask' => $data['VorAbschlussOutlookIsTask'] ?? 0,
                    'VorWiederVorlageOutlookIsTask' => $data['VorWiederVorlageOutlookIsTask'] ?? 0,
                ]);

                DB::connection('sqlsrv2')->table('cis.Vorgang6Wiederhol')->insertGetId([
                    'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
                    'VorWiederholMonat' => $data['VorWiederholMonat'] ?? 0,
                    'VorWiederholKennzeichen' => $data['VorWiederholKennzeichen'] ?? 0,
                    'VorDruckKennzeichen' => $data['VorDruckKennzeichen'] ?? 0,
                ]);

                DB::connection('sqlsrv2')->table('cis.VorgangWert')->insertGetId([
                    'InterneVorgangsnummer' => $data['InterneVorgangsnummer'] ?? $vorgang->InterneVorgangsnummer,
                    'VorWBruttowertGesamt' => $data['VorWBruttowertGesamt'] ?? 0,
                    'VorWBruttowertAuftrag' => $data['VorWBruttowertAuftrag'] ?? 0,
                    'VorWBruttowertAbrechnung' => $data['VorWBruttowertAbrechnung'] ?? 0,
                    'VorWBruttowertLieferung' => $data['VorWBruttowertLieferung'] ?? 0,
                    'VorWBruttowertVersand' => $data['VorWBruttowertVersand'] ?? 0,
                    'VorWBruttowertGut' => $data['VorWBruttowertGut'] ?? 0,
                    'VorWBruttowertRechnung' => $data['VorWBruttowertRechnung'] ?? 0,
                    'VorWNettoPlusZusatzGesamt' => $data['VorWNettoPlusZusatzGesamt'] ?? 0,
                    'VorWNettoPlusZusatzAuftrag' => $data['VorWNettoPlusZusatzAuftrag'] ?? 0,
                    'VorWNettoPlusZusatzAbrechnung' => $data['VorWNettoPlusZusatzAbrechnung'] ?? 0,
                    'VorWNettoPlusZusatzLieferung' => $data['VorWNettoPlusZusatzLieferung'] ?? 0,
                    'VorWNettoPlusZusatzVersand' => $data['VorWNettoPlusZusatzVersand'] ?? 0,
                    'VorWNettoPlusZusatzGut' => $data['VorWNettoPlusZusatzGut'] ?? 0,
                    'VorWNettoPlusZusatzRechnung' => $data['VorWNettoPlusZusatzRechnung'] ?? 0,
                    'VorWNettoMinusRabattGesamt' => $data['VorWNettoMinusRabattGesamt'] ?? 0,
                    'VorWNettoMinusRabattAuftrag' => $data['VorWNettoMinusRabattAuftrag'] ?? 0,
                    'VorWNettoMinusRabattAbrechnung' => $data['VorWNettoMinusRabattAbrechnung'] ?? 0,
                    'VorWNettoMinusRabattLieferung' => $data['VorWNettoMinusRabattLieferung'] ?? 0,
                    'VorWNettoMinusRabattVersand' => $data['VorWNettoMinusRabattVersand'] ?? 0,
                    'VorWNettoMinusRabattGut' => $data['VorWNettoMinusRabattGut'] ?? 0,
                    'VorWNettoMinusRabattRechnung' => $data['VorWNettoMinusRabattRechnung'] ?? 0,
                    'VorWNettoMinusAKontoAbrechnung' => $data['VorWNettoMinusAKontoAbrechnung'] ?? 0,
                    'VorWNettoMinusAKontoLieferung' => $data['VorWNettoMinusAKontoLieferung'] ?? 0,
                    'VorWNettoMinusAKontoRechnung' => $data['VorWNettoMinusAKontoRechnung'] ?? 0,
                    'VorWNettowertGesamt' => $data['VorWNettowertGesamt'] ?? 0,
                    'VorWNettowertAuftrag' => $data['VorWNettowertAuftrag'] ?? 0,
                    'VorWNettowertAbrechnung' => $data['VorWNettowertAbrechnung'] ?? 0,
                    'VorWNettowertLieferung' => $data['VorWNettowertLieferung'] ?? 0,
                    'VorWNettowertVersand' => $data['VorWNettowertVersand'] ?? 0,
                    'VorWNettowertGut' => $data['VorWNettowertGut'] ?? 0,
                    'VorWNettowertRechnung' => $data['VorWNettowertRechnung'] ?? 0,
                    'VorWNettowertMwst1Gesamt' => $data['VorWNettowertMwst1Gesamt'] ?? 0,
                    'VorWNettowertMwst1Auftrag' => $data['VorWNettowertMwst1Auftrag'] ?? 0,
                    'VorWNettowertMwst1Abrechnung' => $data['VorWNettowertMwst1Abrechnung'] ?? 0,
                    'VorWNettowertMwst1Lieferung' => $data['VorWNettowertMwst1Lieferung'] ?? 0,
                    'VorWNettowertMwst1Versand' => $data['VorWNettowertMwst1Versand'] ?? 0,
                    'VorWNettowertMwst1Gut' => $data['VorWNettowertMwst1Gut'] ?? 0,
                    'VorWNettoEKGesamt' => $data['VorWNettoEKGesamt'] ?? 0,
                    'VorWNettoEKAuftrag' => $data['VorWNettoEKAuftrag'] ?? 0,
                    'VorWNettoEKAbrechnung' => $data['VorWNettoEKAbrechnung'] ?? 0,
                    'VorWNettoEKLieferung' => $data['VorWNettoEKLieferung'] ?? 0,
                    'VorWNettoEKVersand' => $data['VorWNettoEKVersand'] ?? 0,
                    'VorWNettoEKGut' => $data['VorWNettoEKGut'] ?? 0,
                    'VorWNettoEKRechnung' => $data['VorWNettoEKRechnung'] ?? 0,
                    'VorWNettoEKOhneNKGesamt' => $data['VorWNettoEKOhneNKGesamt'] ?? 0,
                    'VorWNettoEKOhneNKVTGesamt' => $data['VorWNettoEKOhneNKVTGesamt'] ?? 0,
                    'VorWNettoEKVTGesamt' => $data['VorWNettoEKVTGesamt'] ?? 0,
                    'VorWNettoEKVTAuftrag' => $data['VorWNettoEKVTAuftrag'] ?? 0,
                    'VorWNettoEKVTAbrechnung' => $data['VorWNettoEKVTAbrechnung'] ?? 0,
                    'VorWNettoEKVTLieferung' => $data['VorWNettoEKVTLieferung'] ?? 0,
                    'VorWNettoEKVTVersand' => $data['VorWNettoEKVTVersand'] ?? 0,
                    'VorWNettoEKVTGut' => $data['VorWNettoEKVTGut'] ?? 0,
                    'VorWNettoEKVTRechnung' => $data['VorWNettoEKVTRechnung'] ?? 0,
                    'VorWGewichtGesamt' => $data['VorWGewichtGesamt'] ?? 0,
                    'VorWGewichtAuftrag' => $data['VorWGewichtAuftrag'] ?? 0,
                    'VorWGewichtAbrechnung' => $data['VorWGewichtAbrechnung'] ?? 0,
                    'VorWGewichtLieferung' => $data['VorWGewichtLieferung'] ?? 0,
                    'VorWGewichtVersand' => $data['VorWGewichtVersand'] ?? 0,
                    'VorWGewichtGut' => $data['VorWGewichtGut'] ?? 0,
                    'VorWGewichtRechnung' => $data['VorWGewichtRechnung'] ?? 0,
                ]);

                DB::connection('sqlsrv2')->table('cis.Vorgang1Wert')->insertGetId([
                    'InterneVorgangsnummer' => $data['InterneVorgangsnummer'] ?? $vorgang->InterneVorgangsnummer,
                    'VorRabattProzent' => $data['VorRabattProzent'] ?? 0,
                    'VorZusRabattProzent' => $data['VorZusRabattProzent'] ?? 0,
                    'VorAdrRabattProzent' => $data['VorAdrRabattProzent'] ?? 0,
                    'VorNettowert' => $data['VorNettowert'] ?? 0,
                    'VorNettowertMwst1' => $data['VorNettowertMwst1'] ?? 0,
                    'VorNettowertMwst2' => $data['VorNettowertMwst2'] ?? null,
                    'VorNettowertMwst3' => $data['VorNettowertMwst3'] ?? null,
                    'VorMwstSatz1' => $data['VorMwstSatz1'] ?? 0,
                    'VorMwstSatz2' => $data['VorMwstSatz2'] ?? null,
                    'VorMwstSatz3' => $data['VorMwstSatz3'] ?? null,
                    'VorMwstSatzProzent1' => $data['VorMwstSatzProzent1'] ?? 19,
                    'VorMwstSatzProzent2' => $data['VorMwstSatzProzent2'] ?? null,
                    'VorMwstSatzProzent3' => $data['VorMwstSatzProzent3'] ?? null,
                    'VorNettoMinusRabatt' => $data['VorNettoMinusRabatt'] ?? 0,
                    'VorNettoPlusZusatzkosten' => $data['VorNettoPlusZusatzkosten'] ?? 0,
                    'VorNettoAKonto' => $data['VorNettoAKonto'] ?? 0,
                    'VorMwstAKonto' => $data['VorMwstAKonto'] ?? 0,
                    'VorNettoMinusAKonto' => $data['VorNettoMinusAKonto'] ?? 0,
                    'VorBruttowert' => $data['VorBruttowert'] ?? 0,
                    'VorBruttowertBezahlt' => $data['VorBruttowertBezahlt'] ?? 0,
                    'VorBruttowertZusatzkonto' => $data['VorBruttowertZusatzkonto'] ?? 0,
                    'VorBruttowertSkonto' => $data['VorBruttowertSkonto'] ?? 0,
                    'VorNettoEinkauf' => $data['VorNettoEinkauf'] ?? 0,
                    'VorNettoEinkaufVT' => $data['VorNettoEinkaufVT'] ?? 0,
                    'VorNettoEinkaufAKonto' => $data['VorNettoEinkaufAKonto'] ?? 0,
                    'VorNettoEinkaufAKontoVT' => $data['VorNettoEinkaufAKontoVT'] ?? 0,
                    'VorNettoEinkaufOhneNachkalk' => $data['VorNettoEinkaufOhneNachkalk'] ?? 0,
                    'VorNettoEinkaufOhneNachkalkVT' => $data['VorNettoEinkaufOhneNachkalkVT'] ?? 0,
                    'VorNettoEinkaufNachkalk' => $data['VorNettoEinkaufNachkalk'] ?? 0,
                    'VorNettoEinkaufNachkalkVT' => $data['VorNettoEinkaufNachkalkVT'] ?? 0,
                    'VorWertZusatzkosten1' => $data['VorWertZusatzkosten1'] ?? 0,
                    'VorWertZusatzkosten2' => $data['VorWertZusatzkosten2'] ?? 0,
                    'VorWertZusatzkosten3' => $data['VorWertZusatzkosten3'] ?? 0,
                    'VorWertZusatzkosten4' => $data['VorWertZusatzkosten4'] ?? 0,
                    'VorWertZusatzkosten5' => $data['VorWertZusatzkosten5'] ?? 0,
                    'VorTextZusatzkosten4' => $data['VorTextZusatzkosten4'] ?? null,
                    'VorTextZusatzkosten5' => $data['VorTextZusatzkosten5'] ?? null,
                    'VorMwstSatzZusatzkosten1' => $data['VorMwstSatzZusatzkosten1'] ?? null,
                    'VorMwstSatzZusatzkosten2' => $data['VorMwstSatzZusatzkosten2'] ?? null,
                    'VorMwstSatzZusatzkosten3' => $data['VorMwstSatzZusatzkosten3'] ?? null,
                    'VorMwstSatzZusatzkosten4' => $data['VorMwstSatzZusatzkosten4'] ?? null,
                    'VorMwstSatzZusatzkosten5' => $data['VorMwstSatzZusatzkosten5'] ?? null,
                    'VorMwstSatzProzentZusatzkosten1' => $data['VorMwstSatzProzentZusatzkosten1'] ?? 0,
                    'VorMwstSatzProzentZusatzkosten2' => $data['VorMwstSatzProzentZusatzkosten2'] ?? 0,
                    'VorMwstSatzProzentZusatzkosten3' => $data['VorMwstSatzProzentZusatzkosten3'] ?? 0,
                    'VorMwstSatzProzentZusatzkosten4' => $data['VorMwstSatzProzentZusatzkosten4'] ?? 0,
                    'VorMwstSatzProzentZusatzkosten5' => $data['VorMwstSatzProzentZusatzkosten5'] ?? 0,
                    'VorKontoGruppeZusatzkosten1' => $data['VorKontoGruppeZusatzkosten1'] ?? null,
                    'VorKontoGruppeZusatzkosten2' => $data['VorKontoGruppeZusatzkosten2'] ?? null,
                    'VorKontoGruppeZusatzkosten3' => $data['VorKontoGruppeZusatzkosten3'] ?? null,
                    'VorKontoGruppeZusatzkosten4' => $data['VorKontoGruppeZusatzkosten4'] ?? null,
                    'VorKontoGruppeZusatzkosten5' => $data['VorKontoGruppeZusatzkosten5'] ?? null,
                    'VorBruttowertOriginal' => $data['VorBruttowertOriginal'] ?? 0,
                    'VorTextMwstOriginal1' => $data['VorTextMwstOriginal1'] ?? null,
                    'VorTextMwstOriginal2' => $data['VorTextMwstOriginal2'] ?? null,
                    'VorTextMwstOriginal3' => $data['VorTextMwstOriginal3'] ?? null,
                    'VorTextMwstOriginal4' => $data['VorTextMwstOriginal4'] ?? null,
                    'VorMwstwertOriginal1' => $data['VorMwstwertOriginal1'] ?? 0,
                    'VorMwstwertOriginal2' => $data['VorMwstwertOriginal2'] ?? 0,
                    'VorMwstwertOriginal3' => $data['VorMwstwertOriginal3'] ?? 0,
                    'VorMwstwertOriginal4' => $data['VorMwstwertOriginal4'] ?? 0,
                    'VorWHTWert1' => $data['VorWHTWert1'] ?? 0,
                    'VorWHTWert2' => $data['VorWHTWert2'] ?? null,
                    'VorWHTWert3' => $data['VorWHTWert3'] ?? null,
                    'VorWHTProzent1' => $data['VorWHTProzent1'] ?? 0,
                    'VorWHTProzent2' => $data['VorWHTProzent2'] ?? null,
                    'VorWHTProzent3' => $data['VorWHTProzent3'] ?? null,
                    'VorWHTKat1' => $data['VorWHTKat1'] ?? null,
                    'VorWHTKat2' => $data['VorWHTKat2'] ?? null,
                    'VorWHTKat3' => $data['VorWHTKat3'] ?? null,
                    'VorNettowertRabattfaehig' => $data['VorNettowertRabattfaehig'] ?? 0,
                    'VorRabattfaehigMwst1' => $data['VorRabattfaehigMwst1'] ?? 0,
                    'VorRabattfaehigMwst2' => $data['VorRabattfaehigMwst2'] ?? null,
                    'VorRabattfaehigMwst3' => $data['VorRabattfaehigMwst3'] ?? null,
                    'VorGesamtrabatt' => $data['VorGesamtrabatt'] ?? 0,
                    'VorPosRabattfaehigJN' => $data['VorPosRabattfaehigJN'] ?? 0,
                    'VorRabattKumulativJN' => $data['VorRabattKumulativJN'] ?? 0,
                    'VorPositionswertBrutto' => $data['VorPositionswertBrutto'] ?? 0,
                    'VorRabattWert' => $data['VorRabattWert'] ?? 0,
                    'VorSkontofaehigMwst1' => $data['VorSkontofaehigMwst1'] ?? 0,
                    'VorSkontofaehigMwst2' => $data['VorSkontofaehigMwst2'] ?? null,
                    'VorSkontofaehigMwst3' => $data['VorSkontofaehigMwst3'] ?? null,
                    'VorSkontofaehigBrutto' => $data['VorSkontofaehigBrutto'] ?? 0,
                    'VorSkontofaehigZusatzkosten1JN' => $data['VorSkontofaehigZusatzkosten1JN'] ?? 1,
                    'VorSkontofaehigZusatzkosten2JN' => $data['VorSkontofaehigZusatzkosten2JN'] ?? 1,
                    'VorSkontofaehigZusatzkosten3JN' => $data['VorSkontofaehigZusatzkosten3JN'] ?? 1,
                    'VorSkontofaehigZusatzkosten4JN' => $data['VorSkontofaehigZusatzkosten4JN'] ?? 1,
                    'VorSkontofaehigZusatzkosten5JN' => $data['VorSkontofaehigZusatzkosten5JN'] ?? 1,
                ]);

                return [
                    'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
                    'VorNummer' => $vorgang->VorNummer,
                    'VorGruppe' => $vorgang->VorGruppe,
                ];
            });
        } catch (Throwable $e) {
            Log::error('Create Vorgang' . $e->getMessage());
            return null;
        }
    }

}
