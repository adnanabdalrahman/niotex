<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $ID
 * @property int $LiegenschaftsID
 * @property int $VerwaltungID
 * @property string $DatumVon
 * @property string|null $DatumBis
 * @property int|null $AuftraggeberID
 * @property string|null $Kundenart
 * @property string|null $ErsteAbr
 * @property string|null $LetzteAbr
 * @property int|null $AnsprechpartnerID
 * @property int|null $VorLieferanschrift
 * @property int|null $VorLieferanschriftAnsprechpartnerID
 * @property int|null $VorRechnungsanschrift
 * @property int|null $VorRechnungsanschriftAnsprechpartnerID
 * @property int $User
 * @property string|null $DateStamp
 * @property string $TimeStamp
 * @property string|null $Test_Info
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine newModelQuery()
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine newQuery()
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine query()
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereAnsprechpartnerID($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereAuftraggeberID($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereDateStamp($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereDatumBis($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereDatumVon($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereErsteAbr($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereID($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereKundenart($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereLetzteAbr($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereLiegenschaftsID($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereTestInfo($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereTimeStamp($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereUser($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereVerwaltungID($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereVorLieferanschrift($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereVorLieferanschriftAnsprechpartnerID($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereVorRechnungsanschrift($value)
 * @method static Builder<static>|Ceos_VERWALTUNG_TimeLine whereVorRechnungsanschriftAnsprechpartnerID($value)
 * @mixin Eloquent
 */
class Ceos_VERWALTUNG_TimeLine extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.Ceos_VERWALTUNG_TimeLine';
    protected $primaryKey = 'ID';
    protected $guarded = [];
}
