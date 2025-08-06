<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER_TimeLine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER_TimeLine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER_TimeLine query()
 * @property int $ID
 * @property int $WohneinheitID
 * @property int $MieterID
 * @property string $DatumVon
 * @property string|null $DatumBis
 * @property int|null $lfd.Adressnummer GE CEOS
 * @property string|null $Mietvertragsnummer
 * @property string|null $M_Kundeneigene_NutzerNr
 * @property string|null $M_Eigentuemernummer
 * @property string|null $M_Name1
 * @property string|null $M_Name2
 * @property int|null $M_Anrede
 * @property float|null $M_Personen
 * @property string|null $Bemerkung_intern
 * @property int|null $MWST_JN
 * @property int|null $Vorauszahlung_JN
 * @property int $User
 * @property string|null $DateStamp
 * @property string $TimeStamp
 * @property string|null $Test_Info
 * @property int $LiegenschaftsID
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER_TimeLine whereBemerkungIntern($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER_TimeLine whereDateStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER_TimeLine whereDatumBis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER_TimeLine whereDatumVon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER_TimeLine whereID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER_TimeLine whereLfd.AdressnummerGECEOS($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER_TimeLine whereLiegenschaftsID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER_TimeLine whereMAnrede($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER_TimeLine whereMEigentuemernummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER_TimeLine whereMKundeneigeneNutzerNr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER_TimeLine whereMName1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER_TimeLine whereMName2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER_TimeLine whereMPersonen($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER_TimeLine whereMWSTJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER_TimeLine whereMieterID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER_TimeLine whereMietvertragsnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER_TimeLine whereTestInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER_TimeLine whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER_TimeLine whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER_TimeLine whereVorauszahlungJN($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER_TimeLine whereWohneinheitID($value)
 * @property int|null $lfd. Adressnummer GE CEOS
 * @property int|null $lfd. Adressnummer ME CEOS
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER_TimeLine whereLfd.AdressnummerGECEOS($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_MIETER_TimeLine whereLfd.AdressnummerMECEOS($value)
 * @mixin \Eloquent
 */
class Ceos_MIETER_TimeLine extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.Ceos_MIETER_TimeLine';
    protected $primaryKey = 'ID';
    protected $guarded = [];
}
