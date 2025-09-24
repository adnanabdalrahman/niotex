<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $VerwaltungID
 * @property int|null $VER_FOREIGN_ID
 * @property int $User
 * @property string|null $DateStamp
 * @property string $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_VERWALTUNG newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_VERWALTUNG newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_VERWALTUNG query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_VERWALTUNG whereDateStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_VERWALTUNG whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_VERWALTUNG whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_VERWALTUNG whereVERFOREIGNID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_VERWALTUNG whereVerwaltungID($value)
 * @mixin \Eloquent
 */
class Ceos_VERWALTUNG extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.Ceos_VERWALTUNG';
    protected $primaryKey = 'VerwaltungID';
    protected $guarded = [];
}
