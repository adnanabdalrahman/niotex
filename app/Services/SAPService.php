<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SAPService
{
    protected string $baseUrl;
    protected string $mm221_path;
    protected array $auth;

    public function __construct()
    {
        $this->baseUrl = config('sap.base_url');
        $this->auth = [
            'client_id' => config('sap.client_id'),
            'client_secret' => config('sap.client_secret'),
        ];

        $this->mm221_path = config('sap.mm221_path');
    }


    /**
     * MM-22-1 Abfrage nach Lagerbestände
     * Get stock Level from SAP.
     *
     * @param array $materialNumbers
     * @param string $plant
     * @param string $storageLocation
     * @return \Illuminate\Http\JsonResponse
     */
    public function mm221_getStockLevels(string $materials, string $storage)
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
