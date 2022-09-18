<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Nasdaq source url
    |--------------------------------------------------------------------------
    |
    | Here it's defined the url from where the import of all companies is going
    | to be taken. This is currently only used in database seeding
    |
    */
    'url' => env('NASDAQ_LISTED_URL', false),

    'historical_api_url' => env('RAPIDAPI_HISTORICAL_URL', false),

    'api_key' => env('RAPIDAPI_KEY', false),

    'api_host' => env('RAPIDAPI_HOST', false),
];
