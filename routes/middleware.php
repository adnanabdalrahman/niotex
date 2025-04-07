<?php 
use App\Http\Middleware\VerifySapToken;

return [
    'sap.auth' => VerifySapToken::class,
];
