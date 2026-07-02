<?php


namespace App\Services\Logging;

use Illuminate\Support\Facades\Log;
use Throwable;

class ResponseLogger
{
    /**
     * @throws Throwable
     */
    public static function log(string $level, array $response
    ): void
    {
        Log::channel('incoming_requests')->log(
            $level, request()->attributes->get('trace_id') . ' Response ' .
            request()->path() . ': ' . $response['message'], $response
        );

        $incomingRequest = request()->attributes->get('incoming_request');
        if (!$incomingRequest) {
            return;
        }
        IncomingLogger::storeResponse(
            $incomingRequest,
            $response,
            self::processingTimeMs()
        );
    }

    private static function processingTimeMs(): int
    {
        $startedAt = request()->attributes->get('request_started_at');

        if (!$startedAt) {
            return 0;
        }

        return (int)round(
            (microtime(true) - $startedAt) * 1000
        );
    }

}
