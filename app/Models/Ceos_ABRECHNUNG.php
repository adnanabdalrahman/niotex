<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $AbrechnungID
 * @property int|null $ABR_FOREIGN_ID
 * @property int $User
 * @property string|null $DateStamp
 * @property string $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG whereABRFOREIGNID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG whereAbrechnungID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG whereDateStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG whereUser($value)
 * @property string $ABR_COMP_API_ID
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_ABRECHNUNG whereABRCOMPAPIID($value)
 * @mixin \Eloquent
 */
class Ceos_ABRECHNUNG extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.Ceos_ABRECHNUNG';
    protected $primaryKey = 'AbrechnungID';
    protected $guarded = [];
}
