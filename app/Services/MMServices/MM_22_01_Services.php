<?php

namespace App\Services\MMServices;


use App\Exceptions\DBSaveException;
use App\Exceptions\InvalidSapResponseException;
use App\Exceptions\ResourceNotFoundException;
use App\Models\Artikel;
use App\Models\ArtikelLager;
use App\Services\SapApiClient;
use Illuminate\Support\Facades\Log;
use Psr\Container\NotFoundExceptionInterface;
use Throwable;

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
     * @return array
     * @throws DBSaveException
     * @throws InvalidSapResponseException
     * @throws ResourceNotFoundException
     * @throws Throwable
     * @throws NotFoundExceptionInterface
     */
    public function mm_22_01_lagerbestaende(array $artikelnummer, string $lager): array
    {
        $materialEqArray = array_map(function ($artikelnummer) {
            return "Material  eq '$artikelnummer'";
        }, $artikelnummer);
        $materialFilterString = implode(' or ', $materialEqArray);
        $data = "?\$filter=( $materialFilterString ) and Storage eq '$lager'  and Plant eq '1270'";
        Log::info("mm_22_01_lagerbestaende sent Data", [$data]);
        $result = app(SapApiClient::class)->get($this->mm221_path, $data);
        Log::info('mm_22_01_lagerbestaende received Response', $result);

        if (
            !isset($result['d']) ||
            !isset($result['d']['results']) ||
            !is_array($result['d']['results'])
        ) {
            throw new InvalidSapResponseException('Ungültige SAP-Antwort.');
        }

        $responseData = [];
        foreach ($result['d']['results'] as $item) {
            $amount = ($item['Amount']);
            $receivedArtikelnummer = $item['Material'];
            $artikel = Artikel::where('Artikelnummer', $receivedArtikelnummer)->first();
            if ($artikel === null) {
                throw new ResourceNotFoundException(
                    'Kein Artikel gefunden.',
                    ['Artikelnummer' => $receivedArtikelnummer]
                );
            }
            try {
                ArtikelLager::updateOrCreate(
                    [
                        'interneArtikelnummer' => $artikel->InterneArtikelnummer
                    ],
                    [
                        'AlaPhysikalischeMenge1' => $amount,
                    ]
                );
            } catch (Throwable $e) {
                throw new DBSaveException('Fehler beim Speichern des Lagerbestands: ' . $e->getMessage());
            }
            $responseData[] = ['Artikelnummer' => $artikel->InterneArtikelnummer, 'Amount' => $amount];
        }
        return $responseData;
    }

}
