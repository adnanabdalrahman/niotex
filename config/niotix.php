<?php
return [
    'base_url' => env('NIOTIX_API_BASE_URL'),
    'account_id' => env('ACCOUNT_ID'),
    'scope_id' => env('SCOPE_ID'),
    'digital_twin_id' => env('DIGITAL_TWIN_ID'),
    'api_key' => env('NIOTIX_API_KEY'),
    'digital_twin_path' => '/digital-twins/',
    // niotix allows 70 calls per minute per API key; stay a bit below that
    'rate_limit_per_minute' => (int)env('NIOTIX_RATE_LIMIT_PER_MINUTE', 60),
    // How often to wait for the window to reset after API_LIMIT_REACHED before giving up
    'rate_limit_max_waits' => (int)env('NIOTIX_RATE_LIMIT_MAX_WAITS', 5),
];
