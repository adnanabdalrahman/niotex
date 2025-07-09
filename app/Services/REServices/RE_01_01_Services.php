<?php

namespace App\Services\REServices;

use Illuminate\Support\Facades\Log;
use Throwable;

class RE_01_01_Services
{

    /**
     * RE-01-01 Liegenschaften
     */

    public function re_01_01_Liegenschaften($request): ?array
    {
        try {
            $result = ['message' => 'OK'];
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return null;
        }
        return $result;
    }
}
