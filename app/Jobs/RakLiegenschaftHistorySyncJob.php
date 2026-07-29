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

    public function __construct(
        public string $lsNumber,
        public string $from,
        public string $to,
    )
    {
    }

    /**
     * @throws Throwable
     * @throws ConnectionException
     */
    public function handle(RakLiegenschaftHistorySyncService $service): void
    {
        $service->sync($this->lsNumber, $this->from, $this->to);
    }
}
