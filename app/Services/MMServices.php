<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use App\Services\SapApiClient;
use Illuminate\Support\Facades\DB;



class MMServices
{
    protected string $baseUrl;
    protected string $mm221_path;
    protected string $mm341_path;

    protected array $auth;

    public function __construct()
    {
        $this->baseUrl = config('sap.base_url');
        $this->auth = [
            'client_id' => config('sap.client_id'),
            'client_secret' => config('sap.client_secret'),
        ];

        $this->mm221_path = config('sap.mm221_path');
        $this->mm341_path = config('sap.mm341_path');
    }


    /**
     * MM-31-1 Materialstammdaten
     */
    public function mm_31_materialstammdaten($data)
    {
        // check if Material exist in CEOS materianummer
        // check LÖv => 1/0   

        // if not exist, create new Material

        try {
            DB::transaction(function () use ($data) {
                // Insert into users table
                $interneArtikelnummer = DB::connection('sqlsrv2')->table('cis.Artikel')->insertGetId([
                    'KZArtikelgruppe'      => $data['Produktgruppe'] ?? null,
                    'KZWarengruppe'      => $data['Warengruppe'] ?? null,
                    'Artikelnummer'      => $data['Material'] ?? null,
                    'NRPreisbasis'      => $data['NRPreisbasis'] ?? null,
                    'MwstNummer'      => $data['MwstNummer'] ?? null, // 3
                    'ArtVerkaufspreis1'      => $data['ArtVerkaufspreis1'] ?? 0, // 0
                    'ArtMaterialkosten'      => $data['ArtMaterialkosten'] ?? null, // missbrauchen 
                    'ArtSondereinzelkosten'      => $data['ArtSondereinzelkosten'] ?? null, // null
                    'ArtFertigungskosten'      => $data['ArtFertigungskosten'] ?? null, // null
                    'ArtStkAuftragLagerbuchung'      => $data['ArtStkAuftragLagerbuchung'] ?? null, //??
                ]);

                return $interneArtikelnummer;
            });
        } catch (\Throwable $e) {
            return $e->getMessage();
        }





        return $data;
    }







    //MM_34_01 Umlagerungreservierung 
    /**
     * MM-34-1 Umlagerungreservierung
     * Receive material data from SAP.
     *
     * @param array $recievedData
     * @return JsonResponse
     */

    public function mm_34_01_UmlagerungReservierung()
    {
        // where commes the trigger from    from Blau exist anpassungen 
        // source data from CEOS mapping 
        // what to do with the recieved data?? 

        $data = [
            "TourId" => "123456",
            "ReservNo" => "",
            "MoveStloc" => "H001",
            "MoveStlocSearch" => "",
            "to_Items" => [
                [
                    "Material" => "10041633",
                    "EntryQnt" => "1",
                    "EntryUom" => "ST",
                    "ReqDate" => "/Date(1747094400000)/",
                    "TourId" => "123456"
                ],
                [
                    "Material" => "112600005",
                    "EntryQnt" => "1",
                    "EntryUom" => "ST",
                    "ReqDate" => "/Date(1747094400000)/",
                    "TourId" => "123456"
                ]
            ]
        ];
        $response = app(SapApiClient::class)->post($this->mm341_path, $data);

        return response()->json($response);


        // data to send to SAP:: 
        /*
        { 
            "TourId":"123456", 
            "ReservNo":"", 
            "MoveStloc":"H001", 
            "MoveStlocSearch":"", 
            "to_Items":[ 
                { 
                "Material":"10041633", 
                "EntryQnt":"1", 
                "EntryUom":"ST", 
                "ReqDate":"/Date(1747094400000)/", 
                "TourId":"123456" 
                }, 
                { 
                "Material":"112600005", 
                "EntryQnt":"1", 
                "EntryUom":"ST", 
                "ReqDate":"/Date(1747094400000)/", 
                "TourId":"123456" 
                } 
            ] 
        } 
                    
        // response from SAP: 
        
        */
    }


    /**
     * MM-22-1 Abfrage nach Lagerbestände
     * Get stock Level from SAP.
     *
     * @param string $materials
     * @param string $storage
     * @return JsonResponse
     * @throws ConnectionException
     */
    public function mm_2201_get_Lagerbestaende(string $materials, string $storage): JsonResponse
    {
        $url = $this->baseUrl . $this->mm221_path .
            "?\$filter=Material eq '{$materials}' and Storage eq '{$storage}'";

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'client_id' => $this->auth['client_id'],
            'client_secret' => $this->auth['client_secret'],
        ])->get($url);


        // dd($response->json());

        if ($response->successful()) {
            return response()->json($response->json(), 200);
        }

        return response()->json(['error' => 'Failed to fetch data'], $response->status());
    }
}
