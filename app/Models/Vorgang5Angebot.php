<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $InterneVorgangsnummer
 * @property int|null $VorAbschlussWoche
 * @property int|null $VorAbschlussJahr
 * @property float|null $VorAbschlussChance
 * @property string|null $VorAbschlussOutlookStoreID
 * @property string|null $VorAbschlussOutlookEntryID
 * @property int $VorAbschlussOutlookIsTask
 * @property int $VorAngebotVerfolgenJN
 * @property string|null $VorAngebotVerlorenNotiz
 * @property string|null $VorAngebotGueltigBis
 * @property string|null $VorWiedervorlageDatumIntern
 * @property string|null $VorWiedervorlageDatum
 * @property int|null $VorWiedervorlageWoche
 * @property int|null $VorWiedervorlageJahr
 * @property string|null $VorWiederVorlageOutlookStoreID
 * @property string|null $VorWiederVorlageOutlookEntryID
 * @property int $VorWiederVorlageOutlookIsTask
 * @property string|null $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereInterneVorgangsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorAbschlussChance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorAbschlussJahr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorAbschlussOutlookEntryID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorAbschlussOutlookIsTask($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorAbschlussOutlookStoreID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorAbschlussWoche($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorAngebotGueltigBis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorAngebotVerfolgenJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorAngebotVerlorenNotiz($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorWiederVorlageOutlookEntryID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorWiederVorlageOutlookIsTask($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorWiederVorlageOutlookStoreID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorWiedervorlageDatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorWiedervorlageDatumIntern($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorWiedervorlageJahr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vorgang5Angebot whereVorWiedervorlageWoche($value)
 * @mixin Eloquent
 */
class Vorgang5Angebot extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.Vorgang5Angebot';
    protected $primaryKey = 'InterneVorgangsnummer';
    protected $guarded = [];
}
