<?php

return [
    'api_sso' => env('API_SSO'),
    'client_id' => env('CLIENT_ID'),
    'client_secret' => env('CLIENT_SECRET'),
    'endpoint' => [
        'credential' => '/api/web/v1/auth/credential',
        'login' => '/api/auth/login',
    ],
    'credential' => [
        'username' => env('SSO_USERNAME'),
        'password' => env('SSO_PASSWORD'),
    ],
];
