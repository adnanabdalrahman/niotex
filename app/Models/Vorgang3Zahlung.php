<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $InterneVorgangsnummer
 * @property string|null $VorMahnungAb
 * @property string|null $KZMahnkennzeichen
 * @property string|null $VorLetzteMahnungAm
 * @property int|null $VorLetzteMahnungDurch
 * @property int|null $VorZieltage
 * @property int|null $VorSkontotage1
 * @property float|null $VorSkontosatz1
 * @property int|null $VorSkontotage2
 * @property float|null $VorSkontosatz2
 * @property int|null $VorSkontotage3
 * @property float|null $VorSkontosatz3
 * @property int|null $VorKarenztage
 * @property int $VorSonderkonditionenJN
 * @property int $VorBonusAbrechnungJN
 * @property int $VorZbdVariabelJN
 * @property int|null $VorBerechnungstagVon1
 * @property int|null $VorBerechnungstagBis1
 * @property int|null $VorFaelligkeitstag1
 * @property int|null $VorFolgemonat1
 * @property int|null $VorBerechnungstagVon2
 * @property int|null $VorBerechnungstagBis2
 * @property int|null $VorFaelligkeitstag2
 * @property int|null $VorFolgemonat2
 * @property string|null $TimeStamp
 * @property int|null $VorMahnstufe
 * @property int|null $VorMahnFolgetage
 * @property int|null $VorMahnStufeBestaetig
 * @property int|null $VorMahnFolgetageBestaetig
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereInterneVorgangsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereKZMahnkennzeichen($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorBerechnungstagBis1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorBerechnungstagBis2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorBerechnungstagVon1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorBerechnungstagVon2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorBonusAbrechnungJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorFaelligkeitstag1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorFaelligkeitstag2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorFolgemonat1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorFolgemonat2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorKarenztage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorLetzteMahnungAm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorLetzteMahnungDurch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorMahnFolgetage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorMahnFolgetageBestaetig($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorMahnStufeBestaetig($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorMahnstufe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorMahnungAb($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorSkontosatz1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorSkontosatz2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorSkontosatz3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorSkontotage1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorSkontotage2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorSkontotage3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorSonderkonditionenJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorZbdVariabelJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang3Zahlung whereVorZieltage($value)
 * @mixin \Eloquent
 */
class Vorgang3Zahlung extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.Vorgang3Zahlung';
    protected $primaryKey = 'InterneVorgangsnummer';
    protected $guarded = [];
}
