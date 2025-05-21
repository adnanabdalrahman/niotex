<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

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
    public function sd_0101_beauftragung($data)
    {

        // create Vorgang for beleg
        // create positionen für this Vorgang
        // MaterialGruppen in positionen   => Vorgang.VorGruppe

        try {
            DB::transaction(function () use ($data) {
                $inetrnanlID = DB::connection('sqlsrv2')->table('cis.Artikel')->insertGetId([
                    'Artikelnummer' => $data['Material'],
                    'ArtMatchcode' => $data['Materialkurztext'],
                    'ArtBezeichnung1' => $data['Bezeichnung1'],
                    'ArtBezeichnung2' => $data['Bezeichnung2'],
                    'ArtAltJN' => $data['LVorm'],
                    'ArtEAN1' => $data['EANNummerSAP'],

                    'NRPreisbasis' => $data['NRPreisbasis'],
                    'MwstNummer' => $data['MwstNummer'],
                    'ArtVerkaufspreis1' => $data['ArtVerkaufspreis1'],
                    'ArtMaterialkosten' => $data['ArtMaterialkosten'],
                    'ArtSondereinzelkosten' => $data['ArtSondereinzelkosten'],
                    'ArtStkAuftragLagerbuchung' => $data['ArtStkAuftragLagerbuchung'],
                    'ArtFremdFertigungskosten' => $data['ArtFremdFertigungskosten'],
                    'ArtFertigungskosten' => $data['ArtFertigungskosten'],
                    'ArtRabattfaehigJN' => $data['ArtRabattfaehigJN'],
                    'ArtSeriennummernfaehigJN' => $data['ArtSeriennummernfaehigJN'],
                    'ArtStuecklisteJN' => $data['ArtStuecklisteJN'],
                    'ArtProvisionsfaehigJN' => $data['ArtProvisionsfaehigJN'],
                    'ArtLieferantenfaehigJN' => $data['ArtLieferantenfaehigJN'],
                    'ArtVerkaufsfaehigJN' => $data['ArtVerkaufsfaehigJN'],

                    'KZProduktgruppe' => $data['Produktgruppe'],
                    'KZWarengruppe' => $data['CEOSWarengruppe'],
                    'KZArtikelgruppe' => $data['CEOSArtikelgruppe'],
                    'ArtikelUntergruppeID' => Null,
                ]);
                dd($inetrnanlID);
            });
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
        return null;
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
