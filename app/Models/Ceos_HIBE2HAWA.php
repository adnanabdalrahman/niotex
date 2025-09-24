<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $ID
 * @property int $HIBE
 * @property int $HAWA01
 * @property int|null $HAWA02
 * @property int|null $HAWA03
 * @property int|null $HAWA04
 * @property int|null $HAWA05
 * @property int|null $HAWA06
 * @property int|null $HAWA07
 * @property int|null $HAWA08
 * @property int|null $HAWA09
 * @property int|null $HAWA10
 * @property string $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA whereHAWA01($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA whereHAWA02($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA whereHAWA03($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA whereHAWA04($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA whereHAWA05($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA whereHAWA06($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA whereHAWA07($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA whereHAWA08($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA whereHAWA09($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA whereHAWA10($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA whereHIBE($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA whereID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_HIBE2HAWA whereTimeStamp($value)
 * @mixin \Eloquent
 */
class Ceos_HIBE2HAWA extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.Ceos_HIBE2HAWA';
    protected $primaryKey = 'ID';
    protected $guarded = [];
}
