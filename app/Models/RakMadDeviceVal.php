<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string|null $LS_Nummer
 * @property string|null $GeraeteNummer
 * @property string|null $Datum
 * @property float|null $Wert
 * @property int|null $Process
 * @property string|null $created
 * @property string|null $uploaded
 * @property string|null $Datum_Akt
 * @property string|null $TimeStamp
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakMadDeviceVal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakMadDeviceVal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakMadDeviceVal query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakMadDeviceVal whereCreated($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakMadDeviceVal whereDatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakMadDeviceVal whereDatumAkt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakMadDeviceVal whereGeraeteNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakMadDeviceVal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakMadDeviceVal whereLSNummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakMadDeviceVal whereProcess($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakMadDeviceVal whereTimeStamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakMadDeviceVal whereUploaded($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RakMadDeviceVal whereWert($value)
 * @mixin \Eloquent
 */
class RakMadDeviceVal extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.Rak_Mad_Device_Vals';
    protected $guarded = [];


}
