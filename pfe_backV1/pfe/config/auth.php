<?php

return [
    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        
        'responsable' => [
            'driver' => 'session',
            'provider' => 'responsables',
        ],
        
        'technicien' => [  // Ajout du guard technicien
            'driver' => 'session',
            'provider' => 'techniciens',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),
        ],
        
        'responsables' => [
            'driver' => 'eloquent',
            'model' => App\Models\Responsable::class,
        ],
        
        'techniciens' => [  // Ajout du provider techniciens
            'driver' => 'eloquent',
            'model' => App\Models\Technicien::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
        
        'responsables' => [
            'provider' => 'responsables',
            'table' => 'password_reset_tokens_responsables',
            'expire' => 60,
            'throttle' => 60,
        ],
        
        'techniciens' => [  // Ajout de la config reset password pour techniciens
            'provider' => 'techniciens',
            'table' => 'password_reset_tokens_techniciens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),
];