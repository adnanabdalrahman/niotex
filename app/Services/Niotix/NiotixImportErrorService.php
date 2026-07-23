<?php

namespace App\Services\Niotix;

use App\Models\NiotixImportError;
use Illuminate\Support\Str;
use Throwable;

class NiotixImportErrorService
{
    public function store(
        string    $resourceType,
        ?int      $resourceId,
        array     $payload,
        Throwable $exception
    ): void
    {

        $error = NiotixImportError::updateOrCreate(
            [
                'resource_type' => $resourceType,
                'resource_id' => $resourceId,
            ],
            [
                'message' => Str::limit($exception->getMessage(), 255, ''),
                'exception' => json_encode([
                    'class' => get_class($exception),
                    'message' => $exception->getMessage(),
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine(),
                    'trace' => $exception->getTraceAsString(),
                ], JSON_UNESCAPED_UNICODE),

                'payload' => $payload,

                'resolved' => false,

                'last_failed_at' => now(),
            ]
        );

        if (!$error->wasRecentlyCreated) {
            $error->increment('attempts');
        }
    }
}
