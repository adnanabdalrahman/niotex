<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
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
 * @mixin \Eloquent
 */
class Ceos_LIEGENSCHAFT extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.Ceos_LIEGENSCHAFT';
    protected $primaryKey = 'LiegenschaftsID';
    protected $guarded = [];
}
