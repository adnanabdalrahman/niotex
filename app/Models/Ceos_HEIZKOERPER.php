<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $HeizkoerperID
 * @property int|null $HEI_FOREIGN_ID
 * @property int $User
 * @property string|null $DateStamp
 * @property string $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HEIZKOERPER newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HEIZKOERPER newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HEIZKOERPER query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HEIZKOERPER whereDateStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HEIZKOERPER whereHEIFOREIGNID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HEIZKOERPER whereHeizkoerperID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HEIZKOERPER whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HEIZKOERPER whereUser($value)
 * @property string|null $HEI_COMP_API_ID
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HEIZKOERPER whereHEICOMPAPIID($value)
 * @mixin \Eloquent
 */
class Ceos_HEIZKOERPER extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.Ceos_HEIZKOERPER';
    protected $primaryKey = 'HeizkoerperID';
    protected $guarded = [];
}
