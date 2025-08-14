<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * 
 *
 * @property int $InterneVorgangsnummer
 * @property string|null $VorEinleitungstext
 * @property int|null $VorEinleitungstextForm
 * @property string|null $VorSchlusstext
 * @property int|null $VorSchlusstextForm
 * @property string|null $VorFusstext
 * @property int|null $VorFusstextForm
 * @property string|null $VorNotiz
 * @property int|null $VorNotizForm
 * @property string|null $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang2Text newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang2Text newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang2Text query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang2Text whereInterneVorgangsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang2Text whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang2Text whereVorEinleitungstext($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang2Text whereVorEinleitungstextForm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang2Text whereVorFusstext($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang2Text whereVorFusstextForm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang2Text whereVorNotiz($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang2Text whereVorNotizForm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang2Text whereVorSchlusstext($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang2Text whereVorSchlusstextForm($value)
 * @mixin \Eloquent
 */
class Vorgang2Text extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.Vorgang2Text';
    protected $primaryKey = 'InterneVorgangsnummer';
    protected $guarded = [];

}
