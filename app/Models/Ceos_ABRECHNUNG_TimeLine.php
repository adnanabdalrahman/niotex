<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
class Ceos_ABRECHNUNG_TimeLine extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.Ceos_ABRECHNUNG_TimeLine';
    protected $primaryKey = 'ID';
    protected $guarded = [];
}
