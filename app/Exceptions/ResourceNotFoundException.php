<?php

namespace App\Exceptions;

class ResourceNotFoundException extends ApiException
{
    public function getErrorCode(): string
    {
        return "RESOURCE_NOT_FOUND";
    }

}
