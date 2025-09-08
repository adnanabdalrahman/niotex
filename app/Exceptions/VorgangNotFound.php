<?php

namespace App\Exceptions;

use Exception;

class VorgangNotFound extends Exception
{
    public function __construct($interneVorgangsnummer, int $code = 404)
    {
        parent::__construct("Kein Vorgang gefunden. InterneVorgangsnummer : $interneVorgangsnummer", $code);
    }
}
