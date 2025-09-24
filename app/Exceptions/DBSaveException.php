<?php

namespace App\Exceptions;

class DBSaveException extends ApiException
{
    public function getErrorCode(): string
    {
        return "RESOURCE_NOT_SAVED";
    }
}
