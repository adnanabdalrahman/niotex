<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $InterneVorgangsnummer
 * @property float|null $VorRabattProzent
 * @property float|null $VorZusRabattProzent
 * @property float|null $VorAdrRabattProzent
 * @property float|null $VorNettowert
 * @property float|null $VorNettowertMwst1
 * @property float|null $VorNettowertMwst2
 * @property float|null $VorNettowertMwst3
 * @property int|null $VorMwstSatz1
 * @property int|null $VorMwstSatz2
 * @property int|null $VorMwstSatz3
 * @property float|null $VorMwstSatzProzent1
 * @property float|null $VorMwstSatzProzent2
 * @property float|null $VorMwstSatzProzent3
 * @property float|null $VorNettoMinusRabatt
 * @property float|null $VorNettoPlusZusatzkosten
 * @property float|null $VorNettoAKonto
 * @property float|null $VorMwstAKonto
 * @property float|null $VorNettoMinusAKonto
 * @property float|null $VorBruttowert
 * @property float|null $VorBruttowertBezahlt
 * @property float|null $VorBruttowertZusatzkonto
 * @property float|null $VorBruttowertSkonto
 * @property float|null $VorNettoEinkauf
 * @property float|null $VorNettoEinkaufVT
 * @property float|null $VorNettoEinkaufAKonto
 * @property float|null $VorNettoEinkaufAKontoVT
 * @property float|null $VorNettoEinkaufOhneNachkalk
 * @property float|null $VorNettoEinkaufOhneNachkalkVT
 * @property float|null $VorNettoEinkaufNachkalk
 * @property float|null $VorNettoEinkaufNachkalkVT
 * @property float|null $VorWertZusatzkosten1
 * @property float|null $VorWertZusatzkosten2
 * @property float|null $VorWertZusatzkosten3
 * @property float|null $VorWertZusatzkosten4
 * @property float|null $VorWertZusatzkosten5
 * @property string|null $VorTextZusatzkosten4
 * @property string|null $VorTextZusatzkosten5
 * @property int|null $VorMwstSatzZusatzkosten1
 * @property int|null $VorMwstSatzZusatzkosten2
 * @property int|null $VorMwstSatzZusatzkosten3
 * @property int|null $VorMwstSatzZusatzkosten4
 * @property int|null $VorMwstSatzZusatzkosten5
 * @property float|null $VorMwstSatzProzentZusatzkosten1
 * @property float|null $VorMwstSatzProzentZusatzkosten2
 * @property float|null $VorMwstSatzProzentZusatzkosten3
 * @property float|null $VorMwstSatzProzentZusatzkosten4
 * @property float|null $VorMwstSatzProzentZusatzkosten5
 * @property int|null $VorKontoGruppeZusatzkosten1
 * @property int|null $VorKontoGruppeZusatzkosten2
 * @property int|null $VorKontoGruppeZusatzkosten3
 * @property int|null $VorKontoGruppeZusatzkosten4
 * @property int|null $VorKontoGruppeZusatzkosten5
 * @property float|null $VorBruttowertOriginal
 * @property string|null $VorTextMwstOriginal1
 * @property string|null $VorTextMwstOriginal2
 * @property string|null $VorTextMwstOriginal3
 * @property string|null $VorTextMwstOriginal4
 * @property float|null $VorMwstwertOriginal1
 * @property float|null $VorMwstwertOriginal2
 * @property float|null $VorMwstwertOriginal3
 * @property float|null $VorMwstwertOriginal4
 * @property string|null $TimeStamp
 * @property float|null $VorWHTWert1
 * @property float|null $VorWHTWert2
 * @property float|null $VorWHTWert3
 * @property float|null $VorWHTProzent1
 * @property float|null $VorWHTProzent2
 * @property float|null $VorWHTProzent3
 * @property int|null $VorWHTKat1
 * @property int|null $VorWHTKat2
 * @property int|null $VorWHTKat3
 * @property float $VorNettowertRabattfaehig
 * @property float|null $VorRabattfaehigMwst1
 * @property float|null $VorRabattfaehigMwst2
 * @property float|null $VorRabattfaehigMwst3
 * @property float|null $VorGesamtrabatt
 * @property int $VorPosRabattfaehigJN
 * @property int $VorRabattKumulativJN
 * @property float|null $VorPositionswertBrutto
 * @property float|null $VorRabattWert
 * @property float|null $VorSkontofaehigMwst1
 * @property float|null $VorSkontofaehigMwst2
 * @property float|null $VorSkontofaehigMwst3
 * @property float|null $VorSkontofaehigBrutto
 * @property int $VorSkontofaehigZusatzkosten1JN
 * @property int $VorSkontofaehigZusatzkosten2JN
 * @property int $VorSkontofaehigZusatzkosten3JN
 * @property int $VorSkontofaehigZusatzkosten4JN
 * @property int $VorSkontofaehigZusatzkosten5JN
 * @method static Builder<static>|Vorgang1Wert newModelQuery()
 * @method static Builder<static>|Vorgang1Wert newQuery()
 * @method static Builder<static>|Vorgang1Wert query()
 * @method static Builder<static>|Vorgang1Wert whereInterneVorgangsnummer($value)
 * @method static Builder<static>|Vorgang1Wert whereTimeStamp($value)
 * @method static Builder<static>|Vorgang1Wert whereVorAdrRabattProzent($value)
 * @method static Builder<static>|Vorgang1Wert whereVorBruttowert($value)
 * @method static Builder<static>|Vorgang1Wert whereVorBruttowertBezahlt($value)
 * @method static Builder<static>|Vorgang1Wert whereVorBruttowertOriginal($value)
 * @method static Builder<static>|Vorgang1Wert whereVorBruttowertSkonto($value)
 * @method static Builder<static>|Vorgang1Wert whereVorBruttowertZusatzkonto($value)
 * @method static Builder<static>|Vorgang1Wert whereVorGesamtrabatt($value)
 * @method static Builder<static>|Vorgang1Wert whereVorKontoGruppeZusatzkosten1($value)
 * @method static Builder<static>|Vorgang1Wert whereVorKontoGruppeZusatzkosten2($value)
 * @method static Builder<static>|Vorgang1Wert whereVorKontoGruppeZusatzkosten3($value)
 * @method static Builder<static>|Vorgang1Wert whereVorKontoGruppeZusatzkosten4($value)
 * @method static Builder<static>|Vorgang1Wert whereVorKontoGruppeZusatzkosten5($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstAKonto($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatz1($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatz2($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatz3($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatzProzent1($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatzProzent2($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatzProzent3($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatzProzentZusatzkosten1($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatzProzentZusatzkosten2($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatzProzentZusatzkosten3($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatzProzentZusatzkosten4($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatzProzentZusatzkosten5($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatzZusatzkosten1($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatzZusatzkosten2($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatzZusatzkosten3($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatzZusatzkosten4($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstSatzZusatzkosten5($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstwertOriginal1($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstwertOriginal2($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstwertOriginal3($value)
 * @method static Builder<static>|Vorgang1Wert whereVorMwstwertOriginal4($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettoAKonto($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettoEinkauf($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettoEinkaufAKonto($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettoEinkaufAKontoVT($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettoEinkaufNachkalk($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettoEinkaufNachkalkVT($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettoEinkaufOhneNachkalk($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettoEinkaufOhneNachkalkVT($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettoEinkaufVT($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettoMinusAKonto($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettoMinusRabatt($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettoPlusZusatzkosten($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettowert($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettowertMwst1($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettowertMwst2($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettowertMwst3($value)
 * @method static Builder<static>|Vorgang1Wert whereVorNettowertRabattfaehig($value)
 * @method static Builder<static>|Vorgang1Wert whereVorPosRabattfaehigJN($value)
 * @method static Builder<static>|Vorgang1Wert whereVorPositionswertBrutto($value)
 * @method static Builder<static>|Vorgang1Wert whereVorRabattKumulativJN($value)
 * @method static Builder<static>|Vorgang1Wert whereVorRabattProzent($value)
 * @method static Builder<static>|Vorgang1Wert whereVorRabattWert($value)
 * @method static Builder<static>|Vorgang1Wert whereVorRabattfaehigMwst1($value)
 * @method static Builder<static>|Vorgang1Wert whereVorRabattfaehigMwst2($value)
 * @method static Builder<static>|Vorgang1Wert whereVorRabattfaehigMwst3($value)
 * @method static Builder<static>|Vorgang1Wert whereVorSkontofaehigBrutto($value)
 * @method static Builder<static>|Vorgang1Wert whereVorSkontofaehigMwst1($value)
 * @method static Builder<static>|Vorgang1Wert whereVorSkontofaehigMwst2($value)
 * @method static Builder<static>|Vorgang1Wert whereVorSkontofaehigMwst3($value)
 * @method static Builder<static>|Vorgang1Wert whereVorSkontofaehigZusatzkosten1JN($value)
 * @method static Builder<static>|Vorgang1Wert whereVorSkontofaehigZusatzkosten2JN($value)
 * @method static Builder<static>|Vorgang1Wert whereVorSkontofaehigZusatzkosten3JN($value)
 * @method static Builder<static>|Vorgang1Wert whereVorSkontofaehigZusatzkosten4JN($value)
 * @method static Builder<static>|Vorgang1Wert whereVorSkontofaehigZusatzkosten5JN($value)
 * @method static Builder<static>|Vorgang1Wert whereVorTextMwstOriginal1($value)
 * @method static Builder<static>|Vorgang1Wert whereVorTextMwstOriginal2($value)
 * @method static Builder<static>|Vorgang1Wert whereVorTextMwstOriginal3($value)
 * @method static Builder<static>|Vorgang1Wert whereVorTextMwstOriginal4($value)
 * @method static Builder<static>|Vorgang1Wert whereVorTextZusatzkosten4($value)
 * @method static Builder<static>|Vorgang1Wert whereVorTextZusatzkosten5($value)
 * @method static Builder<static>|Vorgang1Wert whereVorWHTKat1($value)
 * @method static Builder<static>|Vorgang1Wert whereVorWHTKat2($value)
 * @method static Builder<static>|Vorgang1Wert whereVorWHTKat3($value)
 * @method static Builder<static>|Vorgang1Wert whereVorWHTProzent1($value)
 * @method static Builder<static>|Vorgang1Wert whereVorWHTProzent2($value)
 * @method static Builder<static>|Vorgang1Wert whereVorWHTProzent3($value)
 * @method static Builder<static>|Vorgang1Wert whereVorWHTWert1($value)
 * @method static Builder<static>|Vorgang1Wert whereVorWHTWert2($value)
 * @method static Builder<static>|Vorgang1Wert whereVorWHTWert3($value)
 * @method static Builder<static>|Vorgang1Wert whereVorWertZusatzkosten1($value)
 * @method static Builder<static>|Vorgang1Wert whereVorWertZusatzkosten2($value)
 * @method static Builder<static>|Vorgang1Wert whereVorWertZusatzkosten3($value)
 * @method static Builder<static>|Vorgang1Wert whereVorWertZusatzkosten4($value)
 * @method static Builder<static>|Vorgang1Wert whereVorWertZusatzkosten5($value)
 * @method static Builder<static>|Vorgang1Wert whereVorZusRabattProzent($value)
 * @mixin Eloquent
 */
class Vorgang1Wert extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.Vorgang1Wert';
    protected $primaryKey = 'InterneVorgangsnummer';
    protected $guarded = [];
}
