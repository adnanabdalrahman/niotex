<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produktgruppe extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.Produktgruppe';
    protected $primaryKey = 'KZProduktgruppe';
    protected $guarded = [];
}
