<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $InterneVorgangsnummer
 * @property int $InternePositionsnummer
 * @property float|null $PosAbmasse1
 * @property float|null $PosAbmasse2
 * @property float|null $PosAbmasse3
 * @property float|null $PosAbmasse4
 * @property float|null $PosIndividualD1
 * @property float|null $PosIndividualD2
 * @property float|null $PosIndividualD3
 * @property float|null $PosIndividualD4
 * @property float|null $PosIndividualD5
 * @property float|null $PosIndividualD6
 * @property float|null $PosIndividualD7
 * @property float|null $PosIndividualD8
 * @property float|null $PosIndividualD9
 * @property float|null $PosIndividualD10
 * @property string|null $PosIndividualC1
 * @property string|null $PosIndividualC2
 * @property string|null $PosIndividualC3
 * @property string|null $PosIndividualC4
 * @property string|null $PosIndividualC5
 * @property string|null $PosIndividualC6
 * @property string|null $PosIndividualC7
 * @property string|null $PosIndividualC8
 * @property string|null $PosIndividualC9
 * @property string|null $PosIndividualC10
 * @property string|null $PosIndividualT1
 * @property string|null $PosIndividualT2
 * @property string|null $PosIndividualT3
 * @property string|null $PosIndividualT4
 * @property string|null $PosIndividualT5
 * @property string|null $PosIndividualT6
 * @property int|null $PosIndividualCombo1
 * @property int|null $PosIndividualCombo2
 * @property int|null $PosIndividualCombo3
 * @property int|null $PosIndividualCombo4
 * @property int|null $PosIndividualCombo5
 * @property int|null $PosIndividualCombo6
 * @property int|null $PosIndividualCombo7
 * @property int|null $PosIndividualCombo8
 * @property string|null $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual whereInternePositionsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual whereInterneVorgangsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosAbmasse1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosAbmasse2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosAbmasse3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosAbmasse4($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualC1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualC10($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualC2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualC3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualC4($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualC5($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualC6($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualC7($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualC8($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualC9($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualCombo1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualCombo2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualCombo3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualCombo4($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualCombo5($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualCombo6($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualCombo7($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualCombo8($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualD1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualD10($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualD2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualD3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualD4($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualD5($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualD6($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualD7($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualD8($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualD9($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualT1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualT2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualT3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualT4($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualT5($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual wherePosIndividualT6($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position5Individual whereTimeStamp($value)
 * @mixin \Eloquent
 */
class Position5Individual extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.Position5Individual';
    protected $guarded = [];
    protected $primaryKey = 'InternePositionsnummer';
    protected $keyType = 'int';
}
