<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CompositeKey\HasCompositeKey;


class Artikelgruppe extends Model
{
    use HasCompositeKey;

    public $timestamps = false;
    public $incrementing = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.Artikelgruppe';
    protected $guarded = [];
    protected $primaryKey = ['KZArtikelgruppe', 'KZArtikelgruppe'];
    protected $keyType = 'int';
}
