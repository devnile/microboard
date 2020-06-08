<?php

return [
    'routes' => [
        'prefix' => 'admin',

        'middleware' => [
            'auth', 'can:view-dashboard'
        ],

        'apiMiddleware' => [
            //
        ],

        'auth' => [
            'register' => true,
            'verify' => true,
            'reset' => true,
            'confirm' => true
        ]
    ],

    'view' => [
        'enable_notifications' => true,
        'enable_global_search' => true,
        'enable_breadcrumbs' => true
    ]
];
