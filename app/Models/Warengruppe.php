<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warengruppe extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.Warengruppe';
    protected $primaryKey = 'KZWarengruppe';
    protected $guarded = [];

}
