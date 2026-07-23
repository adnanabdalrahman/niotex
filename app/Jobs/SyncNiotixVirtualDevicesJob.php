<?php

namespace App\Jobs;

use App\Services\Niotix\NiotixVirtualDeviceService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Throwable;

class SyncNiotixVirtualDevicesJob implements ShouldQueue
{
    use Queueable;

    /**
     * @throws Throwable
     */
    public function handle(NiotixVirtualDeviceService $service): void
    {
        $service->syncAll();
    }
}
