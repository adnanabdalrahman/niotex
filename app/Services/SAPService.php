<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SAPService
{
    protected string $baseUrl;
    protected array $auth;

    public function __construct()
    {   
        $this->baseUrl = env('SAP_API_BASE_URL');
        $this->auth = [
            'username' => env('SAP_API_USERNAME'),
            'password' => env('SAP_API_PASSWORD'),
        ];
    }

    public function getStockData()
    {
        $url = "https://dev-flex.vivawest.dev/tiw/sap/opu/odata/SAP/Z1ERP_MM_SAS_API_SRV/StockSet?\$filter=MaterialNumber eq '112600005' and StorageLocation eq 'H001'";
        
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'client_id' => '9179e47e7c344e3f873a231921a96646',
            'client_secret' => '16FaeF41990b49738c87C86326e07A1c',
        ])->get($url);
        
        if ($response->successful()) {
            return response()->json($response->json(), 200);
        }
        
        return response()->json(['error' => 'Failed to fetch data'], $response->status());
    }
}
