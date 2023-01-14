<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Payment provider
    |--------------------------------------------------------------------------
    |
    | This option controls the default payment provider that is used to 
    | provide payment process in your application. Alternative providers
    | may be setup and used as needed.
    |
    */

    'default' => env('PAYMENT_PROVIDER', 'oppwa'),

    /*
    |--------------------------------------------------------------------------
    | Payment providers Configurations
    |--------------------------------------------------------------------------
    |
    | Here you may configure all of the smsers used by your application.
    |
    |
    | Supported: "oppwa"
    |
    */

    'providers' => [
        'oppwa' => [
            'live' => [
                'mada' => env('OPPWA_LIVE_MADA'),
                'visa' => env('OPPWA_LIVE_VISA'),
                'url'  => env('OPPWA_LIVE_URL'),
                'auth' => env('OPPWA_LIVE_AUTH')
            ],
            'test' => [
                'mada' => env('OPPWA_TEST_MADA'),
                'visa' => env('OPPWA_TEST_VISA'),
                'url'  => env('OPPWA_TEST_URL'),
                'auth' => env('OPPWA_TEST_AUTH')
            ],
        ],
    ],

];
