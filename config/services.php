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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'facebook' => [
        'client_id' => '1269305420109881',
        'client_secret' => 'd7de17b39b7b62c440a8585131e31f29',
        'redirect' => 'https://shopblue.com/WEB_Laravel/public/login-customer/callback'
    ],
    'google' => [
        'client_id' => '480333666223-behtvqqle6di8408ug7c3o8p066i6q04.apps.googleusercontent.com',
        'client_secret' => 'gzm2XaOnD4qj7bnzD1uHtbRU',
        'redirect' => 'https://shopblue.com/WEB_Laravel/public/login-customer/google/callback'
    ],


];
