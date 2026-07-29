<?php

namespace App\Services;

class RakDeviceStateService
{

    public function getDeviceConfig(string $deviceNumber): ?array
    {
        $prefix = strtoupper(substr($deviceNumber, 0, 3));
        return config("rak_devices.devices.$prefix");
    }
}
