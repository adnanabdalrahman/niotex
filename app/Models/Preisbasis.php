<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $NRPreisbasis
 * @property float|null $Preisfaktor
 * @property string|null $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Preisbasis newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Preisbasis newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Preisbasis query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Preisbasis whereNRPreisbasis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Preisbasis wherePreisfaktor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Preisbasis whereTimeStamp($value)
 * @mixin \Eloquent
 */
class Preisbasis extends Model
{

    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.Preisbasis';
    protected $primaryKey = 'NRPreisbasis';
    protected $guarded = [];
}
