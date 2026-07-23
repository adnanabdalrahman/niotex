<?php

namespace App\Exceptions;

class CreationFailedException extends ApiException
{
    public function __construct(
        string $message = "Erstellung fehlgeschlagen",
        array  $errors = [],
        int    $statusCode = 500,
    )
    {
        parent::__construct($message, $errors, $statusCode);
    }

    public function getErrorCode(): string
    {
        return "CREATION_FAILED";
    }
}
