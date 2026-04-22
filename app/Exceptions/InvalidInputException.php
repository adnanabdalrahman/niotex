<?php

namespace App\Exceptions;

class InvalidInputException extends ApiException
{
    public function __construct(
        string $message = "Ungültige Eingabe",
        array  $errors = [],
        int    $statusCode = 400,
    )
    {
        parent::__construct($message, $errors, $statusCode);
    }

    public function getErrorCode(): string
    {
        return "INVALID_INPUT";
    }
}
