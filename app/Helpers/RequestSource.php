<?php

namespace App\Helpers;

use RuntimeException;

class RequestSource
{
    public static function getChannel(): string
    {
        // Example: detect SAP by a specific header or route prefix
        if (request()->hasHeader('X-SAP-Token')) {
            return 'sap';
        }
        if (request()->hasHeader('CEOS-Web-Token')) {
            return 'ceos_web';
        }
        throw new RuntimeException('Unable to detect source system.');
        // Otherwise default to app side
    }
}
