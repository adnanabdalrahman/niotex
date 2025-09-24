<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
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
