<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $KostenID
 * @property int|null $KOS_FOREIGN_ID
 * @property int $User
 * @property string|null $DateStamp
 * @property string $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KOSTEN newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KOSTEN newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KOSTEN query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KOSTEN whereDateStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KOSTEN whereKOSFOREIGNID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KOSTEN whereKostenID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KOSTEN whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KOSTEN whereUser($value)
 * @property string $KOS_COMP_API_ID
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KOSTEN whereKOSCOMPAPIID($value)
 * @mixin \Eloquent
 */
class Ceos_KOSTEN extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.Ceos_KOSTEN';
    protected $primaryKey = 'KostenID';
    protected $guarded = [];
}
