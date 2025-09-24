<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $ID
 * @property string $TYPE
 * @property string $VALUE
 * @property string $TimeStamp
 * @method static Builder<static>|Ceos_ID_SAP newModelQuery()
 * @method static Builder<static>|Ceos_ID_SAP newQuery()
 * @method static Builder<static>|Ceos_ID_SAP query()
 * @method static Builder<static>|Ceos_ID_SAP whereID($value)
 * @method static Builder<static>|Ceos_ID_SAP whereTYPE($value)
 * @method static Builder<static>|Ceos_ID_SAP whereTimeStamp($value)
 * @method static Builder<static>|Ceos_ID_SAP whereVALUE($value)
 * @mixin \Eloquent
 */
class Ceos_ID_SAP extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.Ceos_ID_SAP';
    protected $primaryKey = 'ID';
    protected $guarded = [];
}
