<?php

return [

    'secret' => env('JWT_SECRET'),

    'keys' => [
        'public'     => env('JWT_PUBLIC_KEY', 'file://' . storage_path('oauth-public.key')),
        'private'    => env('JWT_PRIVATE_KEY', 'file://' . storage_path('oauth-private.key')),
        'passphrase' => env('JWT_PASSPHRASE', ''),
    ],

    'ttl' => null,

    'refresh_ttl' => (int) env('JWT_REFRESH_TTL', 20160),

    'algo' => env('JWT_ALGO', \Tymon\JWTAuth\Providers\JWT\Provider::ALGO_HS256),

    'required_claims' => [
        'iss',
        'iat',
        'nbf',
        'sub',
        'jti',
    ],

    'persistent_claims' => [],

    'lock_subject' => env('JWT_LOCK_SUBJECT', true),

    'leeway' => (int) env('JWT_LEEWAY', 0),

    'blacklist_enabled' => env('JWT_BLACKLIST_ENABLED', true),

    'blacklist_grace_period' => (int) env('JWT_BLACKLIST_GRACE_PERIOD', 0),

    'decrypt_cookies' => env('JWT_DECRYPT_COOKIES', false),

    'providers' => [
        'jwt'     => \Tymon\JWTAuth\Providers\JWT\Lcobucci::class,
        'auth'    => \Tymon\JWTAuth\Providers\Auth\Illuminate::class,
        'storage' => \Tymon\JWTAuth\Providers\Storage\Illuminate::class,
    ],
];
