<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $InterneVorgangsnummer
 * @property int $InternePositionsnummer
 * @property int $PosNummer
 * @property int|null $PosVorgaenger
 * @property string|null $Liegenschaftsnummer
 * @property string|null $WE
 * @property string|null $PosNummernText
 * @property string|null $Nutzernummer
 * @property float|null $WE_Nummer
 * @property string|null $PosBezeichnung1
 * @property string|null $KZWarengruppe
 * @property string|null $KZArtikelgruppe
 * @property string|null $Adresse
 * @property float|null $Wohnfläche
 * @property string|null $EinzugAktuellesJahr
 * @property string|null $AuszugAktuellesJahr
 * @property string|null $EinzugVorjahr
 * @property string|null $AuszugVorjahr
 * @property string|null $GeraeteNummer
 * @property string|null $GeraeteNummer_ASM
 * @property string|null $Artikelnummer
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakLiegenschaftDevice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakLiegenschaftDevice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakLiegenschaftDevice query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakLiegenschaftDevice whereAdresse($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakLiegenschaftDevice whereArtikelnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakLiegenschaftDevice whereAuszugAktuellesJahr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakLiegenschaftDevice whereAuszugVorjahr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakLiegenschaftDevice whereEinzugAktuellesJahr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakLiegenschaftDevice whereEinzugVorjahr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakLiegenschaftDevice whereGeraeteNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakLiegenschaftDevice whereGeraeteNummerASM($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakLiegenschaftDevice whereInternePositionsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakLiegenschaftDevice whereInterneVorgangsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakLiegenschaftDevice whereKZArtikelgruppe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakLiegenschaftDevice whereKZWarengruppe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakLiegenschaftDevice whereLiegenschaftsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakLiegenschaftDevice whereNutzernummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakLiegenschaftDevice wherePosBezeichnung1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakLiegenschaftDevice wherePosNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakLiegenschaftDevice wherePosNummernText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakLiegenschaftDevice wherePosVorgaenger($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakLiegenschaftDevice whereWE($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakLiegenschaftDevice whereWENummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakLiegenschaftDevice whereWohnfläche($value)
 * @mixin \Eloquent
 */
class RakLiegenschaftDevice extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.V_RakABNutzerGaerete';
    protected $primaryKey = null;
    protected $guarded = [];
}
