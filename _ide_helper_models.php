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
 * 
 *
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrAkquise($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrAltJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrAnlageAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrAnlageDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrBFWarnung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrBearbeiter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrBezugsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrBonusText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrBonusTextnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrBonusberechtigtJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrBruttoJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrDruckAvisJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrEMail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrERechnung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrEdiKennung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrEdiSendKennung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrEdiSendTestdatenJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrEdifaehigJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrFactoringJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrFactoringUebertragenAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrFactoringUebertragenJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrFax($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrFibuNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrFibuUebergabeAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrFibuUebergabeDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrFilialAdressexportJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrFilialVorgangsexportJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrFirmenbezeichnung1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrFirmenbezeichnung2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrFirmenbezeichnung3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrFirmenbezeichnung4($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrFremdnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrGarantieLaufzeit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrGlobalID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrGutschriftsverfahrenJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrHandelsregeintrag($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrIndividualC1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrIndividualC2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrIndividualC3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrIndividualCombo1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrIndividualCombo2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrIndividualCombo3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrIndividualD1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrIndividualD2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrIndividualD3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrInfoVorgang($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrInsolventJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrIntrastatKennummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrKarenztage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrKontakthistorie($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrKontoLastschrift($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrKontostandAnzahlung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrKontostandAuftragseingang($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrKontostandOffenePosten($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrKreditlimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrLastschriftMandat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrLastschriftMandatVom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrLeitwegID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrLetzteAenderungAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrLetzteAenderungDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrLetzterVorgangAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrLiefersperreJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrLieferzeit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrLockingAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrLockingDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrMahnAbstand($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrMahnMaxAnzahl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrMahnSperreJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrMailingJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrMatchcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrMindestVorgangswert($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrMobiltelefon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrNotiz($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrOrt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrOrtPostfach($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrPLZ($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrPLZPostfach($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrPersktoSammelkonto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrPostfach($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrPreisNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrPrivatJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrQualitaetsguete($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrRabatt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrRabattDM($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrSammelrechnungJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrSkypeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrStSatznummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrSteuernummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrStrasse($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrStrasse2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrStrasse3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrTelefon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrTerminguete($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrUSTID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrUSTIDLand($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrUSTIDPruefungJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrUebertragenAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrUebertragenJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrUeberzahlung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrVDA4905JN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrVDA4908JN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrVDA4912JN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrVDA4913JN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrVDA4915JN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrVDA4916JN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrVersBonitaetsindex($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrVersGesellschaft($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrVersLetzteAnfrageAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrVersLetzteRechercheAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrVersnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrWHTfaehigJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrWebadresse($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrWebshopkennung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdrZahlungsmoral($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereAdressNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereBedingungLieferungOrtID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereFormularGruppeID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereHerkunftID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereInterneAdressnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereKZAdresseRabattgruppe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereKZAdressgruppe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereKZAdresstyp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereKZBundesLand($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereKZLand($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereKZLieferbedingung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereKZSprache($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereKZVerpackung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereKZVersandbedingung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereKZWaehrung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereKZZahlungsart($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereKZZahlungsbedingung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereMarketingID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereMwstTypID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereNRAnrede($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereNRTitel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adresse whereTimeStamp($value)
 */
	class Adresse extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtABCAnalyse($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtAbbuchungsmethode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtAbmasse1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtAbmasse2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtAbmasse3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtAbmasse4($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtAbwicklung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtAltJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtAnlageAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtAnlageDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtAusschussFaktor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtAusschussMenge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtAutoAbbuchenJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtAutoZubuchenJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtAvailabilityCheck($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtBarcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtBearbeiter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtBezeichnung1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtBezeichnung1Einkauf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtBezeichnung1Fertigung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtBezeichnung2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtBezeichnung2Einkauf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtBezeichnung2Fertigung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtBild($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtBleifreiJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtBonusberechtigtJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtBruttoGewicht($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtChargeHaltbarkeitszeitraum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtChargeHerstelldatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtChargeVerfallsdatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtChargenfaehigJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtDienstleistungJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtDispoart($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtDurchlaufzeit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtEAN1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtEAN2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtEAN3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtEKInNachkalkulationJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtEKRabatt1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtEKRabatt2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtEKRabatt3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtEKRabattWert1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtEKRabattWert2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtEKRabattfaehigJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtEdiKennung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtEigenReparaturfaehigJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtErstmusterFreigabeAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtErstmusterFreigabeJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtErstmusterInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtErstmusterPruefungJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtExportAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtExportFremdsoftwareJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtFaktorMengeneinheit2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtFertigungsfaehigJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtFertigungskosten($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtFibuKontoGruppeAR($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtFibuKontoGruppeVB($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtFilialExportJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtFormelMengeneinheit1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtFormelMengeneinheit2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtFremdReparaturfaehigJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtFremdfertigungJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtFremdfertigungskosten($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtGeprueftAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtGeprueftDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtGewichtsbasis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtIndividualC1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtIndividualC2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtIndividualC3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtIndividualC4($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtIndividualC5($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtIndividualC6($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtIndividualC7($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtIndividualCombo1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtIndividualCombo2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtIndividualCombo3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtIndividualCombo4($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtIndividualD1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtIndividualD2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtIndividualD3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtIndividualD4($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtIndividualD5($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtIndividualD6($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtIndividualD7($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtIndividualT1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtIndividualT2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtIndividualT3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtIndividualT4($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtInventurAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtInventurpreis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtKalkulatorischerEK($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtLetzteAenderungAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtLetzteAenderungDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtLetztePreisaenderungAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtLetztePreisaenderungDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtLiefErklaerungGueltigBis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtLiefErklaerungsPflichtigJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtLieferantenfaehigJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtLockingAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtLockingDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtMatchcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtMaterialkosten($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtMenge2ProVerpackungEK($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtMenge2ProVerpackungVK($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtMengeProVerpackungEK($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtMengeProVerpackungVK($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtMieteVerleihJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtNRKostenstelleAR($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtNRKostenstelleVB($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtNRKostentraegerAR($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtNRKostentraegerVB($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtNettoGewicht($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtNorm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtNotiz($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtOberflaeche($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtOptimaleBestellmenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtOptimaleBestellmenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtOptimaleFertigungsmenge1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtOptimaleFertigungsmenge2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtPickingMethode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtPlanungshorizont($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtPraeferenzDynamischJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtPraeferenzJNA($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtPraeferenzWert($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtPreisProMengeneinheit2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtPriceFormular($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtProvisionProzent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtProvisionsfaehigJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtPruefpflichtigJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtRabatt1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtRabatt2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtRabatt3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtRabattWert1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtRabattWert2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtRabattfaehigJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtRoHSKonformJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtSeriennummernfaehigJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtServiceJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtSkontofaehigJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtSnrHaltbarkeitszeitraum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtSnrHerstelldatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtSnrVerfallsdatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtSondereinzelkosten($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtStkAufAufloesungJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtStkAufAusgabeJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtStkAuftragLagerbuchung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtStkBesAufloesungJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtStkBesAusgabeJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtStkBestellLagerbuchung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtStkBestellbeistellungJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtStkBestellpreis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtStkDispodifferenz($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtStkDispotermin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtStkEinkaufspreis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtStkFertLagerbuchung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtStkKundenbeistellabgangJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtStkKundenbeistellungJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtStkManuellJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtStkMultiplikatorJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtStkPseudobaugruppeJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtStkVerkaufspreis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtStlAenderungAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtStlAenderungDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtStuecklisteJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtUrsprungsnachweisJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtVKBrutto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtVerkaufsfaehigJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtVerkaufspreis1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtVerkaufspreisNeu($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtVerkaufspreisNeuDatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtWebshopLetzteAktualisierungAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtWebshopNaechsteAktualisierungJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtWebshopfaehigJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtWebshopkennung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtWerkstoffAnteil($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtWerkstoffPreisbasisEK($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtWerkstoffPreisbasisVK($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtWiederbeschaffungszeit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtZeichnungsformat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtZeichnungsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtikelUntergruppeID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereArtikelnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereInterneArtikelnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereKZArtGewichtseinheit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereKZArtMengeneinheit1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereKZArtMengeneinheit2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereKZArtikelRabattgruppe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereKZArtikelgruppe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereKZIntraStat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereKZKalkulationGruppe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereKZProduktgruppe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereKZWarengruppe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereKZZusatztext($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereLinecardID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereMwstNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereNRPreisbasis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereNRWerkstoff($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Artikel whereWithholdingtaxKategorieID($value)
 */
	class Artikel extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
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
 */
	class ArtikelLieferant extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereAmpullenfarbe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereAnschluss($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereAnzahlFuehlerSkala($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereArtDerBewertung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereArtikelAufsatzModul($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereBasisempfindlichkeitSkala($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereBauart($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereBeschreibung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereCMID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereCheckzahlArtSkala($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereCheckzahlSkala($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereEinheitenUeberfuellungSkala($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereFabrikat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereFolgeAblesewert($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereFormelKVBerechnungSkala($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereGeraetFunkVorbereitet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereGeraetInMiete($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereGeraetInWartung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereGeraetKodiertSkala($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereGeraetWalkByFaehig($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereGeraetebits($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereHKVBewertungsnorm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereHKVSkalierung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereHKVTyp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereHKVTypVisualThermSkala($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereHeizkoerperbezeichnung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereHerstellerbezeichnung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereHoehe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereInterneArtikelNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereKCWert($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereKennzeichenSontex($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereLaenge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereLaufzeit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereLeistungInWatt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereMaximalwertSkala($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereMediacode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereMontagehoeheSkala($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereQN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereRoutenEigenschaften($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereSKFaktorSkala($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereSegmentlaenge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereSkalaHersteller($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereSkalaKurzbezeichnung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereSkalenBezeichnung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereSkalennummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereStichtagProgrammiertSkala($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereStricheUeberfuellungSkala($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereStueckZaehlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereTextSkala($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereTiefe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereVerbrauchzaehlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Basisempfindlichkeit whereZaehlertyp($value)
 */
	class Basisempfindlichkeit extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $VorArt
 * @property string $VorGruppe
 * @property int $VNkArt
 * @property string $VNkName
 * @property int|null $VNkAnfangswert
 * @property int|null $VNkEndwert
 * @property int|null $VNkAktuellerWert
 * @property string|null $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NummernkreisVorgang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NummernkreisVorgang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NummernkreisVorgang query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NummernkreisVorgang whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NummernkreisVorgang whereVNkAktuellerWert($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NummernkreisVorgang whereVNkAnfangswert($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NummernkreisVorgang whereVNkArt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NummernkreisVorgang whereVNkEndwert($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NummernkreisVorgang whereVNkName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NummernkreisVorgang whereVorArt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NummernkreisVorgang whereVorGruppe($value)
 */
	class NummernkreisVorgang extends \Eloquent {}
}

namespace App\Models{
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
 */
	class Vorgang extends \Eloquent {}
}

