<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
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
class Ceos_GERAET extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.Ceos_GERAET';
    protected $primaryKey = 'GeraeteID';
    protected $guarded = [];
}
