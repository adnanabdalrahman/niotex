<?php

namespace App\Services\EAServices;


use App\Services\SapApiClient;
use Exception;
use Illuminate\Support\Facades\Log;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class EA_01_01_FileExchange
{
    protected string $ea11_path;

    public function __construct()
    {
        $this->ea11_path = config('sap.ea11_path');
    }

    /**
     * MM-22-1 Abfrage nach Lagerbestände
     * Get stock Level from SAP.
     * @param $validated
     * @return array|null
     */
    public function EA_01_01_FileExchange($validated): ?array
    {
        $arcdocid = $validated['arcdocid'];
        $archivid = $validated['archivid'];
        $filename = $validated['filename'];


        // todo weiter machen :) 
        $materialEqArray = array_map(function ($record) {
            return "Record eq '{$record}'";
        }, $record);
        $data = "?\$filter= Record eq '{$record}' and ObjectId eq '{$objectId}' and Folkey eq {$folkey}";
        try {
            $response = app(SapApiClient::class)->get($this->ea21_path, $data);
            if ($response === null) {
                Log::error('EA_02_01_ListDokumente Error Response');
                return null;
            }
            Log::info('EA_02_01_ListDokumente received Response', $response);
            if (isset($response['d']['results'])) {
                $responseData = [];

                foreach ($response['d']['results'] as $result) {
                    $responseData [] = $result;
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
