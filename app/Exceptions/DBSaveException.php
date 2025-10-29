<?php

namespace App\Exceptions;

class DBSaveException extends ApiException
{
    public function __construct(
        string $message = "Fehler beim Speichern der Ressource.",
        array  $errors = [],
        int    $statusCode = 500,
    )
    {
        parent::__construct($message, $errors, $statusCode);
    }

    public function getErrorCode(): string
    {
        return "RESOURCE_NOT_SAVED";
    }
}
