<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $MesspunktID
 * @property int|null $MP_FOREIGN_ID
 * @property int $User
 * @property string|null $DateStamp
 * @property string $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MESSPUNKT newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MESSPUNKT newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MESSPUNKT query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MESSPUNKT whereDateStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MESSPUNKT whereMPFOREIGNID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MESSPUNKT whereMesspunktID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MESSPUNKT whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MESSPUNKT whereUser($value)
 * @property string|null $MP_COMP_API_ID
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MESSPUNKT whereMPCOMPAPIID($value)
 * @mixin \Eloquent
 */
class Ceos_MESSPUNKT extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.Ceos_MESSPUNKT';
    protected $primaryKey = 'MesspunktID';
    protected $guarded = [];
}
