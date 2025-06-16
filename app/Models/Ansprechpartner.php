<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $AnsprechpartnerID
 * @property int|null $InterneAdressnummer
 * @property int $AnsHauptansprechpartnerJN
 * @property int $NRAnrede
 * @property int|null $NRTitel
 * @property string|null $AnsVorname
 * @property string|null $AnsNachname
 * @property string|null $AnsAbteilung
 * @property string|null $AnsDurchwahl
 * @property string|null $AnsFax
 * @property string|null $AnsMobiltelefon
 * @property string|null $AnsEMail
 * @property string|null $AnsPrivatStrasse
 * @property string|null $AnsPrivatOrt
 * @property string|null $AnsPrivatTelefon
 * @property string|null $AnsGeburtsdatum
 * @property string|null $AnsNotiz
 * @property int|null $AnsVIP
 * @property int $AnsVersandEMailJN
 * @property string|null $AnsLockingDateTime
 * @property int $AnsAltJN
 * @property string|null $AnsIndividualC1
 * @property string|null $AnsIndividualC2
 * @property string|null $AnsIndividualC3
 * @property string|null $AnsIndividualC4
 * @property string|null $AnsIndividualC5
 * @property string|null $AnsIndividualC6
 * @property string|null $AnsIndividualC7
 * @property float|null $AnsIndividualN1
 * @property float|null $AnsIndividualN2
 * @property float|null $AnsIndividualN3
 * @property float|null $AnsIndividualN4
 * @property float|null $AnsIndividualN5
 * @property float|null $AnsIndividualN6
 * @property float|null $AnsIndividualN7
 * @property string|null $AnsIndividualD1
 * @property string|null $AnsIndividualD2
 * @property string|null $AnsIndividualD3
 * @property string|null $AnsIndividualD4
 * @property string|null $AnsNickname
 * @property string|null $AnsPrivateEmail
 * @property int $AnsHauptFinanzenJN
 * @property string|null $AnsSkypeName
 * @property int|null $AnsIndividualCombo1
 * @property int|null $AnsIndividualCombo2
 * @property int|null $AnsIndividualCombo3
 * @property int|null $AnsIndividualCombo4
 * @property string|null $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsAbteilung($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsAltJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsDurchwahl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsEMail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsFax($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsGeburtsdatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsHauptFinanzenJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsHauptansprechpartnerJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsIndividualC1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsIndividualC2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsIndividualC3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsIndividualC4($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsIndividualC5($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsIndividualC6($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsIndividualC7($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsIndividualCombo1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsIndividualCombo2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsIndividualCombo3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsIndividualCombo4($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsIndividualD1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsIndividualD2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsIndividualD3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsIndividualD4($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsIndividualN1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsIndividualN2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsIndividualN3($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsIndividualN4($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsIndividualN5($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsIndividualN6($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsIndividualN7($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsLockingDateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsMobiltelefon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsNachname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsNotiz($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsPrivatOrt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsPrivatStrasse($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsPrivatTelefon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsPrivateEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsSkypeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsVIP($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsVersandEMailJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsVorname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereAnsprechpartnerID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereInterneAdressnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereNRAnrede($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereNRTitel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ansprechpartner whereTimeStamp($value)
 * @mixin \Eloquent
 */
class Ansprechpartner extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.Ansprechpartner';
    protected $primaryKey = 'AnsprechpartnerID';
    protected $guarded = [];
}
