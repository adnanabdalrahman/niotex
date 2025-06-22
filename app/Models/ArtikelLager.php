<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArtikelLager extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.ArtikelLager';
    protected $primaryKey = 'InterneArtikelnummer';
    protected $guarded = [];

}
