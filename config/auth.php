<?php

use App\Models\Actor;

return [
    'defaults' => [
        'guard' => 'api',
        'passwords' => 'actors',
    ],

    'guards' => [
        'api' => [
            'driver' => 'jwt',
            'provider' => 'actors',
        ],
    ],

    'providers' => [
        'actors' => [
            'driver' => 'eloquent',
            'model' => Actor::class
        ]
    ]
];
