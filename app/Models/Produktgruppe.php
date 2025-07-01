<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $KZProduktgruppe
 * @property string|null $PgrBezeichnung
 * @property string|null $PgrNotiz
 * @property string|null $TimeStamp
 * @property int $PgrInaktivJN
 * @method static Builder<static>|Produktgruppe newModelQuery()
 * @method static Builder<static>|Produktgruppe newQuery()
 * @method static Builder<static>|Produktgruppe query()
 * @method static Builder<static>|Produktgruppe whereKZProduktgruppe($value)
 * @method static Builder<static>|Produktgruppe wherePgrBezeichnung($value)
 * @method static Builder<static>|Produktgruppe wherePgrInaktivJN($value)
 * @method static Builder<static>|Produktgruppe wherePgrNotiz($value)
 * @method static Builder<static>|Produktgruppe whereTimeStamp($value)
 * @mixin Eloquent
 */
class Produktgruppe extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.Produktgruppe';
    protected $primaryKey = 'KZProduktgruppe';
    protected $guarded = [];
}
