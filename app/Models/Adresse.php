<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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
class Adresse extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.Adresse';
    protected $primaryKey = 'InterneAdressnummer';
    protected $guarded = [];

}
