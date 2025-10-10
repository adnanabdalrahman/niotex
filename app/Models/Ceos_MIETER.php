<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $MieterID
 * @property int|null $MI_FOREIGN_ID
 * @property int $User
 * @property string|null $DateStamp
 * @property string $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER whereDateStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER whereMIFOREIGNID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER whereMieterID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER whereUser($value)
 * @property string $MI_COMP_API_ID
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER whereMICOMPAPIID($value)
 * @mixin \Eloquent
 */
class Ceos_MIETER extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.Ceos_MIETER';
    protected $primaryKey = 'MieterID';
    protected $guarded = [];
}
