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
 * @property int $GebaeudeID
 * @property int $WohneinheitID
 * @property string $DatumVon
 * @property string|null $DatumBis
 * @property int|null $lfd. Adressnummer GE CEOS
 * @property string|null $WE_Bezeichnung
 * @property int|null $WE_LfdNr
 * @property string|null $M_Kundeneigene_WohneinheitenNr
 * @property string|null $Lage
 * @property int|null $Garage_JN
 * @property int|null $Heizung_JN
 * @property int|null $WW_JN
 * @property int|null $KW_JN
 * @property int|null $NK_JN
 * @property float|null $Wohn_Fläche
 * @property float|null $Heizung_Fläche
 * @property float|null $WW_Fläche
 * @property int|null $Gewerblich_JN
 * @property string|null $Bemerkung_intern
 * @property string|null $BemerkungWE
 * @property int $User
 * @property string|null $DateStamp
 * @property string $TimeStamp
 * @property string|null $Test_InfoA
 * @property string|null $Test_InfoB
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine newModelQuery()
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine newQuery()
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine query()
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereBemerkungIntern($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereBemerkungWE($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereDateStamp($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereDatumBis($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereDatumVon($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereGarageJN($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereGebaeudeID($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereGewerblichJN($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereHeizungFläche($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereHeizungJN($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereID($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereKWJN($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereLage($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereLfd.AdressnummerGECEOS($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereLiegenschaftsID($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereMKundeneigeneWohneinheitenNr($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereNKJN($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereTestInfoA($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereTestInfoB($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereTimeStamp($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereUser($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereWEBezeichnung($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereWELfdNr($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereWWFläche($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereWWJN($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereWohnFläche($value)
 * @method static Builder<static>|Ceos_WOHNEINHEIT_TimeLine whereWohneinheitID($value)
 * @mixin Eloquent
 */
class Ceos_WOHNEINHEIT_TimeLine extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.Ceos_WOHNEINHEIT_TimeLine';
    protected $primaryKey = 'ID';
    protected $guarded = [];
}
