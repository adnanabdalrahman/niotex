<?php

namespace App\Services;

use App\Services\Niotix\InfluxDbService;
use Illuminate\Http\Client\ConnectionException;
use Throwable;

class RakLiegenschaftHistorySyncService
{
    public function __construct(
        protected RakLiegenschaftDeviceService $deviceService,
        protected RakDeviceStateService        $deviceStateService,
        protected InfluxDbService              $influxDbService,
    )
    {
    }

    /**
     * @throws Throwable
     * @throws ConnectionException
     */
    public function sync(
        string $lsNumber,
        string $device_type,
        string $from,
        string $to,
    ): array
    {
        $devicesCount = 0;
        $statesCount = 0;
        $deviceNumbers = $this->deviceService->getDeviceNumbers($lsNumber);
        foreach ($deviceNumbers as $deviceNumber) {
            $config = $this->deviceStateService->getDeviceConfig($deviceNumber);
            if ($config === null) {
                continue;
            }
            if (
                !empty($device_type) &&
                $config['device_type'] !== $device_type
            ) {
                continue;
            }

            $devicesCount++;

            foreach ($config['state_identifiers'] as $stateIdentifier) {

                $statesCount++;

                $this->influxDbService->syncStateHistory([
                    'dtwin_title' => $deviceNumber,
                    'state_identifier' => $stateIdentifier,
                    'from' => $from,
                    'to' => $to,
                    'lsnummer' => $lsNumber,
                    'geraeteNummer' => $deviceNumber,
                ]);
            }
        }

        return [
            'devices' => $devicesCount,
            'states' => $statesCount,
        ];
    }
}
