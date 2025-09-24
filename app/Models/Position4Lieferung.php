<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $InterneVorgangsnummer
 * @property int $InternePositionsnummer
 * @property int|null $PosLieferungAmWoche
 * @property int|null $PosLieferungAmJahr
 * @property string|null $PosLieferterminAm
 * @property string|null $PosLieferterminDispoAm
 * @property int|null $PosLieferungWunschWoche
 * @property int|null $PosLieferungWunschJahr
 * @property string|null $PosLieferterminWunsch
 * @property string|null $PosLieferterminDispoWunsch
 * @property string|null $PosLieferterminText
 * @property string|null $PosBestaetigungsnummer
 * @property string|null $PosBestaetigungAm
 * @property int $PosLiefertermineJN
 * @property string|null $PosVersandtermin
 * @property string|null $PosVersandTransportmittel
 * @property int $PosVerladenJN
 * @property string|null $PosFertigungstermin
 * @property string|null $PosFruehestensVerfuegbarAm
 * @property int|null $PosFruehestensVerfuegbarGrund
 * @property string|null $TimeStamp
 * @property int|null $PosMahnstufe
 * @property int|null $PosMahnstufeBestaetigung
 * @property int|null $PosMahnfolgetage
 * @property int|null $PosMahnfolgetageBestaetigung
 * @property string|null $PosLetzteMahnungAm
 * @property string|null $PosLetzteMahnungBestaetigungAm
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung whereInternePositionsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung whereInterneVorgangsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosBestaetigungAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosBestaetigungsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosFertigungstermin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosFruehestensVerfuegbarAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosFruehestensVerfuegbarGrund($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosLetzteMahnungAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosLetzteMahnungBestaetigungAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosLieferterminAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosLieferterminDispoAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosLieferterminDispoWunsch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosLieferterminText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosLieferterminWunsch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosLiefertermineJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosLieferungAmJahr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosLieferungAmWoche($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosLieferungWunschJahr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosLieferungWunschWoche($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosMahnfolgetage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosMahnfolgetageBestaetigung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosMahnstufe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosMahnstufeBestaetigung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosVerladenJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosVersandTransportmittel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung wherePosVersandtermin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position4Lieferung whereTimeStamp($value)
 * @mixin \Eloquent
 */
class Position4Lieferung extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.Position4Lieferung';
    protected $guarded = [];
    protected $primaryKey = 'InternePositionsnummer';
    protected $keyType = 'int';
}
