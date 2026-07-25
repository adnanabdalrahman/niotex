<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RakLiegenschaftDevice extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $connection = 'sqlsrv';
    protected $table = 'cis.V_RakABNutzerGaerete';
    protected $primaryKey = null;
    protected $guarded = [];
}
