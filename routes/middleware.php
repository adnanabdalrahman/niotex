<?php

use App\Http\Middleware\VerifyNiotixToken;

return [
    'niotix.auth' => VerifyNiotixToken::class,
];
