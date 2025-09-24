<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $WohneinheitID
 * @property int|null $WE_FOREIGN_ID
 * @property int $User
 * @property string|null $DateStamp
 * @property string $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_WOHNEINHEIT newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_WOHNEINHEIT newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_WOHNEINHEIT query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_WOHNEINHEIT whereDateStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_WOHNEINHEIT whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_WOHNEINHEIT whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_WOHNEINHEIT whereWEFOREIGNID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_WOHNEINHEIT whereWohneinheitID($value)
 * @property string $WE_COMP_API_ID
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_WOHNEINHEIT whereWECOMPAPIID($value)
 * @mixin \Eloquent
 */
class Ceos_WOHNEINHEIT extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.Ceos_WOHNEINHEIT';
    protected $primaryKey = 'WohneinheitID';
    protected $guarded = [];
}
