<?php

namespace App\Exceptions;

class InvalidJsonException extends ApiException
{
    public function __construct(
        string $message = "Ungültiges oder fehlerhaftes JSON.",
        array  $errors = [],
        int    $statusCode = 400
    )
    {
        parent::__construct($message, $errors, $statusCode);
    }

    public function getErrorCode(): string
    {
        return "INVALID_JSON";
    }
}
