<?php

namespace App\Exceptions;

class InvalidTaxRateException extends ApiException
{
    public function __construct(
        string $message = 'Ungültiger oder unklarer Steuersatz.',
        array  $errors = [],
        int    $statusCode = 422,
    )
    {
        parent::__construct($message, $errors, $statusCode);
    }

    public function getErrorCode(): string
    {
        return 'INVALID_TAX_RATE';
    }
}
