<?php

namespace App\Exceptions;

use Exception;

class Position3MengeNotFound extends Exception
{
    public function __construct(int $vorgangnummer, $internePositionsnummer, int $code = 404)
    {
        parent::__construct("Dieser Geschäftspartner ($vorgangnummer) ist gesperrt.", $code);
    }
}
