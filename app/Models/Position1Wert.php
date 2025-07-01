<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert query()
 * @property int $InterneVorgangsnummer
 * @property int $InternePositionsnummer
 * @property int $PosRabattfaehig
 * @property int $PosRabattUnterpositionJN
 * @property float $PosRabattPosition1
 * @property float $PosRabattPosition2
 * @property float $PosRabattPosition3
 * @property float|null $PosRabattAdresse
 * @property float $PosRabattWert1
 * @property float $PosRabattWert2
 * @property int $NRPreisbasis
 * @property float $PosPreisfaktor
 * @property int $PosPreisProME2
 * @property float $PosPreisEinzel
 * @property float $PosPreisUnterposition
 * @property float $PosPreisUnterposLager
 * @property float $PosPreisPosition
 * @property float $PosGesamteinzelpreis
 * @property float $PosGesamtpreisVorRabatt
 * @property float $PosGesamtpreis
 * @property float $PosPreisEinkauf
 * @property float $PosPreisEinkaufOriginal
 * @property float $PosPreisEinkaufUnterposition
 * @property float $PosPreisEinkaufVT
 * @property float $PosPreisEinkaufUnterpositionVT
 * @property float $PosGesamteinzelpreisEK
 * @property float $PosGesamtpreisEK
 * @property float $PosGesamteinzelpreisEKVT
 * @property float $PosGesamtpreisEKVT
 * @property float|null $PosPreisVerbindlichkeit
 * @property float $PosRundungsfaktorVK
 * @property float $PosAbzugEK
 * @property int $MwstNummer
 * @property float|null $PosMwstProzent
 * @property float $PosVerschnitt
 * @property float|null $PosProvisionProzent
 * @property string|null $PosPreisermittlungVK
 * @property string|null $PosPreisermittlungEK
 * @property string|null $PosPreisermittlungRabatt1
 * @property string|null $PosPreisermittlungRabatt2
 * @property string|null $PosPreisermittlungRabatt3
 * @property string|null $PosPreisermittlungRabattWert1
 * @property string|null $PosPreisermittlungRabattWert2
 * @property string|null $TimeStamp
 * @property float $PosDBEinzel
 * @property float $PosDBGesamt
 * @property float $PosDBProzent
 * @property float $PosDBAufschlag
 * @property int|null $WithholdingtaxKategorieID
 * @property float|null $PosWHTProzent
 * @property float|null $PosPreisEinzelBrutto
 * @property float|null $PosPreisPositionBrutto
 * @property float|null $PosGesamtpreisVorRabattBrutto
 * @property float|null $PosGesamteinzelpreisBrutto
 * @property float|null $PosGesamtpreisBrutto
 * @property int $PosSkontofaehigJN
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert whereInternePositionsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert whereInterneVorgangsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert whereMwstNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert whereNRPreisbasis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosAbzugEK($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosDBAufschlag($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosDBEinzel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosDBGesamt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosDBProzent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosGesamteinzelpreis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosGesamteinzelpreisBrutto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosGesamteinzelpreisEK($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosGesamteinzelpreisEKVT($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosGesamtpreis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosGesamtpreisBrutto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosGesamtpreisEK($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosGesamtpreisEKVT($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosGesamtpreisVorRabatt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosGesamtpreisVorRabattBrutto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosMwstProzent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisEinkauf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisEinkaufOriginal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisEinkaufUnterposition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisEinkaufUnterpositionVT($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisEinkaufVT($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisEinzel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisEinzelBrutto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisPositionBrutto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisProME2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisUnterposLager($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisUnterposition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisVerbindlichkeit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisermittlungEK($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisermittlungRabatt1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisermittlungRabatt2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisermittlungRabatt3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisermittlungRabattWert1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisermittlungRabattWert2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisermittlungVK($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosPreisfaktor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosProvisionProzent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosRabattAdresse($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosRabattPosition1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosRabattPosition2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosRabattPosition3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosRabattUnterpositionJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosRabattWert1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosRabattWert2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosRabattfaehig($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosRundungsfaktorVK($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosSkontofaehigJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosVerschnitt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert wherePosWHTProzent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position1Wert whereWithholdingtaxKategorieID($value)
 * @mixin \Eloquent
 */
class Position1Wert extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.Position1Wert';
    protected $guarded = [];
    protected $primaryKey = 'InternePositionsnummer';
    protected $keyType = 'int';
}
