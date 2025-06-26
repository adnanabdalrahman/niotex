<?php

namespace App\Exceptions;

use Exception;

class AdresseGesperrtException extends Exception
{
    public function __construct(int $adressNummer, int $code = 403)
    {
        parent::__construct("Dieser Geschäftspartner ($adressNummer) ist gesperrt.", $code);
    }
}
