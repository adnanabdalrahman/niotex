<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property string $VorArt
 * @property string $VorGruppe
 * @property int $VNkArt
 * @property string $VNkName
 * @property int|null $VNkAnfangswert
 * @property int|null $VNkEndwert
 * @property int|null $VNkAktuellerWert
 * @property string|null $TimeStamp
 * @method static Builder<static>|NummernkreisVorgang newModelQuery()
 * @method static Builder<static>|NummernkreisVorgang newQuery()
 * @method static Builder<static>|NummernkreisVorgang query()
 * @method static Builder<static>|NummernkreisVorgang whereTimeStamp($value)
 * @method static Builder<static>|NummernkreisVorgang whereVNkAktuellerWert($value)
 * @method static Builder<static>|NummernkreisVorgang whereVNkAnfangswert($value)
 * @method static Builder<static>|NummernkreisVorgang whereVNkArt($value)
 * @method static Builder<static>|NummernkreisVorgang whereVNkEndwert($value)
 * @method static Builder<static>|NummernkreisVorgang whereVNkName($value)
 * @method static Builder<static>|NummernkreisVorgang whereVorArt($value)
 * @method static Builder<static>|NummernkreisVorgang whereVorGruppe($value)
 * @mixin Eloquent
 */
class NummernkreisVorgang extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.NummernkreisVorgang';
    protected $guarded = [];
    protected $primaryKey = null;

}
