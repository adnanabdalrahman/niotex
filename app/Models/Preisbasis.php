<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $NRPreisbasis
 * @property float|null $Preisfaktor
 * @property string|null $TimeStamp
 * @method static Builder<static>|Preisbasis newModelQuery()
 * @method static Builder<static>|Preisbasis newQuery()
 * @method static Builder<static>|Preisbasis query()
 * @method static Builder<static>|Preisbasis whereNRPreisbasis($value)
 * @method static Builder<static>|Preisbasis wherePreisfaktor($value)
 * @method static Builder<static>|Preisbasis whereTimeStamp($value)
 * @mixin Eloquent
 */
class Preisbasis extends Model
{

    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.Preisbasis';
    protected $primaryKey = 'NRPreisbasis';
    protected $guarded = [];
}
