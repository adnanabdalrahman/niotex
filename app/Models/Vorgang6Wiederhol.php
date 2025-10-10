<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $InterneVorgangsnummer
 * @property string|null $VorAbgeschlossenAb
 * @property string|null $VorUnterschriebenAm
 * @property string|null $VorGekuendigtZum
 * @property int|null $VorWiederholMonat
 * @property int|null $VorWiederholKennzeichen
 * @property int $VorDruckKennzeichen
 * @property string|null $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang6Wiederhol newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang6Wiederhol newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang6Wiederhol query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang6Wiederhol whereInterneVorgangsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang6Wiederhol whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang6Wiederhol whereVorAbgeschlossenAb($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang6Wiederhol whereVorDruckKennzeichen($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang6Wiederhol whereVorGekuendigtZum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang6Wiederhol whereVorUnterschriebenAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang6Wiederhol whereVorWiederholKennzeichen($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang6Wiederhol whereVorWiederholMonat($value)
 * @mixin \Eloquent
 */
class Vorgang6Wiederhol extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.Vorgang6Wiederhol';
    protected $primaryKey = 'InterneVorgangsnummer';
    protected $guarded = [];
}
