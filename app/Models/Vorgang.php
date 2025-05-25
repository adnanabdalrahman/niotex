<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $InterneVorgangsnummer
 * @property string $VorArt
 * @property string $VorGruppe
 * @property string $VorUnterArt
 * @property int $VorNummer
 * @property int $VorTeillieferungsNummer
 * @property int $VorStatus
 * @property int|null $VorHauptauftrag
 * @property int $VorAuftraggeber
 * @property int|null $AnsprechpartnerID
 * @property string|null $VorAnsprechpartnerText
 * @property string|null $VorBetrefftextZeile1
 * @property string|null $VorBetrefftextZeile2
 * @property int|null $VorSachbearbeiter
 * @property int|null $VorRechnungsNummer
 * @property int|null $VorLieferscheinNummer
 * @property int|null $VorGutschriftNummer
 * @property int|null $VorRuecklieferscheinNummer
 * @property int|null $VorProformarechnungsNummer
 * @property int|null $VorSammellieferscheinNummer
 * @property int|null $VorSammelrechnungsNummer
 * @property string|null $VorGruppeImport
 * @property int|null $VorNummerImport
 * @property int|null $VorTeillieferungsNummerImport
 * @property int $MwstTypID
 * @property int $VorMwstTyp
 * @property float $VorWaehrungskurs
 * @property float $VorParallelkurs
 * @property float $VorWechselkurs
 * @property int $VorWaehrungskursFixiertJN
 * @property int|null $VorLetzterStatus
 * @property int|null $AdresseBankID
 * @property int|null $VorPreisbasisadresse
 * @property int|null $VorLieferadresse
 * @property int|null $VorLieferanschrift
 * @property int|null $VorRechnungsanschrift
 * @property int|null $VorSammelRechnungsanschrift
 * @property int|null $VorRechnungsadresse
 * @property int|null $VorSpeditionsanschrift
 * @property int|null $VorRuecklieferanschrift
 * @property string|null $VorRMANummer
 * @property string|null $KZSprache
 * @property string $KZWaehrung
 * @property string|null $KZVersandbedingung
 * @property string|null $KZVerpackung
 * @property string|null $KZZahlungsart
 * @property string|null $KZZahlungsbedingung
 * @property string|null $KZFrachtbriefLieferbedingung
 * @property string|null $KZLieferbedingung
 * @property int|null $NRKostentraeger
 * @property string|null $VorIhrAuftrag
 * @property string|null $VorIhrAuftragVom
 * @property string|null $VorUnserZeichen
 * @property int|null $VorAnsprechpartnerID
 * @property string|null $VorIhrZeichen
 * @property int|null $WerkID
 * @property int|null $AbladestelleID
 * @property string|null $VorDatumAngebot
 * @property string|null $VorDatumAuftragsbestaetigung
 * @property string|null $VorDatumLieferschein
 * @property string|null $VorDatumKulanzLieferschein
 * @property string|null $VorDatumRuecklieferung
 * @property string|null $VorDatumProformarechnung
 * @property string|null $VorDatumRechnung
 * @property string|null $VorDatumGutschrift
 * @property string|null $VorDatumAuftragseingang
 * @property string|null $VorDatumArbeitskarte
 * @property string|null $VorDatumAngebotVerloren
 * @property string|null $VorDatumStorno
 * @property int|null $VorAngebotDurch
 * @property int|null $VorAuftragsbestaetigungDurch
 * @property int|null $VorLieferscheinDurch
 * @property int|null $VorKulanzDurch
 * @property int|null $VorRuecklieferungDurch
 * @property int|null $VorRechnungDurch
 * @property int|null $VorArbeitskarteDurch
 * @property string|null $VorStichwort
 * @property int|null $VorlageWinwordID
 * @property string|null $VorDokumentName
 * @property string|null $VorLieferantRechnung
 * @property string|null $VorLieferantLieferschein
 * @property string|null $VorLieferterminText
 * @property string|null $VorBestaetigungsnummer
 * @property string|null $VorLieferungWunschDatum
 * @property int|null $VorLieferungWunschWoche
 * @property int|null $VorLieferungWunschJahr
 * @property string|null $VorLieferungAmDatum
 * @property int|null $VorLieferungAmTag
 * @property int|null $VorLieferungAmWoche
 * @property int|null $VorLieferungAmJahr
 * @property string|null $LagerGruppe
 * @property int|null $Lagerortnummer
 * @property int $VorLieferungTrennenJN
 * @property int $VorLagerumbuchungJN
 * @property int $VorEinzelnePreiseJN
 * @property int $VorLagerbuchungJN
 * @property int|null $VkzID
 * @property string|null $VorIndividualC1
 * @property string|null $VorIndividualC2
 * @property string|null $VorIndividualC3
 * @property float|null $VorIndividualD1
 * @property float|null $VorIndividualD2
 * @property float|null $VorIndividualD3
 * @property string|null $VorIndividualT1
 * @property string|null $VorIndividualT2
 * @property int|null $VorUnterschrift1
 * @property int|null $VorUnterschrift2
 * @property int $VorUebertragenJN
 * @property string|null $VorUebertragenAm
 * @property int $VorVersandEMailJN
 * @property string|null $VorImportAbrufnummer
 * @property string|null $VorImportArtikelbezugsnummer
 * @property int|null $VorImportFortschrittszahl
 * @property int|null $VorImportTeilTyp
 * @property string|null $VorSperrungArt
 * @property int $VorGeneriertJN
 * @property string|null $VorFreigabeAm
 * @property int|null $VorFreigabeDurch
 * @property string|null $VorAnlageAm
 * @property int|null $VorAnlageDurch
 * @property string|null $VorLetzteAenderungAm
 * @property int|null $VorLetzteAenderungDurch
 * @property string|null $VorLetzterWareneingangAm
 * @property int|null $VorLetzterWareneingangDurch
 * @property string|null $VorLetzterZahlungseingangAm
 * @property int|null $VorLetzterZahlungseingangDurch
 * @property string|null $VorPosAenderungAm
 * @property int|null $VorPosAenderungDurch
 * @property string|null $VorLockingAm
 * @property int|null $VorLockingDurch
 * @property int|null $BedingungLieferungOrtID
 * @property int|null $FrachtbriefBedingungLieferungOrtID
 * @property int|null $VorStornoDurch
 * @property int|null $VorRechnungsanschriftAnsprechpartnerID
 * @property int|null $VorLieferanschriftAnsprechpartnerID
 * @property string|null $VorFruehestensVerfuegbarAm
 * @property int|null $VorFruehestensVerfuegbarGrund
 * @property int|null $VorVerantwortlicher
 * @property int $VorGesperrtJN
 * @property string|null $VorGesperrtAm
 * @property int|null $VorGesperrtDurch
 * @property string|null $VorImportVerwendungszweck
 * @property string|null $VorImportLagerort
 * @property string|null $VorImportVerbrauchsstelle
 * @property int|null $VorAnzahlDezimalstellen
 * @property string|null $VorBezugsnummer
 * @property string|null $VorGelangensbestaetigungAm
 * @property int|null $VorGelangensbestaetigungDurch
 * @property string|null $VorGelangesbErhaltenAm
 * @property string|null $VorIndividualC4
 * @property string|null $VorIndividualC5
 * @property string|null $VorIndividualC6
 * @property string|null $VorIndividualC7
 * @property float|null $VorIndividualD4
 * @property float|null $VorIndividualD5
 * @property float|null $VorIndividualD6
 * @property float|null $VorIndividualD7
 * @property string|null $VorIndividualT3
 * @property string|null $VorIndividualT4
 * @property int|null $VorIndividualCombo1
 * @property int|null $VorIndividualCombo2
 * @property int|null $VorIndividualCombo3
 * @property int|null $VorIndividualCombo4
 * @property string|null $TimeStamp
 * @property int $VorFilialExportJN
 * @property string|null $VorVorkasseAufforderungAm
 * @property int|null $VorVorkasseAufforderungDurch
 * @property int $VorVertreterEingelesenJN
 * @property int $VorWHTfaehigJN
 * @property int $VorBruttoJN
 * @property string|null $VorDokumentID
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereAbladestelleID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereAdresseBankID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereAnsprechpartnerID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereBedingungLieferungOrtID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereFrachtbriefBedingungLieferungOrtID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereInterneVorgangsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereKZFrachtbriefLieferbedingung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereKZLieferbedingung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereKZSprache($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereKZVerpackung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereKZVersandbedingung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereKZWaehrung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereKZZahlungsart($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereKZZahlungsbedingung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereLagerGruppe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereLagerortnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereMwstTypID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereNRKostentraeger($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVkzID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorAngebotDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorAnlageAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorAnlageDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorAnsprechpartnerID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorAnsprechpartnerText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorAnzahlDezimalstellen($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorArbeitskarteDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorArt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorAuftraggeber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorAuftragsbestaetigungDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorBestaetigungsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorBetrefftextZeile1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorBetrefftextZeile2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorBezugsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorBruttoJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorDatumAngebot($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorDatumAngebotVerloren($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorDatumArbeitskarte($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorDatumAuftragsbestaetigung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorDatumAuftragseingang($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorDatumGutschrift($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorDatumKulanzLieferschein($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorDatumLieferschein($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorDatumProformarechnung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorDatumRechnung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorDatumRuecklieferung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorDatumStorno($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorDokumentID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorDokumentName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorEinzelnePreiseJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorFilialExportJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorFreigabeAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorFreigabeDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorFruehestensVerfuegbarAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorFruehestensVerfuegbarGrund($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorGelangensbestaetigungAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorGelangensbestaetigungDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorGelangesbErhaltenAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorGeneriertJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorGesperrtAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorGesperrtDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorGesperrtJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorGruppe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorGruppeImport($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorGutschriftNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorHauptauftrag($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorIhrAuftrag($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorIhrAuftragVom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorIhrZeichen($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorImportAbrufnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorImportArtikelbezugsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorImportFortschrittszahl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorImportLagerort($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorImportTeilTyp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorImportVerbrauchsstelle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorImportVerwendungszweck($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorIndividualC1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorIndividualC2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorIndividualC3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorIndividualC4($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorIndividualC5($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorIndividualC6($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorIndividualC7($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorIndividualCombo1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorIndividualCombo2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorIndividualCombo3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorIndividualCombo4($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorIndividualD1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorIndividualD2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorIndividualD3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorIndividualD4($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorIndividualD5($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorIndividualD6($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorIndividualD7($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorIndividualT1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorIndividualT2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorIndividualT3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorIndividualT4($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorKulanzDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorLagerbuchungJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorLagerumbuchungJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorLetzteAenderungAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorLetzteAenderungDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorLetzterStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorLetzterWareneingangAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorLetzterWareneingangDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorLetzterZahlungseingangAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorLetzterZahlungseingangDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorLieferadresse($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorLieferanschrift($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorLieferanschriftAnsprechpartnerID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorLieferantLieferschein($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorLieferantRechnung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorLieferscheinDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorLieferscheinNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorLieferterminText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorLieferungAmDatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorLieferungAmJahr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorLieferungAmTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorLieferungAmWoche($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorLieferungTrennenJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorLieferungWunschDatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorLieferungWunschJahr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorLieferungWunschWoche($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorLockingAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorLockingDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorMwstTyp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorNummerImport($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorParallelkurs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorPosAenderungAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorPosAenderungDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorPreisbasisadresse($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorProformarechnungsNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorRMANummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorRechnungDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorRechnungsNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorRechnungsadresse($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorRechnungsanschrift($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorRechnungsanschriftAnsprechpartnerID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorRuecklieferanschrift($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorRuecklieferscheinNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorRuecklieferungDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorSachbearbeiter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorSammelRechnungsanschrift($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorSammellieferscheinNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorSammelrechnungsNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorSpeditionsanschrift($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorSperrungArt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorStichwort($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorStornoDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorTeillieferungsNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorTeillieferungsNummerImport($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorUebertragenAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorUebertragenJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorUnserZeichen($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorUnterArt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorUnterschrift1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorUnterschrift2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorVerantwortlicher($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorVersandEMailJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorVertreterEingelesenJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorVorkasseAufforderungAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorVorkasseAufforderungDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorWHTfaehigJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorWaehrungskurs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorWaehrungskursFixiertJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorWechselkurs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereVorlageWinwordID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang whereWerkID($value)
 * @mixin \Eloquent
 */
class Vorgang extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.Vorgang';
    protected $primaryKey = 'InterneVorgangsnummer';
    protected $guarded = [];
}
