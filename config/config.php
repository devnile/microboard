<?php

return [
    /**
     |
     */
    'routes' => [
        'prefix' => 'admin',
        'middleware' => [
            'web',
            // 'auth', 'can:view-dashboard'
        ],
        'apiMiddleware' => [
            'api'
        ]
    ]
];
