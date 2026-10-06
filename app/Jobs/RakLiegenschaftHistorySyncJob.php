<?php

namespace App\Jobs;

use App\Services\RakLiegenschaftHistorySyncService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Http\Client\ConnectionException;
use Throwable;

class RakLiegenschaftHistorySyncJob implements ShouldQueue
{
    use Queueable;

    /**
     * Calls to niotix are throttled (~60/min), so a large Liegenschaft can run for many minutes.
     * Keep below the queue's retry_after, otherwise the job is picked up a second time.
     */
    public int $timeout = 3600;

    public int $tries = 1;

    public function __construct(
        public string  $lsNumber,
        public ?string $device_type,
        public string  $from,
        public string  $to,
    )
    {
    }

    /**
     * @throws Throwable
     * @throws ConnectionException
     */
    public function handle(RakLiegenschaftHistorySyncService $service): void
    {
        $service->sync($this->lsNumber, $this->device_type, $this->from, $this->to);
    }
}
