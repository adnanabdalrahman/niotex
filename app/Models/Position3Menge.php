<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position3Menge extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.Position3Menge';
    protected $guarded = [];
    protected $primaryKey = ['InterneVorgangsnummer', 'InternePositionsnummer'];
    protected $keyType = 'int';

}
