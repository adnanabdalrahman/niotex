<?php

namespace App\Services\MMServices;


use App\Models\Artikel;
use App\Models\ArtikelLager;
use App\Services\SapApiClient;
use Exception;
use Illuminate\Support\Facades\Log;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class MM_22_01_Services
{
    protected string $mm221_path;

    public function __construct()
    {
        $this->mm221_path = config('sap.mm221_path');
    }

    /**
     * MM-22-1 Abfrage nach Lagerbestände
     * Get stock Level from SAP.
     * @param array $artikelnummer
     * @param string $lager
     * @return array|null
     */
    public function mm_22_01_lagerbestaende(array $artikelnummer, string $lager): ?array
    {
        $materialEqArray = array_map(function ($artikelnummer) {
            return "Material eq '{$artikelnummer}'";
        }, $artikelnummer);
        $materialFilterString = implode(' or ', $materialEqArray);
        $data = "?\$filter=( {$materialFilterString} ) and Storage eq '{$lager}'  and Plant eq '1270'";
        try {
            $response = app(SapApiClient::class)->get($this->mm221_path, $data);
            if ($response === null) {
                Log::error('mm_22_01_lagerbestaende Error Response');
                return null;
            }
            if (isset($response['d']['results'])) {
                $responseData = [];
                foreach ($response['d']['results'] as $result) {
                    $amount = ($result['Amount']);
                    $artikel = Artikel::where('Artikelnummer', $artikelnummer)->first();
                    ArtikelLager::updateOrCreate(
                        [
                            'interneArtikelnummer' => $artikel->InterneArtikelnummer
                        ],
                        [
                            'AlaPhysikalischeMenge1' => $amount,
                        ]
                    );

                    $responseData[] = ['Artikelnummer' => $artikel->InterneArtikelnummer, 'Amount' => $amount];
                }

            } else {
                Log::error('mm_22_01_lagerbestaende Kein Amount gefunden', $response);
                return null;
            }
        } catch (Exception|NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            Log::error('mm_22_01_lagerbestaende' . $e->getMessage());
            return null;
        }
        return $responseData;
    }

}
