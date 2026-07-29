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
        string $from,
        string $to,
    ): array
    {
        $devicesCount = 0;
        $statesCount = 0;

        $deviceNumbers = $this->deviceService->getDeviceNumbers($lsNumber);

        foreach ($deviceNumbers as $deviceNumber) {
            $devicesCount++;
            $stateIdentifiers = $this->deviceStateService->getStateIdentifiers($deviceNumber);
            if (empty($stateIdentifiers)) {
                continue;
            }
            foreach ($stateIdentifiers as $stateIdentifier) {
                $statesCount++;
                $this->influxDbService->syncStateHistory([
                    'dtwin_title' => $deviceNumber,
                    'state_identifier' => $stateIdentifier,
                    'from' => $from,
                    'to' => $to,
                    'LS_Nummer' => $lsNumber,
                    'GeraeteNummer' => $deviceNumber,
                ]);
            }
        }

        return [
            'devices' => $devicesCount,
            'states' => $statesCount,
        ];
    }
}
