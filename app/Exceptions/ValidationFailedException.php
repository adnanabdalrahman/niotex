<?php

namespace App\Exceptions;

class ValidationFailedException extends ApiException
{
    public function __construct(
        string $message = "Die angegebenen Daten sind ungültig.",
        array  $errors = [],
        int    $statusCode = 422,
    )
    {
        parent::__construct($message, $errors, $statusCode);
    }

    public function getErrorCode(): string
    {
        return "VALIDATION_FAILED";
    }
}
