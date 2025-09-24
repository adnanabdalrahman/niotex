<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
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
class Ceos_GEBAEUDE extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.Ceos_GEBAEUDE';
    protected $primaryKey = 'GebaeudeID';
    protected $guarded = [];
}
