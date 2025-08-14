<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $InterneVorgangsnummer
 * @property int|null $VorFrachtRechnungsanschrift
 * @property string|null $VorFrachtText
 * @property float|null $VorFrachtSendungWert
 * @property string|null $VorVersandtermin
 * @property string|null $VorVersandTransportmittel
 * @property int|null $VorVersandPaketanzahl
 * @property int $VorTransportversicherungJN
 * @property float|null $VorGesamtGewicht
 * @property float|null $VorLieferGewicht
 * @property string|null $KZVorLiefGewichteinheit
 * @property int|null $VersandFormID
 * @property int|null $VersandVerpackungID
 * @property float|null $VorVersandGrundkosten
 * @property float|null $VorVersandZusatzkosten
 * @property int $VorVersandPrivatZustJN
 * @property float|null $VorVersandWarenwert
 * @property float|null $VorVersandWarenwertIntern
 * @property string|null $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereInterneVorgangsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereKZVorLiefGewichteinheit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVersandFormID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVersandVerpackungID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVorFrachtRechnungsanschrift($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVorFrachtSendungWert($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVorFrachtText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVorGesamtGewicht($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVorLieferGewicht($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVorTransportversicherungJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVorVersandGrundkosten($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVorVersandPaketanzahl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVorVersandPrivatZustJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVorVersandTransportmittel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVorVersandWarenwert($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVorVersandWarenwertIntern($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVorVersandZusatzkosten($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang4Versand whereVorVersandtermin($value)
 * @mixin \Eloquent
 */
class Vorgang4Versand extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.Vorgang4Versand';
    protected $primaryKey = 'InterneVorgangsnummer';
    protected $guarded = [];
}
