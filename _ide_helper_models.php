<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $InterneAdressnummer
 * @property int $AdressNummer
 * @property int|null $BedingungLieferungOrtID
 * @property string|null $KZZahlungsart
 * @property int|null $AdrFibuNummer
 * @property string $KZAdresstyp
 * @property int $NRAnrede
 * @property string|null $AdrFirmenbezeichnung1
 * @property int|null $NRTitel
 * @property string|null $AdrFirmenbezeichnung2
 * @property string|null $AdrFirmenbezeichnung3
 * @property string $AdrMatchcode
 * @property string|null $AdrFirmenbezeichnung4
 * @property string|null $KZBundesLand
 * @property string $KZLand
 * @property string|null $AdrPLZ
 * @property string|null $AdrOrt
 * @property string|null $AdrStrasse
 * @property string|null $AdrPLZPostfach
 * @property string|null $AdrStrasse2
 * @property string|null $AdrPostfach
 * @property string|null $AdrStrasse3
 * @property string|null $AdrTelefon
 * @property string|null $AdrOrtPostfach
 * @property string|null $AdrFax
 * @property string|null $AdrEMail
 * @property float|null $AdrRabatt
 * @property string|null $AdrWebadresse
 * @property string|null $AdrLetzterVorgangAm
 * @property string $KZWaehrung
 * @property int $MwstTypID
 * @property string|null $KZZahlungsbedingung
 * @property string|null $KZLieferbedingung
 * @property string|null $KZVersandbedingung
 * @property string|null $KZVerpackung
 * @property string|null $AdrNotiz
 * @property int $AdrKarenztage
 * @property string $KZSprache
 * @property string|null $AdrFremdnummer
 * @property string|null $AdrKontakthistorie
 * @property int $AdrLiefersperreJN
 * @property string|null $AdrAnlageAm
 * @property string|null $AdrInfoVorgang
 * @property float $AdrKreditlimit
 * @property int|null $AdrBearbeiter
 * @property string|null $KZAdressgruppe
 * @property string|null $KZAdresseRabattgruppe
 * @property int|null $AdrAkquise
 * @property float $AdrKontostandOffenePosten
 * @property float $AdrKontostandAuftragseingang
 * @property float|null $AdrMindestVorgangswert
 * @property int|null $HerkunftID
 * @property int|null $FormularGruppeID
 * @property string|null $AdrMobiltelefon
 * @property int|null $AdrKontoLastschrift
 * @property int $AdrSammelrechnungJN
 * @property float $AdrKontostandAnzahlung
 * @property string|null $AdrUSTID
 * @property int $AdrMailingJN
 * @property string|null $AdrLetzteAenderungAm
 * @property float|null $AdrIndividualD1
 * @property string|null $AdrIntrastatKennummer
 * @property string|null $AdrUSTIDLand
 * @property string|null $AdrSteuernummer
 * @property int|null $AdrPersktoSammelkonto
 * @property int|null $AdrStSatznummer
 * @property int|null $AdrAnlageDurch
 * @property string|null $AdrBezugsnummer
 * @property float|null $AdrIndividualD3
 * @property float|null $AdrIndividualD2
 * @property string|null $AdrIndividualC1
 * @property string|null $AdrIndividualC3
 * @property int|null $AdrLetzteAenderungDurch
 * @property string|null $AdrLockingAm
 * @property string|null $AdrIndividualC2
 * @property int|null $AdrIndividualCombo1
 * @property int|null $AdrIndividualCombo2
 * @property int|null $MarketingID
 * @property int $AdrEdifaehigJN
 * @property int|null $AdrIndividualCombo3
 * @property string|null $AdrVersBonitaetsindex
 * @property string|null $AdrHandelsregeintrag
 * @property string|null $AdrVersLetzteRechercheAm
 * @property float|null $AdrRabattDM
 * @property string|null $AdrVersLetzteAnfrageAm
 * @property string|null $AdrEdiKennung
 * @property int|null $AdrPreisNummer
 * @property int $AdrInsolventJN
 * @property int $AdrBonusberechtigtJN
 * @property string|null $AdrBonusText
 * @property string|null $AdrEdiSendKennung
 * @property int|null $AdrBonusTextnummer
 * @property int $AdrUebertragenJN
 * @property int $AdrPrivatJN
 * @property string|null $AdrUebertragenAm
 * @property int|null $AdrBFWarnung
 * @property int|null $AdrTerminguete
 * @property int|null $AdrLockingDurch
 * @property int|null $AdrZahlungsmoral
 * @property int|null $AdrLieferzeit
 * @property int|null $AdrQualitaetsguete
 * @property int|null $AdrMahnMaxAnzahl
 * @property int $AdrEdiSendTestdatenJN
 * @property int $AdrDruckAvisJN
 * @property int $AdrGutschriftsverfahrenJN
 * @property int|null $AdrMahnAbstand
 * @property int $AdrVDA4905JN
 * @property string|null $AdrVersGesellschaft
 * @property int $AdrVDA4915JN
 * @property string|null $AdrVersnummer
 * @property int $AdrVDA4913JN
 * @property int|null $AdrGarantieLaufzeit
 * @property float $AdrUeberzahlung
 * @property int $AdrVDA4908JN
 * @property string|null $AdrFibuUebergabeAm
 * @property int $AdrVDA4916JN
 * @property int $AdrVDA4912JN
 * @property int|null $AdrFibuUebergabeDurch
 * @property int $AdrFactoringJN
 * @property int $AdrMahnSperreJN
 * @property int $AdrFactoringUebertragenJN
 * @property string|null $AdrFactoringUebertragenAm
 * @property string|null $AdrSkypeName
 * @property string|null $AdrLastschriftMandat
 * @property string|null $AdrLastschriftMandatVom
 * @property string|null $AdrWebshopkennung
 * @property int $AdrFilialAdressexportJN
 * @property int $AdrFilialVorgangsexportJN
 * @property int $AdrAltJN
 * @property int|null $AdrERechnung
 * @property int $AdrUSTIDPruefungJN
 * @property int $AdrWHTfaehigJN
 * @property int $AdrBruttoJN
 * @property string|null $AdrGlobalID
 * @property string|null $AdrLeitwegID
 * @property string|null $TimeStamp
 * @method static Builder<static>|Adresse newModelQuery()
 * @method static Builder<static>|Adresse newQuery()
 * @method static Builder<static>|Adresse query()
 * @method static Builder<static>|Adresse whereAdrAkquise($value)
 * @method static Builder<static>|Adresse whereAdrAltJN($value)
 * @method static Builder<static>|Adresse whereAdrAnlageAm($value)
 * @method static Builder<static>|Adresse whereAdrAnlageDurch($value)
 * @method static Builder<static>|Adresse whereAdrBFWarnung($value)
 * @method static Builder<static>|Adresse whereAdrBearbeiter($value)
 * @method static Builder<static>|Adresse whereAdrBezugsnummer($value)
 * @method static Builder<static>|Adresse whereAdrBonusText($value)
 * @method static Builder<static>|Adresse whereAdrBonusTextnummer($value)
 * @method static Builder<static>|Adresse whereAdrBonusberechtigtJN($value)
 * @method static Builder<static>|Adresse whereAdrBruttoJN($value)
 * @method static Builder<static>|Adresse whereAdrDruckAvisJN($value)
 * @method static Builder<static>|Adresse whereAdrEMail($value)
 * @method static Builder<static>|Adresse whereAdrERechnung($value)
 * @method static Builder<static>|Adresse whereAdrEdiKennung($value)
 * @method static Builder<static>|Adresse whereAdrEdiSendKennung($value)
 * @method static Builder<static>|Adresse whereAdrEdiSendTestdatenJN($value)
 * @method static Builder<static>|Adresse whereAdrEdifaehigJN($value)
 * @method static Builder<static>|Adresse whereAdrFactoringJN($value)
 * @method static Builder<static>|Adresse whereAdrFactoringUebertragenAm($value)
 * @method static Builder<static>|Adresse whereAdrFactoringUebertragenJN($value)
 * @method static Builder<static>|Adresse whereAdrFax($value)
 * @method static Builder<static>|Adresse whereAdrFibuNummer($value)
 * @method static Builder<static>|Adresse whereAdrFibuUebergabeAm($value)
 * @method static Builder<static>|Adresse whereAdrFibuUebergabeDurch($value)
 * @method static Builder<static>|Adresse whereAdrFilialAdressexportJN($value)
 * @method static Builder<static>|Adresse whereAdrFilialVorgangsexportJN($value)
 * @method static Builder<static>|Adresse whereAdrFirmenbezeichnung1($value)
 * @method static Builder<static>|Adresse whereAdrFirmenbezeichnung2($value)
 * @method static Builder<static>|Adresse whereAdrFirmenbezeichnung3($value)
 * @method static Builder<static>|Adresse whereAdrFirmenbezeichnung4($value)
 * @method static Builder<static>|Adresse whereAdrFremdnummer($value)
 * @method static Builder<static>|Adresse whereAdrGarantieLaufzeit($value)
 * @method static Builder<static>|Adresse whereAdrGlobalID($value)
 * @method static Builder<static>|Adresse whereAdrGutschriftsverfahrenJN($value)
 * @method static Builder<static>|Adresse whereAdrHandelsregeintrag($value)
 * @method static Builder<static>|Adresse whereAdrIndividualC1($value)
 * @method static Builder<static>|Adresse whereAdrIndividualC2($value)
 * @method static Builder<static>|Adresse whereAdrIndividualC3($value)
 * @method static Builder<static>|Adresse whereAdrIndividualCombo1($value)
 * @method static Builder<static>|Adresse whereAdrIndividualCombo2($value)
 * @method static Builder<static>|Adresse whereAdrIndividualCombo3($value)
 * @method static Builder<static>|Adresse whereAdrIndividualD1($value)
 * @method static Builder<static>|Adresse whereAdrIndividualD2($value)
 * @method static Builder<static>|Adresse whereAdrIndividualD3($value)
 * @method static Builder<static>|Adresse whereAdrInfoVorgang($value)
 * @method static Builder<static>|Adresse whereAdrInsolventJN($value)
 * @method static Builder<static>|Adresse whereAdrIntrastatKennummer($value)
 * @method static Builder<static>|Adresse whereAdrKarenztage($value)
 * @method static Builder<static>|Adresse whereAdrKontakthistorie($value)
 * @method static Builder<static>|Adresse whereAdrKontoLastschrift($value)
 * @method static Builder<static>|Adresse whereAdrKontostandAnzahlung($value)
 * @method static Builder<static>|Adresse whereAdrKontostandAuftragseingang($value)
 * @method static Builder<static>|Adresse whereAdrKontostandOffenePosten($value)
 * @method static Builder<static>|Adresse whereAdrKreditlimit($value)
 * @method static Builder<static>|Adresse whereAdrLastschriftMandat($value)
 * @method static Builder<static>|Adresse whereAdrLastschriftMandatVom($value)
 * @method static Builder<static>|Adresse whereAdrLeitwegID($value)
 * @method static Builder<static>|Adresse whereAdrLetzteAenderungAm($value)
 * @method static Builder<static>|Adresse whereAdrLetzteAenderungDurch($value)
 * @method static Builder<static>|Adresse whereAdrLetzterVorgangAm($value)
 * @method static Builder<static>|Adresse whereAdrLiefersperreJN($value)
 * @method static Builder<static>|Adresse whereAdrLieferzeit($value)
 * @method static Builder<static>|Adresse whereAdrLockingAm($value)
 * @method static Builder<static>|Adresse whereAdrLockingDurch($value)
 * @method static Builder<static>|Adresse whereAdrMahnAbstand($value)
 * @method static Builder<static>|Adresse whereAdrMahnMaxAnzahl($value)
 * @method static Builder<static>|Adresse whereAdrMahnSperreJN($value)
 * @method static Builder<static>|Adresse whereAdrMailingJN($value)
 * @method static Builder<static>|Adresse whereAdrMatchcode($value)
 * @method static Builder<static>|Adresse whereAdrMindestVorgangswert($value)
 * @method static Builder<static>|Adresse whereAdrMobiltelefon($value)
 * @method static Builder<static>|Adresse whereAdrNotiz($value)
 * @method static Builder<static>|Adresse whereAdrOrt($value)
 * @method static Builder<static>|Adresse whereAdrOrtPostfach($value)
 * @method static Builder<static>|Adresse whereAdrPLZ($value)
 * @method static Builder<static>|Adresse whereAdrPLZPostfach($value)
 * @method static Builder<static>|Adresse whereAdrPersktoSammelkonto($value)
 * @method static Builder<static>|Adresse whereAdrPostfach($value)
 * @method static Builder<static>|Adresse whereAdrPreisNummer($value)
 * @method static Builder<static>|Adresse whereAdrPrivatJN($value)
 * @method static Builder<static>|Adresse whereAdrQualitaetsguete($value)
 * @method static Builder<static>|Adresse whereAdrRabatt($value)
 * @method static Builder<static>|Adresse whereAdrRabattDM($value)
 * @method static Builder<static>|Adresse whereAdrSammelrechnungJN($value)
 * @method static Builder<static>|Adresse whereAdrSkypeName($value)
 * @method static Builder<static>|Adresse whereAdrStSatznummer($value)
 * @method static Builder<static>|Adresse whereAdrSteuernummer($value)
 * @method static Builder<static>|Adresse whereAdrStrasse($value)
 * @method static Builder<static>|Adresse whereAdrStrasse2($value)
 * @method static Builder<static>|Adresse whereAdrStrasse3($value)
 * @method static Builder<static>|Adresse whereAdrTelefon($value)
 * @method static Builder<static>|Adresse whereAdrTerminguete($value)
 * @method static Builder<static>|Adresse whereAdrUSTID($value)
 * @method static Builder<static>|Adresse whereAdrUSTIDLand($value)
 * @method static Builder<static>|Adresse whereAdrUSTIDPruefungJN($value)
 * @method static Builder<static>|Adresse whereAdrUebertragenAm($value)
 * @method static Builder<static>|Adresse whereAdrUebertragenJN($value)
 * @method static Builder<static>|Adresse whereAdrUeberzahlung($value)
 * @method static Builder<static>|Adresse whereAdrVDA4905JN($value)
 * @method static Builder<static>|Adresse whereAdrVDA4908JN($value)
 * @method static Builder<static>|Adresse whereAdrVDA4912JN($value)
 * @method static Builder<static>|Adresse whereAdrVDA4913JN($value)
 * @method static Builder<static>|Adresse whereAdrVDA4915JN($value)
 * @method static Builder<static>|Adresse whereAdrVDA4916JN($value)
 * @method static Builder<static>|Adresse whereAdrVersBonitaetsindex($value)
 * @method static Builder<static>|Adresse whereAdrVersGesellschaft($value)
 * @method static Builder<static>|Adresse whereAdrVersLetzteAnfrageAm($value)
 * @method static Builder<static>|Adresse whereAdrVersLetzteRechercheAm($value)
 * @method static Builder<static>|Adresse whereAdrVersnummer($value)
 * @method static Builder<static>|Adresse whereAdrWHTfaehigJN($value)
 * @method static Builder<static>|Adresse whereAdrWebadresse($value)
 * @method static Builder<static>|Adresse whereAdrWebshopkennung($value)
 * @method static Builder<static>|Adresse whereAdrZahlungsmoral($value)
 * @method static Builder<static>|Adresse whereAdressNummer($value)
 * @method static Builder<static>|Adresse whereBedingungLieferungOrtID($value)
 * @method static Builder<static>|Adresse whereFormularGruppeID($value)
 * @method static Builder<static>|Adresse whereHerkunftID($value)
 * @method static Builder<static>|Adresse whereInterneAdressnummer($value)
 * @method static Builder<static>|Adresse whereKZAdresseRabattgruppe($value)
 * @method static Builder<static>|Adresse whereKZAdressgruppe($value)
 * @method static Builder<static>|Adresse whereKZAdresstyp($value)
 * @method static Builder<static>|Adresse whereKZBundesLand($value)
 * @method static Builder<static>|Adresse whereKZLand($value)
 * @method static Builder<static>|Adresse whereKZLieferbedingung($value)
 * @method static Builder<static>|Adresse whereKZSprache($value)
 * @method static Builder<static>|Adresse whereKZVerpackung($value)
 * @method static Builder<static>|Adresse whereKZVersandbedingung($value)
 * @method static Builder<static>|Adresse whereKZWaehrung($value)
 * @method static Builder<static>|Adresse whereKZZahlungsart($value)
 * @method static Builder<static>|Adresse whereKZZahlungsbedingung($value)
 * @method static Builder<static>|Adresse whereMarketingID($value)
 * @method static Builder<static>|Adresse whereMwstTypID($value)
 * @method static Builder<static>|Adresse whereNRAnrede($value)
 * @method static Builder<static>|Adresse whereNRTitel($value)
 * @method static Builder<static>|Adresse whereTimeStamp($value)
 * @mixin Eloquent
 */
	class Adresse extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $AdresseBrancheID
 * @property int $InterneAdressnummer
 * @property string $KZBranche
 * @property int $AbrHauptJN
 * @property string|null $TimeStamp
 * @method static Builder<static>|AdresseBranche newModelQuery()
 * @method static Builder<static>|AdresseBranche newQuery()
 * @method static Builder<static>|AdresseBranche query()
 * @method static Builder<static>|AdresseBranche whereAbrHauptJN($value)
 * @method static Builder<static>|AdresseBranche whereAdresseBrancheID($value)
 * @method static Builder<static>|AdresseBranche whereInterneAdressnummer($value)
 * @method static Builder<static>|AdresseBranche whereKZBranche($value)
 * @method static Builder<static>|AdresseBranche whereTimeStamp($value)
 * @mixin Eloquent
 */
	class AdresseBranche extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $AnsprechpartnerID
 * @property int|null $InterneAdressnummer
 * @property int $AnsHauptansprechpartnerJN
 * @property int $NRAnrede
 * @property int|null $NRTitel
 * @property string|null $AnsVorname
 * @property string|null $AnsNachname
 * @property string|null $AnsAbteilung
 * @property string|null $AnsDurchwahl
 * @property string|null $AnsFax
 * @property string|null $AnsMobiltelefon
 * @property string|null $AnsEMail
 * @property string|null $AnsPrivatStrasse
 * @property string|null $AnsPrivatOrt
 * @property string|null $AnsPrivatTelefon
 * @property string|null $AnsGeburtsdatum
 * @property string|null $AnsNotiz
 * @property int|null $AnsVIP
 * @property int $AnsVersandEMailJN
 * @property string|null $AnsLockingDateTime
 * @property int $AnsAltJN
 * @property string|null $AnsIndividualC1
 * @property string|null $AnsIndividualC2
 * @property string|null $AnsIndividualC3
 * @property string|null $AnsIndividualC4
 * @property string|null $AnsIndividualC5
 * @property string|null $AnsIndividualC6
 * @property string|null $AnsIndividualC7
 * @property float|null $AnsIndividualN1
 * @property float|null $AnsIndividualN2
 * @property float|null $AnsIndividualN3
 * @property float|null $AnsIndividualN4
 * @property float|null $AnsIndividualN5
 * @property float|null $AnsIndividualN6
 * @property float|null $AnsIndividualN7
 * @property string|null $AnsIndividualD1
 * @property string|null $AnsIndividualD2
 * @property string|null $AnsIndividualD3
 * @property string|null $AnsIndividualD4
 * @property string|null $AnsNickname
 * @property string|null $AnsPrivateEmail
 * @property int $AnsHauptFinanzenJN
 * @property string|null $AnsSkypeName
 * @property int|null $AnsIndividualCombo1
 * @property int|null $AnsIndividualCombo2
 * @property int|null $AnsIndividualCombo3
 * @property int|null $AnsIndividualCombo4
 * @property string|null $TimeStamp
 * @method static Builder<static>|Ansprechpartner newModelQuery()
 * @method static Builder<static>|Ansprechpartner newQuery()
 * @method static Builder<static>|Ansprechpartner query()
 * @method static Builder<static>|Ansprechpartner whereAnsAbteilung($value)
 * @method static Builder<static>|Ansprechpartner whereAnsAltJN($value)
 * @method static Builder<static>|Ansprechpartner whereAnsDurchwahl($value)
 * @method static Builder<static>|Ansprechpartner whereAnsEMail($value)
 * @method static Builder<static>|Ansprechpartner whereAnsFax($value)
 * @method static Builder<static>|Ansprechpartner whereAnsGeburtsdatum($value)
 * @method static Builder<static>|Ansprechpartner whereAnsHauptFinanzenJN($value)
 * @method static Builder<static>|Ansprechpartner whereAnsHauptansprechpartnerJN($value)
 * @method static Builder<static>|Ansprechpartner whereAnsIndividualC1($value)
 * @method static Builder<static>|Ansprechpartner whereAnsIndividualC2($value)
 * @method static Builder<static>|Ansprechpartner whereAnsIndividualC3($value)
 * @method static Builder<static>|Ansprechpartner whereAnsIndividualC4($value)
 * @method static Builder<static>|Ansprechpartner whereAnsIndividualC5($value)
 * @method static Builder<static>|Ansprechpartner whereAnsIndividualC6($value)
 * @method static Builder<static>|Ansprechpartner whereAnsIndividualC7($value)
 * @method static Builder<static>|Ansprechpartner whereAnsIndividualCombo1($value)
 * @method static Builder<static>|Ansprechpartner whereAnsIndividualCombo2($value)
 * @method static Builder<static>|Ansprechpartner whereAnsIndividualCombo3($value)
 * @method static Builder<static>|Ansprechpartner whereAnsIndividualCombo4($value)
 * @method static Builder<static>|Ansprechpartner whereAnsIndividualD1($value)
 * @method static Builder<static>|Ansprechpartner whereAnsIndividualD2($value)
 * @method static Builder<static>|Ansprechpartner whereAnsIndividualD3($value)
 * @method static Builder<static>|Ansprechpartner whereAnsIndividualD4($value)
 * @method static Builder<static>|Ansprechpartner whereAnsIndividualN1($value)
 * @method static Builder<static>|Ansprechpartner whereAnsIndividualN2($value)
 * @method static Builder<static>|Ansprechpartner whereAnsIndividualN3($value)
 * @method static Builder<static>|Ansprechpartner whereAnsIndividualN4($value)
 * @method static Builder<static>|Ansprechpartner whereAnsIndividualN5($value)
 * @method static Builder<static>|Ansprechpartner whereAnsIndividualN6($value)
 * @method static Builder<static>|Ansprechpartner whereAnsIndividualN7($value)
 * @method static Builder<static>|Ansprechpartner whereAnsLockingDateTime($value)
 * @method static Builder<static>|Ansprechpartner whereAnsMobiltelefon($value)
 * @method static Builder<static>|Ansprechpartner whereAnsNachname($value)
 * @method static Builder<static>|Ansprechpartner whereAnsNickname($value)
 * @method static Builder<static>|Ansprechpartner whereAnsNotiz($value)
 * @method static Builder<static>|Ansprechpartner whereAnsPrivatOrt($value)
 * @method static Builder<static>|Ansprechpartner whereAnsPrivatStrasse($value)
 * @method static Builder<static>|Ansprechpartner whereAnsPrivatTelefon($value)
 * @method static Builder<static>|Ansprechpartner whereAnsPrivateEmail($value)
 * @method static Builder<static>|Ansprechpartner whereAnsSkypeName($value)
 * @method static Builder<static>|Ansprechpartner whereAnsVIP($value)
 * @method static Builder<static>|Ansprechpartner whereAnsVersandEMailJN($value)
 * @method static Builder<static>|Ansprechpartner whereAnsVorname($value)
 * @method static Builder<static>|Ansprechpartner whereAnsprechpartnerID($value)
 * @method static Builder<static>|Ansprechpartner whereInterneAdressnummer($value)
 * @method static Builder<static>|Ansprechpartner whereNRAnrede($value)
 * @method static Builder<static>|Ansprechpartner whereNRTitel($value)
 * @method static Builder<static>|Ansprechpartner whereTimeStamp($value)
 * @mixin Eloquent
 */
	class Ansprechpartner extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $InterneArtikelnummer
 * @property string $KZArtikelgruppe
 * @property string $KZWarengruppe
 * @property int|null $ArtikelUntergruppeID
 * @property string|null $KZProduktgruppe
 * @property string|null $KZKalkulationGruppe
 * @property string|null $KZArtikelRabattgruppe
 * @property string $Artikelnummer
 * @property string|null $ArtBezeichnung1
 * @property string|null $ArtBezeichnung2
 * @property string|null $ArtMatchcode
 * @property string|null $ArtNotiz
 * @property string|null $KZArtMengeneinheit1
 * @property string|null $KZArtMengeneinheit2
 * @property string|null $ArtFormelMengeneinheit1
 * @property float|null $ArtFaktorMengeneinheit2
 * @property string|null $ArtFormelMengeneinheit2
 * @property int $ArtPreisProMengeneinheit2
 * @property int $NRPreisbasis
 * @property int $MwstNummer
 * @property int|null $LinecardID
 * @property int $ArtRabattfaehigJN
 * @property float|null $ArtRabatt1
 * @property float|null $ArtRabatt2
 * @property float|null $ArtRabatt3
 * @property float|null $ArtRabattWert1
 * @property float|null $ArtRabattWert2
 * @property int $ArtEKRabattfaehigJN
 * @property float|null $ArtEKRabatt1
 * @property float|null $ArtEKRabatt2
 * @property float|null $ArtEKRabatt3
 * @property float|null $ArtEKRabattWert1
 * @property float|null $ArtEKRabattWert2
 * @property string|null $ArtABC_Analyse
 * @property float $ArtVerkaufspreis1
 * @property float|null $ArtVerkaufspreisNeu
 * @property string|null $ArtVerkaufspreisNeuDatum
 * @property float|null $ArtKalkulatorischerEK
 * @property float|null $ArtInventurpreis
 * @property string|null $ArtInventurAm
 * @property float $ArtMaterialkosten
 * @property float $ArtFertigungskosten
 * @property float $ArtFremdfertigungskosten
 * @property float $ArtSondereinzelkosten
 * @property int $ArtSeriennummernfaehigJN
 * @property int $ArtChargenfaehigJN
 * @property int $ArtAutoAbbuchenJN
 * @property int $ArtAutoZubuchenJN
 * @property int|null $ArtDispoart
 * @property int|null $ArtAbbuchungsmethode
 * @property int $ArtPruefpflichtigJN
 * @property string|null $KZZusatztext
 * @property string|null $KZIntraStat
 * @property string|null $ArtOberflaeche
 * @property int|null $NRWerkstoff
 * @property float|null $ArtWerkstoffPreisbasisEK
 * @property float|null $ArtWerkstoffPreisbasisVK
 * @property float|null $ArtWerkstoffAnteil
 * @property string|null $ArtNorm
 * @property string|null $ArtZeichnungsnummer
 * @property string|null $ArtZeichnungsformat
 * @property float|null $ArtNettoGewicht
 * @property float|null $ArtBruttoGewicht
 * @property string|null $KZArtGewichtseinheit
 * @property int|null $ArtGewichtsbasis
 * @property float|null $ArtAbwicklung
 * @property string|null $ArtBezeichnung1Fertigung
 * @property string|null $ArtBezeichnung2Fertigung
 * @property string|null $ArtBezeichnung1Einkauf
 * @property string|null $ArtBezeichnung2Einkauf
 * @property int $ArtAltJN
 * @property float|null $ArtAbmasse1
 * @property float|null $ArtAbmasse2
 * @property float|null $ArtAbmasse3
 * @property float|null $ArtAbmasse4
 * @property string|null $ArtBarcode
 * @property int|null $ArtFibuKontoGruppeAR
 * @property int|null $ArtFibuKontoGruppeVB
 * @property int|null $ArtNRKostenstelleAR
 * @property int|null $ArtNRKostenstelleVB
 * @property int|null $ArtNRKostentraegerAR
 * @property int|null $ArtNRKostentraegerVB
 * @property float|null $ArtIndividualD1
 * @property float|null $ArtIndividualD2
 * @property float|null $ArtIndividualD3
 * @property float|null $ArtIndividualD4
 * @property float|null $ArtIndividualD5
 * @property float|null $ArtIndividualD6
 * @property float|null $ArtIndividualD7
 * @property string|null $ArtIndividualC1
 * @property string|null $ArtIndividualC2
 * @property string|null $ArtIndividualC3
 * @property string|null $ArtIndividualC4
 * @property string|null $ArtIndividualC5
 * @property string|null $ArtIndividualC6
 * @property string|null $ArtIndividualC7
 * @property string|null $ArtIndividualT1
 * @property string|null $ArtIndividualT2
 * @property string|null $ArtIndividualT3
 * @property string|null $ArtIndividualT4
 * @property int|null $ArtIndividualCombo1
 * @property int|null $ArtIndividualCombo2
 * @property int|null $ArtIndividualCombo3
 * @property int|null $ArtIndividualCombo4
 * @property int $ArtStuecklisteJN
 * @property int|null $ArtBearbeiter
 * @property int|null $ArtStkVerkaufspreis
 * @property int|null $ArtStkEinkaufspreis
 * @property int|null $ArtStkBestellpreis
 * @property int $ArtStkAufAusgabeJN
 * @property int $ArtStkAufAufloesungJN
 * @property int $ArtStkBesAusgabeJN
 * @property int $ArtStkBesAufloesungJN
 * @property int $ArtStkAuftragLagerbuchung
 * @property int|null $ArtStkBestellLagerbuchung
 * @property int|null $ArtStkFertLagerbuchung
 * @property int $ArtStkBestellbeistellungJN
 * @property int $ArtStkKundenbeistellungJN
 * @property int $ArtStkKundenbeistellabgangJN
 * @property int $ArtStkMultiplikatorJN
 * @property int $ArtStkPseudobaugruppeJN
 * @property int $ArtStkManuellJN
 * @property float|null $ArtProvisionProzent
 * @property int $ArtProvisionsfaehigJN
 * @property int $ArtWebshopfaehigJN
 * @property int $ArtBonusberechtigtJN
 * @property int|null $ArtPlanungshorizont
 * @property float|null $ArtOptimaleBestellmenge1
 * @property float|null $ArtOptimaleBestellmenge2
 * @property float|null $ArtOptimaleFertigungsmenge1
 * @property float|null $ArtOptimaleFertigungsmenge2
 * @property float|null $ArtMengeProVerpackungEK
 * @property float|null $ArtMenge2ProVerpackungEK
 * @property float|null $ArtMengeProVerpackungVK
 * @property float|null $ArtMenge2ProVerpackungVK
 * @property string|null $ArtWebshopLetzteAktualisierungAm
 * @property int $ArtWebshopNaechsteAktualisierungJN
 * @property string|null $ArtEdiKennung
 * @property string|null $ArtLetztePreisaenderungAm
 * @property int|null $ArtLetztePreisaenderungDurch
 * @property int $ArtLiefErklaerungsPflichtigJN
 * @property string|null $ArtLiefErklaerungGueltigBis
 * @property int $ArtPraeferenzJNA
 * @property float|null $ArtPraeferenzWert
 * @property int $ArtPraeferenzDynamischJN
 * @property int $ArtFremdfertigungJN
 * @property int $ArtLieferantenfaehigJN
 * @property int $ArtFertigungsfaehigJN
 * @property int $ArtVerkaufsfaehigJN
 * @property int $ArtEKInNachkalkulationJN
 * @property int $ArtServiceJN
 * @property float|null $ArtAusschussFaktor
 * @property float|null $ArtAusschussMenge
 * @property int|null $ArtWiederbeschaffungszeit
 * @property int|null $ArtDurchlaufzeit
 * @property string|null $ArtExportAm
 * @property int $ArtErstmusterPruefungJN
 * @property int $ArtErstmusterFreigabeJN
 * @property string|null $ArtErstmusterFreigabeAm
 * @property float|null $ArtErstmusterInterval
 * @property int $ArtUrsprungsnachweisJN
 * @property string|null $ArtAnlageAm
 * @property int|null $ArtAnlageDurch
 * @property string|null $ArtLetzteAenderungAm
 * @property int|null $ArtLetzteAenderungDurch
 * @property string|null $ArtStlAenderungAm
 * @property int|null $ArtStlAenderungDurch
 * @property string|null $ArtGeprueftAm
 * @property int|null $ArtGeprueftDurch
 * @property string|null $ArtLockingAm
 * @property int|null $ArtLockingDurch
 * @property string|null $ArtEAN1
 * @property string|null $ArtEAN2
 * @property string|null $ArtEAN3
 * @property int $ArtBleifreiJN
 * @property int $ArtRoHSKonformJN
 * @property int $ArtMieteVerleihJN
 * @property int $ArtEigenReparaturfaehigJN
 * @property int $ArtFremdReparaturfaehigJN
 * @property int $ArtDienstleistungJN
 * @property string|null $ArtPriceFormular
 * @property int|null $ArtAvailabilityCheck
 * @property string|null $ArtWebshopkennung
 * @property int|null $ArtStkDispotermin
 * @property int|null $ArtStkDispodifferenz
 * @property int $ArtFilialExportJN
 * @property int $ArtExportFremdsoftwareJN
 * @property int $ArtSnrHerstelldatum
 * @property int $ArtSnrVerfallsdatum
 * @property int|null $ArtSnrHaltbarkeitszeitraum
 * @property int $ArtChargeHerstelldatum
 * @property int $ArtChargeVerfallsdatum
 * @property int|null $ArtChargeHaltbarkeitszeitraum
 * @property string|null $TimeStamp
 * @property int|null $ArtPickingMethode
 * @property int|null $WithholdingtaxKategorieID
 * @property float|null $ArtVKBrutto
 * @property int $ArtSkontofaehigJN
 * @property string|null $ArtBild
 * @method static Builder<static>|Artikel newModelQuery()
 * @method static Builder<static>|Artikel newQuery()
 * @method static Builder<static>|Artikel query()
 * @method static Builder<static>|Artikel whereArtABCAnalyse($value)
 * @method static Builder<static>|Artikel whereArtAbbuchungsmethode($value)
 * @method static Builder<static>|Artikel whereArtAbmasse1($value)
 * @method static Builder<static>|Artikel whereArtAbmasse2($value)
 * @method static Builder<static>|Artikel whereArtAbmasse3($value)
 * @method static Builder<static>|Artikel whereArtAbmasse4($value)
 * @method static Builder<static>|Artikel whereArtAbwicklung($value)
 * @method static Builder<static>|Artikel whereArtAltJN($value)
 * @method static Builder<static>|Artikel whereArtAnlageAm($value)
 * @method static Builder<static>|Artikel whereArtAnlageDurch($value)
 * @method static Builder<static>|Artikel whereArtAusschussFaktor($value)
 * @method static Builder<static>|Artikel whereArtAusschussMenge($value)
 * @method static Builder<static>|Artikel whereArtAutoAbbuchenJN($value)
 * @method static Builder<static>|Artikel whereArtAutoZubuchenJN($value)
 * @method static Builder<static>|Artikel whereArtAvailabilityCheck($value)
 * @method static Builder<static>|Artikel whereArtBarcode($value)
 * @method static Builder<static>|Artikel whereArtBearbeiter($value)
 * @method static Builder<static>|Artikel whereArtBezeichnung1($value)
 * @method static Builder<static>|Artikel whereArtBezeichnung1Einkauf($value)
 * @method static Builder<static>|Artikel whereArtBezeichnung1Fertigung($value)
 * @method static Builder<static>|Artikel whereArtBezeichnung2($value)
 * @method static Builder<static>|Artikel whereArtBezeichnung2Einkauf($value)
 * @method static Builder<static>|Artikel whereArtBezeichnung2Fertigung($value)
 * @method static Builder<static>|Artikel whereArtBild($value)
 * @method static Builder<static>|Artikel whereArtBleifreiJN($value)
 * @method static Builder<static>|Artikel whereArtBonusberechtigtJN($value)
 * @method static Builder<static>|Artikel whereArtBruttoGewicht($value)
 * @method static Builder<static>|Artikel whereArtChargeHaltbarkeitszeitraum($value)
 * @method static Builder<static>|Artikel whereArtChargeHerstelldatum($value)
 * @method static Builder<static>|Artikel whereArtChargeVerfallsdatum($value)
 * @method static Builder<static>|Artikel whereArtChargenfaehigJN($value)
 * @method static Builder<static>|Artikel whereArtDienstleistungJN($value)
 * @method static Builder<static>|Artikel whereArtDispoart($value)
 * @method static Builder<static>|Artikel whereArtDurchlaufzeit($value)
 * @method static Builder<static>|Artikel whereArtEAN1($value)
 * @method static Builder<static>|Artikel whereArtEAN2($value)
 * @method static Builder<static>|Artikel whereArtEAN3($value)
 * @method static Builder<static>|Artikel whereArtEKInNachkalkulationJN($value)
 * @method static Builder<static>|Artikel whereArtEKRabatt1($value)
 * @method static Builder<static>|Artikel whereArtEKRabatt2($value)
 * @method static Builder<static>|Artikel whereArtEKRabatt3($value)
 * @method static Builder<static>|Artikel whereArtEKRabattWert1($value)
 * @method static Builder<static>|Artikel whereArtEKRabattWert2($value)
 * @method static Builder<static>|Artikel whereArtEKRabattfaehigJN($value)
 * @method static Builder<static>|Artikel whereArtEdiKennung($value)
 * @method static Builder<static>|Artikel whereArtEigenReparaturfaehigJN($value)
 * @method static Builder<static>|Artikel whereArtErstmusterFreigabeAm($value)
 * @method static Builder<static>|Artikel whereArtErstmusterFreigabeJN($value)
 * @method static Builder<static>|Artikel whereArtErstmusterInterval($value)
 * @method static Builder<static>|Artikel whereArtErstmusterPruefungJN($value)
 * @method static Builder<static>|Artikel whereArtExportAm($value)
 * @method static Builder<static>|Artikel whereArtExportFremdsoftwareJN($value)
 * @method static Builder<static>|Artikel whereArtFaktorMengeneinheit2($value)
 * @method static Builder<static>|Artikel whereArtFertigungsfaehigJN($value)
 * @method static Builder<static>|Artikel whereArtFertigungskosten($value)
 * @method static Builder<static>|Artikel whereArtFibuKontoGruppeAR($value)
 * @method static Builder<static>|Artikel whereArtFibuKontoGruppeVB($value)
 * @method static Builder<static>|Artikel whereArtFilialExportJN($value)
 * @method static Builder<static>|Artikel whereArtFormelMengeneinheit1($value)
 * @method static Builder<static>|Artikel whereArtFormelMengeneinheit2($value)
 * @method static Builder<static>|Artikel whereArtFremdReparaturfaehigJN($value)
 * @method static Builder<static>|Artikel whereArtFremdfertigungJN($value)
 * @method static Builder<static>|Artikel whereArtFremdfertigungskosten($value)
 * @method static Builder<static>|Artikel whereArtGeprueftAm($value)
 * @method static Builder<static>|Artikel whereArtGeprueftDurch($value)
 * @method static Builder<static>|Artikel whereArtGewichtsbasis($value)
 * @method static Builder<static>|Artikel whereArtIndividualC1($value)
 * @method static Builder<static>|Artikel whereArtIndividualC2($value)
 * @method static Builder<static>|Artikel whereArtIndividualC3($value)
 * @method static Builder<static>|Artikel whereArtIndividualC4($value)
 * @method static Builder<static>|Artikel whereArtIndividualC5($value)
 * @method static Builder<static>|Artikel whereArtIndividualC6($value)
 * @method static Builder<static>|Artikel whereArtIndividualC7($value)
 * @method static Builder<static>|Artikel whereArtIndividualCombo1($value)
 * @method static Builder<static>|Artikel whereArtIndividualCombo2($value)
 * @method static Builder<static>|Artikel whereArtIndividualCombo3($value)
 * @method static Builder<static>|Artikel whereArtIndividualCombo4($value)
 * @method static Builder<static>|Artikel whereArtIndividualD1($value)
 * @method static Builder<static>|Artikel whereArtIndividualD2($value)
 * @method static Builder<static>|Artikel whereArtIndividualD3($value)
 * @method static Builder<static>|Artikel whereArtIndividualD4($value)
 * @method static Builder<static>|Artikel whereArtIndividualD5($value)
 * @method static Builder<static>|Artikel whereArtIndividualD6($value)
 * @method static Builder<static>|Artikel whereArtIndividualD7($value)
 * @method static Builder<static>|Artikel whereArtIndividualT1($value)
 * @method static Builder<static>|Artikel whereArtIndividualT2($value)
 * @method static Builder<static>|Artikel whereArtIndividualT3($value)
 * @method static Builder<static>|Artikel whereArtIndividualT4($value)
 * @method static Builder<static>|Artikel whereArtInventurAm($value)
 * @method static Builder<static>|Artikel whereArtInventurpreis($value)
 * @method static Builder<static>|Artikel whereArtKalkulatorischerEK($value)
 * @method static Builder<static>|Artikel whereArtLetzteAenderungAm($value)
 * @method static Builder<static>|Artikel whereArtLetzteAenderungDurch($value)
 * @method static Builder<static>|Artikel whereArtLetztePreisaenderungAm($value)
 * @method static Builder<static>|Artikel whereArtLetztePreisaenderungDurch($value)
 * @method static Builder<static>|Artikel whereArtLiefErklaerungGueltigBis($value)
 * @method static Builder<static>|Artikel whereArtLiefErklaerungsPflichtigJN($value)
 * @method static Builder<static>|Artikel whereArtLieferantenfaehigJN($value)
 * @method static Builder<static>|Artikel whereArtLockingAm($value)
 * @method static Builder<static>|Artikel whereArtLockingDurch($value)
 * @method static Builder<static>|Artikel whereArtMatchcode($value)
 * @method static Builder<static>|Artikel whereArtMaterialkosten($value)
 * @method static Builder<static>|Artikel whereArtMenge2ProVerpackungEK($value)
 * @method static Builder<static>|Artikel whereArtMenge2ProVerpackungVK($value)
 * @method static Builder<static>|Artikel whereArtMengeProVerpackungEK($value)
 * @method static Builder<static>|Artikel whereArtMengeProVerpackungVK($value)
 * @method static Builder<static>|Artikel whereArtMieteVerleihJN($value)
 * @method static Builder<static>|Artikel whereArtNRKostenstelleAR($value)
 * @method static Builder<static>|Artikel whereArtNRKostenstelleVB($value)
 * @method static Builder<static>|Artikel whereArtNRKostentraegerAR($value)
 * @method static Builder<static>|Artikel whereArtNRKostentraegerVB($value)
 * @method static Builder<static>|Artikel whereArtNettoGewicht($value)
 * @method static Builder<static>|Artikel whereArtNorm($value)
 * @method static Builder<static>|Artikel whereArtNotiz($value)
 * @method static Builder<static>|Artikel whereArtOberflaeche($value)
 * @method static Builder<static>|Artikel whereArtOptimaleBestellmenge1($value)
 * @method static Builder<static>|Artikel whereArtOptimaleBestellmenge2($value)
 * @method static Builder<static>|Artikel whereArtOptimaleFertigungsmenge1($value)
 * @method static Builder<static>|Artikel whereArtOptimaleFertigungsmenge2($value)
 * @method static Builder<static>|Artikel whereArtPickingMethode($value)
 * @method static Builder<static>|Artikel whereArtPlanungshorizont($value)
 * @method static Builder<static>|Artikel whereArtPraeferenzDynamischJN($value)
 * @method static Builder<static>|Artikel whereArtPraeferenzJNA($value)
 * @method static Builder<static>|Artikel whereArtPraeferenzWert($value)
 * @method static Builder<static>|Artikel whereArtPreisProMengeneinheit2($value)
 * @method static Builder<static>|Artikel whereArtPriceFormular($value)
 * @method static Builder<static>|Artikel whereArtProvisionProzent($value)
 * @method static Builder<static>|Artikel whereArtProvisionsfaehigJN($value)
 * @method static Builder<static>|Artikel whereArtPruefpflichtigJN($value)
 * @method static Builder<static>|Artikel whereArtRabatt1($value)
 * @method static Builder<static>|Artikel whereArtRabatt2($value)
 * @method static Builder<static>|Artikel whereArtRabatt3($value)
 * @method static Builder<static>|Artikel whereArtRabattWert1($value)
 * @method static Builder<static>|Artikel whereArtRabattWert2($value)
 * @method static Builder<static>|Artikel whereArtRabattfaehigJN($value)
 * @method static Builder<static>|Artikel whereArtRoHSKonformJN($value)
 * @method static Builder<static>|Artikel whereArtSeriennummernfaehigJN($value)
 * @method static Builder<static>|Artikel whereArtServiceJN($value)
 * @method static Builder<static>|Artikel whereArtSkontofaehigJN($value)
 * @method static Builder<static>|Artikel whereArtSnrHaltbarkeitszeitraum($value)
 * @method static Builder<static>|Artikel whereArtSnrHerstelldatum($value)
 * @method static Builder<static>|Artikel whereArtSnrVerfallsdatum($value)
 * @method static Builder<static>|Artikel whereArtSondereinzelkosten($value)
 * @method static Builder<static>|Artikel whereArtStkAufAufloesungJN($value)
 * @method static Builder<static>|Artikel whereArtStkAufAusgabeJN($value)
 * @method static Builder<static>|Artikel whereArtStkAuftragLagerbuchung($value)
 * @method static Builder<static>|Artikel whereArtStkBesAufloesungJN($value)
 * @method static Builder<static>|Artikel whereArtStkBesAusgabeJN($value)
 * @method static Builder<static>|Artikel whereArtStkBestellLagerbuchung($value)
 * @method static Builder<static>|Artikel whereArtStkBestellbeistellungJN($value)
 * @method static Builder<static>|Artikel whereArtStkBestellpreis($value)
 * @method static Builder<static>|Artikel whereArtStkDispodifferenz($value)
 * @method static Builder<static>|Artikel whereArtStkDispotermin($value)
 * @method static Builder<static>|Artikel whereArtStkEinkaufspreis($value)
 * @method static Builder<static>|Artikel whereArtStkFertLagerbuchung($value)
 * @method static Builder<static>|Artikel whereArtStkKundenbeistellabgangJN($value)
 * @method static Builder<static>|Artikel whereArtStkKundenbeistellungJN($value)
 * @method static Builder<static>|Artikel whereArtStkManuellJN($value)
 * @method static Builder<static>|Artikel whereArtStkMultiplikatorJN($value)
 * @method static Builder<static>|Artikel whereArtStkPseudobaugruppeJN($value)
 * @method static Builder<static>|Artikel whereArtStkVerkaufspreis($value)
 * @method static Builder<static>|Artikel whereArtStlAenderungAm($value)
 * @method static Builder<static>|Artikel whereArtStlAenderungDurch($value)
 * @method static Builder<static>|Artikel whereArtStuecklisteJN($value)
 * @method static Builder<static>|Artikel whereArtUrsprungsnachweisJN($value)
 * @method static Builder<static>|Artikel whereArtVKBrutto($value)
 * @method static Builder<static>|Artikel whereArtVerkaufsfaehigJN($value)
 * @method static Builder<static>|Artikel whereArtVerkaufspreis1($value)
 * @method static Builder<static>|Artikel whereArtVerkaufspreisNeu($value)
 * @method static Builder<static>|Artikel whereArtVerkaufspreisNeuDatum($value)
 * @method static Builder<static>|Artikel whereArtWebshopLetzteAktualisierungAm($value)
 * @method static Builder<static>|Artikel whereArtWebshopNaechsteAktualisierungJN($value)
 * @method static Builder<static>|Artikel whereArtWebshopfaehigJN($value)
 * @method static Builder<static>|Artikel whereArtWebshopkennung($value)
 * @method static Builder<static>|Artikel whereArtWerkstoffAnteil($value)
 * @method static Builder<static>|Artikel whereArtWerkstoffPreisbasisEK($value)
 * @method static Builder<static>|Artikel whereArtWerkstoffPreisbasisVK($value)
 * @method static Builder<static>|Artikel whereArtWiederbeschaffungszeit($value)
 * @method static Builder<static>|Artikel whereArtZeichnungsformat($value)
 * @method static Builder<static>|Artikel whereArtZeichnungsnummer($value)
 * @method static Builder<static>|Artikel whereArtikelUntergruppeID($value)
 * @method static Builder<static>|Artikel whereArtikelnummer($value)
 * @method static Builder<static>|Artikel whereInterneArtikelnummer($value)
 * @method static Builder<static>|Artikel whereKZArtGewichtseinheit($value)
 * @method static Builder<static>|Artikel whereKZArtMengeneinheit1($value)
 * @method static Builder<static>|Artikel whereKZArtMengeneinheit2($value)
 * @method static Builder<static>|Artikel whereKZArtikelRabattgruppe($value)
 * @method static Builder<static>|Artikel whereKZArtikelgruppe($value)
 * @method static Builder<static>|Artikel whereKZIntraStat($value)
 * @method static Builder<static>|Artikel whereKZKalkulationGruppe($value)
 * @method static Builder<static>|Artikel whereKZProduktgruppe($value)
 * @method static Builder<static>|Artikel whereKZWarengruppe($value)
 * @method static Builder<static>|Artikel whereKZZusatztext($value)
 * @method static Builder<static>|Artikel whereLinecardID($value)
 * @method static Builder<static>|Artikel whereMwstNummer($value)
 * @method static Builder<static>|Artikel whereNRPreisbasis($value)
 * @method static Builder<static>|Artikel whereNRWerkstoff($value)
 * @method static Builder<static>|Artikel whereTimeStamp($value)
 * @method static Builder<static>|Artikel whereWithholdingtaxKategorieID($value)
 * @mixin Eloquent
 */
	class Artikel extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $ArtikelKundeID
 * @property int $InterneArtikelnummer
 * @property int $InterneAdressnummer
 * @property int|null $AkuErsatzartikel
 * @property string|null $AkuBestellnummer
 * @property float $AkuLetzterVK
 * @property float|null $AkuLetzterRabatt1
 * @property float|null $AkuLetzterRabatt2
 * @property float|null $AkuLetzterRabatt3
 * @property float $AkuLetzterRabattWert1
 * @property float $AkuLetzterRabattWert2
 * @property float $AkuLetzteMenge1
 * @property float $AkuLetzteMenge2
 * @property float|null $AkuMindestverkaufsmenge
 * @property float|null $AkuMengeProVerpackungseinheit
 * @property int|null $AkuLieferzeitTage
 * @property string|null $AkuArtikelBezeichnung2
 * @property string|null $AkuNotiz
 * @property float|null $AkuProvisionProzent
 * @property int|null $AkuTerminguete
 * @property string|null $AkuLetzterVerkaufAm
 * @property int|null $AkuLetzterVerkaufDurch
 * @property int|null $NRPreisbasis
 * @property string|null $AkuEdiKennung
 * @property int|null $AkuGarantieLaufzeit
 * @property int $AkuLiefersperreJN
 * @property string|null $KZAdresseRabattgruppe
 * @property int|null $AkuPreisNummer
 * @property string|null $AkuZeichnungsnummer
 * @property string|null $AkuZeichnungsformat
 * @property string|null $AkuIndividualC1
 * @property string|null $AkuIndividualC2
 * @property string|null $AkuIndividualC3
 * @property float|null $AkuIndividualD1
 * @property float|null $AkuIndividualD2
 * @property float|null $AkuIndividualD3
 * @property string|null $AkuIndividualT1
 * @property string|null $AkuIndividualT2
 * @property string|null $AkuArtikelBezeichnung1
 * @property int $AkuPreisProMengeneinheit2
 * @property string|null $AkuIndividualT3
 * @property int|null $AkuIndividualCombo1
 * @property int|null $AkuIndividualCombo2
 * @property int|null $AkuIndividualCombo3
 * @property string|null $TimeStamp
 * @property float|null $AkuVKBrutto
 * @property float|null $AkuVKNeu
 * @property string|null $AkuVKNeuDatum
 * @method static Builder<static>|ArtikelKunde newModelQuery()
 * @method static Builder<static>|ArtikelKunde newQuery()
 * @method static Builder<static>|ArtikelKunde query()
 * @method static Builder<static>|ArtikelKunde whereAkuArtikelBezeichnung1($value)
 * @method static Builder<static>|ArtikelKunde whereAkuArtikelBezeichnung2($value)
 * @method static Builder<static>|ArtikelKunde whereAkuBestellnummer($value)
 * @method static Builder<static>|ArtikelKunde whereAkuEdiKennung($value)
 * @method static Builder<static>|ArtikelKunde whereAkuErsatzartikel($value)
 * @method static Builder<static>|ArtikelKunde whereAkuGarantieLaufzeit($value)
 * @method static Builder<static>|ArtikelKunde whereAkuIndividualC1($value)
 * @method static Builder<static>|ArtikelKunde whereAkuIndividualC2($value)
 * @method static Builder<static>|ArtikelKunde whereAkuIndividualC3($value)
 * @method static Builder<static>|ArtikelKunde whereAkuIndividualCombo1($value)
 * @method static Builder<static>|ArtikelKunde whereAkuIndividualCombo2($value)
 * @method static Builder<static>|ArtikelKunde whereAkuIndividualCombo3($value)
 * @method static Builder<static>|ArtikelKunde whereAkuIndividualD1($value)
 * @method static Builder<static>|ArtikelKunde whereAkuIndividualD2($value)
 * @method static Builder<static>|ArtikelKunde whereAkuIndividualD3($value)
 * @method static Builder<static>|ArtikelKunde whereAkuIndividualT1($value)
 * @method static Builder<static>|ArtikelKunde whereAkuIndividualT2($value)
 * @method static Builder<static>|ArtikelKunde whereAkuIndividualT3($value)
 * @method static Builder<static>|ArtikelKunde whereAkuLetzteMenge1($value)
 * @method static Builder<static>|ArtikelKunde whereAkuLetzteMenge2($value)
 * @method static Builder<static>|ArtikelKunde whereAkuLetzterRabatt1($value)
 * @method static Builder<static>|ArtikelKunde whereAkuLetzterRabatt2($value)
 * @method static Builder<static>|ArtikelKunde whereAkuLetzterRabatt3($value)
 * @method static Builder<static>|ArtikelKunde whereAkuLetzterRabattWert1($value)
 * @method static Builder<static>|ArtikelKunde whereAkuLetzterRabattWert2($value)
 * @method static Builder<static>|ArtikelKunde whereAkuLetzterVK($value)
 * @method static Builder<static>|ArtikelKunde whereAkuLetzterVerkaufAm($value)
 * @method static Builder<static>|ArtikelKunde whereAkuLetzterVerkaufDurch($value)
 * @method static Builder<static>|ArtikelKunde whereAkuLiefersperreJN($value)
 * @method static Builder<static>|ArtikelKunde whereAkuLieferzeitTage($value)
 * @method static Builder<static>|ArtikelKunde whereAkuMengeProVerpackungseinheit($value)
 * @method static Builder<static>|ArtikelKunde whereAkuMindestverkaufsmenge($value)
 * @method static Builder<static>|ArtikelKunde whereAkuNotiz($value)
 * @method static Builder<static>|ArtikelKunde whereAkuPreisNummer($value)
 * @method static Builder<static>|ArtikelKunde whereAkuPreisProMengeneinheit2($value)
 * @method static Builder<static>|ArtikelKunde whereAkuProvisionProzent($value)
 * @method static Builder<static>|ArtikelKunde whereAkuTerminguete($value)
 * @method static Builder<static>|ArtikelKunde whereAkuVKBrutto($value)
 * @method static Builder<static>|ArtikelKunde whereAkuVKNeu($value)
 * @method static Builder<static>|ArtikelKunde whereAkuVKNeuDatum($value)
 * @method static Builder<static>|ArtikelKunde whereAkuZeichnungsformat($value)
 * @method static Builder<static>|ArtikelKunde whereAkuZeichnungsnummer($value)
 * @method static Builder<static>|ArtikelKunde whereArtikelKundeID($value)
 * @method static Builder<static>|ArtikelKunde whereInterneAdressnummer($value)
 * @method static Builder<static>|ArtikelKunde whereInterneArtikelnummer($value)
 * @method static Builder<static>|ArtikelKunde whereKZAdresseRabattgruppe($value)
 * @method static Builder<static>|ArtikelKunde whereNRPreisbasis($value)
 * @method static Builder<static>|ArtikelKunde whereTimeStamp($value)
 * @mixin Eloquent
 */
	class ArtikelKunde extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $ArtikelLagerID
 * @property int $InterneArtikelnummer
 * @property int $AlaAuswahlJN
 * @property float $AlaMindestMenge1
 * @property float $AlaMindestMenge2
 * @property float $AlaPhysikalischeMenge1
 * @property float $AlaPhysikalischeMenge2
 * @property float $AlaSperrMenge1
 * @property float $AlaSperrMenge2
 * @property float $AlaKommissionsMenge1
 * @property float $AlaKommissionsMenge2
 * @property float $AlaEKMenge1
 * @property float $AlaEKMenge2
 * @property float $AlaVerplanteMenge1
 * @property float $AlaVerplanteMenge2
 * @property float $AlaVerplantBestellungMenge1
 * @property float $AlaVerplantBestellungMenge2
 * @property float $AlaVerplantFertigungMenge1
 * @property float $AlaVerplantFertigungMenge2
 * @property float $AlaBestellteMenge1
 * @property float $AlaBestellteMenge2
 * @property float $AlaGefertigteMenge1
 * @property float $AlaGefertigteMenge2
 * @property float $AlaForecastMenge1
 * @property float $AlaForecastMenge2
 * @property float $AlaVerfuegbar1Menge1
 * @property float $AlaVerfuegbar1Menge2
 * @property float $AlaVerfuegbar2Menge1
 * @property float $AlaVerfuegbar2Menge2
 * @property float $AlaVerfuegbarBestellungMenge1
 * @property float $AlaVerfuegbarBestellungMenge2
 * @property float $AlaVerfuegbarFertigungMenge1
 * @property float $AlaVerfuegbarFertigungMenge2
 * @property string|null $TimeStamp
 * @property float $AlaBeistellungsMenge1
 * @property float $AlaBeistellungsMenge2
 * @property int $AlaMindestmengeJN
 * @property int $AlaBestandsobergrenzeJN
 * @property float $AlaBestandsobergrenzeMenge1
 * @property float $AlaBestandsobergrenzeMenge2
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaAuswahlJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaBeistellungsMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaBeistellungsMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaBestandsobergrenzeJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaBestandsobergrenzeMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaBestandsobergrenzeMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaBestellteMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaBestellteMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaEKMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaEKMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaForecastMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaForecastMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaGefertigteMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaGefertigteMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaKommissionsMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaKommissionsMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaMindestMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaMindestMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaMindestmengeJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaPhysikalischeMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaPhysikalischeMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaSperrMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaSperrMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaVerfuegbar1Menge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaVerfuegbar1Menge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaVerfuegbar2Menge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaVerfuegbar2Menge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaVerfuegbarBestellungMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaVerfuegbarBestellungMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaVerfuegbarFertigungMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaVerfuegbarFertigungMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaVerplantBestellungMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaVerplantBestellungMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaVerplantFertigungMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaVerplantFertigungMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaVerplanteMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereAlaVerplanteMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereArtikelLagerID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereInterneArtikelnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLager whereTimeStamp($value)
 * @mixin Eloquent
 */
	class ArtikelLager extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $ArtikelLieferantID
 * @property int $InterneAdressnummer
 * @property int $InterneArtikelnummer
 * @property string|null $AliBestellnummer
 * @property string|null $AliLieferzeit
 * @property float $AliLetzterEK
 * @property float|null $AliProzentualeZusatzKostenEK
 * @property string|null $AliLetzterEinkaufAm
 * @property float $AliLetzteMenge1
 * @property float $AliLetzteMenge2
 * @property float $AliLetzterRabatt1
 * @property float $AliLetzterRabatt2
 * @property float $AliLetzterRabatt3
 * @property float $AliLetzterRabattWert1
 * @property float $AliLetzterRabattWert2
 * @property string|null $AliLetzteAnfrageAm
 * @property string|null $AliLetztesAngebotAm
 * @property string|null $AliAngebotGueltigBis
 * @property float $AliMindestbestellmenge
 * @property float|null $AliMengeProVerpackungseinheit
 * @property string|null $AliNotiz
 * @property string|null $AliArtikelBezeichnung2
 * @property int $AliStammlieferantJN
 * @property int|null $AliTerminguete
 * @property int|null $AliQualitaetsguete
 * @property int|null $AliLieferzeitTage
 * @property int $AliErstmusterFreigabeJN
 * @property string|null $AliErstmusterFreigabeAm
 * @property string|null $AliAnlageAm
 * @property int|null $AliAnlageDurch
 * @property string|null $AliLetzteAenderungAm
 * @property int|null $AliLetzteAenderungDurch
 * @property int|null $NRPreisbasis
 * @property string|null $AliEdiKennung
 * @property int|null $AliGarantieLaufzeit
 * @property int $AliLiefersperreJN
 * @property string|null $KZAdresseRabattgruppe
 * @property int|null $AliPreisNummer
 * @property string|null $AliIndividualC1
 * @property string|null $AliIndividualC2
 * @property string|null $AliIndividualC3
 * @property float|null $AliIndividualD1
 * @property float|null $AliIndividualD2
 * @property float|null $AliIndividualD3
 * @property string|null $AliIndividualT1
 * @property string|null $AliIndividualT2
 * @property string|null $AliArtikelBezeichnung1
 * @property int $AliPreisProMengeneinheit2
 * @property string|null $AliIndividualT3
 * @property int|null $AliIndividualCombo1
 * @property int|null $AliIndividualCombo2
 * @property int|null $AliIndividualCombo3
 * @property string|null $TimeStamp
 * @property float|null $AliEKNeu
 * @property string|null $AliEKNeuDatum
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliAngebotGueltigBis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliAnlageAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliAnlageDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliArtikelBezeichnung1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliArtikelBezeichnung2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliBestellnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliEKNeu($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliEKNeuDatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliEdiKennung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliErstmusterFreigabeAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliErstmusterFreigabeJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliGarantieLaufzeit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliIndividualC1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliIndividualC2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliIndividualC3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliIndividualCombo1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliIndividualCombo2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliIndividualCombo3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliIndividualD1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliIndividualD2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliIndividualD3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliIndividualT1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliIndividualT2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliIndividualT3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLetzteAenderungAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLetzteAenderungDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLetzteAnfrageAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLetzteMenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLetzteMenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLetzterEK($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLetzterEinkaufAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLetzterRabatt1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLetzterRabatt2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLetzterRabatt3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLetzterRabattWert1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLetzterRabattWert2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLetztesAngebotAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLiefersperreJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLieferzeit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliLieferzeitTage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliMengeProVerpackungseinheit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliMindestbestellmenge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliNotiz($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliPreisNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliPreisProMengeneinheit2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliProzentualeZusatzKostenEK($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliQualitaetsguete($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliStammlieferantJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereAliTerminguete($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereArtikelLieferantID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereInterneAdressnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereInterneArtikelnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereKZAdresseRabattgruppe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereNRPreisbasis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArtikelLieferant whereTimeStamp($value)
 * @mixin Eloquent
 */
	class ArtikelLieferant extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $ArtikelUntergruppeID
 * @property string $KZWarengruppe
 * @property string $KZArtikelgruppe
 * @property string $KZUnterArtikelgruppe
 * @property string|null $AugBezeichnung
 * @property string|null $TimeStamp
 * @property int $AugInaktivJN
 * @method static Builder<static>|ArtikelUntergruppe newModelQuery()
 * @method static Builder<static>|ArtikelUntergruppe newQuery()
 * @method static Builder<static>|ArtikelUntergruppe query()
 * @method static Builder<static>|ArtikelUntergruppe whereArtikelUntergruppeID($value)
 * @method static Builder<static>|ArtikelUntergruppe whereAugBezeichnung($value)
 * @method static Builder<static>|ArtikelUntergruppe whereAugInaktivJN($value)
 * @method static Builder<static>|ArtikelUntergruppe whereKZArtikelgruppe($value)
 * @method static Builder<static>|ArtikelUntergruppe whereKZUnterArtikelgruppe($value)
 * @method static Builder<static>|ArtikelUntergruppe whereKZWarengruppe($value)
 * @method static Builder<static>|ArtikelUntergruppe whereTimeStamp($value)
 * @mixin Eloquent
 */
	class ArtikelUntergruppe extends \Eloquent {}
}

namespace App\Models{
/**
 * @property string $KZWarengruppe
 * @property string $KZArtikelgruppe
 * @property string|null $AgrBezeichnung
 * @property string|null $AgrArtikelbezeichnung1
 * @property string|null $AgrArtikelbezeichnung2
 * @property string|null $KZAgrMengeneinheit1
 * @property string|null $KZAgrMengeneinheit2
 * @property float|null $AgrEKRabatt
 * @property float|null $AgrProvisionProzent
 * @property int|null $LinecardID
 * @property string|null $TimeStamp
 * @property int $AgrInaktivJN
 * @method static Builder<static>|Artikelgruppe newModelQuery()
 * @method static Builder<static>|Artikelgruppe newQuery()
 * @method static Builder<static>|Artikelgruppe query()
 * @method static Builder<static>|Artikelgruppe whereAgrArtikelbezeichnung1($value)
 * @method static Builder<static>|Artikelgruppe whereAgrArtikelbezeichnung2($value)
 * @method static Builder<static>|Artikelgruppe whereAgrBezeichnung($value)
 * @method static Builder<static>|Artikelgruppe whereAgrEKRabatt($value)
 * @method static Builder<static>|Artikelgruppe whereAgrInaktivJN($value)
 * @method static Builder<static>|Artikelgruppe whereAgrProvisionProzent($value)
 * @method static Builder<static>|Artikelgruppe whereKZAgrMengeneinheit1($value)
 * @method static Builder<static>|Artikelgruppe whereKZAgrMengeneinheit2($value)
 * @method static Builder<static>|Artikelgruppe whereKZArtikelgruppe($value)
 * @method static Builder<static>|Artikelgruppe whereKZWarengruppe($value)
 * @method static Builder<static>|Artikelgruppe whereLinecardID($value)
 * @method static Builder<static>|Artikelgruppe whereTimeStamp($value)
 * @mixin Eloquent
 */
	class Artikelgruppe extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $InterneArtikelNummer
 * @property string|null $Zaehlertyp
 * @property string|null $Beschreibung
 * @property string|null $Bauart
 * @property string|null $Fabrikat
 * @property int|null $Laufzeit
 * @property string|null $Anschluss
 * @property string|null $QN
 * @property int|null $Verbrauchzaehlt
 * @property int|null $StueckZaehlt
 * @property int|null $GeraetWalkByFaehig
 * @property string|null $ArtikelAufsatzModul
 * @property int|null $GeraetInWartung
 * @property int|null $GeraetInMiete
 * @property int|null $GeraetFunkVorbereitet
 * @property int|null $Skalennummer
 * @property string|null $SkalenBezeichnung
 * @property string|null $SkalaHersteller
 * @property string|null $SkalaKurzbezeichnung
 * @property string|null $HKVTypVisualThermSkala
 * @property int|null $MaximalwertSkala
 * @property string|null $FormelKVBerechnungSkala
 * @property string|null $AnzahlFuehlerSkala
 * @property string|null $MontagehoeheSkala
 * @property float|null $BasisempfindlichkeitSkala
 * @property float|null $SKFaktorSkala
 * @property int|null $StricheUeberfuellungSkala
 * @property float|null $EinheitenUeberfuellungSkala
 * @property int|null $HKVTyp
 * @property int|null $HKVBewertungsnorm
 * @property int|null $HKVSkalierung
 * @property int|null $Ampullenfarbe
 * @property int|null $FolgeAblesewert
 * @property int|null $ArtDerBewertung
 * @property int|null $StichtagProgrammiertSkala
 * @property int|null $GeraetKodiertSkala
 * @property int|null $CheckzahlSkala
 * @property int|null $CheckzahlArtSkala
 * @property string|null $TextSkala
 * @property string|null $KennzeichenSontex
 * @property int|null $Geraetebits
 * @property string|null $RoutenEigenschaften
 * @property float|null $Laenge
 * @property float|null $Hoehe
 * @property float|null $Tiefe
 * @property string|null $Heizkoerperbezeichnung
 * @property string|null $Herstellerbezeichnung
 * @property string|null $CMID
 * @property float|null $LeistungInWatt
 * @property float|null $Segmentlaenge
 * @property float|null $KCWert
 * @property string|null $TimeStamp
 * @property string|null $Mediacode
 * @method static Builder<static>|Basisempfindlichkeit newModelQuery()
 * @method static Builder<static>|Basisempfindlichkeit newQuery()
 * @method static Builder<static>|Basisempfindlichkeit query()
 * @method static Builder<static>|Basisempfindlichkeit whereAmpullenfarbe($value)
 * @method static Builder<static>|Basisempfindlichkeit whereAnschluss($value)
 * @method static Builder<static>|Basisempfindlichkeit whereAnzahlFuehlerSkala($value)
 * @method static Builder<static>|Basisempfindlichkeit whereArtDerBewertung($value)
 * @method static Builder<static>|Basisempfindlichkeit whereArtikelAufsatzModul($value)
 * @method static Builder<static>|Basisempfindlichkeit whereBasisempfindlichkeitSkala($value)
 * @method static Builder<static>|Basisempfindlichkeit whereBauart($value)
 * @method static Builder<static>|Basisempfindlichkeit whereBeschreibung($value)
 * @method static Builder<static>|Basisempfindlichkeit whereCMID($value)
 * @method static Builder<static>|Basisempfindlichkeit whereCheckzahlArtSkala($value)
 * @method static Builder<static>|Basisempfindlichkeit whereCheckzahlSkala($value)
 * @method static Builder<static>|Basisempfindlichkeit whereEinheitenUeberfuellungSkala($value)
 * @method static Builder<static>|Basisempfindlichkeit whereFabrikat($value)
 * @method static Builder<static>|Basisempfindlichkeit whereFolgeAblesewert($value)
 * @method static Builder<static>|Basisempfindlichkeit whereFormelKVBerechnungSkala($value)
 * @method static Builder<static>|Basisempfindlichkeit whereGeraetFunkVorbereitet($value)
 * @method static Builder<static>|Basisempfindlichkeit whereGeraetInMiete($value)
 * @method static Builder<static>|Basisempfindlichkeit whereGeraetInWartung($value)
 * @method static Builder<static>|Basisempfindlichkeit whereGeraetKodiertSkala($value)
 * @method static Builder<static>|Basisempfindlichkeit whereGeraetWalkByFaehig($value)
 * @method static Builder<static>|Basisempfindlichkeit whereGeraetebits($value)
 * @method static Builder<static>|Basisempfindlichkeit whereHKVBewertungsnorm($value)
 * @method static Builder<static>|Basisempfindlichkeit whereHKVSkalierung($value)
 * @method static Builder<static>|Basisempfindlichkeit whereHKVTyp($value)
 * @method static Builder<static>|Basisempfindlichkeit whereHKVTypVisualThermSkala($value)
 * @method static Builder<static>|Basisempfindlichkeit whereHeizkoerperbezeichnung($value)
 * @method static Builder<static>|Basisempfindlichkeit whereHerstellerbezeichnung($value)
 * @method static Builder<static>|Basisempfindlichkeit whereHoehe($value)
 * @method static Builder<static>|Basisempfindlichkeit whereInterneArtikelNummer($value)
 * @method static Builder<static>|Basisempfindlichkeit whereKCWert($value)
 * @method static Builder<static>|Basisempfindlichkeit whereKennzeichenSontex($value)
 * @method static Builder<static>|Basisempfindlichkeit whereLaenge($value)
 * @method static Builder<static>|Basisempfindlichkeit whereLaufzeit($value)
 * @method static Builder<static>|Basisempfindlichkeit whereLeistungInWatt($value)
 * @method static Builder<static>|Basisempfindlichkeit whereMaximalwertSkala($value)
 * @method static Builder<static>|Basisempfindlichkeit whereMediacode($value)
 * @method static Builder<static>|Basisempfindlichkeit whereMontagehoeheSkala($value)
 * @method static Builder<static>|Basisempfindlichkeit whereQN($value)
 * @method static Builder<static>|Basisempfindlichkeit whereRoutenEigenschaften($value)
 * @method static Builder<static>|Basisempfindlichkeit whereSKFaktorSkala($value)
 * @method static Builder<static>|Basisempfindlichkeit whereSegmentlaenge($value)
 * @method static Builder<static>|Basisempfindlichkeit whereSkalaHersteller($value)
 * @method static Builder<static>|Basisempfindlichkeit whereSkalaKurzbezeichnung($value)
 * @method static Builder<static>|Basisempfindlichkeit whereSkalenBezeichnung($value)
 * @method static Builder<static>|Basisempfindlichkeit whereSkalennummer($value)
 * @method static Builder<static>|Basisempfindlichkeit whereStichtagProgrammiertSkala($value)
 * @method static Builder<static>|Basisempfindlichkeit whereStricheUeberfuellungSkala($value)
 * @method static Builder<static>|Basisempfindlichkeit whereStueckZaehlt($value)
 * @method static Builder<static>|Basisempfindlichkeit whereTextSkala($value)
 * @method static Builder<static>|Basisempfindlichkeit whereTiefe($value)
 * @method static Builder<static>|Basisempfindlichkeit whereTimeStamp($value)
 * @method static Builder<static>|Basisempfindlichkeit whereVerbrauchzaehlt($value)
 * @method static Builder<static>|Basisempfindlichkeit whereZaehlertyp($value)
 * @mixin Eloquent
 */
	class Basisempfindlichkeit extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $AbrechnungID
 * @property int|null $ABR_FOREIGN_ID
 * @property int $User
 * @property string|null $DateStamp
 * @property string $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG whereABRFOREIGNID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG whereAbrechnungID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG whereDateStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG whereUser($value)
 * @property string $ABR_COMP_API_ID
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG whereABRCOMPAPIID($value)
 * @mixin \Eloquent
 */
	class Ceos_ABRECHNUNG extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $ID
 * @property int $LiegenschaftsID
 * @property int $AbrechnungID
 * @property string $DatumVon
 * @property string|null $DatumBis
 * @property string|null $Stichtag HKA
 * @property int|null $Heizkostenabrechnung
 * @property int|null $Kaltwasserabrechnung
 * @property int|null $Nebenkostenabrechnung
 * @property int|null $Stromabrechnung
 * @property int|null $Ablesung
 * @property int|null $Selbstableser
 * @property int|null $DTA
 * @property int|null $BKB
 * @property int|null $ServiceRWM
 * @property int|null $Abrechnung/Haus
 * @property int|null $Warmwasser
 * @property string|null $AbrechnungszeitraumVon
 * @property string|null $AbrechnungszeitraumBis
 * @property int|null $AbrechnungsMonat
 * @property string|null $DatumLetzteAbrechnung
 * @property int|null $EigentuemerAbrechnungJN
 * @property string|null $Abrechnung_Memo
 * @property int $User
 * @property string|null $DateStamp
 * @property string $TimeStamp
 * @property string|null $Test_Info
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereAblesung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereAbrechnung/Haus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereAbrechnungID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereAbrechnungMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereAbrechnungsMonat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereAbrechnungszeitraumBis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereAbrechnungszeitraumVon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereBKB($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereDTA($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereDateStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereDatumBis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereDatumLetzteAbrechnung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereDatumVon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereEigentuemerAbrechnungJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereHeizkostenabrechnung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereKaltwasserabrechnung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereLiegenschaftsID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereNebenkostenabrechnung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereSelbstableser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereServiceRWM($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereStichtagHKA($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereStichtagKWA($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereStichtagNKA($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereStichtagSTA($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereStromabrechnung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereTestInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereWarmwasser($value)
 * @property string|null $Stichtag_HKA
 * @property string|null $Stichtag_KWA
 * @property string|null $Stichtag_NKA
 * @property string|null $Stichtag_STA
 * @property int|null $AbrechnungProHaus
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereAbrechnungProHaus($value)
 * @property int|null $Heizung_JN
 * @property int|null $Warmwasser_JN
 * @property int|null $Kaltwasser_JN
 * @property int|null $Betriebskosten_JN
 * @property int|null $Stromkosten_JN
 * @property int|null $MDM
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereBetriebskostenJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereHeizungJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereKaltwasserJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereMDM($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereStromkostenJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereWarmwasserJN($value)
 * @property int|null $EigentuemerAbrechnung_JN
 * @property int|null $MDM_ABR
 * @property int $Geloescht_JN
 * @property int|null $AbrechnungsArt
 * @property float|null $Hz_Festkostenanteil
 * @property float|null $Hz_Verbrauchskostenanteil
 * @property string|null $GrundkostenEinheit_H
 * @property float|null $WW_Festkostenanteil
 * @property float|null $WW_Verbrauchskosten
 * @property string|null $GrundkostenEinheit_WW
 * @property float|null $WW_Temperatur
 * @property float|null $FaktorWW
 * @property string|null $Art_EinheitWW
 * @property string|null $Druck_EinheitWW
 * @property string|null $Art_BerechnungWW
 * @property string|null $BrennstoffArt
 * @property string|null $Brennstoff_MEH
 * @property float|null $Brennwert1
 * @property string|null $Heizwert_Art1
 * @property string|null $BrennstoffArt2
 * @property string|null $Brennstoff_MEH2
 * @property float|null $Brennwert2
 * @property string|null $Heizwert_Art2
 * @property string|null $BrennstoffArt3
 * @property string|null $Brennstoff_MEH3
 * @property float|null $Brennwert3
 * @property string|null $Heizwert_Art3
 * @property string|null $Liegenschaft_Art
 * @property string|null $Ablesetermin_Bis
 * @property string|null $HKVTyp
 * @property int|null $UAW_JN
 * @property float|null $UAW_Prozent
 * @property string|null $KZZahlungsart
 * @property string|null $KZZahlungsbedingung
 * @property int|null $BANK
 * @property int|null $BLZ
 * @property int|null $KONTO
 * @property string|null $IBAN
 * @property string|null $BIC
 * @property string|null $Inhaber
 * @property int|null $AdresseBankID
 * @property int|null $AbleseMonat
 * @property int|null $Bezirk_Tour
 * @property string|null $Ablesung_Memo
 * @property string|null $Ablesetermin_Von
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereAbleseMonat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereAbleseterminBis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereAbleseterminVon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereAblesungMemo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereAbrechnungsArt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereAdresseBankID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereArtBerechnungWW($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereArtEinheitWW($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereBANK($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereBIC($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereBLZ($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereBezirkTour($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereBrennstoffArt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereBrennstoffArt2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereBrennstoffArt3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereBrennstoffMEH($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereBrennstoffMEH2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereBrennstoffMEH3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereBrennwert1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereBrennwert2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereBrennwert3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereDruckEinheitWW($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereFaktorWW($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereGeloeschtJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereGrundkostenEinheitH($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereGrundkostenEinheitWW($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereHKVTyp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereHeizwertArt1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereHeizwertArt2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereHeizwertArt3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereHzFestkostenanteil($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereHzVerbrauchskostenanteil($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereIBAN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereInhaber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereKONTO($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereKZZahlungsart($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereKZZahlungsbedingung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereLiegenschaftArt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereMDMABR($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereUAWJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereUAWProzent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereWWFestkostenanteil($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereWWTemperatur($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG_TimeLine whereWWVerbrauchskosten($value)
 * @mixin \Eloquent
 */
	class Ceos_ABRECHNUNG_TimeLine extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $ID
 * @property string $createDate
 * @property string $LiegenschaftsNummer
 * @property string $DatumVon
 * @property string|null $DatumBis
 * @property int $EigenschaftTyp
 * @property string|null $EigenschaftWert
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_DTA_Eigenschaften newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_DTA_Eigenschaften newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_DTA_Eigenschaften query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_DTA_Eigenschaften whereCreateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_DTA_Eigenschaften whereDatumBis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_DTA_Eigenschaften whereDatumVon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_DTA_Eigenschaften whereEigenschaftTyp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_DTA_Eigenschaften whereEigenschaftWert($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_DTA_Eigenschaften whereID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_DTA_Eigenschaften whereLiegenschaftsNummer($value)
 */
	class Ceos_DTA_Eigenschaften extends \Eloquent {}
}

namespace App\Models{
/**
 * @method static Builder<static>|Ceos_GEBAEUDE newModelQuery()
 * @method static Builder<static>|Ceos_GEBAEUDE newQuery()
 * @method static Builder<static>|Ceos_GEBAEUDE query()
 * @property int $GebaeudeID
 * @property int|null $GEB_FOREIGN_ID
 * @property int $User
 * @property string|null $DateStamp
 * @property string $TimeStamp
 * @method static Builder<static>|Ceos_GEBAEUDE whereDateStamp($value)
 * @method static Builder<static>|Ceos_GEBAEUDE whereGEBFOREIGNID($value)
 * @method static Builder<static>|Ceos_GEBAEUDE whereGebaeudeID($value)
 * @method static Builder<static>|Ceos_GEBAEUDE whereTimeStamp($value)
 * @method static Builder<static>|Ceos_GEBAEUDE whereUser($value)
 * @property string $GEB_COMP_API_ID
 * @method static Builder<static>|Ceos_GEBAEUDE whereGEBCOMPAPIID($value)
 * @mixin Eloquent
 */
	class Ceos_GEBAEUDE extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $ID
 * @property int $LiegenschaftsID
 * @property int $GebaeudeID
 * @property string $DatumVon
 * @property string|null $DatumBis
 * @property int|null $GebaeudeNr
 * @property string|null $LAND
 * @property string|null $LG_Strasse
 * @property string|null $LG_PLZ
 * @property string|null $LG_Ort
 * @property int|null $Heizanlage_JN
 * @property int $User
 * @property string|null $DateStamp
 * @property string $TimeStamp
 * @property string|null $Test_Info
 * @method static Builder<static>|Ceos_GEBAEUDE_TimeLine newModelQuery()
 * @method static Builder<static>|Ceos_GEBAEUDE_TimeLine newQuery()
 * @method static Builder<static>|Ceos_GEBAEUDE_TimeLine query()
 * @method static Builder<static>|Ceos_GEBAEUDE_TimeLine whereDateStamp($value)
 * @method static Builder<static>|Ceos_GEBAEUDE_TimeLine whereDatumBis($value)
 * @method static Builder<static>|Ceos_GEBAEUDE_TimeLine whereDatumVon($value)
 * @method static Builder<static>|Ceos_GEBAEUDE_TimeLine whereGebaeudeID($value)
 * @method static Builder<static>|Ceos_GEBAEUDE_TimeLine whereGebaeudeNr($value)
 * @method static Builder<static>|Ceos_GEBAEUDE_TimeLine whereHeizanlageJN($value)
 * @method static Builder<static>|Ceos_GEBAEUDE_TimeLine whereID($value)
 * @method static Builder<static>|Ceos_GEBAEUDE_TimeLine whereLAND($value)
 * @method static Builder<static>|Ceos_GEBAEUDE_TimeLine whereLGOrt($value)
 * @method static Builder<static>|Ceos_GEBAEUDE_TimeLine whereLGPLZ($value)
 * @method static Builder<static>|Ceos_GEBAEUDE_TimeLine whereLGStrasse($value)
 * @method static Builder<static>|Ceos_GEBAEUDE_TimeLine whereLiegenschaftsID($value)
 * @method static Builder<static>|Ceos_GEBAEUDE_TimeLine whereTestInfo($value)
 * @method static Builder<static>|Ceos_GEBAEUDE_TimeLine whereTimeStamp($value)
 * @method static Builder<static>|Ceos_GEBAEUDE_TimeLine whereUser($value)
 * @property int|null $MDM
 * @method static Builder<static>|Ceos_GEBAEUDE_TimeLine whereMDM($value)
 * @property int|null $MDM_GEB
 * @property int $Geloescht_JN
 * @property string|null $GEB_TPlatz
 * @method static Builder<static>|Ceos_GEBAEUDE_TimeLine whereGEBTPlatz($value)
 * @method static Builder<static>|Ceos_GEBAEUDE_TimeLine whereGeloeschtJN($value)
 * @method static Builder<static>|Ceos_GEBAEUDE_TimeLine whereMDMGEB($value)
 * @mixin Eloquent
 */
	class Ceos_GEBAEUDE_TimeLine extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $GeraeteID
 * @property int|null $GER_FOREIGN_ID
 * @property int $User
 * @property string|null $DateStamp
 * @property string $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_GERAET newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_GERAET newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_GERAET query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_GERAET whereDateStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_GERAET whereGERFOREIGNID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_GERAET whereGeraeteID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_GERAET whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_GERAET whereUser($value)
 * @property string|null $GER_COMP_API_ID
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_GERAET whereGERCOMPAPIID($value)
 * @mixin \Eloquent
 */
	class Ceos_GERAET extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $HeizkoerperID
 * @property int|null $HEI_FOREIGN_ID
 * @property int $User
 * @property string|null $DateStamp
 * @property string $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HEIZKOERPER newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HEIZKOERPER newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HEIZKOERPER query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HEIZKOERPER whereDateStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HEIZKOERPER whereHEIFOREIGNID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HEIZKOERPER whereHeizkoerperID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HEIZKOERPER whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HEIZKOERPER whereUser($value)
 * @property string|null $HEI_COMP_API_ID
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HEIZKOERPER whereHEICOMPAPIID($value)
 * @mixin \Eloquent
 */
	class Ceos_HEIZKOERPER extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $ID
 * @property int $HIBE
 * @property int $HAWA01
 * @property int|null $HAWA02
 * @property int|null $HAWA03
 * @property int|null $HAWA04
 * @property int|null $HAWA05
 * @property int|null $HAWA06
 * @property int|null $HAWA07
 * @property int|null $HAWA08
 * @property int|null $HAWA09
 * @property int|null $HAWA10
 * @property string $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA whereHAWA01($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA whereHAWA02($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA whereHAWA03($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA whereHAWA04($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA whereHAWA05($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA whereHAWA06($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA whereHAWA07($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA whereHAWA08($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA whereHAWA09($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA whereHAWA10($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA whereHIBE($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA whereID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA whereTimeStamp($value)
 * @mixin \Eloquent
 */
	class Ceos_HIBE2HAWA extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $ID
 * @property string $TYPE
 * @property string $VALUE
 * @property string $TimeStamp
 * @method static Builder<static>|Ceos_ID_SAP newModelQuery()
 * @method static Builder<static>|Ceos_ID_SAP newQuery()
 * @method static Builder<static>|Ceos_ID_SAP query()
 * @method static Builder<static>|Ceos_ID_SAP whereID($value)
 * @method static Builder<static>|Ceos_ID_SAP whereTYPE($value)
 * @method static Builder<static>|Ceos_ID_SAP whereTimeStamp($value)
 * @method static Builder<static>|Ceos_ID_SAP whereVALUE($value)
 * @mixin \Eloquent
 */
	class Ceos_ID_SAP extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $KontaktID
 * @property int|null $KON_FOREIGN_ID
 * @property int $User
 * @property string|null $DateStamp
 * @property string $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KONTAKT newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KONTAKT newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KONTAKT query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KONTAKT whereDateStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KONTAKT whereKONFOREIGNID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KONTAKT whereKontaktID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KONTAKT whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KONTAKT whereUser($value)
 * @property string $KON_COMP_API_ID
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KONTAKT whereKONCOMPAPIID($value)
 * @mixin \Eloquent
 */
	class Ceos_KONTAKT extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $KostenID
 * @property int|null $KOS_FOREIGN_ID
 * @property int $User
 * @property string|null $DateStamp
 * @property string $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KOSTEN newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KOSTEN newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KOSTEN query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KOSTEN whereDateStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KOSTEN whereKOSFOREIGNID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KOSTEN whereKostenID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KOSTEN whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KOSTEN whereUser($value)
 * @property string $KOS_COMP_API_ID
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KOSTEN whereKOSCOMPAPIID($value)
 * @mixin \Eloquent
 */
	class Ceos_KOSTEN extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $LiegenschaftsID
 * @property int|null $LG_DELETED
 * @property int|null $LG_FOREIGN_ID
 * @property int $User
 * @property string|null $DateStamp
 * @property string $TimeStamp
 * @method static Builder<static>|Ceos_LIEGENSCHAFT newModelQuery()
 * @method static Builder<static>|Ceos_LIEGENSCHAFT newQuery()
 * @method static Builder<static>|Ceos_LIEGENSCHAFT query()
 * @method static Builder<static>|Ceos_LIEGENSCHAFT whereDateStamp($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT whereLGDELETED($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT whereLGFOREIGNID($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT whereLiegenschaftsID($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT whereTimeStamp($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT whereUser($value)
 * @property string $Liegenschaftsnummer
 * @method static Builder<static>|Ceos_LIEGENSCHAFT whereLiegenschaftsnummer($value)
 * @mixin Eloquent
 */
	class Ceos_LIEGENSCHAFT extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $ID
 * @property int $LiegenschaftsID
 * @property string $DatumVon
 * @property string|null $DatumBis
 * @property string $Liegenschaftsnummer
 * @property int|null $Fernablesung_JN
 * @property string|null $Fernablesung_Ab
 * @property int|null $OnlinePortal_JN
 * @property string|null $OnlinePortal_Ab
 * @property int|null $UviReady_JN
 * @property string|null $UviReady_Ab
 * @property int|null $Mdf
 * @property string|null $Mdf_Bis
 * @property int|null $Vertreter
 * @property string|null $Liegenschaft_Art
 * @property int|null $Heizung_JN
 * @property int|null $Warmwasser_JN
 * @property int|null $Kaltwasser_JN
 * @property int|null $Betriebskosten_JN
 * @property int|null $Stromkosten_JN
 * @property float|null $Hz_Festkostenanteil
 * @property float|null $Hz_Verbrauchskostenanteil
 * @property string|null $GrundkostenEinheit_H
 * @property float|null $WW_Festkostenanteil
 * @property float|null $WW_Verbrauchskosten
 * @property string|null $GrundkostenEinheit_WW
 * @property float|null $WW_Temperatur
 * @property float|null $FaktorWW
 * @property string|null $Art_EinheitWW
 * @property string|null $Druck_EinheitWW
 * @property string|null $Art_BerechnungWW
 * @property string|null $BrennstoffArt
 * @property string|null $Brennstoff_MEH
 * @property float|null $Brennwert1
 * @property string|null $Heizwert_Art1
 * @property string|null $BrennstoffArt2
 * @property string|null $Brennstoff_MEH2
 * @property float|null $Brennwert2
 * @property string|null $Heizwert_Art2
 * @property string|null $BrennstoffArt3
 * @property string|null $Brennstoff_MEH3
 * @property float|null $Brennwert3
 * @property string|null $Heizwert_Art3
 * @property int|null $UAW_JN
 * @property float|null $UAW_Prozent
 * @property string|null $KZZahlungsart
 * @property string|null $KZZahlungsbedingung
 * @property int|null $BANK
 * @property int|null $BLZ
 * @property int|null $KONTO
 * @property string|null $IBAN
 * @property string|null $BIC
 * @property string|null $Inhaber
 * @property int|null $AdresseBankID
 * @property int|null $AbleseMonat
 * @property int|null $Bezirk_Tour
 * @property int|null $Selbstableser_JN
 * @property string|null $Ablesung_Memo
 * @property string|null $Ablesetermin_Von
 * @property string|null $Ablesetermin_Bis
 * @property string|null $HKVTyp
 * @property string|null $ObjektEigenschaften
 * @property int $User
 * @property string|null $DateStamp
 * @property string $TimeStamp
 * @property string $FULL_HASH
 * @property string|null $Test_Info
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine newModelQuery()
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine newQuery()
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine query()
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereAbleseMonat($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereAbleseterminBis($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereAbleseterminVon($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereAblesungMemo($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereAdresseBankID($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereArtBerechnungWW($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereArtEinheitWW($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereBANK($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereBIC($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereBLZ($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereBetriebskostenJN($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereBezirkTour($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereBrennstoffArt($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereBrennstoffArt2($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereBrennstoffArt3($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereBrennstoffMEH($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereBrennstoffMEH2($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereBrennstoffMEH3($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereBrennwert1($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereBrennwert2($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereBrennwert3($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereDateStamp($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereDatumBis($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereDatumVon($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereDruckEinheitWW($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereFULLHASH($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereFaktorWW($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereFernablesungAb($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereFernablesungJN($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereGrundkostenEinheitH($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereGrundkostenEinheitWW($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereHKVTyp($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereHeizungJN($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereHeizwertArt1($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereHeizwertArt2($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereHeizwertArt3($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereHzFestkostenanteil($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereHzVerbrauchskostenanteil($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereIBAN($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereID($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereInhaber($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereKONTO($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereKZZahlungsart($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereKZZahlungsbedingung($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereKaltwasserJN($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereLiegenschaftArt($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereLiegenschaftsID($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereLiegenschaftsnummer($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereMdf($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereMdfBis($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereObjektEigenschaften($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereOnlinePortalAb($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereOnlinePortalJN($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereSelbstableserJN($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereStromkostenJN($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereTestInfo($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereTimeStamp($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereUAWJN($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereUAWProzent($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereUser($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereUviReadyAb($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereUviReadyJN($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereVertreter($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereWWFestkostenanteil($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereWWTemperatur($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereWWVerbrauchskosten($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereWarmwasserJN($value)
 * @property int|null $MDM
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereMDM($value)
 * @property int|null $MDM_LG
 * @property int $Geloescht_JN
 * @property string|null $LG_KORR_Nr
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereGeloeschtJN($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereLGKORRNr($value)
 * @method static Builder<static>|Ceos_LIEGENSCHAFT_TimeLine whereMDMLG($value)
 * @mixin Eloquent
 */
	class Ceos_LIEGENSCHAFT_TimeLine extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $MesspunktID
 * @property int|null $MP_FOREIGN_ID
 * @property int $User
 * @property string|null $DateStamp
 * @property string $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MESSPUNKT newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MESSPUNKT newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MESSPUNKT query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MESSPUNKT whereDateStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MESSPUNKT whereMPFOREIGNID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MESSPUNKT whereMesspunktID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MESSPUNKT whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MESSPUNKT whereUser($value)
 * @property string|null $MP_COMP_API_ID
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MESSPUNKT whereMPCOMPAPIID($value)
 * @mixin \Eloquent
 */
	class Ceos_MESSPUNKT extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $MieterID
 * @property int|null $MI_FOREIGN_ID
 * @property int $User
 * @property string|null $DateStamp
 * @property string $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER whereDateStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER whereMIFOREIGNID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER whereMieterID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER whereUser($value)
 * @property string $MI_COMP_API_ID
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER whereMICOMPAPIID($value)
 * @mixin \Eloquent
 */
	class Ceos_MIETER extends \Eloquent {}
}

namespace App\Models{
/**
 * @method static Builder<static>|Ceos_MIETER_TimeLine newModelQuery()
 * @method static Builder<static>|Ceos_MIETER_TimeLine newQuery()
 * @method static Builder<static>|Ceos_MIETER_TimeLine query()
 * @property int $ID
 * @property int $WohneinheitID
 * @property int $MieterID
 * @property string $DatumVon
 * @property string|null $DatumBis
 * @property int|null $lfd.Adressnummer GE CEOS
 * @property string|null $Mietvertragsnummer
 * @property string|null $M_Kundeneigene_NutzerNr
 * @property string|null $M_Eigentuemernummer
 * @property string|null $M_Name1
 * @property string|null $M_Name2
 * @property int|null $M_Anrede
 * @property float|null $M_Personen
 * @property string|null $Bemerkung_intern
 * @property int|null $MWST_JN
 * @property int|null $Vorauszahlung_JN
 * @property int $User
 * @property string|null $DateStamp
 * @property string $TimeStamp
 * @property string|null $Test_Info
 * @property int $LiegenschaftsID
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereBemerkungIntern($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereDateStamp($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereDatumBis($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereDatumVon($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereID($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereLfd.AdressnummerGECEOS($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereLiegenschaftsID($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereMAnrede($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereMEigentuemernummer($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereMKundeneigeneNutzerNr($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereMName1($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereMName2($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereMPersonen($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereMWSTJN($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereMieterID($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereMietvertragsnummer($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereTestInfo($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereTimeStamp($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereUser($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereVorauszahlungJN($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereWohneinheitID($value)
 * @property int|null $lfd_Adressnummer_GE_CEOS
 * @property int|null $lfd_Adressnummer_ME_CEOS
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereLfdAdressnummerGECEOS($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereLfdAdressnummerMECEOS($value)
 * @property int|null $MDM
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereMDM($value)
 * @property int|null $MDM_MI
 * @property int|null $Geloescht_JN
 * @property string|null $M_Strasse
 * @property string|null $M_PlzOrt
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereGeloeschtJN($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereMDMMI($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereMPlzOrt($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereMStrasse($value)
 * @mixin Eloquent
 * @property string|null $M_Telefon
 * @property string|null $M_Mobil
 * @property string|null $M_Email
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER_TimeLine whereMEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER_TimeLine whereMMobil($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER_TimeLine whereMTelefon($value)
 */
	class Ceos_MIETER_TimeLine extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $VerwaltungID
 * @property int|null $VER_FOREIGN_ID
 * @property int $User
 * @property string|null $DateStamp
 * @property string $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_VERWALTUNG newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_VERWALTUNG newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_VERWALTUNG query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_VERWALTUNG whereDateStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_VERWALTUNG whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_VERWALTUNG whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_VERWALTUNG whereVERFOREIGNID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_VERWALTUNG whereVerwaltungID($value)
 * @mixin \Eloquent
 */
	class Ceos_VERWALTUNG extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $ID
 * @property int $LiegenschaftsID
 * @property int $VerwaltungID
 * @property string $DatumVon
 * @property string|null $DatumBis
 * @property int|null $AuftraggeberID
 * @property string|null $Kundenart
 * @property string|null $ErsteAbr
 * @property string|null $LetzteAbr
 * @property int|null $AnsprechpartnerID
 * @property int|null $VorLieferanschrift
 * @property int|null $VorLieferanschriftAnsprechpartnerID
 * @property int|null $VorRechnungsanschrift
 * @property int|null $VorRechnungsanschriftAnsprechpartnerID
 * @property int $User
 * @property string|null $DateStamp
 * @property string $TimeStamp
 * @property string|null $Test_Info
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine newModelQuery()
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine newQuery()
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine query()
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereAnsprechpartnerID($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereAuftraggeberID($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereDateStamp($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereDatumBis($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereDatumVon($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereErsteAbr($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereID($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereKundenart($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereLetzteAbr($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereLiegenschaftsID($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereTestInfo($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereTimeStamp($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereUser($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereVerwaltungID($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereVorLieferanschrift($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereVorLieferanschriftAnsprechpartnerID($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereVorRechnungsanschrift($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereVorRechnungsanschriftAnsprechpartnerID($value)
 * @property int $Geloescht_JN
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereGeloeschtJN($value)
 * @mixin Eloquent
 */
	class Ceos_VERWALTUNG_TimeLine extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $WohneinheitID
 * @property int|null $WE_FOREIGN_ID
 * @property int $User
 * @property string|null $DateStamp
 * @property string $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_WOHNEINHEIT newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_WOHNEINHEIT newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_WOHNEINHEIT query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_WOHNEINHEIT whereDateStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_WOHNEINHEIT whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_WOHNEINHEIT whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_WOHNEINHEIT whereWEFOREIGNID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_WOHNEINHEIT whereWohneinheitID($value)
 * @property string $WE_COMP_API_ID
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_WOHNEINHEIT whereWECOMPAPIID($value)
 * @mixin \Eloquent
 */
	class Ceos_WOHNEINHEIT extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $ID
 * @property int $LiegenschaftsID
 * @property int $GebaeudeID
 * @property int $WohneinheitID
 * @property string $DatumVon
 * @property string|null $DatumBis
 * @property int|null $lfd. Adressnummer GE CEOS
 * @property string|null $WE_Bezeichnung
 * @property int|null $WE_LfdNr
 * @property string|null $M_Kundeneigene_WohneinheitenNr
 * @property string|null $Lage
 * @property int|null $Garage_JN
 * @property int|null $Heizung_JN
 * @property int|null $WW_JN
 * @property int|null $KW_JN
 * @property int|null $NK_JN
 * @property float|null $Wohn_Fläche
 * @property float|null $Heizung_Fläche
 * @property float|null $WW_Fläche
 * @property int|null $Gewerblich_JN
 * @property string|null $Bemerkung_intern
 * @property string|null $BemerkungWE
 * @property int $User
 * @property string|null $DateStamp
 * @property string $TimeStamp
 * @property string|null $Test_InfoA
 * @property string|null $Test_InfoB
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine newModelQuery()
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine newQuery()
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine query()
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereBemerkungIntern($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereBemerkungWE($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereDateStamp($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereDatumBis($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereDatumVon($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereGarageJN($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereGebaeudeID($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereGewerblichJN($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereHeizungFläche($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereHeizungJN($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereID($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereKWJN($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereLage($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereLfd.AdressnummerGECEOS($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereLiegenschaftsID($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereMKundeneigeneWohneinheitenNr($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereNKJN($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereTestInfoA($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereTestInfoB($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereTimeStamp($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereUser($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereWEBezeichnung($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereWELfdNr($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereWWFläche($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereWWJN($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereWohnFläche($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereWohneinheitID($value)
 * @property int|null $lfd_Adressnummer_GE_CEOS
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereLfdAdressnummerGECEOS($value)
 * @property int|null $MDM
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereMDM($value)
 * @property float|null $Wohn_Flaeche
 * @property float|null $Heizung_Flaeche
 * @property float|null $WW_Flaeche
 * @property int|null $MDM_WE
 * @property int $Geloescht_JN
 * @property string|null $WE_HK_KORR_Nr
 * @property string|null $WE_KW_KORR_Nr
 * @property string|null $WE_TPlatz
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereGeloeschtJN($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereHeizungFlaeche($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereMDMWE($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereWEHKKORRNr($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereWEKWKORRNr($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereWETPlatz($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereWWFlaeche($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereWohnFlaeche($value)
 * @mixin Eloquent
 * @property string|null $Geschosslage_SKT
 * @property int|null $Begehreihenfolge
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereBegehreihenfolge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereGeschosslageSKT($value)
 */
	class Ceos_WOHNEINHEIT_TimeLine extends \Eloquent {}
}

namespace App\Models{
/**
 * @property string $VorArt
 * @property string $VorGruppe
 * @property int $VNkArt
 * @property string $VNkName
 * @property int|null $VNkAnfangswert
 * @property int|null $VNkEndwert
 * @property int|null $VNkAktuellerWert
 * @property string|null $TimeStamp
 * @method static Builder<static>|NummernkreisVorgang newModelQuery()
 * @method static Builder<static>|NummernkreisVorgang newQuery()
 * @method static Builder<static>|NummernkreisVorgang query()
 * @method static Builder<static>|NummernkreisVorgang whereTimeStamp($value)
 * @method static Builder<static>|NummernkreisVorgang whereVNkAktuellerWert($value)
 * @method static Builder<static>|NummernkreisVorgang whereVNkAnfangswert($value)
 * @method static Builder<static>|NummernkreisVorgang whereVNkArt($value)
 * @method static Builder<static>|NummernkreisVorgang whereVNkEndwert($value)
 * @method static Builder<static>|NummernkreisVorgang whereVNkName($value)
 * @method static Builder<static>|NummernkreisVorgang whereVorArt($value)
 * @method static Builder<static>|NummernkreisVorgang whereVorGruppe($value)
 * @mixin Eloquent
 */
	class NummernkreisVorgang extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $NRBenutzer
 * @property string $NutName
 * @property string|null $NutPasswort
 * @property int $NutLoginJN
 * @property int $NutSuperuserJN
 * @property int $NutOutlookJN
 * @property int $NutFibuAdminJN
 * @property int $NutPersonalAdminJN
 * @property int $NutPersonalGruppeAdminJN
 * @property int $NutEinkaufsdatenJN
 * @property string|null $NutKuerzel
 * @property string|null $NutDurchwahl
 * @property string|null $NutEMail
 * @property string|null $NutUnterschrift1
 * @property string|null $NutUnterschrift2
 * @property int|null $NutInterneAdressnummer
 * @property int $NutSupporterJN
 * @property int $NutProgrammiererJN
 * @property int|null $NutUnterschrift1Textnummer
 * @property int|null $NutUnterschrift2Textnummer
 * @property string|null $NutPfadVCard
 * @property string|null $SystemPW
 * @property int|null $SystemRechte
 * @property int|null $SystemKBits
 * @property int $NutMailingMethod
 * @property string|null $TimeStamp
 * @property int $NutUseInternalUserConfigJN
 * @property int|null $LayoutGruppeID
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereLayoutGruppeID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNRBenutzer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutDurchwahl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutEMail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutEinkaufsdatenJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutFibuAdminJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutInterneAdressnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutKuerzel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutLoginJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutMailingMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutOutlookJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutPasswort($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutPersonalAdminJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutPersonalGruppeAdminJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutPfadVCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutProgrammiererJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutSuperuserJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutSupporterJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutUnterschrift1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutUnterschrift1Textnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutUnterschrift2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutUnterschrift2Textnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutUseInternalUserConfigJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereSystemKBits($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereSystemPW($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereSystemRechte($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereTimeStamp($value)
 * @mixin \Eloquent
 */
	class Nutzer extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $InterneVorgangsnummer
 * @property int $InternePositionsnummer
 * @property int $PosEbene
 * @property int $PosNummer
 * @property string|null $PosNummernText
 * @property int|null $PosVorgaenger
 * @property int|null $PosHaupt
 * @property string|null $KZArtikelgruppe
 * @property string|null $KZWarengruppe
 * @property int|null $ArtikelUntergruppeID
 * @property string|null $KZProduktgruppe
 * @property int|null $InterneArtikelnummer
 * @property string|null $PosBezeichnung1
 * @property int|null $FibuKontoGruppeID
 * @property int|null $FKtoNummer
 * @property int $PosNeueSeite
 * @property int $PosSeriennummernfaehigJN
 * @property int $PosChargenfaehigJN
 * @property int $PosAutoAbbuchenJN
 * @property int $PosAutoZubuchenJN
 * @property int|null $PosTyp
 * @property int $PosGebuchtJN
 * @property int $PosErledigtJN
 * @property int $PosLagerbuchungJN
 * @property string|null $LagerGruppe
 * @property int|null $Lagerortnummer
 * @property int|null $MagazinID
 * @property string|null $PosUeberschrift
 * @property int $PosFremdfertigungJN
 * @property int $PosLieferantenfaehigJN
 * @property int $PosFertigungsfaehigJN
 * @property int $PosUrsprungsnachweisJN
 * @property int $PosEKInNachkalkulationJN
 * @property string|null $PosKZMengeneinheit1Ansicht
 * @property float|null $PosFaktorAnsicht
 * @property string|null $PosAnlageAm
 * @property int|null $PosAnlageDurch
 * @property string|null $PosLetzteAenderungAm
 * @property int|null $PosLetzteAenderungDurch
 * @property string|null $KZKalkulationGruppe
 * @property string|null $TimeStamp
 * @property int|null $NRKostentraeger
 * @method static Builder<static>|Position newModelQuery()
 * @method static Builder<static>|Position newQuery()
 * @method static Builder<static>|Position query()
 * @method static Builder<static>|Position whereArtikelUntergruppeID($value)
 * @method static Builder<static>|Position whereFKtoNummer($value)
 * @method static Builder<static>|Position whereFibuKontoGruppeID($value)
 * @method static Builder<static>|Position whereInterneArtikelnummer($value)
 * @method static Builder<static>|Position whereInternePositionsnummer($value)
 * @method static Builder<static>|Position whereInterneVorgangsnummer($value)
 * @method static Builder<static>|Position whereKZArtikelgruppe($value)
 * @method static Builder<static>|Position whereKZKalkulationGruppe($value)
 * @method static Builder<static>|Position whereKZProduktgruppe($value)
 * @method static Builder<static>|Position whereKZWarengruppe($value)
 * @method static Builder<static>|Position whereLagerGruppe($value)
 * @method static Builder<static>|Position whereLagerortnummer($value)
 * @method static Builder<static>|Position whereMagazinID($value)
 * @method static Builder<static>|Position whereNRKostentraeger($value)
 * @method static Builder<static>|Position wherePosAnlageAm($value)
 * @method static Builder<static>|Position wherePosAnlageDurch($value)
 * @method static Builder<static>|Position wherePosAutoAbbuchenJN($value)
 * @method static Builder<static>|Position wherePosAutoZubuchenJN($value)
 * @method static Builder<static>|Position wherePosBezeichnung1($value)
 * @method static Builder<static>|Position wherePosChargenfaehigJN($value)
 * @method static Builder<static>|Position wherePosEKInNachkalkulationJN($value)
 * @method static Builder<static>|Position wherePosEbene($value)
 * @method static Builder<static>|Position wherePosErledigtJN($value)
 * @method static Builder<static>|Position wherePosFaktorAnsicht($value)
 * @method static Builder<static>|Position wherePosFertigungsfaehigJN($value)
 * @method static Builder<static>|Position wherePosFremdfertigungJN($value)
 * @method static Builder<static>|Position wherePosGebuchtJN($value)
 * @method static Builder<static>|Position wherePosHaupt($value)
 * @method static Builder<static>|Position wherePosKZMengeneinheit1Ansicht($value)
 * @method static Builder<static>|Position wherePosLagerbuchungJN($value)
 * @method static Builder<static>|Position wherePosLetzteAenderungAm($value)
 * @method static Builder<static>|Position wherePosLetzteAenderungDurch($value)
 * @method static Builder<static>|Position wherePosLieferantenfaehigJN($value)
 * @method static Builder<static>|Position wherePosNeueSeite($value)
 * @method static Builder<static>|Position wherePosNummer($value)
 * @method static Builder<static>|Position wherePosNummernText($value)
 * @method static Builder<static>|Position wherePosSeriennummernfaehigJN($value)
 * @method static Builder<static>|Position wherePosTyp($value)
 * @method static Builder<static>|Position wherePosUeberschrift($value)
 * @method static Builder<static>|Position wherePosUrsprungsnachweisJN($value)
 * @method static Builder<static>|Position wherePosVorgaenger($value)
 * @method static Builder<static>|Position whereTimeStamp($value)
 * @mixin Eloquent
 */
	class Position extends \Eloquent {}
}

namespace App\Models{
/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert query()
 * @property int $InterneVorgangsnummer
 * @property int $InternePositionsnummer
 * @property int $PosRabattfaehig
 * @property int $PosRabattUnterpositionJN
 * @property float $PosRabattPosition1
 * @property float $PosRabattPosition2
 * @property float $PosRabattPosition3
 * @property float|null $PosRabattAdresse
 * @property float $PosRabattWert1
 * @property float $PosRabattWert2
 * @property int $NRPreisbasis
 * @property float $PosPreisfaktor
 * @property int $PosPreisProME2
 * @property float $PosPreisEinzel
 * @property float $PosPreisUnterposition
 * @property float $PosPreisUnterposLager
 * @property float $PosPreisPosition
 * @property float $PosGesamteinzelpreis
 * @property float $PosGesamtpreisVorRabatt
 * @property float $PosGesamtpreis
 * @property float $PosPreisEinkauf
 * @property float $PosPreisEinkaufOriginal
 * @property float $PosPreisEinkaufUnterposition
 * @property float $PosPreisEinkaufVT
 * @property float $PosPreisEinkaufUnterpositionVT
 * @property float $PosGesamteinzelpreisEK
 * @property float $PosGesamtpreisEK
 * @property float $PosGesamteinzelpreisEKVT
 * @property float $PosGesamtpreisEKVT
 * @property float|null $PosPreisVerbindlichkeit
 * @property float $PosRundungsfaktorVK
 * @property float $PosAbzugEK
 * @property int $MwstNummer
 * @property float|null $PosMwstProzent
 * @property float $PosVerschnitt
 * @property float|null $PosProvisionProzent
 * @property string|null $PosPreisermittlungVK
 * @property string|null $PosPreisermittlungEK
 * @property string|null $PosPreisermittlungRabatt1
 * @property string|null $PosPreisermittlungRabatt2
 * @property string|null $PosPreisermittlungRabatt3
 * @property string|null $PosPreisermittlungRabattWert1
 * @property string|null $PosPreisermittlungRabattWert2
 * @property string|null $TimeStamp
 * @property float $PosDBEinzel
 * @property float $PosDBGesamt
 * @property float $PosDBProzent
 * @property float $PosDBAufschlag
 * @property int|null $WithholdingtaxKategorieID
 * @property float|null $PosWHTProzent
 * @property float|null $PosPreisEinzelBrutto
 * @property float|null $PosPreisPositionBrutto
 * @property float|null $PosGesamtpreisVorRabattBrutto
 * @property float|null $PosGesamteinzelpreisBrutto
 * @property float|null $PosGesamtpreisBrutto
 * @property int $PosSkontofaehigJN
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert whereInternePositionsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert whereInterneVorgangsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert whereMwstNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert whereNRPreisbasis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosAbzugEK($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosDBAufschlag($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosDBEinzel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosDBGesamt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosDBProzent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosGesamteinzelpreis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosGesamteinzelpreisBrutto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosGesamteinzelpreisEK($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosGesamteinzelpreisEKVT($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosGesamtpreis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosGesamtpreisBrutto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosGesamtpreisEK($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosGesamtpreisEKVT($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosGesamtpreisVorRabatt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosGesamtpreisVorRabattBrutto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosMwstProzent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisEinkauf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisEinkaufOriginal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisEinkaufUnterposition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisEinkaufUnterpositionVT($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisEinkaufVT($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisEinzel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisEinzelBrutto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisPositionBrutto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisProME2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisUnterposLager($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisUnterposition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisVerbindlichkeit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisermittlungEK($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisermittlungRabatt1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisermittlungRabatt2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisermittlungRabatt3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisermittlungRabattWert1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisermittlungRabattWert2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisermittlungVK($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisfaktor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosProvisionProzent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosRabattAdresse($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosRabattPosition1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosRabattPosition2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosRabattPosition3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosRabattUnterpositionJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosRabattWert1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosRabattWert2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosRabattfaehig($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosRundungsfaktorVK($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosSkontofaehigJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosVerschnitt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosWHTProzent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert whereWithholdingtaxKategorieID($value)
 * @mixin Eloquent
 */
	class Position1Wert extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $InterneVorgangsnummer
 * @property int $InternePositionsnummer
 * @property string|null $PosBezeichnung2
 * @property string|null $PosBezeichnung3
 * @property string|null $PosZusatztext
 * @property string|null $PosBetreff
 * @property string|null $PosZusatztextAngebot
 * @property string|null $PosZusatztextAuftrag
 * @property string|null $PosZusatztextLieferschein
 * @property string|null $PosZusatztextRechnung
 * @property string|null $PosZusatztextArbeitskarte
 * @property string|null $PosNotiz
 * @property string|null $PosVariante
 * @property string|null $PosFormelVK
 * @property string|null $PosFormelMengeneinheit2
 * @property string|null $PosFormelMengeneinheit1
 * @property string|null $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text whereInternePositionsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text whereInterneVorgangsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text wherePosBetreff($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text wherePosBezeichnung2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text wherePosBezeichnung3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text wherePosFormelMengeneinheit1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text wherePosFormelMengeneinheit2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text wherePosFormelVK($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text wherePosNotiz($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text wherePosVariante($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text wherePosZusatztext($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text wherePosZusatztextAngebot($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text wherePosZusatztextArbeitskarte($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text wherePosZusatztextAuftrag($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text wherePosZusatztextLieferschein($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text wherePosZusatztextRechnung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text whereTimeStamp($value)
 * @mixin Eloquent
 */
	class Position2Text extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $InterneVorgangsnummer
 * @property int $InternePositionsnummer
 * @property float $PosMenge1
 * @property float $PosMengeAuftrag1
 * @property float $PosMengeLieferung1
 * @property float $PosMengeAbrechnung1
 * @property float $PosMengeRechnung1
 * @property float $PosMengeVersand1
 * @property float $PosMengeAusschuss1
 * @property float $PosMenge2
 * @property float $PosMengeAuftrag2
 * @property float $PosMengeLieferung2
 * @property float $PosMengeAbrechnung2
 * @property float $PosMengeRechnung2
 * @property float $PosMengeVersand2
 * @property float $PosMengeAusschuss2
 * @property float $PosMultiplikator
 * @property float $PosMultiplikatorAuftrag
 * @property float $PosMultiplikatorLieferung
 * @property float $PosMultiplikatorAbrechnung
 * @property float $PosMultiplikatorRechnung
 * @property float $PosMultiplikatorVersand
 * @property string|null $PosKZMengeneinheit1
 * @property float|null $PosFaktorMengeneinheit2
 * @property int|null $PosTypMengeneinheit2
 * @property string|null $PosKZMengeneinheit2
 * @property string|null $PosKZGewichtseinheit
 * @property float|null $PosGewicht
 * @property int|null $PosGewichtsbasis
 * @property float $PosBundleMenge1
 * @property string|null $PosBundleMengeneinheit1
 * @property float $PosBundleMenge2
 * @property string|null $TimeStamp
 * @property float|null $PosMengeOriginal1
 * @property float|null $PosMengeOriginal2
 * @method static Builder<static>|Position3Menge newModelQuery()
 * @method static Builder<static>|Position3Menge newQuery()
 * @method static Builder<static>|Position3Menge query()
 * @method static Builder<static>|Position3Menge whereInternePositionsnummer($value)
 * @method static Builder<static>|Position3Menge whereInterneVorgangsnummer($value)
 * @method static Builder<static>|Position3Menge wherePosBundleMenge1($value)
 * @method static Builder<static>|Position3Menge wherePosBundleMenge2($value)
 * @method static Builder<static>|Position3Menge wherePosBundleMengeneinheit1($value)
 * @method static Builder<static>|Position3Menge wherePosFaktorMengeneinheit2($value)
 * @method static Builder<static>|Position3Menge wherePosGewicht($value)
 * @method static Builder<static>|Position3Menge wherePosGewichtsbasis($value)
 * @method static Builder<static>|Position3Menge wherePosKZGewichtseinheit($value)
 * @method static Builder<static>|Position3Menge wherePosKZMengeneinheit1($value)
 * @method static Builder<static>|Position3Menge wherePosKZMengeneinheit2($value)
 * @method static Builder<static>|Position3Menge wherePosMenge1($value)
 * @method static Builder<static>|Position3Menge wherePosMenge2($value)
 * @method static Builder<static>|Position3Menge wherePosMengeAbrechnung1($value)
 * @method static Builder<static>|Position3Menge wherePosMengeAbrechnung2($value)
 * @method static Builder<static>|Position3Menge wherePosMengeAuftrag1($value)
 * @method static Builder<static>|Position3Menge wherePosMengeAuftrag2($value)
 * @method static Builder<static>|Position3Menge wherePosMengeAusschuss1($value)
 * @method static Builder<static>|Position3Menge wherePosMengeAusschuss2($value)
 * @method static Builder<static>|Position3Menge wherePosMengeLieferung1($value)
 * @method static Builder<static>|Position3Menge wherePosMengeLieferung2($value)
 * @method static Builder<static>|Position3Menge wherePosMengeOriginal1($value)
 * @method static Builder<static>|Position3Menge wherePosMengeOriginal2($value)
 * @method static Builder<static>|Position3Menge wherePosMengeRechnung1($value)
 * @method static Builder<static>|Position3Menge wherePosMengeRechnung2($value)
 * @method static Builder<static>|Position3Menge wherePosMengeVersand1($value)
 * @method static Builder<static>|Position3Menge wherePosMengeVersand2($value)
 * @method static Builder<static>|Position3Menge wherePosMultiplikator($value)
 * @method static Builder<static>|Position3Menge wherePosMultiplikatorAbrechnung($value)
 * @method static Builder<static>|Position3Menge wherePosMultiplikatorAuftrag($value)
 * @method static Builder<static>|Position3Menge wherePosMultiplikatorLieferung($value)
 * @method static Builder<static>|Position3Menge wherePosMultiplikatorRechnung($value)
 * @method static Builder<static>|Position3Menge wherePosMultiplikatorVersand($value)
 * @method static Builder<static>|Position3Menge wherePosTypMengeneinheit2($value)
 * @method static Builder<static>|Position3Menge whereTimeStamp($value)
 * @mixin Eloquent
 */
	class Position3Menge extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $InterneVorgangsnummer
 * @property int $InternePositionsnummer
 * @property int|null $PosLieferungAmWoche
 * @property int|null $PosLieferungAmJahr
 * @property string|null $PosLieferterminAm
 * @property string|null $PosLieferterminDispoAm
 * @property int|null $PosLieferungWunschWoche
 * @property int|null $PosLieferungWunschJahr
 * @property string|null $PosLieferterminWunsch
 * @property string|null $PosLieferterminDispoWunsch
 * @property string|null $PosLieferterminText
 * @property string|null $PosBestaetigungsnummer
 * @property string|null $PosBestaetigungAm
 * @property int $PosLiefertermineJN
 * @property string|null $PosVersandtermin
 * @property string|null $PosVersandTransportmittel
 * @property int $PosVerladenJN
 * @property string|null $PosFertigungstermin
 * @property string|null $PosFruehestensVerfuegbarAm
 * @property int|null $PosFruehestensVerfuegbarGrund
 * @property string|null $TimeStamp
 * @property int|null $PosMahnstufe
 * @property int|null $PosMahnstufeBestaetigung
 * @property int|null $PosMahnfolgetage
 * @property int|null $PosMahnfolgetageBestaetigung
 * @property string|null $PosLetzteMahnungAm
 * @property string|null $PosLetzteMahnungBestaetigungAm
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung whereInternePositionsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung whereInterneVorgangsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosBestaetigungAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosBestaetigungsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosFertigungstermin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosFruehestensVerfuegbarAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosFruehestensVerfuegbarGrund($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosLetzteMahnungAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosLetzteMahnungBestaetigungAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosLieferterminAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosLieferterminDispoAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosLieferterminDispoWunsch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosLieferterminText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosLieferterminWunsch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosLiefertermineJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosLieferungAmJahr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosLieferungAmWoche($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosLieferungWunschJahr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosLieferungWunschWoche($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosMahnfolgetage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosMahnfolgetageBestaetigung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosMahnstufe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosMahnstufeBestaetigung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosVerladenJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosVersandTransportmittel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosVersandtermin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung whereTimeStamp($value)
 * @mixin \Eloquent
 */
	class Position4Lieferung extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $InterneVorgangsnummer
 * @property int $InternePositionsnummer
 * @property float|null $PosAbmasse1
 * @property float|null $PosAbmasse2
 * @property float|null $PosAbmasse3
 * @property float|null $PosAbmasse4
 * @property float|null $PosIndividualD1
 * @property float|null $PosIndividualD2
 * @property float|null $PosIndividualD3
 * @property float|null $PosIndividualD4
 * @property float|null $PosIndividualD5
 * @property float|null $PosIndividualD6
 * @property float|null $PosIndividualD7
 * @property float|null $PosIndividualD8
 * @property float|null $PosIndividualD9
 * @property float|null $PosIndividualD10
 * @property string|null $PosIndividualC1
 * @property string|null $PosIndividualC2
 * @property string|null $PosIndividualC3
 * @property string|null $PosIndividualC4
 * @property string|null $PosIndividualC5
 * @property string|null $PosIndividualC6
 * @property string|null $PosIndividualC7
 * @property string|null $PosIndividualC8
 * @property string|null $PosIndividualC9
 * @property string|null $PosIndividualC10
 * @property string|null $PosIndividualT1
 * @property string|null $PosIndividualT2
 * @property string|null $PosIndividualT3
 * @property string|null $PosIndividualT4
 * @property string|null $PosIndividualT5
 * @property string|null $PosIndividualT6
 * @property int|null $PosIndividualCombo1
 * @property int|null $PosIndividualCombo2
 * @property int|null $PosIndividualCombo3
 * @property int|null $PosIndividualCombo4
 * @property int|null $PosIndividualCombo5
 * @property int|null $PosIndividualCombo6
 * @property int|null $PosIndividualCombo7
 * @property int|null $PosIndividualCombo8
 * @property string|null $TimeStamp
 * @method static Builder<static>|Position5Individual newModelQuery()
 * @method static Builder<static>|Position5Individual newQuery()
 * @method static Builder<static>|Position5Individual query()
 * @method static Builder<static>|Position5Individual whereInternePositionsnummer($value)
 * @method static Builder<static>|Position5Individual whereInterneVorgangsnummer($value)
 * @method static Builder<static>|Position5Individual wherePosAbmasse1($value)
 * @method static Builder<static>|Position5Individual wherePosAbmasse2($value)
 * @method static Builder<static>|Position5Individual wherePosAbmasse3($value)
 * @method static Builder<static>|Position5Individual wherePosAbmasse4($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualC1($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualC10($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualC2($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualC3($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualC4($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualC5($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualC6($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualC7($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualC8($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualC9($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualCombo1($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualCombo2($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualCombo3($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualCombo4($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualCombo5($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualCombo6($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualCombo7($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualCombo8($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualD1($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualD10($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualD2($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualD3($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualD4($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualD5($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualD6($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualD7($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualD8($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualD9($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualT1($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualT2($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualT3($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualT4($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualT5($value)
 * @method static Builder<static>|Position5Individual wherePosIndividualT6($value)
 * @method static Builder<static>|Position5Individual whereTimeStamp($value)
 * @mixin Eloquent
 */
	class Position5Individual extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $InterneVorgangsnummer
 * @property int $InternePositionsnummer
 * @property int|null $InterneStuecklistenummer
 * @property int|null $PosStuecklistennummer
 * @property int|null $PosStkVerkaufspreis
 * @property int|null $PosStkEinkaufspreis
 * @property int|null $PosStkBestellpreis
 * @property int $PosStkAufAusgabeJN
 * @property int $PosStkBesAusgabeJN
 * @property int|null $PosStkAuftragLagerbuchung
 * @property int|null $PosStkBestellLagerbuchung
 * @property int|null $PosStkFertLagerbuchung
 * @property int $PosStkKalkulationsstopJN
 * @property int $PosStkBestellbeistellungJN
 * @property int $PosStkKundenbeistellungJN
 * @property int $PosStkKundenbeistellabgangJN
 * @property int $PosStkPseudobaugruppeJN
 * @property string|null $PosBeistellLagerGruppe
 * @property int|null $PosBeistellLagerortnummer
 * @property int $PosStkManuellJN
 * @property int|null $PosStkDispotermin
 * @property int|null $PosStkDispodifferenz
 * @property string|null $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste whereInternePositionsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste whereInterneStuecklistenummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste whereInterneVorgangsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosBeistellLagerGruppe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosBeistellLagerortnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkAufAusgabeJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkAuftragLagerbuchung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkBesAusgabeJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkBestellLagerbuchung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkBestellbeistellungJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkBestellpreis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkDispodifferenz($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkDispotermin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkEinkaufspreis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkFertLagerbuchung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkKalkulationsstopJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkKundenbeistellabgangJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkKundenbeistellungJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkManuellJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkPseudobaugruppeJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkVerkaufspreis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStuecklistennummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste whereTimeStamp($value)
 * @mixin \Eloquent
 */
	class Position6Stueckliste extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $InterneVorgangsnummer
 * @property int $InternePositionsnummer
 * @property string|null $KZIntraStat
 * @property int|null $GftArtID
 * @property int|null $NRWerkstoff
 * @property string|null $PosZeichnungsformat
 * @property string|null $PosZeichnungsnummer
 * @property float|null $PosAbwicklung
 * @property string|null $PosNorm
 * @property int|null $ReklamationID
 * @property int $PosErsatzteilJN
 * @property string|null $PosFreigabeAm
 * @property int|null $PosFreigabeDurch
 * @property int $PosPraeferenzJNA
 * @property int $PosPraeferenzDynamischJN
 * @property float|null $PosPraeferenzWert
 * @property int $PosServiceJN
 * @property float|null $PosKostenMehrkopien
 * @property int|null $PosFreikopien
 * @property int|null $PosZaehlerstandAlt
 * @property int|null $PosZaehlerstandNeu
 * @property int|null $PosZaehlerstandVK
 * @property int $PosAusNachkalkulationJN
 * @property int $PosMTZFixiertJN
 * @property float|null $PosMTZ
 * @property float|null $PosWerkstoffPreisbasis
 * @property float|null $PosWerkstoffAnteil
 * @property string|null $TimeStamp
 * @property int $PosBuchungsfreigabeJN
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz whereGftArtID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz whereInternePositionsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz whereInterneVorgangsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz whereKZIntraStat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz whereNRWerkstoff($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosAbwicklung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosAusNachkalkulationJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosBuchungsfreigabeJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosErsatzteilJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosFreigabeAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosFreigabeDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosFreikopien($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosKostenMehrkopien($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosMTZ($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosMTZFixiertJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosNorm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosPraeferenzDynamischJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosPraeferenzJNA($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosPraeferenzWert($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosServiceJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosWerkstoffAnteil($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosWerkstoffPreisbasis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosZaehlerstandAlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosZaehlerstandNeu($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosZaehlerstandVK($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosZeichnungsformat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosZeichnungsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz whereReklamationID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz whereTimeStamp($value)
 * @mixin \Eloquent
 */
	class Position7Zusatz extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $PositionWertID
 * @property int $InterneVorgangsnummer
 * @property int $InternePositionsnummer
 * @property float|null $PosWPreisPositionGesamt
 * @property float|null $PosWPreisPositionAuftrag
 * @property float|null $PosWPreisPositionAbrechnung
 * @property float|null $PosWPreisPositionLieferung
 * @property float|null $PosWPreisPositionVersand
 * @property float|null $PosWPreisPositionGut
 * @property float|null $PosWPreisPositionRechnung
 * @property float|null $PosWGesamtpreisVorRabattGes
 * @property float|null $PosWGesamtpreisVorRabattAuf
 * @property float|null $PosWGesamtpreisVorRabattAbr
 * @property float|null $PosWGesamtpreisVorRabattLief
 * @property float|null $PosWGesamtpreisVorRabattVers
 * @property float|null $PosWGesamtpreisVorRabattGut
 * @property float|null $PosWGesamtpreisVorRabattRec
 * @property float|null $PosWGesamtpreisGesamt
 * @property float|null $PosWGesamtpreisAuftrag
 * @property float|null $PosWGesamtpreisAbrechnung
 * @property float|null $PosWGesamtpreisLieferung
 * @property float|null $PosWGesamtpreisVersand
 * @property float|null $PosWGesamtpreisGut
 * @property float|null $PosWGesamtpreisRechnung
 * @property float|null $PosWGesamtpreisEKGesamt
 * @property float|null $PosWGesamtpreisEKAuftrag
 * @property float|null $PosWGesamtpreisEKAbrechnung
 * @property float|null $PosWGesamtpreisEKLieferung
 * @property float|null $PosWGesamtpreisEKVersand
 * @property float|null $PosWGesamtpreisEKGut
 * @property float|null $PosWGesamtpreisEKRechnung
 * @property float|null $PosWGesamtpreisEKVTGesamt
 * @property float|null $PosWGesamtpreisEKVTAuftrag
 * @property float|null $PosWGesamtpreisEKVTAbrechnung
 * @property float|null $PosWGesamtpreisEKVTLieferung
 * @property float|null $PosWGesamtpreisEKVTVersand
 * @property float|null $PosWGesamtpreisEKVTGut
 * @property float|null $PosWGesamtpreisEKVTRechnung
 * @property float|null $PosWMengeGesamt1
 * @property float|null $PosWMengeGesamt2
 * @property float|null $PosWMengeAuftrag1
 * @property float|null $PosWMengeAuftrag2
 * @property float|null $PosWMengeAbrechnung1
 * @property float|null $PosWMengeAbrechnung2
 * @property float|null $PosWMengeLieferung1
 * @property float|null $PosWMengeLieferung2
 * @property float|null $PosWMengeVersand1
 * @property float|null $PosWMengeVersand2
 * @property float|null $PosWMengeGut1
 * @property float|null $PosWMengeGut2
 * @property float|null $PosWMengeRechnung1
 * @property float|null $PosWMengeRechnung2
 * @property float|null $PosWEinzelpreisMinusRabatt
 * @property string|null $TimeStamp
 * @method static Builder<static>|PositionWert newModelQuery()
 * @method static Builder<static>|PositionWert newQuery()
 * @method static Builder<static>|PositionWert query()
 * @method static Builder<static>|PositionWert whereInternePositionsnummer($value)
 * @method static Builder<static>|PositionWert whereInterneVorgangsnummer($value)
 * @method static Builder<static>|PositionWert wherePosWEinzelpreisMinusRabatt($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisAbrechnung($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisAuftrag($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisEKAbrechnung($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisEKAuftrag($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisEKGesamt($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisEKGut($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisEKLieferung($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisEKRechnung($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisEKVTAbrechnung($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisEKVTAuftrag($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisEKVTGesamt($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisEKVTGut($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisEKVTLieferung($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisEKVTRechnung($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisEKVTVersand($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisEKVersand($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisGesamt($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisGut($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisLieferung($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisRechnung($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisVersand($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisVorRabattAbr($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisVorRabattAuf($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisVorRabattGes($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisVorRabattGut($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisVorRabattLief($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisVorRabattRec($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisVorRabattVers($value)
 * @method static Builder<static>|PositionWert wherePosWMengeAbrechnung1($value)
 * @method static Builder<static>|PositionWert wherePosWMengeAbrechnung2($value)
 * @method static Builder<static>|PositionWert wherePosWMengeAuftrag1($value)
 * @method static Builder<static>|PositionWert wherePosWMengeAuftrag2($value)
 * @method static Builder<static>|PositionWert wherePosWMengeGesamt1($value)
 * @method static Builder<static>|PositionWert wherePosWMengeGesamt2($value)
 * @method static Builder<static>|PositionWert wherePosWMengeGut1($value)
 * @method static Builder<static>|PositionWert wherePosWMengeGut2($value)
 * @method static Builder<static>|PositionWert wherePosWMengeLieferung1($value)
 * @method static Builder<static>|PositionWert wherePosWMengeLieferung2($value)
 * @method static Builder<static>|PositionWert wherePosWMengeRechnung1($value)
 * @method static Builder<static>|PositionWert wherePosWMengeRechnung2($value)
 * @method static Builder<static>|PositionWert wherePosWMengeVersand1($value)
 * @method static Builder<static>|PositionWert wherePosWMengeVersand2($value)
 * @method static Builder<static>|PositionWert wherePosWPreisPositionAbrechnung($value)
 * @method static Builder<static>|PositionWert wherePosWPreisPositionAuftrag($value)
 * @method static Builder<static>|PositionWert wherePosWPreisPositionGesamt($value)
 * @method static Builder<static>|PositionWert wherePosWPreisPositionGut($value)
 * @method static Builder<static>|PositionWert wherePosWPreisPositionLieferung($value)
 * @method static Builder<static>|PositionWert wherePosWPreisPositionRechnung($value)
 * @method static Builder<static>|PositionWert wherePosWPreisPositionVersand($value)
 * @method static Builder<static>|PositionWert wherePositionWertID($value)
 * @method static Builder<static>|PositionWert whereTimeStamp($value)
 * @mixin Eloquent
 */
	class PositionWert extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $NRPreisbasis
 * @property float|null $Preisfaktor
 * @property string|null $TimeStamp
 * @method static Builder<static>|Preisbasis newModelQuery()
 * @method static Builder<static>|Preisbasis newQuery()
 * @method static Builder<static>|Preisbasis query()
 * @method static Builder<static>|Preisbasis whereNRPreisbasis($value)
 * @method static Builder<static>|Preisbasis wherePreisfaktor($value)
 * @method static Builder<static>|Preisbasis whereTimeStamp($value)
 * @mixin Eloquent
 */
	class Preisbasis extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $KZProduktgruppe
 * @property string|null $PgrBezeichnung
 * @property string|null $PgrNotiz
 * @property string|null $TimeStamp
 * @property int $PgrInaktivJN
 * @method static Builder<static>|Produktgruppe newModelQuery()
 * @method static Builder<static>|Produktgruppe newQuery()
 * @method static Builder<static>|Produktgruppe query()
 * @method static Builder<static>|Produktgruppe whereKZProduktgruppe($value)
 * @method static Builder<static>|Produktgruppe wherePgrBezeichnung($value)
 * @method static Builder<static>|Produktgruppe wherePgrInaktivJN($value)
 * @method static Builder<static>|Produktgruppe wherePgrNotiz($value)
 * @method static Builder<static>|Produktgruppe whereTimeStamp($value)
 * @mixin Eloquent
 */
	class Produktgruppe extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $TourID
 * @property string $TourDatum
 * @property int $TourDatumNo
 * @property string $TourName
 * @property string $LSNummer
 * @property int $InterneVorgangsnummer
 * @property int $VorNummer
 * @property string $VorGruppe
 * @property string|null $created
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereCreated($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereInterneVorgangsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereLSNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereTourDatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereTourDatumNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereTourID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereTourName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereVorGruppe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereVorNummer($value)
 * @property string|null $Ceos_Calendar_ID
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Rak_Mad_Material_Tour whereCeosCalendarID($value)
 * @mixin \Eloquent
 */
	class Rak_Mad_Material_Tour extends \Eloquent {}
}

namespace App\Models{
/**
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
 * @method static Builder<static>|Vorgang newModelQuery()
 * @method static Builder<static>|Vorgang newQuery()
 * @method static Builder<static>|Vorgang query()
 * @method static Builder<static>|Vorgang whereAbladestelleID($value)
 * @method static Builder<static>|Vorgang whereAdresseBankID($value)
 * @method static Builder<static>|Vorgang whereAnsprechpartnerID($value)
 * @method static Builder<static>|Vorgang whereBedingungLieferungOrtID($value)
 * @method static Builder<static>|Vorgang whereFrachtbriefBedingungLieferungOrtID($value)
 * @method static Builder<static>|Vorgang whereInterneVorgangsnummer($value)
 * @method static Builder<static>|Vorgang whereKZFrachtbriefLieferbedingung($value)
 * @method static Builder<static>|Vorgang whereKZLieferbedingung($value)
 * @method static Builder<static>|Vorgang whereKZSprache($value)
 * @method static Builder<static>|Vorgang whereKZVerpackung($value)
 * @method static Builder<static>|Vorgang whereKZVersandbedingung($value)
 * @method static Builder<static>|Vorgang whereKZWaehrung($value)
 * @method static Builder<static>|Vorgang whereKZZahlungsart($value)
 * @method static Builder<static>|Vorgang whereKZZahlungsbedingung($value)
 * @method static Builder<static>|Vorgang whereLagerGruppe($value)
 * @method static Builder<static>|Vorgang whereLagerortnummer($value)
 * @method static Builder<static>|Vorgang whereMwstTypID($value)
 * @method static Builder<static>|Vorgang whereNRKostentraeger($value)
 * @method static Builder<static>|Vorgang whereTimeStamp($value)
 * @method static Builder<static>|Vorgang whereVkzID($value)
 * @method static Builder<static>|Vorgang whereVorAngebotDurch($value)
 * @method static Builder<static>|Vorgang whereVorAnlageAm($value)
 * @method static Builder<static>|Vorgang whereVorAnlageDurch($value)
 * @method static Builder<static>|Vorgang whereVorAnsprechpartnerID($value)
 * @method static Builder<static>|Vorgang whereVorAnsprechpartnerText($value)
 * @method static Builder<static>|Vorgang whereVorAnzahlDezimalstellen($value)
 * @method static Builder<static>|Vorgang whereVorArbeitskarteDurch($value)
 * @method static Builder<static>|Vorgang whereVorArt($value)
 * @method static Builder<static>|Vorgang whereVorAuftraggeber($value)
 * @method static Builder<static>|Vorgang whereVorAuftragsbestaetigungDurch($value)
 * @method static Builder<static>|Vorgang whereVorBestaetigungsnummer($value)
 * @method static Builder<static>|Vorgang whereVorBetrefftextZeile1($value)
 * @method static Builder<static>|Vorgang whereVorBetrefftextZeile2($value)
 * @method static Builder<static>|Vorgang whereVorBezugsnummer($value)
 * @method static Builder<static>|Vorgang whereVorBruttoJN($value)
 * @method static Builder<static>|Vorgang whereVorDatumAngebot($value)
 * @method static Builder<static>|Vorgang whereVorDatumAngebotVerloren($value)
 * @method static Builder<static>|Vorgang whereVorDatumArbeitskarte($value)
 * @method static Builder<static>|Vorgang whereVorDatumAuftragsbestaetigung($value)
 * @method static Builder<static>|Vorgang whereVorDatumAuftragseingang($value)
 * @method static Builder<static>|Vorgang whereVorDatumGutschrift($value)
 * @method static Builder<static>|Vorgang whereVorDatumKulanzLieferschein($value)
 * @method static Builder<static>|Vorgang whereVorDatumLieferschein($value)
 * @method static Builder<static>|Vorgang whereVorDatumProformarechnung($value)
 * @method static Builder<static>|Vorgang whereVorDatumRechnung($value)
 * @method static Builder<static>|Vorgang whereVorDatumRuecklieferung($value)
 * @method static Builder<static>|Vorgang whereVorDatumStorno($value)
 * @method static Builder<static>|Vorgang whereVorDokumentID($value)
 * @method static Builder<static>|Vorgang whereVorDokumentName($value)
 * @method static Builder<static>|Vorgang whereVorEinzelnePreiseJN($value)
 * @method static Builder<static>|Vorgang whereVorFilialExportJN($value)
 * @method static Builder<static>|Vorgang whereVorFreigabeAm($value)
 * @method static Builder<static>|Vorgang whereVorFreigabeDurch($value)
 * @method static Builder<static>|Vorgang whereVorFruehestensVerfuegbarAm($value)
 * @method static Builder<static>|Vorgang whereVorFruehestensVerfuegbarGrund($value)
 * @method static Builder<static>|Vorgang whereVorGelangensbestaetigungAm($value)
 * @method static Builder<static>|Vorgang whereVorGelangensbestaetigungDurch($value)
 * @method static Builder<static>|Vorgang whereVorGelangesbErhaltenAm($value)
 * @method static Builder<static>|Vorgang whereVorGeneriertJN($value)
 * @method static Builder<static>|Vorgang whereVorGesperrtAm($value)
 * @method static Builder<static>|Vorgang whereVorGesperrtDurch($value)
 * @method static Builder<static>|Vorgang whereVorGesperrtJN($value)
 * @method static Builder<static>|Vorgang whereVorGruppe($value)
 * @method static Builder<static>|Vorgang whereVorGruppeImport($value)
 * @method static Builder<static>|Vorgang whereVorGutschriftNummer($value)
 * @method static Builder<static>|Vorgang whereVorHauptauftrag($value)
 * @method static Builder<static>|Vorgang whereVorIhrAuftrag($value)
 * @method static Builder<static>|Vorgang whereVorIhrAuftragVom($value)
 * @method static Builder<static>|Vorgang whereVorIhrZeichen($value)
 * @method static Builder<static>|Vorgang whereVorImportAbrufnummer($value)
 * @method static Builder<static>|Vorgang whereVorImportArtikelbezugsnummer($value)
 * @method static Builder<static>|Vorgang whereVorImportFortschrittszahl($value)
 * @method static Builder<static>|Vorgang whereVorImportLagerort($value)
 * @method static Builder<static>|Vorgang whereVorImportTeilTyp($value)
 * @method static Builder<static>|Vorgang whereVorImportVerbrauchsstelle($value)
 * @method static Builder<static>|Vorgang whereVorImportVerwendungszweck($value)
 * @method static Builder<static>|Vorgang whereVorIndividualC1($value)
 * @method static Builder<static>|Vorgang whereVorIndividualC2($value)
 * @method static Builder<static>|Vorgang whereVorIndividualC3($value)
 * @method static Builder<static>|Vorgang whereVorIndividualC4($value)
 * @method static Builder<static>|Vorgang whereVorIndividualC5($value)
 * @method static Builder<static>|Vorgang whereVorIndividualC6($value)
 * @method static Builder<static>|Vorgang whereVorIndividualC7($value)
 * @method static Builder<static>|Vorgang whereVorIndividualCombo1($value)
 * @method static Builder<static>|Vorgang whereVorIndividualCombo2($value)
 * @method static Builder<static>|Vorgang whereVorIndividualCombo3($value)
 * @method static Builder<static>|Vorgang whereVorIndividualCombo4($value)
 * @method static Builder<static>|Vorgang whereVorIndividualD1($value)
 * @method static Builder<static>|Vorgang whereVorIndividualD2($value)
 * @method static Builder<static>|Vorgang whereVorIndividualD3($value)
 * @method static Builder<static>|Vorgang whereVorIndividualD4($value)
 * @method static Builder<static>|Vorgang whereVorIndividualD5($value)
 * @method static Builder<static>|Vorgang whereVorIndividualD6($value)
 * @method static Builder<static>|Vorgang whereVorIndividualD7($value)
 * @method static Builder<static>|Vorgang whereVorIndividualT1($value)
 * @method static Builder<static>|Vorgang whereVorIndividualT2($value)
 * @method static Builder<static>|Vorgang whereVorIndividualT3($value)
 * @method static Builder<static>|Vorgang whereVorIndividualT4($value)
 * @method static Builder<static>|Vorgang whereVorKulanzDurch($value)
 * @method static Builder<static>|Vorgang whereVorLagerbuchungJN($value)
 * @method static Builder<static>|Vorgang whereVorLagerumbuchungJN($value)
 * @method static Builder<static>|Vorgang whereVorLetzteAenderungAm($value)
 * @method static Builder<static>|Vorgang whereVorLetzteAenderungDurch($value)
 * @method static Builder<static>|Vorgang whereVorLetzterStatus($value)
 * @method static Builder<static>|Vorgang whereVorLetzterWareneingangAm($value)
 * @method static Builder<static>|Vorgang whereVorLetzterWareneingangDurch($value)
 * @method static Builder<static>|Vorgang whereVorLetzterZahlungseingangAm($value)
 * @method static Builder<static>|Vorgang whereVorLetzterZahlungseingangDurch($value)
 * @method static Builder<static>|Vorgang whereVorLieferadresse($value)
 * @method static Builder<static>|Vorgang whereVorLieferanschrift($value)
 * @method static Builder<static>|Vorgang whereVorLieferanschriftAnsprechpartnerID($value)
 * @method static Builder<static>|Vorgang whereVorLieferantLieferschein($value)
 * @method static Builder<static>|Vorgang whereVorLieferantRechnung($value)
 * @method static Builder<static>|Vorgang whereVorLieferscheinDurch($value)
 * @method static Builder<static>|Vorgang whereVorLieferscheinNummer($value)
 * @method static Builder<static>|Vorgang whereVorLieferterminText($value)
 * @method static Builder<static>|Vorgang whereVorLieferungAmDatum($value)
 * @method static Builder<static>|Vorgang whereVorLieferungAmJahr($value)
 * @method static Builder<static>|Vorgang whereVorLieferungAmTag($value)
 * @method static Builder<static>|Vorgang whereVorLieferungAmWoche($value)
 * @method static Builder<static>|Vorgang whereVorLieferungTrennenJN($value)
 * @method static Builder<static>|Vorgang whereVorLieferungWunschDatum($value)
 * @method static Builder<static>|Vorgang whereVorLieferungWunschJahr($value)
 * @method static Builder<static>|Vorgang whereVorLieferungWunschWoche($value)
 * @method static Builder<static>|Vorgang whereVorLockingAm($value)
 * @method static Builder<static>|Vorgang whereVorLockingDurch($value)
 * @method static Builder<static>|Vorgang whereVorMwstTyp($value)
 * @method static Builder<static>|Vorgang whereVorNummer($value)
 * @method static Builder<static>|Vorgang whereVorNummerImport($value)
 * @method static Builder<static>|Vorgang whereVorParallelkurs($value)
 * @method static Builder<static>|Vorgang whereVorPosAenderungAm($value)
 * @method static Builder<static>|Vorgang whereVorPosAenderungDurch($value)
 * @method static Builder<static>|Vorgang whereVorPreisbasisadresse($value)
 * @method static Builder<static>|Vorgang whereVorProformarechnungsNummer($value)
 * @method static Builder<static>|Vorgang whereVorRMANummer($value)
 * @method static Builder<static>|Vorgang whereVorRechnungDurch($value)
 * @method static Builder<static>|Vorgang whereVorRechnungsNummer($value)
 * @method static Builder<static>|Vorgang whereVorRechnungsadresse($value)
 * @method static Builder<static>|Vorgang whereVorRechnungsanschrift($value)
 * @method static Builder<static>|Vorgang whereVorRechnungsanschriftAnsprechpartnerID($value)
 * @method static Builder<static>|Vorgang whereVorRuecklieferanschrift($value)
 * @method static Builder<static>|Vorgang whereVorRuecklieferscheinNummer($value)
 * @method static Builder<static>|Vorgang whereVorRuecklieferungDurch($value)
 * @method static Builder<static>|Vorgang whereVorSachbearbeiter($value)
 * @method static Builder<static>|Vorgang whereVorSammelRechnungsanschrift($value)
 * @method static Builder<static>|Vorgang whereVorSammellieferscheinNummer($value)
 * @method static Builder<static>|Vorgang whereVorSammelrechnungsNummer($value)
 * @method static Builder<static>|Vorgang whereVorSpeditionsanschrift($value)
 * @method static Builder<static>|Vorgang whereVorSperrungArt($value)
 * @method static Builder<static>|Vorgang whereVorStatus($value)
 * @method static Builder<static>|Vorgang whereVorStichwort($value)
 * @method static Builder<static>|Vorgang whereVorStornoDurch($value)
 * @method static Builder<static>|Vorgang whereVorTeillieferungsNummer($value)
 * @method static Builder<static>|Vorgang whereVorTeillieferungsNummerImport($value)
 * @method static Builder<static>|Vorgang whereVorUebertragenAm($value)
 * @method static Builder<static>|Vorgang whereVorUebertragenJN($value)
 * @method static Builder<static>|Vorgang whereVorUnserZeichen($value)
 * @method static Builder<static>|Vorgang whereVorUnterArt($value)
 * @method static Builder<static>|Vorgang whereVorUnterschrift1($value)
 * @method static Builder<static>|Vorgang whereVorUnterschrift2($value)
 * @method static Builder<static>|Vorgang whereVorVerantwortlicher($value)
 * @method static Builder<static>|Vorgang whereVorVersandEMailJN($value)
 * @method static Builder<static>|Vorgang whereVorVertreterEingelesenJN($value)
 * @method static Builder<static>|Vorgang whereVorVorkasseAufforderungAm($value)
 * @method static Builder<static>|Vorgang whereVorVorkasseAufforderungDurch($value)
 * @method static Builder<static>|Vorgang whereVorWHTfaehigJN($value)
 * @method static Builder<static>|Vorgang whereVorWaehrungskurs($value)
 * @method static Builder<static>|Vorgang whereVorWaehrungskursFixiertJN($value)
 * @method static Builder<static>|Vorgang whereVorWechselkurs($value)
 * @method static Builder<static>|Vorgang whereVorlageWinwordID($value)
 * @method static Builder<static>|Vorgang whereWerkID($value)
 * @mixin Eloquent
 */
	class Vorgang extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $InterneVorgangsnummer
 * @property float|null $VorRabattProzent
 * @property float|null $VorZusRabattProzent
 * @property float|null $VorAdrRabattProzent
 * @property float|null $VorNettowert
 * @property float|null $VorNettowertMwst1
 * @property float|null $VorNettowertMwst2
 * @property float|null $VorNettowertMwst3
 * @property int|null $VorMwstSatz1
 * @property int|null $VorMwstSatz2
 * @property int|null $VorMwstSatz3
 * @property float|null $VorMwstSatzProzent1
 * @property float|null $VorMwstSatzProzent2
 * @property float|null $VorMwstSatzProzent3
 * @property float|null $VorNettoMinusRabatt
 * @property float|null $VorNettoPlusZusatzkosten
 * @property float|null $VorNettoAKonto
 * @property float|null $VorMwstAKonto
 * @property float|null $VorNettoMinusAKonto
 * @property float|null $VorBruttowert
 * @property float|null $VorBruttowertBezahlt
 * @property float|null $VorBruttowertZusatzkonto
 * @property float|null $VorBruttowertSkonto
 * @property float|null $VorNettoEinkauf
 * @property float|null $VorNettoEinkaufVT
 * @property float|null $VorNettoEinkaufAKonto
 * @property float|null $VorNettoEinkaufAKontoVT
 * @property float|null $VorNettoEinkaufOhneNachkalk
 * @property float|null $VorNettoEinkaufOhneNachkalkVT
 * @property float|null $VorNettoEinkaufNachkalk
 * @property float|null $VorNettoEinkaufNachkalkVT
 * @property float|null $VorWertZusatzkosten1
 * @property float|null $VorWertZusatzkosten2
 * @property float|null $VorWertZusatzkosten3
 * @property float|null $VorWertZusatzkosten4
 * @property float|null $VorWertZusatzkosten5
 * @property string|null $VorTextZusatzkosten4
 * @property string|null $VorTextZusatzkosten5
 * @property int|null $VorMwstSatzZusatzkosten1
 * @property int|null $VorMwstSatzZusatzkosten2
 * @property int|null $VorMwstSatzZusatzkosten3
 * @property int|null $VorMwstSatzZusatzkosten4
 * @property int|null $VorMwstSatzZusatzkosten5
 * @property float|null $VorMwstSatzProzentZusatzkosten1
 * @property float|null $VorMwstSatzProzentZusatzkosten2
 * @property float|null $VorMwstSatzProzentZusatzkosten3
 * @property float|null $VorMwstSatzProzentZusatzkosten4
 * @property float|null $VorMwstSatzProzentZusatzkosten5
 * @property int|null $VorKontoGruppeZusatzkosten1
 * @property int|null $VorKontoGruppeZusatzkosten2
 * @property int|null $VorKontoGruppeZusatzkosten3
 * @property int|null $VorKontoGruppeZusatzkosten4
 * @property int|null $VorKontoGruppeZusatzkosten5
 * @property float|null $VorBruttowertOriginal
 * @property string|null $VorTextMwstOriginal1
 * @property string|null $VorTextMwstOriginal2
 * @property string|null $VorTextMwstOriginal3
 * @property string|null $VorTextMwstOriginal4
 * @property float|null $VorMwstwertOriginal1
 * @property float|null $VorMwstwertOriginal2
 * @property float|null $VorMwstwertOriginal3
 * @property float|null $VorMwstwertOriginal4
 * @property string|null $TimeStamp
 * @property float|null $VorWHTWert1
 * @property float|null $VorWHTWert2
 * @property float|null $VorWHTWert3
 * @property float|null $VorWHTProzent1
 * @property float|null $VorWHTProzent2
 * @property float|null $VorWHTProzent3
 * @property int|null $VorWHTKat1
 * @property int|null $VorWHTKat2
 * @property int|null $VorWHTKat3
 * @property float $VorNettowertRabattfaehig
 * @property float|null $VorRabattfaehigMwst1
 * @property float|null $VorRabattfaehigMwst2
 * @property float|null $VorRabattfaehigMwst3
 * @property float|null $VorGesamtrabatt
 * @property int $VorPosRabattfaehigJN
 * @property int $VorRabattKumulativJN
 * @property float|null $VorPositionswertBrutto
 * @property float|null $VorRabattWert
 * @property float|null $VorSkontofaehigMwst1
 * @property float|null $VorSkontofaehigMwst2
 * @property float|null $VorSkontofaehigMwst3
 * @property float|null $VorSkontofaehigBrutto
 * @property int $VorSkontofaehigZusatzkosten1JN
 * @property int $VorSkontofaehigZusatzkosten2JN
 * @property int $VorSkontofaehigZusatzkosten3JN
 * @property int $VorSkontofaehigZusatzkosten4JN
 * @property int $VorSkontofaehigZusatzkosten5JN
 * @method static Builder<static>|Vorgang1Wert newModelQuery()
 * @method static Builder<static>|Vorgang1Wert newQuery()
 * @method static Builder<static>|Vorgang1Wert query()
 * @method static Builder<static>|Vorgang1Wert whereInterneVorgangsnummer($value)
 * @method static Builder<static>|Vorgang1Wert whereTimeStamp($value)
 * @method static Builder<static>|Vorgang1Wert whereVorAdrRabattProzent($value)
 * @method static Builder<static>|Vorgang1Wert whereVorBruttowert($value)
 * @method static Builder<static>|Vorgang1Wert whereVorBruttowertBezahlt($value)
 * @method static Builder<static>|Vorgang1Wert whereVorBruttowertOriginal($value)
 * @method static Builder<static>|Vorgang1Wert whereVorBruttowertSkonto($value)
 * @method static Builder<static>|Vorgang1Wert whereVorBruttowertZusatzkonto($value)
 * @method static Builder<static>|Vorgang1Wert whereVorGesamtrabatt($value)
 * @method static Builder<static>|Vorgang1Wert whereVorKontoGruppeZusatzkosten1($value)
 * @method static Builder<static>|Vorgang1Wert whereVorKontoGruppeZusatzkosten2($value)
 * @method static Builder<static>|Vorgang1Wert whereVorKontoGruppeZusatzkosten3($value)
 * @method static Builder<static>|Vorgang1Wert whereVorKontoGruppeZusatzkosten4($value)
 * @method static Builder<static>|Vorgang1Wert whereVorKontoGruppeZusatzkosten5($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstAKonto($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatz1($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatz2($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatz3($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatzProzent1($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatzProzent2($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatzProzent3($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatzProzentZusatzkosten1($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatzProzentZusatzkosten2($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatzProzentZusatzkosten3($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatzProzentZusatzkosten4($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatzProzentZusatzkosten5($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatzZusatzkosten1($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatzZusatzkosten2($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatzZusatzkosten3($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatzZusatzkosten4($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatzZusatzkosten5($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstwertOriginal1($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstwertOriginal2($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstwertOriginal3($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstwertOriginal4($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettoAKonto($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettoEinkauf($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettoEinkaufAKonto($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettoEinkaufAKontoVT($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettoEinkaufNachkalk($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettoEinkaufNachkalkVT($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettoEinkaufOhneNachkalk($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettoEinkaufOhneNachkalkVT($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettoEinkaufVT($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettoMinusAKonto($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettoMinusRabatt($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettoPlusZusatzkosten($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettowert($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettowertMwst1($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettowertMwst2($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettowertMwst3($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettowertRabattfaehig($value)
 * @method static Builder<static>|Vorgang1Wert whereVorPosRabattfaehigJN($value)
 * @method static Builder<static>|Vorgang1Wert whereVorPositionswertBrutto($value)
 * @method static Builder<static>|Vorgang1Wert whereVorRabattKumulativJN($value)
 * @method static Builder<static>|Vorgang1Wert whereVorRabattProzent($value)
 * @method static Builder<static>|Vorgang1Wert whereVorRabattWert($value)
 * @method static Builder<static>|Vorgang1Wert whereVorRabattfaehigMwst1($value)
 * @method static Builder<static>|Vorgang1Wert whereVorRabattfaehigMwst2($value)
 * @method static Builder<static>|Vorgang1Wert whereVorRabattfaehigMwst3($value)
 * @method static Builder<static>|Vorgang1Wert whereVorSkontofaehigBrutto($value)
 * @method static Builder<static>|Vorgang1Wert whereVorSkontofaehigMwst1($value)
 * @method static Builder<static>|Vorgang1Wert whereVorSkontofaehigMwst2($value)
 * @method static Builder<static>|Vorgang1Wert whereVorSkontofaehigMwst3($value)
 * @method static Builder<static>|Vorgang1Wert whereVorSkontofaehigZusatzkosten1JN($value)
 * @method static Builder<static>|Vorgang1Wert whereVorSkontofaehigZusatzkosten2JN($value)
 * @method static Builder<static>|Vorgang1Wert whereVorSkontofaehigZusatzkosten3JN($value)
 * @method static Builder<static>|Vorgang1Wert whereVorSkontofaehigZusatzkosten4JN($value)
 * @method static Builder<static>|Vorgang1Wert whereVorSkontofaehigZusatzkosten5JN($value)
 * @method static Builder<static>|Vorgang1Wert whereVorTextMwstOriginal1($value)
 * @method static Builder<static>|Vorgang1Wert whereVorTextMwstOriginal2($value)
 * @method static Builder<static>|Vorgang1Wert whereVorTextMwstOriginal3($value)
 * @method static Builder<static>|Vorgang1Wert whereVorTextMwstOriginal4($value)
 * @method static Builder<static>|Vorgang1Wert whereVorTextZusatzkosten4($value)
 * @method static Builder<static>|Vorgang1Wert whereVorTextZusatzkosten5($value)
 * @method static Builder<static>|Vorgang1Wert whereVorWHTKat1($value)
 * @method static Builder<static>|Vorgang1Wert whereVorWHTKat2($value)
 * @method static Builder<static>|Vorgang1Wert whereVorWHTKat3($value)
 * @method static Builder<static>|Vorgang1Wert whereVorWHTProzent1($value)
 * @method static Builder<static>|Vorgang1Wert whereVorWHTProzent2($value)
 * @method static Builder<static>|Vorgang1Wert whereVorWHTProzent3($value)
 * @method static Builder<static>|Vorgang1Wert whereVorWHTWert1($value)
 * @method static Builder<static>|Vorgang1Wert whereVorWHTWert2($value)
 * @method static Builder<static>|Vorgang1Wert whereVorWHTWert3($value)
 * @method static Builder<static>|Vorgang1Wert whereVorWertZusatzkosten1($value)
 * @method static Builder<static>|Vorgang1Wert whereVorWertZusatzkosten2($value)
 * @method static Builder<static>|Vorgang1Wert whereVorWertZusatzkosten3($value)
 * @method static Builder<static>|Vorgang1Wert whereVorWertZusatzkosten4($value)
 * @method static Builder<static>|Vorgang1Wert whereVorWertZusatzkosten5($value)
 * @method static Builder<static>|Vorgang1Wert whereVorZusRabattProzent($value)
 * @mixin Eloquent
 */
	class Vorgang1Wert extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $InterneVorgangsnummer
 * @property string|null $VorEinleitungstext
 * @property int|null $VorEinleitungstextForm
 * @property string|null $VorSchlusstext
 * @property int|null $VorSchlusstextForm
 * @property string|null $VorFusstext
 * @property int|null $VorFusstextForm
 * @property string|null $VorNotiz
 * @property int|null $VorNotizForm
 * @property string|null $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang2Text newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang2Text newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang2Text query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang2Text whereInterneVorgangsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang2Text whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang2Text whereVorEinleitungstext($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang2Text whereVorEinleitungstextForm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang2Text whereVorFusstext($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang2Text whereVorFusstextForm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang2Text whereVorNotiz($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang2Text whereVorNotizForm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang2Text whereVorSchlusstext($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang2Text whereVorSchlusstextForm($value)
 * @mixin \Eloquent
 */
	class Vorgang2Text extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $InterneVorgangsnummer
 * @property string|null $VorMahnungAb
 * @property string|null $KZMahnkennzeichen
 * @property string|null $VorLetzteMahnungAm
 * @property int|null $VorLetzteMahnungDurch
 * @property int|null $VorZieltage
 * @property int|null $VorSkontotage1
 * @property float|null $VorSkontosatz1
 * @property int|null $VorSkontotage2
 * @property float|null $VorSkontosatz2
 * @property int|null $VorSkontotage3
 * @property float|null $VorSkontosatz3
 * @property int|null $VorKarenztage
 * @property int $VorSonderkonditionenJN
 * @property int $VorBonusAbrechnungJN
 * @property int $VorZbdVariabelJN
 * @property int|null $VorBerechnungstagVon1
 * @property int|null $VorBerechnungstagBis1
 * @property int|null $VorFaelligkeitstag1
 * @property int|null $VorFolgemonat1
 * @property int|null $VorBerechnungstagVon2
 * @property int|null $VorBerechnungstagBis2
 * @property int|null $VorFaelligkeitstag2
 * @property int|null $VorFolgemonat2
 * @property string|null $TimeStamp
 * @property int|null $VorMahnstufe
 * @property int|null $VorMahnFolgetage
 * @property int|null $VorMahnStufeBestaetig
 * @property int|null $VorMahnFolgetageBestaetig
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereInterneVorgangsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereKZMahnkennzeichen($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorBerechnungstagBis1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorBerechnungstagBis2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorBerechnungstagVon1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorBerechnungstagVon2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorBonusAbrechnungJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorFaelligkeitstag1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorFaelligkeitstag2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorFolgemonat1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorFolgemonat2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorKarenztage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorLetzteMahnungAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorLetzteMahnungDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorMahnFolgetage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorMahnFolgetageBestaetig($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorMahnStufeBestaetig($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorMahnstufe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorMahnungAb($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorSkontosatz1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorSkontosatz2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorSkontosatz3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorSkontotage1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorSkontotage2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorSkontotage3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorSonderkonditionenJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorZbdVariabelJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorZieltage($value)
 * @mixin \Eloquent
 */
	class Vorgang3Zahlung extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $InterneVorgangsnummer
 * @property int|null $VorFrachtRechnungsanschrift
 * @property string|null $VorFrachtText
 * @property float|null $VorFrachtSendungWert
 * @property string|null $VorVersandtermin
 * @property string|null $VorVersandTransportmittel
 * @property int|null $VorVersandPaketanzahl
 * @property int $VorTransportversicherungJN
 * @property float|null $VorGesamtGewicht
 * @property float|null $VorLieferGewicht
 * @property string|null $KZVorLiefGewichteinheit
 * @property int|null $VersandFormID
 * @property int|null $VersandVerpackungID
 * @property float|null $VorVersandGrundkosten
 * @property float|null $VorVersandZusatzkosten
 * @property int $VorVersandPrivatZustJN
 * @property float|null $VorVersandWarenwert
 * @property float|null $VorVersandWarenwertIntern
 * @property string|null $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereInterneVorgangsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereKZVorLiefGewichteinheit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVersandFormID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVersandVerpackungID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVorFrachtRechnungsanschrift($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVorFrachtSendungWert($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVorFrachtText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVorGesamtGewicht($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVorLieferGewicht($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVorTransportversicherungJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVorVersandGrundkosten($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVorVersandPaketanzahl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVorVersandPrivatZustJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVorVersandTransportmittel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVorVersandWarenwert($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVorVersandWarenwertIntern($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVorVersandZusatzkosten($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVorVersandtermin($value)
 * @mixin \Eloquent
 */
	class Vorgang4Versand extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $InterneVorgangsnummer
 * @property int|null $VorAbschlussWoche
 * @property int|null $VorAbschlussJahr
 * @property float|null $VorAbschlussChance
 * @property string|null $VorAbschlussOutlookStoreID
 * @property string|null $VorAbschlussOutlookEntryID
 * @property int $VorAbschlussOutlookIsTask
 * @property int $VorAngebotVerfolgenJN
 * @property string|null $VorAngebotVerlorenNotiz
 * @property string|null $VorAngebotGueltigBis
 * @property string|null $VorWiedervorlageDatumIntern
 * @property string|null $VorWiedervorlageDatum
 * @property int|null $VorWiedervorlageWoche
 * @property int|null $VorWiedervorlageJahr
 * @property string|null $VorWiederVorlageOutlookStoreID
 * @property string|null $VorWiederVorlageOutlookEntryID
 * @property int $VorWiederVorlageOutlookIsTask
 * @property string|null $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereInterneVorgangsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorAbschlussChance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorAbschlussJahr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorAbschlussOutlookEntryID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorAbschlussOutlookIsTask($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorAbschlussOutlookStoreID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorAbschlussWoche($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorAngebotGueltigBis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorAngebotVerfolgenJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorAngebotVerlorenNotiz($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorWiederVorlageOutlookEntryID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorWiederVorlageOutlookIsTask($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorWiederVorlageOutlookStoreID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorWiedervorlageDatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorWiedervorlageDatumIntern($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorWiedervorlageJahr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorWiedervorlageWoche($value)
 * @mixin Eloquent
 */
	class Vorgang5Angebot extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $InterneVorgangsnummer
 * @property string|null $VorAbgeschlossenAb
 * @property string|null $VorUnterschriebenAm
 * @property string|null $VorGekuendigtZum
 * @property int|null $VorWiederholMonat
 * @property int|null $VorWiederholKennzeichen
 * @property int $VorDruckKennzeichen
 * @property string|null $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang6Wiederhol newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang6Wiederhol newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang6Wiederhol query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang6Wiederhol whereInterneVorgangsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang6Wiederhol whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang6Wiederhol whereVorAbgeschlossenAb($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang6Wiederhol whereVorDruckKennzeichen($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang6Wiederhol whereVorGekuendigtZum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang6Wiederhol whereVorUnterschriebenAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang6Wiederhol whereVorWiederholKennzeichen($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang6Wiederhol whereVorWiederholMonat($value)
 * @mixin \Eloquent
 */
	class Vorgang6Wiederhol extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $InterneVorgangsnummer
 * @property int|null $InterneRechnungsnummer
 * @property string|null $LiegenschaftStrasse2
 * @property string|null $LiegenschaftOrt2
 * @property int|null $UnterStrassenVorhanden
 * @property string|null $FirmenBezeichnung1Versand
 * @property string|null $FirmenBezeichnung2Versand
 * @property string|null $StrasseVersand
 * @property string|null $PLZVersand
 * @property string|null $StadtVersand
 * @property string|null $Ablesebezirk
 * @property string|null $Sachbearbeiter
 * @property string|null $RaumNrAblage
 * @property string|null $HausmeisterName
 * @property string|null $HausmeisterStrasse
 * @property string|null $HausmeisterPLZ
 * @property string|null $HausmeisterOrt
 * @property string|null $HausmeisterFestnetz
 * @property string|null $HausmeisterMobil
 * @property string|null $HausmeisterFax
 * @property string|null $HausmeisterEmail
 * @property string|null $AnsprechpartnerName
 * @property string|null $AnsprechPartnerFestnetz
 * @property string|null $AnsprechPartnerMobil
 * @property string|null $AnsprechPartnerFax
 * @property string|null $AnsprechPartnerEmail
 * @property string|null $AnsprechPartnerInfo
 * @property string|null $DatumAblesebelegGedrucktAutomatisch
 * @property string|null $DatumKostenbelegNutzerlisteAutomatisch
 * @property string|null $DatumEingangAblesebelegManuell
 * @property string|null $DatumEingangKostenbelegNutzerlisteManuell
 * @property string|null $DatumAbrechnungserstellungAutomatisch
 * @property string|null $UnterStrassen
 * @property string|null $Strasse2Versand
 * @property string|null $Stadt2Versand
 * @property string|null $FirmenBezeichnung1Rechnung
 * @property string|null $FirmenBezeichnung2Rechnung
 * @property string|null $StrasseRechnung
 * @property string|null $Strasse2Rechnung
 * @property string|null $PLZRechnung
 * @property string|null $StadtRechnung
 * @property string|null $Stadt2Rechnung
 * @property string|null $EigentuemerName
 * @property string|null $EigentuemerStrasse
 * @property string|null $EigentuemerPLZ
 * @property string|null $EigentuemerOrt
 * @property string|null $EigentuemerFestnetz
 * @property string|null $EigentuemerMobil
 * @property string|null $EigentuemerFax
 * @property string|null $EigentuemerEmail
 * @property string|null $Ablesemonat
 * @property int|null $SelbstAbleser
 * @property string|null $HausmeisterAnrede
 * @property string|null $EigentuemerAnrede
 * @property string|null $AnsprechpartnerAnrede
 * @property string|null $DatumAbrechnungserstellungAutomatischErste
 * @property int|null $VorgangVorgaenger
 * @property int|null $VorgangNachfolger
 * @property float|null $VBWMZVJ
 * @property float|null $VBHKVVJ
 * @property float|null $VBWWZVJ
 * @property float|null $VBKWZVJ
 * @property string|null $Preisliste
 * @property string|null $LSStatus
 * @property int|null $AnzNE
 * @property string|null $HKVTyp
 * @property int|null $AnzHKV
 * @property int|null $AnzWMZ
 * @property int|null $AnzWWZ
 * @property int|null $AnzKWZ
 * @property int|null $AnzWWKV
 * @property int|null $AnzSZ
 * @property string|null $HK_BWNorm
 * @property string|null $HK_Skalierung
 * @property int|null $aKontoRechnung
 * @property int|null $AbrechnerID
 * @property int|null $AbrechnerIDLA
 * @property int|null $AbrechnerIDLA_VJ
 * @property int|null $AbrechnerIDEAnl
 * @property string|null $DatumAnlageErstellung
 * @property string|null $DatumLetzteAenderung
 * @property string|null $DatumUebertrag
 * @property int|null $AbrechnerIDUebertrag
 * @property string|null $FarbeAktendeckel
 * @property string|null $BaujahrObjekt
 * @property string|null $BaujahrHeizung
 * @property int|null $Isolierverglasung
 * @property int|null $DachIsoliert
 * @property int|null $FassadeIsoliert
 * @property int|null $Niedrigtemperaturheizung
 * @property int|null $Niedrigenergiehaus
 * @property string|null $DatumletzteSanierung
 * @property string|null $Gebäudeart
 * @property string|null $Ampullenfarben
 * @property string|null $DatumEingangAbrechnungsvertrag
 * @property string|null $SachbearbeiterLetzteBearbeitung
 * @property int|null $AbrechnerIDLV
 * @property string|null $AblesungVon
 * @property string|null $AblesungBis
 * @property int|null $StatusAuskunft
 * @property string|null $DatumAusgangAblesebelegManuell
 * @property int|null $GeraeteStatus
 * @property string|null $DatumLegionellenpruefung
 * @property string|null $ArtikelnummerSkala
 * @property int|null $Skalennummer
 * @property string|null $SkalenBezeichnung
 * @property string|null $SkalaHersteller
 * @property string|null $SkalaKurzbezeichnung
 * @property string|null $HKVTypVisualThermSkala
 * @property int|null $MaximalwertSkala
 * @property string|null $FormelKVBerechnungSkala
 * @property int|null $LaufzeitSkala
 * @property string|null $AnzahlFuehlerSkala
 * @property string|null $MontagehoeheSkala
 * @property float|null $BasisempfindlichkeitSkala
 * @property float|null $SKFaktorSkala
 * @property int|null $EigenschaftenGeraetSkala
 * @property int|null $CheckzahlArtSkala
 * @property string|null $TextSkala
 * @property int|null $LiegenschaftBits
 * @property string|null $AblesungVon_LJ
 * @property string|null $AblesungBis_LJ
 * @property string|null $VorAblesung
 * @property string|null $VorMontage
 * @property string|null $InfostringVorgang
 * @property int|null $VorAuftraggeberInternet
 * @property string|null $DatumMobilExport
 * @property string|null $DatumMobilImport
 * @property string|null $DatumMobilEinlesen
 * @property string|null $Gruppe
 * @property string|null $UnterGruppe
 * @property string|null $WiedervorlageAM
 * @property int|null $AnzRWM
 * @property string|null $ObjektEigenschaften
 * @property string|null $AdressEigenschaften
 * @property int|null $VorgangCheck
 * @property string|null $DatumBNKGedrucktAutomatisch
 * @property int|null $AbrechnerID_Zustaendig
 * @property string|null $Stichworte
 * @property int|null $LiegenschaftBits_2
 * @property string|null $RoutenEigenschaften
 * @property string|null $Text_Abrechnungsinformationen
 * @property string|null $Text_Streitbeilegung
 * @property string|null $EingangKostenbelegNutzerlisteManuell_Sachbearbeiter
 * @property string|null $EingangKostenbelegNutzerlisteManuell_Bemerkung
 * @property string|null $EingangAblesebelegManuell_Sachbearbeiter
 * @property string|null $EingangAblesebelegManuell_Bemerkung
 * @property int|null $SynchonizeVor_Archiv
 * @property int|null $ID_Liegenschaften
 * @property string|null $TimeStamp
 * @property string|null $Gespeichert_Datum
 * @property int|null $Gespeichert_NutzerNr
 * @property string|null $Abgeschlossen_Datum
 * @property int|null $Abgeschlossen_NutzerNr
 * @property string|null $Montage_Auftragstext
 * @property string|null $Montage_Telefonnummer
 * @property string|null $Montage_Wunschtermin
 * @property string|null $Montage_Bemerkung
 * @property string|null $Montage_Bestellnummer
 * @method static Builder<static>|Vorgang7Abrechnung newModelQuery()
 * @method static Builder<static>|Vorgang7Abrechnung newQuery()
 * @method static Builder<static>|Vorgang7Abrechnung query()
 * @method static Builder<static>|Vorgang7Abrechnung whereAKontoRechnung($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAbgeschlossenDatum($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAbgeschlossenNutzerNr($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAblesebezirk($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAblesemonat($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAblesungBis($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAblesungBisLJ($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAblesungVon($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAblesungVonLJ($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAbrechnerID($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAbrechnerIDEAnl($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAbrechnerIDLA($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAbrechnerIDLAVJ($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAbrechnerIDLV($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAbrechnerIDUebertrag($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAbrechnerIDZustaendig($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAdressEigenschaften($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAmpullenfarben($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAnsprechPartnerEmail($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAnsprechPartnerFax($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAnsprechPartnerFestnetz($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAnsprechPartnerInfo($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAnsprechPartnerMobil($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAnsprechpartnerAnrede($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAnsprechpartnerName($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAnzHKV($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAnzKWZ($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAnzNE($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAnzRWM($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAnzSZ($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAnzWMZ($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAnzWWKV($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAnzWWZ($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAnzahlFuehlerSkala($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereArtikelnummerSkala($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereBasisempfindlichkeitSkala($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereBaujahrHeizung($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereBaujahrObjekt($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereCheckzahlArtSkala($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereDachIsoliert($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereDatumAblesebelegGedrucktAutomatisch($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereDatumAbrechnungserstellungAutomatisch($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereDatumAbrechnungserstellungAutomatischErste($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereDatumAnlageErstellung($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereDatumAusgangAblesebelegManuell($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereDatumBNKGedrucktAutomatisch($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereDatumEingangAblesebelegManuell($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereDatumEingangAbrechnungsvertrag($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereDatumEingangKostenbelegNutzerlisteManuell($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereDatumKostenbelegNutzerlisteAutomatisch($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereDatumLegionellenpruefung($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereDatumLetzteAenderung($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereDatumMobilEinlesen($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereDatumMobilExport($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereDatumMobilImport($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereDatumUebertrag($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereDatumletzteSanierung($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereEigenschaftenGeraetSkala($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereEigentuemerAnrede($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereEigentuemerEmail($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereEigentuemerFax($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereEigentuemerFestnetz($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereEigentuemerMobil($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereEigentuemerName($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereEigentuemerOrt($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereEigentuemerPLZ($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereEigentuemerStrasse($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereEingangAblesebelegManuellBemerkung($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereEingangAblesebelegManuellSachbearbeiter($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereEingangKostenbelegNutzerlisteManuellBemerkung($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereEingangKostenbelegNutzerlisteManuellSachbearbeiter($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereFarbeAktendeckel($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereFassadeIsoliert($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereFirmenBezeichnung1Rechnung($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereFirmenBezeichnung1Versand($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereFirmenBezeichnung2Rechnung($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereFirmenBezeichnung2Versand($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereFormelKVBerechnungSkala($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereGebäudeart($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereGeraeteStatus($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereGespeichertDatum($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereGespeichertNutzerNr($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereGruppe($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereHKBWNorm($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereHKSkalierung($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereHKVTyp($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereHKVTypVisualThermSkala($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereHausmeisterAnrede($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereHausmeisterEmail($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereHausmeisterFax($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereHausmeisterFestnetz($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereHausmeisterMobil($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereHausmeisterName($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereHausmeisterOrt($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereHausmeisterPLZ($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereHausmeisterStrasse($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereIDLiegenschaften($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereInfostringVorgang($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereInterneRechnungsnummer($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereInterneVorgangsnummer($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereIsolierverglasung($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereLSStatus($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereLaufzeitSkala($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereLiegenschaftBits($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereLiegenschaftBits2($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereLiegenschaftOrt2($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereLiegenschaftStrasse2($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereMaximalwertSkala($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereMontageAuftragstext($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereMontageBemerkung($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereMontageBestellnummer($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereMontageTelefonnummer($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereMontageWunschtermin($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereMontagehoeheSkala($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereNiedrigenergiehaus($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereNiedrigtemperaturheizung($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereObjektEigenschaften($value)
 * @method static Builder<static>|Vorgang7Abrechnung wherePLZRechnung($value)
 * @method static Builder<static>|Vorgang7Abrechnung wherePLZVersand($value)
 * @method static Builder<static>|Vorgang7Abrechnung wherePreisliste($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereRaumNrAblage($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereRoutenEigenschaften($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereSKFaktorSkala($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereSachbearbeiter($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereSachbearbeiterLetzteBearbeitung($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereSelbstAbleser($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereSkalaHersteller($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereSkalaKurzbezeichnung($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereSkalenBezeichnung($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereSkalennummer($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereStadt2Rechnung($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereStadt2Versand($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereStadtRechnung($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereStadtVersand($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereStatusAuskunft($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereStichworte($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereStrasse2Rechnung($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereStrasse2Versand($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereStrasseRechnung($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereStrasseVersand($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereSynchonizeVorArchiv($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereTextAbrechnungsinformationen($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereTextSkala($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereTextStreitbeilegung($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereTimeStamp($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereUnterGruppe($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereUnterStrassen($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereUnterStrassenVorhanden($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereVBHKVVJ($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereVBKWZVJ($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereVBWMZVJ($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereVBWWZVJ($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereVorAblesung($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereVorAuftraggeberInternet($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereVorMontage($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereVorgangCheck($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereVorgangNachfolger($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereVorgangVorgaenger($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereWiedervorlageAM($value)
 * @property string|null $NutzerMontage_Auftragstext
 * @property string|null $NutzerMontage_Telefonnummer
 * @property string|null $NutzerMontage_Wunschtermin
 * @property string|null $NutzerMontage_Bemerkung
 * @property string|null $NutzerMontage_Bestellnummer
 * @method static Builder<static>|Vorgang7Abrechnung whereNutzerMontageAuftragstext($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereNutzerMontageBemerkung($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereNutzerMontageBestellnummer($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereNutzerMontageTelefonnummer($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereNutzerMontageWunschtermin($value)
 * @mixin Eloquent
 * @property string|null $AlteLiegenschaftsnummern
 * @property string|null $Abrechnungseinheit
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang7Abrechnung whereAbrechnungseinheit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang7Abrechnung whereAlteLiegenschaftsnummern($value)
 */
	class Vorgang7Abrechnung extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $VorgangWertID
 * @property int $InterneVorgangsnummer
 * @property float|null $VorWBruttowertGesamt
 * @property float|null $VorWBruttowertAuftrag
 * @property float|null $VorWBruttowertAbrechnung
 * @property float|null $VorWBruttowertLieferung
 * @property float|null $VorWBruttowertVersand
 * @property float|null $VorWBruttowertGut
 * @property float|null $VorWBruttowertRechnung
 * @property float|null $VorWNettoPlusZusatzGesamt
 * @property float|null $VorWNettoPlusZusatzAuftrag
 * @property float|null $VorWNettoPlusZusatzAbrechnung
 * @property float|null $VorWNettoPlusZusatzLieferung
 * @property float|null $VorWNettoPlusZusatzVersand
 * @property float|null $VorWNettoPlusZusatzGut
 * @property float|null $VorWNettoPlusZusatzRechnung
 * @property float|null $VorWNettoMinusRabattGesamt
 * @property float|null $VorWNettoMinusRabattAuftrag
 * @property float|null $VorWNettoMinusRabattAbrechnung
 * @property float|null $VorWNettoMinusRabattLieferung
 * @property float|null $VorWNettoMinusRabattVersand
 * @property float|null $VorWNettoMinusRabattGut
 * @property float|null $VorWNettoMinusRabattRechnung
 * @property float|null $VorWNettoMinusAKontoAbrechnung
 * @property float|null $VorWNettoMinusAKontoLieferung
 * @property float|null $VorWNettoMinusAKontoRechnung
 * @property float|null $VorWNettowertGesamt
 * @property float|null $VorWNettowertAuftrag
 * @property float|null $VorWNettowertAbrechnung
 * @property float|null $VorWNettowertLieferung
 * @property float|null $VorWNettowertVersand
 * @property float|null $VorWNettowertGut
 * @property float|null $VorWNettowertRechnung
 * @property float|null $VorWNettowertMwst1Gesamt
 * @property float|null $VorWNettowertMwst1Auftrag
 * @property float|null $VorWNettowertMwst1Abrechnung
 * @property float|null $VorWNettowertMwst1Lieferung
 * @property float|null $VorWNettowertMwst1Versand
 * @property float|null $VorWNettowertMwst1Gut
 * @property float|null $VorWNettowertMwst1Rechnung
 * @property float|null $VorWNettowertMwst2Gesamt
 * @property float|null $VorWNettowertMwst2Auftrag
 * @property float|null $VorWNettowertMwst2Abrechnung
 * @property float|null $VorWNettowertMwst2Lieferung
 * @property float|null $VorWNettowertMwst2Versand
 * @property float|null $VorWNettowertMwst2Gut
 * @property float|null $VorWNettowertMwst2Rechnung
 * @property float|null $VorWNettowertMwst3Gesamt
 * @property float|null $VorWNettowertMwst3Auftrag
 * @property float|null $VorWNettowertMwst3Abrechnung
 * @property float|null $VorWNettowertMwst3Lieferung
 * @property float|null $VorWNettowertMwst3Versand
 * @property float|null $VorWNettowertMwst3Gut
 * @property float|null $VorWNettowertMwst3Rechnung
 * @property float|null $VorWNettoEKGesamt
 * @property float|null $VorWNettoEKAuftrag
 * @property float|null $VorWNettoEKAbrechnung
 * @property float|null $VorWNettoEKLieferung
 * @property float|null $VorWNettoEKVersand
 * @property float|null $VorWNettoEKGut
 * @property float|null $VorWNettoEKRechnung
 * @property float|null $VorWNettoEKOhneNKGesamt
 * @property float|null $VorWNettoEKOhneNKVTGesamt
 * @property float|null $VorWNettoEKVTGesamt
 * @property float|null $VorWNettoEKVTAuftrag
 * @property float|null $VorWNettoEKVTAbrechnung
 * @property float|null $VorWNettoEKVTLieferung
 * @property float|null $VorWNettoEKVTVersand
 * @property float|null $VorWNettoEKVTGut
 * @property float|null $VorWNettoEKVTRechnung
 * @property float|null $VorWGewichtGesamt
 * @property float|null $VorWGewichtAuftrag
 * @property float|null $VorWGewichtAbrechnung
 * @property float|null $VorWGewichtLieferung
 * @property float|null $VorWGewichtVersand
 * @property float|null $VorWGewichtGut
 * @property float|null $VorWGewichtRechnung
 * @property string|null $TimeStamp
 * @method static Builder<static>|VorgangWert newModelQuery()
 * @method static Builder<static>|VorgangWert newQuery()
 * @method static Builder<static>|VorgangWert query()
 * @method static Builder<static>|VorgangWert whereInterneVorgangsnummer($value)
 * @method static Builder<static>|VorgangWert whereTimeStamp($value)
 * @method static Builder<static>|VorgangWert whereVorWBruttowertAbrechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWBruttowertAuftrag($value)
 * @method static Builder<static>|VorgangWert whereVorWBruttowertGesamt($value)
 * @method static Builder<static>|VorgangWert whereVorWBruttowertGut($value)
 * @method static Builder<static>|VorgangWert whereVorWBruttowertLieferung($value)
 * @method static Builder<static>|VorgangWert whereVorWBruttowertRechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWBruttowertVersand($value)
 * @method static Builder<static>|VorgangWert whereVorWGewichtAbrechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWGewichtAuftrag($value)
 * @method static Builder<static>|VorgangWert whereVorWGewichtGesamt($value)
 * @method static Builder<static>|VorgangWert whereVorWGewichtGut($value)
 * @method static Builder<static>|VorgangWert whereVorWGewichtLieferung($value)
 * @method static Builder<static>|VorgangWert whereVorWGewichtRechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWGewichtVersand($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKAbrechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKAuftrag($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKGesamt($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKGut($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKLieferung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKOhneNKGesamt($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKOhneNKVTGesamt($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKRechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKVTAbrechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKVTAuftrag($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKVTGesamt($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKVTGut($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKVTLieferung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKVTRechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKVTVersand($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoEKVersand($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoMinusAKontoAbrechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoMinusAKontoLieferung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoMinusAKontoRechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoMinusRabattAbrechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoMinusRabattAuftrag($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoMinusRabattGesamt($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoMinusRabattGut($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoMinusRabattLieferung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoMinusRabattRechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoMinusRabattVersand($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoPlusZusatzAbrechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoPlusZusatzAuftrag($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoPlusZusatzGesamt($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoPlusZusatzGut($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoPlusZusatzLieferung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoPlusZusatzRechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettoPlusZusatzVersand($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertAbrechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertAuftrag($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertGesamt($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertGut($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertLieferung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst1Abrechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst1Auftrag($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst1Gesamt($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst1Gut($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst1Lieferung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst1Rechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst1Versand($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst2Abrechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst2Auftrag($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst2Gesamt($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst2Gut($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst2Lieferung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst2Rechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst2Versand($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst3Abrechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst3Auftrag($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst3Gesamt($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst3Gut($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst3Lieferung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst3Rechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertMwst3Versand($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertRechnung($value)
 * @method static Builder<static>|VorgangWert whereVorWNettowertVersand($value)
 * @method static Builder<static>|VorgangWert whereVorgangWertID($value)
 * @mixin Eloquent
 */
	class VorgangWert extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $KZWarengruppe
 * @property string|null $WgrBezeichnung
 * @property string|null $WgrArtikelart
 * @property string|null $KZWgrMengeneinheit1
 * @property string|null $KZWgrMengeneinheit2
 * @property int|null $WgrTypMengeneinheit2
 * @property string|null $WgrTextArtikelnummer
 * @property string|null $WgrTextAbmasse1
 * @property string|null $WgrTextAbmasse2
 * @property string|null $WgrTextAbmasse3
 * @property string|null $WgrTextAbmasse4
 * @property int|null $WgrNummerAbmasse1
 * @property int|null $WgrNummerAbmasse2
 * @property int|null $WgrNummerAbmasse3
 * @property int|null $WgrNummerAbmasse4
 * @property int|null $WgrNachkommaAbmasse1
 * @property int|null $WgrNachkommaAbmasse2
 * @property int|null $WgrNachkommaAbmasse3
 * @property int|null $WgrNachkommaAbmasse4
 * @property int $WgrArtikelgruppenfaehig
 * @property int $WgrLieferantenfaehig
 * @property int $WgrLagerfaehig
 * @property int $WgrDisponierbar
 * @property int $WgrFertigungsfaehig
 * @property int $WgrVerkaufsfaehig
 * @property int $WgrFremdfertigungJN
 * @property int $WgrBonusberechtigt
 * @property int $WgrUrsprungsnachweisJN
 * @property int $WgrBaugruppeJN
 * @property int $WgrMengeneinheit2faehig
 * @property int $WgrPreisProMengeneinheit2
 * @property string|null $WgrFormelVerkaufspreis
 * @property string|null $WgrPicture
 * @property string|null $WgrWhen
 * @property string|null $WgrValid
 * @property float $WgrVerschnitt
 * @property int $WgrAutoAbbuchen
 * @property int $WgrAutoZubuchen
 * @property int|null $WgrAbbuchungsmethode
 * @property int|null $WgrDispoart
 * @property float $WgrRundungsfaktorVK
 * @property float $WgrRestmenge
 * @property int $WgrRestmengeME
 * @property float $WgrAbzugEK
 * @property float|null $WgrSpeditionProzent
 * @property int|null $WgrEigenmasseField
 * @property float|null $WgrProvisionProzent
 * @property int|null $WgrWiederbeschaffungszeit
 * @property int|null $FKtoNummer
 * @property int|null $LinecardID
 * @property int|null $WgrFibuKontoGruppeAR
 * @property int|null $WgrFibuKontoGruppeVB
 * @property int $WgrFilialExportJN
 * @property int $WgrSeriennummernfaehigJN
 * @property int $WgrChargenfaehigJN
 * @property int $WgrSnrHerstelldatum
 * @property int $WgrSnrVerfallsdatum
 * @property int|null $WgrSnrHaltbarkeitszeitraum
 * @property int $WgrChargeHerstelldatum
 * @property int $WgrChargeVerfallsdatum
 * @property int|null $WgrChargeHaltbarkeitszeitraum
 * @property int|null $WgrWPTyp
 * @property string|null $TimeStamp
 * @property int|null $WgrPickingMethode
 * @property int $WgrInaktivJN
 * @property int $WgrWerkzeugJN
 * @property int $WgrPruefmittelJN
 * @method static Builder<static>|Warengruppe newModelQuery()
 * @method static Builder<static>|Warengruppe newQuery()
 * @method static Builder<static>|Warengruppe query()
 * @method static Builder<static>|Warengruppe whereFKtoNummer($value)
 * @method static Builder<static>|Warengruppe whereKZWarengruppe($value)
 * @method static Builder<static>|Warengruppe whereKZWgrMengeneinheit1($value)
 * @method static Builder<static>|Warengruppe whereKZWgrMengeneinheit2($value)
 * @method static Builder<static>|Warengruppe whereLinecardID($value)
 * @method static Builder<static>|Warengruppe whereTimeStamp($value)
 * @method static Builder<static>|Warengruppe whereWgrAbbuchungsmethode($value)
 * @method static Builder<static>|Warengruppe whereWgrAbzugEK($value)
 * @method static Builder<static>|Warengruppe whereWgrArtikelart($value)
 * @method static Builder<static>|Warengruppe whereWgrArtikelgruppenfaehig($value)
 * @method static Builder<static>|Warengruppe whereWgrAutoAbbuchen($value)
 * @method static Builder<static>|Warengruppe whereWgrAutoZubuchen($value)
 * @method static Builder<static>|Warengruppe whereWgrBaugruppeJN($value)
 * @method static Builder<static>|Warengruppe whereWgrBezeichnung($value)
 * @method static Builder<static>|Warengruppe whereWgrBonusberechtigt($value)
 * @method static Builder<static>|Warengruppe whereWgrChargeHaltbarkeitszeitraum($value)
 * @method static Builder<static>|Warengruppe whereWgrChargeHerstelldatum($value)
 * @method static Builder<static>|Warengruppe whereWgrChargeVerfallsdatum($value)
 * @method static Builder<static>|Warengruppe whereWgrChargenfaehigJN($value)
 * @method static Builder<static>|Warengruppe whereWgrDispoart($value)
 * @method static Builder<static>|Warengruppe whereWgrDisponierbar($value)
 * @method static Builder<static>|Warengruppe whereWgrEigenmasseField($value)
 * @method static Builder<static>|Warengruppe whereWgrFertigungsfaehig($value)
 * @method static Builder<static>|Warengruppe whereWgrFibuKontoGruppeAR($value)
 * @method static Builder<static>|Warengruppe whereWgrFibuKontoGruppeVB($value)
 * @method static Builder<static>|Warengruppe whereWgrFilialExportJN($value)
 * @method static Builder<static>|Warengruppe whereWgrFormelVerkaufspreis($value)
 * @method static Builder<static>|Warengruppe whereWgrFremdfertigungJN($value)
 * @method static Builder<static>|Warengruppe whereWgrInaktivJN($value)
 * @method static Builder<static>|Warengruppe whereWgrLagerfaehig($value)
 * @method static Builder<static>|Warengruppe whereWgrLieferantenfaehig($value)
 * @method static Builder<static>|Warengruppe whereWgrMengeneinheit2faehig($value)
 * @method static Builder<static>|Warengruppe whereWgrNachkommaAbmasse1($value)
 * @method static Builder<static>|Warengruppe whereWgrNachkommaAbmasse2($value)
 * @method static Builder<static>|Warengruppe whereWgrNachkommaAbmasse3($value)
 * @method static Builder<static>|Warengruppe whereWgrNachkommaAbmasse4($value)
 * @method static Builder<static>|Warengruppe whereWgrNummerAbmasse1($value)
 * @method static Builder<static>|Warengruppe whereWgrNummerAbmasse2($value)
 * @method static Builder<static>|Warengruppe whereWgrNummerAbmasse3($value)
 * @method static Builder<static>|Warengruppe whereWgrNummerAbmasse4($value)
 * @method static Builder<static>|Warengruppe whereWgrPickingMethode($value)
 * @method static Builder<static>|Warengruppe whereWgrPicture($value)
 * @method static Builder<static>|Warengruppe whereWgrPreisProMengeneinheit2($value)
 * @method static Builder<static>|Warengruppe whereWgrProvisionProzent($value)
 * @method static Builder<static>|Warengruppe whereWgrPruefmittelJN($value)
 * @method static Builder<static>|Warengruppe whereWgrRestmenge($value)
 * @method static Builder<static>|Warengruppe whereWgrRestmengeME($value)
 * @method static Builder<static>|Warengruppe whereWgrRundungsfaktorVK($value)
 * @method static Builder<static>|Warengruppe whereWgrSeriennummernfaehigJN($value)
 * @method static Builder<static>|Warengruppe whereWgrSnrHaltbarkeitszeitraum($value)
 * @method static Builder<static>|Warengruppe whereWgrSnrHerstelldatum($value)
 * @method static Builder<static>|Warengruppe whereWgrSnrVerfallsdatum($value)
 * @method static Builder<static>|Warengruppe whereWgrSpeditionProzent($value)
 * @method static Builder<static>|Warengruppe whereWgrTextAbmasse1($value)
 * @method static Builder<static>|Warengruppe whereWgrTextAbmasse2($value)
 * @method static Builder<static>|Warengruppe whereWgrTextAbmasse3($value)
 * @method static Builder<static>|Warengruppe whereWgrTextAbmasse4($value)
 * @method static Builder<static>|Warengruppe whereWgrTextArtikelnummer($value)
 * @method static Builder<static>|Warengruppe whereWgrTypMengeneinheit2($value)
 * @method static Builder<static>|Warengruppe whereWgrUrsprungsnachweisJN($value)
 * @method static Builder<static>|Warengruppe whereWgrValid($value)
 * @method static Builder<static>|Warengruppe whereWgrVerkaufsfaehig($value)
 * @method static Builder<static>|Warengruppe whereWgrVerschnitt($value)
 * @method static Builder<static>|Warengruppe whereWgrWPTyp($value)
 * @method static Builder<static>|Warengruppe whereWgrWerkzeugJN($value)
 * @method static Builder<static>|Warengruppe whereWgrWhen($value)
 * @method static Builder<static>|Warengruppe whereWgrWiederbeschaffungszeit($value)
 * @mixin Eloquent
 */
	class Warengruppe extends \Eloquent {}
}

