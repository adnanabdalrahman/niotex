<?php

namespace App\Services;

use App\Models\RakLiegenschaftDevice;
use Illuminate\Support\Collection;

class RakLiegenschaftDeviceService
{
    public function getDeviceNumbers(string $lsNumber): Collection
    {
        return RakLiegenschaftDevice::query()
            ->where('Liegenschaftsnummer', $lsNumber)
            ->whereNotNull('GeraeteNummer')
            ->pluck('GeraeteNummer')
            ->unique()
            ->values();
    }
}
