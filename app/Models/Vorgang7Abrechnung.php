<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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
 * @property string|null $AlteLiegenschaftsnummern
 * @property string|null $Abrechnungseinheit
 * @method static Builder<static>|Vorgang7Abrechnung whereAbrechnungseinheit($value)
 * @method static Builder<static>|Vorgang7Abrechnung whereAlteLiegenschaftsnummern($value)
 * @mixin Eloquent
 */
class Vorgang7Abrechnung extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.Vorgang7Abrechnung';
    protected $primaryKey = 'InterneVorgangsnummer';
    protected $guarded = [];
}
