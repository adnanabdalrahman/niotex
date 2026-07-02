<?php

namespace App\Exceptions;

class SapBusinessException extends ApiException
{
    public function __construct(
        string $message = 'SAP business operation failed.',
        array  $errors = [],
        int    $statusCode = 502,
    )
    {
        parent::__construct($message, $errors, $statusCode);
    }

    public function getErrorCode(): string
    {
        return "SAP_BUSINESS_ERROR";
    }
}
