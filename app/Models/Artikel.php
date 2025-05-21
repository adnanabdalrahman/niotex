<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.Artikel';
    protected $primaryKey = 'InterneArtikelnummer';
    protected $guarded = [];
}

