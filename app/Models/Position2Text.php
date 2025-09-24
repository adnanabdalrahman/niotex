<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $InterneVorgangsnummer
 * @property int $InternePositionsnummer
 * @property string|null $PosBezeichnung2
 * @property string|null $PosBezeichnung3
 * @property string|null $PosZusatztext
 * @property string|null $PosBetreff
 * @property string|null $PosZusatztextAngebot
 * @property string|null $PosZusatztextAuftrag
 * @property string|null $PosZusatztextLieferschein
 * @property string|null $PosZusatztextRechnung
 * @property string|null $PosZusatztextArbeitskarte
 * @property string|null $PosNotiz
 * @property string|null $PosVariante
 * @property string|null $PosFormelVK
 * @property string|null $PosFormelMengeneinheit2
 * @property string|null $PosFormelMengeneinheit1
 * @property string|null $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text whereInternePositionsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text whereInterneVorgangsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text wherePosBetreff($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text wherePosBezeichnung2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text wherePosBezeichnung3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text wherePosFormelMengeneinheit1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text wherePosFormelMengeneinheit2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text wherePosFormelVK($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text wherePosNotiz($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text wherePosVariante($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text wherePosZusatztext($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text wherePosZusatztextAngebot($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text wherePosZusatztextArbeitskarte($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text wherePosZusatztextAuftrag($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text wherePosZusatztextLieferschein($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text wherePosZusatztextRechnung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position2Text whereTimeStamp($value)
 * @mixin Eloquent
 */
class Position2Text extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.Position2Text';
    protected $guarded = [];
    protected $primaryKey = 'InternePositionsnummer';
    protected $keyType = 'int';
}
