<?php

namespace App\Services\Niotix;

use App\Models\NiotixVirtualDevice;
use App\Models\NiotixVirtualDeviceData;
use App\Models\NiotixVirtualDeviceMetadata;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\DB;
use Throwable;

class NiotixVirtualDeviceService
{
    public function __construct(
        protected NiotixApiClient          $niotixApiClient,
        protected NiotixImportErrorService $importErrorService
    )
    {
    }

    /**
     * GET all virtual devices.
     *
     * @throws ConnectionException
     * @throws Throwable
     */
    public function getAllFromNiotix(): void
    {
        $payload = $this->niotixApiClient->get('/virtual-devices');
        while (true) {
            $this->storeCollection($payload);
            if (empty($payload['pagination']['next'])) {
                break;
            }
            $payload = $this->niotixApiClient->getByUrl(
                $payload['pagination']['next']
            );
        }
    }

    /**
     * Store collection locally.
     *
     * @throws Throwable
     */
    private function storeCollection(array $payload): void
    {
        foreach ($payload['data'] as $device) {
            try {
                $this->save($device);
            } catch (Throwable $e) {
                $this->importErrorService->store('virtual-device', $device['id'] ?? null, $device, $e);
                report($e);
                continue;
            }
        }
    }

    /**
     * Save or update virtual device.
     *
     * @throws Throwable
     */
    private function save(array $device): void
    {
        DB::transaction(function () use ($device) {

            $deviceData = $device['device']['data'];
            $connector = $device['device']['connector'];
            $meta = $device['meta'];
            $system = $device['system'];

            $virtualDevice = $this->saveVirtualDevice(
                $device,
                $deviceData,
                $connector,
                $meta,
                $system
            );

            $this->saveMetadata(
                $virtualDevice,
                $device,
                $meta
            );

            $this->saveDeviceData(
                $virtualDevice,
                $deviceData
            );
        });
    }

    private function saveVirtualDevice(
        array $device,
        array $deviceData,
        array $connector,
        array $meta,
        array $system
    ): NiotixVirtualDevice
    {
        return NiotixVirtualDevice::updateOrCreate(
            [
                'niotix_device_id' => $device['id'],
            ],
            [
                'device_id' => $deviceData['device_id'],
                'name' => $meta['name'],
                'description' => $meta['description'] ?? null,

                'device_type' => $device['device']['deviceTypeId'] ?? $deviceData['deviceType'] ?? null,
                'device_driver_id' => $device['device']['deviceDriverId'] ?? null,
                'device_template_id' => $device['device']['deviceTemplateId'] ?? null,

                'connector_type' => $connector['type'],
                'connector_config_id' => $connector['configId'],

                'region' => $deviceData['region'] ?? null,
                'activation' => $deviceData['activation'] ?? null,
                'line_number' => $deviceData['lineNumber'] ?? null,

                'parent_id' => $system['parentId'] ?? null,
                'account_id' => $system['accountId'] ?? null,
                'scope_id' => $system['scopeId'] ?? null,
                'disabled' => $system['disabled'] ?? false,

                'last_seen' => $device['lastSeen'] ?? null,

                'niotix_created_at' => $meta['createdAt'] ?? null,
                'niotix_updated_at' => $meta['updatedAt'] ?? null,
            ]
        );
    }

    private function saveMetadata(
        NiotixVirtualDevice $virtualDevice,
        array               $device,
        array               $meta
    ): void
    {
        NiotixVirtualDeviceMetadata::updateOrCreate(

            [
                'virtual_device_id' => $virtualDevice->id,
            ],

            [
                'fa_icon' => $meta['faIcon'] ?? null,
                'groups' => $device['device']['groups'] ?? [],
                'tags' => $meta['tags'] ?? [],
                'key_value_data' => $meta['keyValueData'] ?? [],
                'target_reference_ids' => $meta['targetReferenceId'] ?? [],
                'location_data' => $meta['locationData'] ?? [],
                'header_image' => $meta['headerImage'] ?? [],
                'attachments' => $meta['attachments'] ?? [],
            ]
        );
    }

    private function saveDeviceData(
        NiotixVirtualDevice $virtualDevice,
        array               $deviceData
    ): void
    {
        NiotixVirtualDeviceData::updateOrCreate(
            [
                'virtual_device_id' => $virtualDevice->id,
            ],

            [
                'device_data' => $deviceData,
            ]
        );
    }

    /**
     * GET virtual device by ID.
     *
     * @throws ConnectionException
     * @throws Throwable
     */
    public function getByIdFromNiotix($niotixDeviceId): array
    {
        $payload = $this->niotixApiClient->get("/virtual-devices/$niotixDeviceId");
        $this->storeSingle($payload);

        return $payload;
    }

    /**
     * Store single locally.
     *
     * @throws Throwable
     */
    private function storeSingle(array $device): void
    {
        $this->save($device);
    }

    /**
     * POST virtual device.
     *
     * @throws ConnectionException
     */
    public function createInNiotix(array $data): array
    {
        return $this->niotixApiClient->post('/virtual-devices', [], $data);
    }

    /**
     * PUT virtual device.
     */
    public function updateInNiotix(
        int   $niotixDeviceId,
        array $data
    ): array
    {
        // سيتم تنفيذها لاحقاً
        return [];
    }

    /**
     * DELETE virtual device.
     */
    public function deleteFromNiotix(int $niotixDeviceId): bool
    {
        return true;
    }

    /**
     * Synchronize all virtual devices.
     *
     * @throws ConnectionException
     * @throws Throwable
     */
    /**
     * Synchronize all virtual devices.
     *
     * @throws ConnectionException
     * @throws Throwable
     */
    public function syncAll(): void
    {
        $payload = $this->niotixApiClient->get('/virtual-devices');
        do {
            $this->storeCollection($payload);
            $next = $payload['pagination']['next'] ?? null;
            if ($next) {
                $payload = $this->niotixApiClient->getByUrl($next);
            }

        } while ($next);
    }

    /**
     * Synchronize one virtual device.
     *
     * @throws ConnectionException
     * @throws Throwable
     */
    public function syncById(
        int $niotixDeviceId
    ): void
    {
        $payload = $this->niotixApiClient->get("/virtual-devices/$niotixDeviceId");
        $this->storeSingle($payload);
    }


}
