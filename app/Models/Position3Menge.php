<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $InterneVorgangsnummer
 * @property int $InternePositionsnummer
 * @property float $PosMenge1
 * @property float $PosMengeAuftrag1
 * @property float $PosMengeLieferung1
 * @property float $PosMengeAbrechnung1
 * @property float $PosMengeRechnung1
 * @property float $PosMengeVersand1
 * @property float $PosMengeAusschuss1
 * @property float $PosMenge2
 * @property float $PosMengeAuftrag2
 * @property float $PosMengeLieferung2
 * @property float $PosMengeAbrechnung2
 * @property float $PosMengeRechnung2
 * @property float $PosMengeVersand2
 * @property float $PosMengeAusschuss2
 * @property float $PosMultiplikator
 * @property float $PosMultiplikatorAuftrag
 * @property float $PosMultiplikatorLieferung
 * @property float $PosMultiplikatorAbrechnung
 * @property float $PosMultiplikatorRechnung
 * @property float $PosMultiplikatorVersand
 * @property string|null $PosKZMengeneinheit1
 * @property float|null $PosFaktorMengeneinheit2
 * @property int|null $PosTypMengeneinheit2
 * @property string|null $PosKZMengeneinheit2
 * @property string|null $PosKZGewichtseinheit
 * @property float|null $PosGewicht
 * @property int|null $PosGewichtsbasis
 * @property float $PosBundleMenge1
 * @property string|null $PosBundleMengeneinheit1
 * @property float $PosBundleMenge2
 * @property string|null $TimeStamp
 * @property float|null $PosMengeOriginal1
 * @property float|null $PosMengeOriginal2
 * @method static Builder<static>|Position3Menge newModelQuery()
 * @method static Builder<static>|Position3Menge newQuery()
 * @method static Builder<static>|Position3Menge query()
 * @method static Builder<static>|Position3Menge whereInternePositionsnummer($value)
 * @method static Builder<static>|Position3Menge whereInterneVorgangsnummer($value)
 * @method static Builder<static>|Position3Menge wherePosBundleMenge1($value)
 * @method static Builder<static>|Position3Menge wherePosBundleMenge2($value)
 * @method static Builder<static>|Position3Menge wherePosBundleMengeneinheit1($value)
 * @method static Builder<static>|Position3Menge wherePosFaktorMengeneinheit2($value)
 * @method static Builder<static>|Position3Menge wherePosGewicht($value)
 * @method static Builder<static>|Position3Menge wherePosGewichtsbasis($value)
 * @method static Builder<static>|Position3Menge wherePosKZGewichtseinheit($value)
 * @method static Builder<static>|Position3Menge wherePosKZMengeneinheit1($value)
 * @method static Builder<static>|Position3Menge wherePosKZMengeneinheit2($value)
 * @method static Builder<static>|Position3Menge wherePosMenge1($value)
 * @method static Builder<static>|Position3Menge wherePosMenge2($value)
 * @method static Builder<static>|Position3Menge wherePosMengeAbrechnung1($value)
 * @method static Builder<static>|Position3Menge wherePosMengeAbrechnung2($value)
 * @method static Builder<static>|Position3Menge wherePosMengeAuftrag1($value)
 * @method static Builder<static>|Position3Menge wherePosMengeAuftrag2($value)
 * @method static Builder<static>|Position3Menge wherePosMengeAusschuss1($value)
 * @method static Builder<static>|Position3Menge wherePosMengeAusschuss2($value)
 * @method static Builder<static>|Position3Menge wherePosMengeLieferung1($value)
 * @method static Builder<static>|Position3Menge wherePosMengeLieferung2($value)
 * @method static Builder<static>|Position3Menge wherePosMengeOriginal1($value)
 * @method static Builder<static>|Position3Menge wherePosMengeOriginal2($value)
 * @method static Builder<static>|Position3Menge wherePosMengeRechnung1($value)
 * @method static Builder<static>|Position3Menge wherePosMengeRechnung2($value)
 * @method static Builder<static>|Position3Menge wherePosMengeVersand1($value)
 * @method static Builder<static>|Position3Menge wherePosMengeVersand2($value)
 * @method static Builder<static>|Position3Menge wherePosMultiplikator($value)
 * @method static Builder<static>|Position3Menge wherePosMultiplikatorAbrechnung($value)
 * @method static Builder<static>|Position3Menge wherePosMultiplikatorAuftrag($value)
 * @method static Builder<static>|Position3Menge wherePosMultiplikatorLieferung($value)
 * @method static Builder<static>|Position3Menge wherePosMultiplikatorRechnung($value)
 * @method static Builder<static>|Position3Menge wherePosMultiplikatorVersand($value)
 * @method static Builder<static>|Position3Menge wherePosTypMengeneinheit2($value)
 * @method static Builder<static>|Position3Menge whereTimeStamp($value)
 * @mixin Eloquent
 */
class Position3Menge extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.Position3Menge';
    protected $guarded = [];
    protected $primaryKey = 'InternePositionsnummer';
    protected $keyType = 'int';

}
