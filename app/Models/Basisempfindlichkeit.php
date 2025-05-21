<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basisempfindlichkeit extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.RakArtikel';
    protected $primaryKey = 'InterneArtikelNummer';
    protected $guarded = [];


}
