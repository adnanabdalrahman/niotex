<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $InterneVorgangsnummer
 * @property int $InternePositionsnummer
 * @property int|null $InterneStuecklistenummer
 * @property int|null $PosStuecklistennummer
 * @property int|null $PosStkVerkaufspreis
 * @property int|null $PosStkEinkaufspreis
 * @property int|null $PosStkBestellpreis
 * @property int $PosStkAufAusgabeJN
 * @property int $PosStkBesAusgabeJN
 * @property int|null $PosStkAuftragLagerbuchung
 * @property int|null $PosStkBestellLagerbuchung
 * @property int|null $PosStkFertLagerbuchung
 * @property int $PosStkKalkulationsstopJN
 * @property int $PosStkBestellbeistellungJN
 * @property int $PosStkKundenbeistellungJN
 * @property int $PosStkKundenbeistellabgangJN
 * @property int $PosStkPseudobaugruppeJN
 * @property string|null $PosBeistellLagerGruppe
 * @property int|null $PosBeistellLagerortnummer
 * @property int $PosStkManuellJN
 * @property int|null $PosStkDispotermin
 * @property int|null $PosStkDispodifferenz
 * @property string|null $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste whereInternePositionsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste whereInterneStuecklistenummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste whereInterneVorgangsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosBeistellLagerGruppe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosBeistellLagerortnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkAufAusgabeJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkAuftragLagerbuchung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkBesAusgabeJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkBestellLagerbuchung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkBestellbeistellungJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkBestellpreis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkDispodifferenz($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkDispotermin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkEinkaufspreis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkFertLagerbuchung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkKalkulationsstopJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkKundenbeistellabgangJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkKundenbeistellungJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkManuellJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkPseudobaugruppeJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStkVerkaufspreis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste wherePosStuecklistennummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position6Stueckliste whereTimeStamp($value)
 * @mixin \Eloquent
 */
class Position6Stueckliste extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.Position6Stueckliste';
    protected $guarded = [];
    protected $primaryKey = 'InternePositionsnummer';
    protected $keyType = 'int';
}
