<?php

namespace App\Services;

class RakDeviceStateService
{

    public function getStateIdentifiers(string $deviceNumber): array
    {
        $prefix = strtoupper(substr($deviceNumber, 0, 2));

        return config("rak_devices.state_identifiers.$prefix", []);
    }
}
