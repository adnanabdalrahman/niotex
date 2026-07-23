<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RakMadDeviceVal extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.Rak_Mad_Device_Vals';
    protected $guarded = [];
}
