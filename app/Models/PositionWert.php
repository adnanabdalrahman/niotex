<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $PositionWertID
 * @property int $InterneVorgangsnummer
 * @property int $InternePositionsnummer
 * @property float|null $PosWPreisPositionGesamt
 * @property float|null $PosWPreisPositionAuftrag
 * @property float|null $PosWPreisPositionAbrechnung
 * @property float|null $PosWPreisPositionLieferung
 * @property float|null $PosWPreisPositionVersand
 * @property float|null $PosWPreisPositionGut
 * @property float|null $PosWPreisPositionRechnung
 * @property float|null $PosWGesamtpreisVorRabattGes
 * @property float|null $PosWGesamtpreisVorRabattAuf
 * @property float|null $PosWGesamtpreisVorRabattAbr
 * @property float|null $PosWGesamtpreisVorRabattLief
 * @property float|null $PosWGesamtpreisVorRabattVers
 * @property float|null $PosWGesamtpreisVorRabattGut
 * @property float|null $PosWGesamtpreisVorRabattRec
 * @property float|null $PosWGesamtpreisGesamt
 * @property float|null $PosWGesamtpreisAuftrag
 * @property float|null $PosWGesamtpreisAbrechnung
 * @property float|null $PosWGesamtpreisLieferung
 * @property float|null $PosWGesamtpreisVersand
 * @property float|null $PosWGesamtpreisGut
 * @property float|null $PosWGesamtpreisRechnung
 * @property float|null $PosWGesamtpreisEKGesamt
 * @property float|null $PosWGesamtpreisEKAuftrag
 * @property float|null $PosWGesamtpreisEKAbrechnung
 * @property float|null $PosWGesamtpreisEKLieferung
 * @property float|null $PosWGesamtpreisEKVersand
 * @property float|null $PosWGesamtpreisEKGut
 * @property float|null $PosWGesamtpreisEKRechnung
 * @property float|null $PosWGesamtpreisEKVTGesamt
 * @property float|null $PosWGesamtpreisEKVTAuftrag
 * @property float|null $PosWGesamtpreisEKVTAbrechnung
 * @property float|null $PosWGesamtpreisEKVTLieferung
 * @property float|null $PosWGesamtpreisEKVTVersand
 * @property float|null $PosWGesamtpreisEKVTGut
 * @property float|null $PosWGesamtpreisEKVTRechnung
 * @property float|null $PosWMengeGesamt1
 * @property float|null $PosWMengeGesamt2
 * @property float|null $PosWMengeAuftrag1
 * @property float|null $PosWMengeAuftrag2
 * @property float|null $PosWMengeAbrechnung1
 * @property float|null $PosWMengeAbrechnung2
 * @property float|null $PosWMengeLieferung1
 * @property float|null $PosWMengeLieferung2
 * @property float|null $PosWMengeVersand1
 * @property float|null $PosWMengeVersand2
 * @property float|null $PosWMengeGut1
 * @property float|null $PosWMengeGut2
 * @property float|null $PosWMengeRechnung1
 * @property float|null $PosWMengeRechnung2
 * @property float|null $PosWEinzelpreisMinusRabatt
 * @property string|null $TimeStamp
 * @method static Builder<static>|PositionWert newModelQuery()
 * @method static Builder<static>|PositionWert newQuery()
 * @method static Builder<static>|PositionWert query()
 * @method static Builder<static>|PositionWert whereInternePositionsnummer($value)
 * @method static Builder<static>|PositionWert whereInterneVorgangsnummer($value)
 * @method static Builder<static>|PositionWert wherePosWEinzelpreisMinusRabatt($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisAbrechnung($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisAuftrag($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisEKAbrechnung($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisEKAuftrag($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisEKGesamt($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisEKGut($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisEKLieferung($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisEKRechnung($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisEKVTAbrechnung($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisEKVTAuftrag($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisEKVTGesamt($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisEKVTGut($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisEKVTLieferung($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisEKVTRechnung($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisEKVTVersand($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisEKVersand($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisGesamt($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisGut($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisLieferung($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisRechnung($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisVersand($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisVorRabattAbr($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisVorRabattAuf($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisVorRabattGes($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisVorRabattGut($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisVorRabattLief($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisVorRabattRec($value)
 * @method static Builder<static>|PositionWert wherePosWGesamtpreisVorRabattVers($value)
 * @method static Builder<static>|PositionWert wherePosWMengeAbrechnung1($value)
 * @method static Builder<static>|PositionWert wherePosWMengeAbrechnung2($value)
 * @method static Builder<static>|PositionWert wherePosWMengeAuftrag1($value)
 * @method static Builder<static>|PositionWert wherePosWMengeAuftrag2($value)
 * @method static Builder<static>|PositionWert wherePosWMengeGesamt1($value)
 * @method static Builder<static>|PositionWert wherePosWMengeGesamt2($value)
 * @method static Builder<static>|PositionWert wherePosWMengeGut1($value)
 * @method static Builder<static>|PositionWert wherePosWMengeGut2($value)
 * @method static Builder<static>|PositionWert wherePosWMengeLieferung1($value)
 * @method static Builder<static>|PositionWert wherePosWMengeLieferung2($value)
 * @method static Builder<static>|PositionWert wherePosWMengeRechnung1($value)
 * @method static Builder<static>|PositionWert wherePosWMengeRechnung2($value)
 * @method static Builder<static>|PositionWert wherePosWMengeVersand1($value)
 * @method static Builder<static>|PositionWert wherePosWMengeVersand2($value)
 * @method static Builder<static>|PositionWert wherePosWPreisPositionAbrechnung($value)
 * @method static Builder<static>|PositionWert wherePosWPreisPositionAuftrag($value)
 * @method static Builder<static>|PositionWert wherePosWPreisPositionGesamt($value)
 * @method static Builder<static>|PositionWert wherePosWPreisPositionGut($value)
 * @method static Builder<static>|PositionWert wherePosWPreisPositionLieferung($value)
 * @method static Builder<static>|PositionWert wherePosWPreisPositionRechnung($value)
 * @method static Builder<static>|PositionWert wherePosWPreisPositionVersand($value)
 * @method static Builder<static>|PositionWert wherePositionWertID($value)
 * @method static Builder<static>|PositionWert whereTimeStamp($value)
 * @mixin Eloquent
 */
class PositionWert extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.PositionWert';
    protected $guarded = [];
    protected $primaryKey = 'InternePositionsnummer';
    protected $keyType = 'int';
}
