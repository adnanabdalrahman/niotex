<?php

namespace App\Services;

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
    public function sd_0101_beauftragung($recievedData)
    {

        // create Vorgang for beleg
        // create positionen für this Vorgang
        // MaterialGruppen in positionen   => Vorgang.VorGruppe

        $data = ['vbeln' => '6000000026', 'vorNummer' => '12301'];
        return $data;
    }


    /**
     * SD-02-01 Mietvertragsrechnungen
     */
    public function sd_0201_mietvertragsrechnungen($recievedData)
    {
        // create Vorgang with same vorNummer that they sent
        // create poitionen für this Vorgang

        $data = ['vorNummer' => '12301'];
        return $data;
    }


    /**
     * SAP -> CEOS
     * SD-03-01 Dienstleistungsabrechnung
     */
    public function sd_0301_dienstleistungsabrechnung($receivedData): array
    {
        // create Vorgang with same vorNummer that they sent
        // create positioned für this Vorgang

        $data = ['vorNummer' => '12301'];
        return $data;
    }


}
