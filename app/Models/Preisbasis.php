<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preisbasis extends Model
{

    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.Preisbasis';
    protected $primaryKey = 'NRPreisbasis';
    protected $guarded = [];
}
