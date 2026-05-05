<?php
declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Default API Version
    |--------------------------------------------------------------------------
    | Options: 'auto', 'standard' (Fusion Standard), 'pro' (Fusion Pro Reseller)
    | 'auto' will attempt to detect the API version automatically.
    */
    'api_version' => env('SERVERTHEME_API_VERSION', 'pro'),

    /*
    |--------------------------------------------------------------------------
    | Fusion Standard API Configuration (Legacy - Action-based)
    |--------------------------------------------------------------------------
    */
    'standard' => [
        'base_url' => env('SERVERTHEME_STANDARD_URL', 'https://yourdomain.com/api/'),
        'api_key' => env('SERVERTHEME_STANDARD_API_KEY'),
        'username' => env('SERVERTHEME_STANDARD_USERNAME'),
        'timeout' => env('SERVERTHEME_STANDARD_TIMEOUT', 30),
        'retries' => env('SERVERTHEME_STANDARD_RETRIES', 3),
    ],

    /*
    |--------------------------------------------------------------------------
    | Fusion Pro API Configuration (Modern - RESTful)
    |--------------------------------------------------------------------------
    */
    'pro' => [
        'base_url' => env('SERVERTHEME_PRO_URL', 'https://api.dhrufusion.com'),
        'api_token' => env('SERVERTHEME_PRO_API_TOKEN'),
        'timeout' => env('SERVERTHEME_PRO_TIMEOUT', 30),
        'retries' => env('SERVERTHEME_PRO_RETRIES', 3),
    ],

    /*
    |--------------------------------------------------------------------------
    | Common Settings
    |--------------------------------------------------------------------------
    */
    'default_currency' => env('SERVERTHEME_DEFAULT_CURRENCY', 'USD'),
    'log_orders' => env('SERVERTHEME_LOG_ORDERS', true),
    'feedback_route_prefix' => env('SERVERTHEME_FEEDBACK_PREFIX', 'api/servertheme/webhook'),
    'cache_ttl' => env('SERVERTHEME_CACHE_TTL', 300),
];
