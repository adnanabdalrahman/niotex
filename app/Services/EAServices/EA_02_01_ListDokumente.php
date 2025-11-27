<?php

namespace App\Services\EAServices;


use App\Services\SapApiClient;
use Exception;
use Illuminate\Support\Facades\Log;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class EA_02_01_ListDokumente
{
    protected string $ea21_path;

    public function __construct()
    {
        $this->ea21_path = config('sap.ea21_path');
    }

    /**
     * MM-22-1 Abfrage nach Lagerbestände
     * Get stock Level from SAP.
     * @param $validated
     * @return array|null
     */
    public function EA_02_01_ListDokumente($validated): ?array
    {
        $record = $validated['Record'];
        $objectId = $validated['ObjectId'];
        $folkey = $validated['Folkey'];

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
