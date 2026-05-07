<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;


/**
 * @property int $ID
 * @property string $createDate
 * @property string $LiegenschaftsNummer
 * @property string $DatumVon
 * @property string|null $DatumBis
 * @property int $EigenschaftTyp
 * @property string|null $EigenschaftWert
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_DTA_Eigenschaften newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_DTA_Eigenschaften newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_DTA_Eigenschaften query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_DTA_Eigenschaften whereCreateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_DTA_Eigenschaften whereDatumBis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_DTA_Eigenschaften whereDatumVon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_DTA_Eigenschaften whereEigenschaftTyp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_DTA_Eigenschaften whereEigenschaftWert($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_DTA_Eigenschaften whereID($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ceos_DTA_Eigenschaften whereLiegenschaftsNummer($value)
 * @mixin Eloquent
 */
class Ceos_DTA_Eigenschaften extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.Ceos_DTA_Eigenschaften';
    protected $primaryKey = 'ID';
    protected $guarded = [];
}
