<?php

namespace App\Services\VorgangServices;

use App\Models\NummernkreisVorgang;
use App\Models\Vorgang;
use Illuminate\Support\Facades\Log;
use Throwable;

class VorgangService
{
    public function createVorgang($data): ?Vorgang
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
            $vorgang = Vorgang::create([
                'VorArt' => $data['VorArt'],
                'VorGruppe' => $data['VorGruppe'],
                'VorUnterArt' => $data['VorUnterArt'],
                'VorStatus' => $data['VorStatus'],
                'VorNummer' => $data['VorNummer'],

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
                'VorIndividualD2' => $data['VorIndividualD2'] ?? NULL,
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
                'VorIndividualC1' => $data['VorIndividualC1'] ?? NULL, // VBELN (fakturanummer)
                'VorIndividualC2' => $data['VorIndividualC2'] ?? NULL, // Auart (Verkaufsbelegart)
                'VorIndividualC3' => $data['VorIndividualC3'] ?? NULL, // Slgnr(Liegenschaftsnummer)
                'VorIndividualC4' => $data['VorIndividualC4'] ?? NULL, // ReservNo
                'VorIndividualC5' => $data['VorIndividualC5'] ?? NULL, // PoItem
                'VorIndividualC6' => $data['VorIndividualC6'] ?? NULL,
                'VorIndividualC7' => $data['VorIndividualC7'] ?? NULL, // Vorlagebeleg
                'VorIndividualD5' => $data['VorIndividualD5'] ?? NULL,
                'VorIndividualD6' => $data['VorIndividualD6'] ?? NULL, // PoNumber
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

            // Add 1 to $nummernkreisVorgang->VNkAktuellerWert;
            NummernkreisVorgang::where('VorArt', $data['VorArt'])
                ->where('VorGruppe', $data['VorGruppe'])
                ->where('VNkArt', $data['VNkArt'])
                ->update(['VNkAktuellerWert' => $data['VorNummer'] + 1]);
            return $vorgang;

        } catch (Throwable $e) {
            Log::error('Create Vorgang' . $e->getMessage());
            return null;
        }
    }


    public function updateVorgang($data): ?Vorgang
    {
        try {
            return Vorgang::updateOrCreate(
                [
                    'InterneVorgangsnummer' => $data['InterneVorgangsnummer'],
                ],
                [
                    'VorArt' => $data['VorArt'],
                    'VorGruppe' => $data['VorGruppe'],
                    'VorUnterArt' => $data['VorUnterArt'],
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
                    'VorIndividualD2' => $data['VorIndividualD2'] ?? NULL,
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
                ]
            );
            return [
                'InterneVorgangsnummer' => $vorgang->InterneVorgangsnummer,
                'VorNummer' => $vorgang->VorNummer,
                'VorGruppe' => $vorgang->VorGruppe,
            ];
        } catch (Throwable $e) {
            Log::error('Create Vorgang' . $e->getMessage());
            return null;
        }
    }


}
