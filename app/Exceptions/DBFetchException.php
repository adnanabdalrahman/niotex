<?php

namespace App\Exceptions;

class DBFetchException extends ApiException
{
    public function getErrorCode(): string
    {
        return "RESOURCE_NOT_FETCHED";
    }
}
