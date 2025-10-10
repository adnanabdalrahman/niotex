<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $NRBenutzer
 * @property string $NutName
 * @property string|null $NutPasswort
 * @property int $NutLoginJN
 * @property int $NutSuperuserJN
 * @property int $NutOutlookJN
 * @property int $NutFibuAdminJN
 * @property int $NutPersonalAdminJN
 * @property int $NutPersonalGruppeAdminJN
 * @property int $NutEinkaufsdatenJN
 * @property string|null $NutKuerzel
 * @property string|null $NutDurchwahl
 * @property string|null $NutEMail
 * @property string|null $NutUnterschrift1
 * @property string|null $NutUnterschrift2
 * @property int|null $NutInterneAdressnummer
 * @property int $NutSupporterJN
 * @property int $NutProgrammiererJN
 * @property int|null $NutUnterschrift1Textnummer
 * @property int|null $NutUnterschrift2Textnummer
 * @property string|null $NutPfadVCard
 * @property string|null $SystemPW
 * @property int|null $SystemRechte
 * @property int|null $SystemKBits
 * @property int $NutMailingMethod
 * @property string|null $TimeStamp
 * @property int $NutUseInternalUserConfigJN
 * @property int|null $LayoutGruppeID
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereLayoutGruppeID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNRBenutzer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutDurchwahl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutEMail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutEinkaufsdatenJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutFibuAdminJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutInterneAdressnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutKuerzel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutLoginJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutMailingMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutOutlookJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutPasswort($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutPersonalAdminJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutPersonalGruppeAdminJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutPfadVCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutProgrammiererJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutSuperuserJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutSupporterJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutUnterschrift1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutUnterschrift1Textnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutUnterschrift2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutUnterschrift2Textnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereNutUseInternalUserConfigJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereSystemKBits($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereSystemPW($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereSystemRechte($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nutzer whereTimeStamp($value)
 * @mixin \Eloquent
 */
class Nutzer extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.Nutzer';
    protected $guarded = [];
    protected $primaryKey = null;
}
