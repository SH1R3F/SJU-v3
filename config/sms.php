<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Smser
    |--------------------------------------------------------------------------
    |
    | This option controls the default smser that is used to send any sms
    | messages sent by your application. Alternative smsers may be setup
    | and used as needed; however, this smser will be used by default.
    |
    */

    'default' => env('SMS_PROVIDER', 'taqnyat'),

    /*
    |--------------------------------------------------------------------------
    | Smser Configurations
    |--------------------------------------------------------------------------
    |
    | Here you may configure all of the smsers used by your application.
    |
    |
    | Supported: "twilio", "nexmo"
    |
    */

    'smsers' => [
        'twilio' => [
            'auth_token' => env('TWILIO_AUTH_TOKEN', null),
            'account_sid' => env('TWILIO_ACCOUNT_SID', null),
            'service_sid' => env('TWILIO_SMS_SERVICE_SID', null),
        ],
        'vonage' => [
            'api_key' => env('VONAGE_API_KEY', null),
            'api_secret' => env('VONAGE_API_SECRET', null),
            'from' => env('VONAGE_FROM', null),
        ],
        'taqnyat' => [
            'bearer' => env('TAQNYAT_BEARER', null),
            'sender' => env('TAQNYAT_SENDER', null)
        ]
    ],

];
