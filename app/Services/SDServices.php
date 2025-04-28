<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SDServices
{
    protected string $baseUrl;
    protected string $mm221_path;
    protected array $auth;

    public function __construct()
    {

    }

    /**
        * SD-01-01 Beauftragung
     */
    public function sd_0101_beauftragung()
    {

    // create Vorgan for beleg 
    // create poitionen für this Vorgang
    // MaterialGruppen in positionen   => Vorgang.VorGruppe 

    $data  = ['vbeln' => '6000000026', 'vorNummer' => '12301'];
    return $data;

    }
}




