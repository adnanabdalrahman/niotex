<?php

namespace App\Exceptions;

class ResourceNotFoundException extends ApiException
{
    public function __construct(
        string $message = "Ressource wurde nicht gefunden",
        array  $errors = [],
        int    $statusCode = 404,
    )
    {
        parent::__construct($message, $errors, $statusCode);
    }

    public function getErrorCode(): string
    {
        return "RESOURCE_NOT_FOUND";
    }
}
