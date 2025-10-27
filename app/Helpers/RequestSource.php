<?php

namespace App\Helpers;

class RequestSource
{
    public static function getChannel(): string
    {
        $path = request()->path();
        $headers = request()->headers->all();
        // Example: detect SAP by a specific header or route prefix
        if (isset($headers['x-sap-token']) || str_contains($path, 'sap/')) {
            return 'sap_requests';
        }

        // Otherwise default to app side
        return 'ceosweb_requests';
    }
}
