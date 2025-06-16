<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $KZProduktgruppe
 * @property string|null $PgrBezeichnung
 * @property string|null $PgrNotiz
 * @property string|null $TimeStamp
 * @property int $PgrInaktivJN
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produktgruppe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produktgruppe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produktgruppe query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produktgruppe whereKZProduktgruppe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produktgruppe wherePgrBezeichnung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produktgruppe wherePgrInaktivJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produktgruppe wherePgrNotiz($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Produktgruppe whereTimeStamp($value)
 * @mixin \Eloquent
 */
class Produktgruppe extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.Produktgruppe';
    protected $primaryKey = 'KZProduktgruppe';
    protected $guarded = [];
}
