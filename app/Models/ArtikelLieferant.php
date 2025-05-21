<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArtikelLieferant extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.ArtikelLieferant';
    protected $primaryKey = 'ArtikelLieferantID';
    protected $guarded = [];
}
