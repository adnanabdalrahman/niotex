<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArtikelKunde extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.ArtikelKunde';
    protected $primaryKey = 'ArtikelKundeID';
    protected $guarded = [];
}


