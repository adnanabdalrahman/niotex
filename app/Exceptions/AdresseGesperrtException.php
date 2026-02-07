<?php

namespace App\Exceptions;

namespace App\Exceptions;

class AdresseGesperrtException extends ApiException
{

    public function __construct(
        string $message = "Dieser Geschäftspartner ist gesperrt.",
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

