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
    ],

    'view' => [
        'enable_notifications' => true,
        'enable_global_search' => true,
        'enable_breadcrumbs' => true
    ]
];
