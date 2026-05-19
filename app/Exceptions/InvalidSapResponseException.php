<?php

namespace App\Exceptions;

class InvalidSapResponseException extends ApiException
{
    public function __construct(
        string $message = "Ungültige SAP Response.",
        array  $errors = [],
        int    $statusCode = 502,
    )
    {
        parent::__construct($message, $errors, $statusCode);
    }

    public function getErrorCode(): string
    {
        return "INVALID_SAP_RESPONSE";
    }
}
