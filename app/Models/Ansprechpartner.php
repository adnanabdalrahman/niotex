<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ansprechpartner extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv2';
    protected $table = 'cis.Ansprechpartner';
    protected $primaryKey = 'AnsprechpartnerID';
    protected $guarded = [];
}
