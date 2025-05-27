<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.Position';
    protected $guarded = [];
    protected $primaryKey = ['InterneVorgangsnummer', 'InternePositionsnummer'];
    protected $keyType = 'int';
}
