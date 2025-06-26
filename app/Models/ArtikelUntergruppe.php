<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArtikelUntergruppe extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.ArtikelUntergruppe';
    protected $primaryKey = 'InterneArtikelnummer';
    protected $guarded = [];

}
