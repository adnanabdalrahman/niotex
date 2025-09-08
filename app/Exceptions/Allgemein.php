<?php

namespace App\Exceptions;

use Exception;

class Allgemein extends Exception
{
    public function __construct(int $m, $e, int $code = 404)
    {
        parent::__construct($m . $e->message, $code);
    }
}
