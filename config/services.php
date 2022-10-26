<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */
    'xendit' => [
        'key' => env('XENDIT_PUBLIC_KEY'),
        'secret' => env('XENDIT_SECRET_KEY'),
        'url' => env('XENDIT_URL'),
        'token_callback' => env('XENDIT_TOKEN_CALLBACK'),
    ],

];
