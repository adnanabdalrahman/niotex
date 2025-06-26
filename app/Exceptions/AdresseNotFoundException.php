<?php

namespace App\Exceptions;

use Exception;

class AdresseNotFoundException extends Exception
{
    public function __construct(int $vbeln, int $adressNummer, int $code = 404)
    {
        parent::__construct("Kein Adresse für Vorgang gefunden, kunnr:$adressNummer, vbeln: $vbeln", $code);
    }
}
