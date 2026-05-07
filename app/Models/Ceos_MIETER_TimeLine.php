<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static Builder<static>|Ceos_MIETER_TimeLine newModelQuery()
 * @method static Builder<static>|Ceos_MIETER_TimeLine newQuery()
 * @method static Builder<static>|Ceos_MIETER_TimeLine query()
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
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereBemerkungIntern($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereDateStamp($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereDatumBis($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereDatumVon($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereID($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereLfd.AdressnummerGECEOS($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereLiegenschaftsID($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereMAnrede($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereMEigentuemernummer($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereMKundeneigeneNutzerNr($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereMName1($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereMName2($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereMPersonen($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereMWSTJN($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereMieterID($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereMietvertragsnummer($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereTestInfo($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereTimeStamp($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereUser($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereVorauszahlungJN($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereWohneinheitID($value)
 * @property int|null $lfd_Adressnummer_GE_CEOS
 * @property int|null $lfd_Adressnummer_ME_CEOS
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereLfdAdressnummerGECEOS($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereLfdAdressnummerMECEOS($value)
 * @property int|null $MDM
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereMDM($value)
 * @property int|null $MDM_MI
 * @property int|null $Geloescht_JN
 * @property string|null $M_Strasse
 * @property string|null $M_PlzOrt
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereGeloeschtJN($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereMDMMI($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereMPlzOrt($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereMStrasse($value)
 * @property string|null $M_Telefon
 * @property string|null $M_Mobil
 * @property string|null $M_Email
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereMEmail($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereMMobil($value)
 * @method static Builder<static>|Ceos_MIETER_TimeLine whereMTelefon($value)
 * @mixin Eloquent
 */
class Ceos_MIETER_TimeLine extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.Ceos_MIETER_TimeLine';
    protected $primaryKey = 'ID';
    protected $guarded = [];
}
