<?php

namespace App\Services\Niotix;

use Illuminate\Http\Client\ConnectionException;

class NiotixDigitalTwinsService
{
    protected NiotixApiClient $niotixApiClient;

    public function __construct(
        NiotixApiClient $niotixApiClient
    )
    {
        $this->niotixApiClient = $niotixApiClient;
    }

    /**
     * GET all digital twins
     * @throws ConnectionException
     */
    public function getAllFromNiotix(): array
    {
        $payload = $this->niotixApiClient->get('digital-twins');
        $this->storeCollection($payload);
        return $payload;
    }

    /**
     * Store collection locally
     */
    private function storeCollection(array $payload): void
    {
        foreach ($payload['data'] as $digitalTwin) {
            $this->saveDigitalTwin($digitalTwin);
        }
    }

    /**
     * Save/update digital twin
     */
    private function saveDigitalTwin(
        array $data
    ): void
    {

    }

    /**
     * GET digital twin by id
     * @throws ConnectionException
     */
    public function getByIdFromNiotix(
        int $digitalTwinId
    ): array
    {
        $payload = $this->niotixApiClient->get("/digital-twins/{$digitalTwinId}");
        $this->storeSingle($payload);
        return $payload;
    }

    /**
     * Store single locally
     */
    private function storeSingle(
        array $payload
    ): void
    {

    }

    /**
     * POST digital twin
     */
    public function createInNiotix(
        array $data
    ): array
    {

        return [];
    }

    /**
     * PUT digital twin
     */
    public function updateInNiotix(
        int   $id,
        array $data
    ): array
    {

        return [];
    }

    /**
     * DELETE digital twin
     */
    public function deleteFromNiotix(
        int $id
    ): bool
    {
        return true;
    }
}
