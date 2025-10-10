<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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
 * @mixin Eloquent
 */
class Ceos_LIEGENSCHAFT_TimeLine extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.Ceos_LIEGENSCHAFT_TimeLine';
    protected $primaryKey = 'ID';
    protected $guarded = [];

}

