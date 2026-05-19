<?php

namespace App\Services;

use App\Exceptions\DBSaveException;
use App\Exceptions\ResourceNotFoundException;
use App\Models\NummernkreisVorgang;
use App\Models\Vorgang;
use App\Models\Vorgang1Wert;
use App\Models\Vorgang2Text;
use App\Models\Vorgang3Zahlung;
use App\Models\Vorgang4Versand;
use App\Models\Vorgang5Angebot;
use App\Models\Vorgang6Wiederhol;
use App\Models\VorgangWert;
use Throwable;

class VorgangService
{
    /**
     * @throws Throwable
     */

    //todo to be deleted from sd0201 no more needs
    public function createVorgang($data): array
    {
        $currentNummernkreis = NummernkreisVorgang::where('VorArt', $data['VorArt'])
            ->where('VorGruppe', $data['VorGruppe'])
            ->where('VNkArt', $data['VNkArt'])
            ->first();

        if (!$currentNummernkreis) {
            throw new ResourceNotFoundException(
                'Kein NummernkreisVorgang gefunden',
                [
                    'VorArt' => $data['VorArt'],
                    'VorGruppe' => $data['VorGruppe'],
                    'VNkArt' => $data['VNkArt'],
                ]
            );
        }

        $vorgang = Vorgang::
        where('VorArt', $data['VorArt'])
            ->where('VorGruppe', $data['VorGruppe'])
            ->where('VorNummer', $currentNummernkreis->VNkAktuellerWert)
            ->first();
        if ($vorgang) {
            NummernkreisVorgang::where('VorArt', $data['VorArt'])
                ->where('VorGruppe', $data['VorGruppe'])
                ->where('VNkArt', $data['VNkArt'])
                ->increment('VNkAktuellerWert');
            $data['VorNummer'] = $currentNummernkreis->VNkAktuellerWert + 1;
        } else {
            $data['VorNummer'] = $currentNummernkreis->VNkAktuellerWert;
        }

        $vorgang = Vorgang::create([
            'VorArt' => $data['VorArt'],
            'VorGruppe' => $data['VorGruppe'],
            'VorUnterArt' => $data['VorUnterArt'],
            'VorNummer' => $data['VorNummer'],
            'VorStatus' => $data['VorStatus'],

            'VorLieferungWunschDatum' => $data['VorLieferungWunschDatum'] ?? NULL,
            'VorAuftraggeber' => $data['VorAuftraggeber'], // Kunnr
            'VorIndividualD4' => $data['VorIndividualD4'] ?? NULL, // GebäudeNr
            'VorLieferanschrift' => $data['VorLieferanschrift'] ?? NULL,
            'VorRechnungsanschrift' => $data['VorRechnungsanschrift'] ?? NULL,
            'VorSammelRechnungsanschrift' => $data['VorSammelRechnungsanschrift'] ?? NULL,
            'VorDatumRechnung' => $data['VorDatumRechnung'] ?? NULL,
            'VorIndividualT1' => $data['VorIndividualT1'] ?? NULL,
            'VorIndividualT2' => $data['VorIndividualT2'] ?? NULL,

            // TODO clarify late with Pante (Important for miclas),
            'VorRechnungsanschriftAnsprechpartnerID' => $data['VorRechnungsanschriftAnsprechpartnerID'] ?? NULL,
            'VorLieferanschriftAnsprechpartnerID' => $data['VorLieferanschriftAnsprechpartnerID'] ?? NULL,
            'VorBetrefftextZeile1' => $data['VorBetrefftextZeile1'] ?? NULL,
            'VorBetrefftextZeile2' => $data['VorBetrefftextZeile2'] ?? NULL,

            'VorIndividualC1' => $data['VorIndividualC1'] ?? NULL,
            'VorIndividualC2' => $data['VorIndividualC2'] ?? NULL,
            'VorIndividualC3' => $data['VorIndividualC3'] ?? NULL,
            'VorIndividualC7' => $data['VorIndividualC7'] ?? NULL,

            'VorStichwort' => $data['VorStichwort'] ?? NULL,

            'VorTeillieferungsNummer' => $data['VorTeillieferungsNummer'] ?? 0,
            'MwstTypID' => $data['MwstTypID'] ?? 3,
            'VorMwstTyp' => $data['VorMwstTyp'] ?? 1,
            'VorWaehrungskurs' => $data['VorWaehrungskurs'] ?? 1,
            'VorParallelkurs' => $data['VorParallelkurs'] ?? 1,
            'VorWechselkurs' => $data['VorWechselkurs'] ?? 1,
            'VorWaehrungskursFixiertJN' => $data['VorWaehrungskursFixiertJN'] ?? 0,
            'KZWaehrung' => $data['KZWaehrung'] ?? 'EUR',
            'VorLieferungTrennenJN' => $data['VorLieferungTrennenJN'] ?? 0,
            'VorLagerumbuchungJN' => $data['VorLagerumbuchungJN'] ?? 0,
            'VorEinzelnePreiseJN' => $data['VorEinzelnePreiseJN'] ?? 1,
            'VorLagerbuchungJN' => $data['VorLagerbuchungJN'] ?? 1,
            'VorVersandEMailJN' => $data['VorVersandEMailJN'] ?? 0,
            'VorGeneriertJN' => $data['VorGeneriertJN'] ?? 0,
            'VorGesperrtJN' => $data['VorGesperrtJN'] ?? 0,
            'VorFilialExportJN' => $data['VorFilialExportJN'] ?? 0,
            'VorVertreterEingelesenJN' => $data['VorVertreterEingelesenJN'] ?? 0,
            'VorWHTfaehigJN' => $data['VorWHTfaehigJN'] ?? 0,
            'VorBruttoJN' => $data['VorBruttoJN'] ?? 0,
            'VorHauptauftrag' => $data['VorHauptauftrag'] ?? 0,
            'VorUebertragenJN' => $data['VorUebertragenJN'] ?? 0,
            'VorBezugsnummer' => $data['VorBezugsnummer'] ?? 0,

            'KZSprache' => $data['KZSprache'] ?? 'DE',
            'VorAnzahlDezimalstellen' => $data['VorAnzahlDezimalstellen'] ?? NULL,

            /*              'VorAnlageAm' => $data['VorAnlageAm'] ?? date('Ymd'),
                          'VorDatumAuftragsbestaetigung' => $data['VorDatumAuftragsbestaetigung'] ?? date('Ymd'),
                          'VorDatumAuftragseingang' => $data['VorDatumAuftragseingang'] ?? date('Ymd'),
            */


            'VorAnlageAm' => $data['VorAnlageAm'] ?? NULL,
            'VorDatumAuftragsbestaetigung' => $data['VorDatumAuftragsbestaetigung'] ?? NULL,
            'VorDatumAuftragseingang' => $data['VorDatumAuftragseingang'] ?? NULL,

            'AnsprechpartnerID' => $data['AnsprechpartnerID'] ?? NULL,
            'VorAnsprechpartnerText' => $data['VorAnsprechpartnerText'] ?? NULL,
            'VorSachbearbeiter' => $data['VorSachbearbeiter'] ?? NULL,
            'VorRechnungsNummer' => $data['VorRechnungsNummer'] ?? NULL,
            'VorLieferscheinNummer' => $data['VorLieferscheinNummer'] ?? NULL,
            'VorGutschriftNummer' => $data['VorGutschriftNummer'] ?? NULL,
            'VorRuecklieferscheinNummer' => $data['VorRuecklieferscheinNummer'] ?? NULL,
            'VorProformarechnungsNummer' => $data['VorProformarechnungsNummer'] ?? NULL,
            'VorSammellieferscheinNummer' => $data['VorSammellieferscheinNummer'] ?? NULL,
            'VorSammelrechnungsNummer' => $data['VorSammelrechnungsNummer'] ?? NULL,
            'VorGruppeImport' => $data['VorGruppeImport'] ?? NULL,
            'VorNummerImport' => $data['VorNummerImport'] ?? NULL,
            'VorTeillieferungsNummerImport' => $data['VorTeillieferungsNummerImport'] ?? NULL,
            'VorLetzterStatus' => $data['VorLetzterStatus'] ?? NULL,
            'AdresseBankID' => $data['AdresseBankID'] ?? NULL,
            'VorPreisbasisadresse' => $data['VorPreisbasisadresse'] ?? NULL,
            'VorLieferadresse' => $data['VorLieferadresse'] ?? NULL,
            'VorRechnungsadresse' => $data['VorRechnungsadresse'] ?? NULL,
            'VorSpeditionsanschrift' => $data['VorSpeditionsanschrift'] ?? NULL,
            'VorRuecklieferanschrift' => $data['VorRuecklieferanschrift'] ?? NULL,
            'VorRMANummer' => $data['VorRMANummer'] ?? NULL,
            'KZVersandbedingung' => $data['KZVersandbedingung'] ?? NULL,
            'KZVerpackung' => $data['KZVerpackung'] ?? NULL,
            'KZZahlungsart' => $data['KZZahlungsart'] ?? NULL,
            'KZZahlungsbedingung' => $data['KZZahlungsbedingung'] ?? NULL,
            'KZFrachtbriefLieferbedingung' => $data['KZFrachtbriefLieferbedingung'] ?? NULL,
            'KZLieferbedingung' => $data['KZLieferbedingung'] ?? NULL,
            'NRKostentraeger' => $data['NRKostentraeger'] ?? NULL,
            'VorIhrAuftrag' => $data['VorIhrAuftrag'] ?? NULL,
            'VorIhrAuftragVom' => $data['VorIhrAuftragVom'] ?? NULL,
            'VorUnserZeichen' => $data['VorUnserZeichen'] ?? NULL,
            'VorAnsprechpartnerID' => $data['VorAnsprechpartnerID'] ?? NULL,
            'VorIhrZeichen' => $data['VorIhrZeichen'] ?? NULL,
            'WerkID' => $data['WerkID'] ?? NULL,
            'AbladestelleID' => $data['AbladestelleID'] ?? NULL,
            'VorDatumLieferschein' => $data['VorDatumLieferschein'] ?? NULL,
            'VorDatumKulanzLieferschein' => $data['VorDatumKulanzLieferschein'] ?? NULL,
            'VorDatumRuecklieferung' => $data['VorDatumRuecklieferung'] ?? NULL,
            'VorDatumProformarechnung' => $data['VorDatumProformarechnung'] ?? NULL,
            'VorDatumGutschrift' => $data['VorDatumGutschrift'] ?? NULL,
            'VorDatumArbeitskarte' => $data['VorDatumArbeitskarte'] ?? NULL,
            'VorDatumAngebotVerloren' => $data['VorDatumAngebotVerloren'] ?? NULL,
            'VorDatumStorno' => $data['VorDatumStorno'] ?? NULL,
            'VorAngebotDurch' => $data['VorAngebotDurch'] ?? NULL,
            'VorAuftragsbestaetigungDurch' => $data['VorAuftragsbestaetigungDurch'] ?? NULL,
            'VorLieferscheinDurch' => $data['VorLieferscheinDurch'] ?? NULL,
            'VorKulanzDurch' => $data['VorKulanzDurch'] ?? NULL,
            'VorRuecklieferungDurch' => $data['VorRuecklieferungDurch'] ?? NULL,
            'VorRechnungDurch' => $data['VorRechnungDurch'] ?? NULL,
            'VorArbeitskarteDurch' => $data['VorArbeitskarteDurch'] ?? NULL,
            'VorlageWinwordID' => $data['VorlageWinwordID'] ?? NULL,
            'VorDokumentName' => $data['VorDokumentName'] ?? NULL,
            'VorLieferantRechnung' => $data['VorLieferantRechnung'] ?? NULL,
            'VorLieferantLieferschein' => $data['VorLieferantLieferschein'] ?? NULL,
            'VorLieferterminText' => $data['VorLieferterminText'] ?? NULL,
            'VorBestaetigungsnummer' => $data['VorBestaetigungsnummer'] ?? NULL,
            'VorLieferungWunschWoche' => $data['VorLieferungWunschWoche'] ?? NULL,
            'VorLieferungWunschJahr' => $data['VorLieferungWunschJahr'] ?? NULL,
            'VorLieferungAmDatum' => $data['VorLieferungAmDatum'] ?? NULL,
            'VorLieferungAmTag' => $data['VorLieferungAmTag'] ?? NULL,
            'VorLieferungAmWoche' => $data['VorLieferungAmWoche'] ?? NULL,
            'VorLieferungAmJahr' => $data['VorLieferungAmJahr'] ?? NULL,
            'LagerGruppe' => $data['LagerGruppe'] ?? NULL,
            'Lagerortnummer' => $data['Lagerortnummer'] ?? NULL,
            'VkzID' => $data['VkzID'] ?? NULL,
            'VorIndividualD1' => $data['VorIndividualD1'] ?? NULL,
            'VorIndividualD2' => $data['VorIndividualD2'] ?? NULL, // 
            'VorIndividualD3' => $data['VorIndividualD3'] ?? NULL,
            'VorUebertragenAm' => $data['VorUebertragenAm'] ?? NULL,
            'VorImportAbrufnummer' => $data['VorImportAbrufnummer'] ?? NULL,
            'VorImportArtikelbezugsnummer' => $data['VorImportArtikelbezugsnummer'] ?? NULL,
            'VorImportFortschrittszahl' => $data['VorImportFortschrittszahl'] ?? NULL,
            'VorImportTeilTyp' => $data['VorImportTeilTyp'] ?? NULL,
            'VorSperrungArt' => $data['VorSperrungArt'] ?? NULL,
            'VorFreigabeAm' => $data['VorFreigabeAm'] ?? NULL,
            'VorFreigabeDurch' => $data['VorFreigabeDurch'] ?? NULL,
            'VorAnlageDurch' => $data['VorAnlageDurch'] ?? NULL,
            'VorLetzteAenderungAm' => $data['VorLetzteAenderungAm'] ?? NULL,
            'VorLetzteAenderungDurch' => $data['VorLetzteAenderungDurch'] ?? NULL,
            'VorLetzterWareneingangAm' => $data['VorLetzterWareneingangAm'] ?? NULL,
            'VorLetzterWareneingangDurch' => $data['VorLetzterWareneingangDurch'] ?? NULL,
            'VorLetzterZahlungseingangAm' => $data['VorLetzterZahlungseingangAm'] ?? NULL,
            'VorLetzterZahlungseingangDurch' => $data['VorLetzterZahlungseingangDurch'] ?? NULL,
            'VorPosAenderungAm' => $data['VorPosAenderungAm'] ?? NULL,
            'VorPosAenderungDurch' => $data['VorPosAenderungDurch'] ?? NULL,
            'VorLockingAm' => $data['VorLockingAm'] ?? NULL,
            'VorLockingDurch' => $data['VorLockingDurch'] ?? NULL,
            'BedingungLieferungOrtID' => $data['BedingungLieferungOrtID'] ?? NULL,
            'FrachtbriefBedingungLieferungOrtID' => $data['FrachtbriefBedingungLieferungOrtID'] ?? NULL,
            'VorStornoDurch' => $data['VorStornoDurch'] ?? NULL,
            'VorFruehestensVerfuegbarAm' => $data['VorFruehestensVerfuegbarAm'] ?? NULL,
            'VorFruehestensVerfuegbarGrund' => $data['VorFruehestensVerfuegbarGrund'] ?? NULL,
            'VorVerantwortlicher' => $data['VorVerantwortlicher'] ?? NULL,
            'VorGesperrtAm' => $data['VorGesperrtAm'] ?? NULL,
            'VorGesperrtDurch' => $data['VorGesperrtDurch'] ?? NULL,
            'VorImportVerwendungszweck' => $data['VorImportVerwendungszweck'] ?? NULL,
            'VorImportLagerort' => $data['VorImportLagerort'] ?? NULL,
            'VorImportVerbrauchsstelle' => $data['VorImportVerbrauchsstelle'] ?? NULL,
            'VorGelangensbestaetigungAm' => $data['VorGelangensbestaetigungAm'] ?? NULL,
            'VorGelangensbestaetigungDurch' => $data['VorGelangensbestaetigungDurch'] ?? NULL,
            'VorGelangesbErhaltenAm' => $data['VorGelangesbErhaltenAm'] ?? NULL,
            'VorIndividualC4' => $data['VorIndividualC4'] ?? NULL,
            'VorIndividualC5' => $data['VorIndividualC5'] ?? NULL,
            'VorIndividualC6' => $data['VorIndividualC6'] ?? NULL,
            'VorIndividualD5' => $data['VorIndividualD5'] ?? NULL,
            'VorIndividualD6' => $data['VorIndividualD6'] ?? NULL,
            'VorIndividualD7' => $data['VorIndividualD7'] ?? NULL,
            'VorIndividualT3' => $data['VorIndividualT3'] ?? NULL,
            'VorIndividualT4' => $data['VorIndividualT4'] ?? NULL,
            'VorUnterschrift1' => $data['VorUnterschrift1'] ?? NULL,
            'VorUnterschrift2' => $data['VorUnterschrift2'] ?? NULL,
            'VorIndividualCombo1' => $data['VorIndividualCombo1'] ?? NULL,
            'VorIndividualCombo2' => $data['VorIndividualCombo2'] ?? NULL,
            'VorIndividualCombo3' => $data['VorIndividualCombo3'] ?? NULL,
            'VorIndividualCombo4' => $data['VorIndividualCombo4'] ?? NULL,
            'VorVorkasseAufforderungAm' => $data['VorVorkasseAufforderungAm'] ?? NULL,
            'VorVorkasseAufforderungDurch' => $data['VorVorkasseAufforderungDurch'] ?? NULL,
            'VorDokumentID' => $data['VorDokumentID'] ?? NULL,
            'VorDatumAngebot' => $data['VorDatumAngebot'] ?? NULL,
        ]);

        $vorgang->refresh();
        if (!$vorgang->exists) {
            throw new DBSaveException('Trigger deleted the Vorgang InterneVorgangsnummer:', [
                'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
            ]);
        }

        $newNummernkreis = NummernkreisVorgang::where('VorArt', $data['VorArt'])
            ->where('VorGruppe', $data['VorGruppe'])
            ->where('VNkArt', $data['VNkArt'])
            ->first();

        if ($newNummernkreis->VNkAktuellerWert !== $currentNummernkreis->VNkAktuellerWert + 1) {
            NummernkreisVorgang::where('VorArt', $data['VorArt'])
                ->where('VorGruppe', $data['VorGruppe'])
                ->where('VNkArt', $data['VNkArt'])
                ->increment('VNkAktuellerWert');
        }

        // ------------------------------------------------------------------
        // Zusatz Tabellen

        Vorgang2Text::insertGetId([
            'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
            'VorNotiz' => $data['VorNotiz'] ?? NULL
        ]);

        Vorgang3Zahlung::insertGetId([
            'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
            'VorSonderkonditionenJN' => $data['VorSonderkonditionenJN'] ?? 0,
            'VorBonusAbrechnungJN' => $data['VorBonusAbrechnungJN'] ?? 0,
            'VorZbdVariabelJN' => $data['VorZbdVariabelJN'] ?? 0,
        ]);

        Vorgang4Versand::insertGetId([
            'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
            'VorTransportversicherungJN' => $data['VorTransportversicherungJN'] ?? 0,
            'VorVersandPrivatZustJN' => $data['VorVersandPrivatZustJN'] ?? 0,
        ]);

        Vorgang5Angebot::insertGetId([
            'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
            'VorAngebotVerfolgenJN' => $data['VorAngebotVerfolgenJN'] ?? 1,
            'VorAbschlussOutlookIsTask' => $data['VorAbschlussOutlookIsTask'] ?? 0,
            'VorWiederVorlageOutlookIsTask' => $data['VorWiederVorlageOutlookIsTask'] ?? 0,
        ]);

        Vorgang6Wiederhol::insertGetId([
            'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
            'VorWiederholMonat' => $data['VorWiederholMonat'] ?? 0,
            'VorWiederholKennzeichen' => $data['VorWiederholKennzeichen'] ?? 0,
            'VorDruckKennzeichen' => $data['VorDruckKennzeichen'] ?? 0,
        ]);

        VorgangWert::insertGetId([
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

        Vorgang1Wert::insertGetId([
            'InterneVorgangsnummer' => $data['InterneVorgangsnummer'] ?? $vorgang->InterneVorgangsnummer,
            'VorRabattProzent' => $data['VorRabattProzent'] ?? 0,
            'VorZusRabattProzent' => $data['VorZusRabattProzent'] ?? 0,
            'VorAdrRabattProzent' => $data['VorAdrRabattProzent'] ?? 0,
            'VorNettowert' => $data['VorNettowert'] ?? 0,
            'VorNettowertMwst1' => $data['VorNettowertMwst1'] ?? 0,
            'VorNettowertMwst2' => $data['VorNettowertMwst2'] ?? NULL,
            'VorNettowertMwst3' => $data['VorNettowertMwst3'] ?? NULL,
            'VorMwstSatz1' => $data['VorMwstSatz1'] ?? NULL,
            'VorMwstSatz2' => $data['VorMwstSatz2'] ?? NULL,
            'VorMwstSatz3' => $data['VorMwstSatz3'] ?? NULL,
            'VorMwstSatzProzent1' => $data['VorMwstSatzProzent1'] ?? 3,
            'VorMwstSatzProzent2' => $data['VorMwstSatzProzent2'] ?? NULL,
            'VorMwstSatzProzent3' => $data['VorMwstSatzProzent3'] ?? NULL,
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
            'VorTextZusatzkosten4' => $data['VorTextZusatzkosten4'] ?? NULL,
            'VorTextZusatzkosten5' => $data['VorTextZusatzkosten5'] ?? NULL,
            'VorMwstSatzZusatzkosten1' => $data['VorMwstSatzZusatzkosten1'] ?? NULL,
            'VorMwstSatzZusatzkosten2' => $data['VorMwstSatzZusatzkosten2'] ?? NULL,
            'VorMwstSatzZusatzkosten3' => $data['VorMwstSatzZusatzkosten3'] ?? NULL,
            'VorMwstSatzZusatzkosten4' => $data['VorMwstSatzZusatzkosten4'] ?? NULL,
            'VorMwstSatzZusatzkosten5' => $data['VorMwstSatzZusatzkosten5'] ?? NULL,
            'VorMwstSatzProzentZusatzkosten1' => $data['VorMwstSatzProzentZusatzkosten1'] ?? 0,
            'VorMwstSatzProzentZusatzkosten2' => $data['VorMwstSatzProzentZusatzkosten2'] ?? 0,
            'VorMwstSatzProzentZusatzkosten3' => $data['VorMwstSatzProzentZusatzkosten3'] ?? 0,
            'VorMwstSatzProzentZusatzkosten4' => $data['VorMwstSatzProzentZusatzkosten4'] ?? 0,
            'VorMwstSatzProzentZusatzkosten5' => $data['VorMwstSatzProzentZusatzkosten5'] ?? 0,
            'VorKontoGruppeZusatzkosten1' => $data['VorKontoGruppeZusatzkosten1'] ?? NULL,
            'VorKontoGruppeZusatzkosten2' => $data['VorKontoGruppeZusatzkosten2'] ?? NULL,
            'VorKontoGruppeZusatzkosten3' => $data['VorKontoGruppeZusatzkosten3'] ?? NULL,
            'VorKontoGruppeZusatzkosten4' => $data['VorKontoGruppeZusatzkosten4'] ?? NULL,
            'VorKontoGruppeZusatzkosten5' => $data['VorKontoGruppeZusatzkosten5'] ?? NULL,
            'VorBruttowertOriginal' => $data['VorBruttowertOriginal'] ?? 0,
            'VorTextMwstOriginal1' => $data['VorTextMwstOriginal1'] ?? NULL,
            'VorTextMwstOriginal2' => $data['VorTextMwstOriginal2'] ?? NULL,
            'VorTextMwstOriginal3' => $data['VorTextMwstOriginal3'] ?? NULL,
            'VorTextMwstOriginal4' => $data['VorTextMwstOriginal4'] ?? NULL,
            'VorMwstwertOriginal1' => $data['VorMwstwertOriginal1'] ?? 0,
            'VorMwstwertOriginal2' => $data['VorMwstwertOriginal2'] ?? 0,
            'VorMwstwertOriginal3' => $data['VorMwstwertOriginal3'] ?? 0,
            'VorMwstwertOriginal4' => $data['VorMwstwertOriginal4'] ?? 0,
            'VorWHTWert1' => $data['VorWHTWert1'] ?? 0,
            'VorWHTWert2' => $data['VorWHTWert2'] ?? NULL,
            'VorWHTWert3' => $data['VorWHTWert3'] ?? NULL,
            'VorWHTProzent1' => $data['VorWHTProzent1'] ?? 0,
            'VorWHTProzent2' => $data['VorWHTProzent2'] ?? NULL,
            'VorWHTProzent3' => $data['VorWHTProzent3'] ?? NULL,
            'VorWHTKat1' => $data['VorWHTKat1'] ?? NULL,
            'VorWHTKat2' => $data['VorWHTKat2'] ?? NULL,
            'VorWHTKat3' => $data['VorWHTKat3'] ?? NULL,
            'VorNettowertRabattfaehig' => $data['VorNettowertRabattfaehig'] ?? 0,
            'VorRabattfaehigMwst1' => $data['VorRabattfaehigMwst1'] ?? 0,
            'VorRabattfaehigMwst2' => $data['VorRabattfaehigMwst2'] ?? NULL,
            'VorRabattfaehigMwst3' => $data['VorRabattfaehigMwst3'] ?? NULL,
            'VorGesamtrabatt' => $data['VorGesamtrabatt'] ?? 0,
            'VorPosRabattfaehigJN' => $data['VorPosRabattfaehigJN'] ?? 0,
            'VorRabattKumulativJN' => $data['VorRabattKumulativJN'] ?? 0,
            'VorPositionswertBrutto' => $data['VorPositionswertBrutto'] ?? 0,
            'VorRabattWert' => $data['VorRabattWert'] ?? 0,
            'VorSkontofaehigMwst1' => $data['VorSkontofaehigMwst1'] ?? 0,
            'VorSkontofaehigMwst2' => $data['VorSkontofaehigMwst2'] ?? NULL,
            'VorSkontofaehigMwst3' => $data['VorSkontofaehigMwst3'] ?? NULL,
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

    }
}
