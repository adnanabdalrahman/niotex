<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdresseBranche extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.AdresseBranche';
    protected $primaryKey = 'InterneAdressnummer';
    protected $guarded = [];
}
