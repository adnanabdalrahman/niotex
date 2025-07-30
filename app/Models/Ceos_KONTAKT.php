<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $KontaktID
 * @property int|null $KON_FOREIGN_ID
 * @property int $User
 * @property string|null $DateStamp
 * @property string $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KONTAKT newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KONTAKT newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KONTAKT query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KONTAKT whereDateStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KONTAKT whereKONFOREIGNID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KONTAKT whereKontaktID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KONTAKT whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_KONTAKT whereUser($value)
 * @mixin \Eloquent
 */
class Ceos_KONTAKT extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.Ceos_KONTAKT';
    protected $primaryKey = 'KontaktID';
    protected $guarded = [];
}
