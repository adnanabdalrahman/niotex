<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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
class Ceos_GEBAEUDE_TimeLine extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.Ceos_GEBAEUDE_TimeLine';
    protected $primaryKey = 'ID';
    protected $guarded = [];
}
