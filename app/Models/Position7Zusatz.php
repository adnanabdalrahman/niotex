<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $InterneVorgangsnummer
 * @property int $InternePositionsnummer
 * @property string|null $KZIntraStat
 * @property int|null $GftArtID
 * @property int|null $NRWerkstoff
 * @property string|null $PosZeichnungsformat
 * @property string|null $PosZeichnungsnummer
 * @property float|null $PosAbwicklung
 * @property string|null $PosNorm
 * @property int|null $ReklamationID
 * @property int $PosErsatzteilJN
 * @property string|null $PosFreigabeAm
 * @property int|null $PosFreigabeDurch
 * @property int $PosPraeferenzJNA
 * @property int $PosPraeferenzDynamischJN
 * @property float|null $PosPraeferenzWert
 * @property int $PosServiceJN
 * @property float|null $PosKostenMehrkopien
 * @property int|null $PosFreikopien
 * @property int|null $PosZaehlerstandAlt
 * @property int|null $PosZaehlerstandNeu
 * @property int|null $PosZaehlerstandVK
 * @property int $PosAusNachkalkulationJN
 * @property int $PosMTZFixiertJN
 * @property float|null $PosMTZ
 * @property float|null $PosWerkstoffPreisbasis
 * @property float|null $PosWerkstoffAnteil
 * @property string|null $TimeStamp
 * @property int $PosBuchungsfreigabeJN
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz whereGftArtID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz whereInternePositionsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz whereInterneVorgangsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz whereKZIntraStat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz whereNRWerkstoff($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosAbwicklung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosAusNachkalkulationJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosBuchungsfreigabeJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosErsatzteilJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosFreigabeAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosFreigabeDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosFreikopien($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosKostenMehrkopien($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosMTZ($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosMTZFixiertJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosNorm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosPraeferenzDynamischJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosPraeferenzJNA($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosPraeferenzWert($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosServiceJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosWerkstoffAnteil($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosWerkstoffPreisbasis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosZaehlerstandAlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosZaehlerstandNeu($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosZaehlerstandVK($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosZeichnungsformat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz wherePosZeichnungsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz whereReklamationID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position7Zusatz whereTimeStamp($value)
 * @mixin \Eloquent
 */
class Position7Zusatz extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.Position7Zusatz';
    protected $guarded = [];
    protected $primaryKey = 'InternePositionsnummer';
    protected $keyType = 'int';
}
