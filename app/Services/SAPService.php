<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SAPService
{
    protected string $baseUrl;
    protected array $auth;

    public function __construct()
    {
        $this->baseUrl = config('sap.base_url');
        $this->auth = [
            'client_id' => config('sap.client_id'),
            'client_secret' => config('sap.client_secret'),
        ];
    }


    /**
     * Get stock data from SAP API.
     *
     * @param array $materialNumbers
     * @param string $plant
     * @param string $storageLocation
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStockData(string $materialNumber, string $plant, string $storageLocation)
    {
        // $url = "https://dev-flex.vivawest.dev/tiw/sap/opu/odata/SAP/Z1ERP_MM_SAS_API_SRV/StockSet?\$filter=MaterialNumber eq '112600005' and StorageLocation eq 'H001'";

        $url = $this->baseUrl .
            "?\$filter=MaterialNumber eq '{$materialNumber}' and StorageLocation eq '{$storageLocation}'";
            
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'client_id' => $this->auth['client_id'],
            'client_secret' => $this->auth['client_secret'],
        ])->get($url);
    
        if ($response->successful()) {
            return response()->json($response->json(), 200);
        }
    
        return response()->json(['error' => 'Failed to fetch data'], $response->status());
    }
    
}
