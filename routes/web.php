<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(config('microboard.routes.auth', []));

Route::group([
    'middleware' => config('microboard.routes.middleware', []),
    'as' => 'microboard.'
], function () {
    Route::get('/', 'DashboardController')->name('home');
    Route::resources([
        'users' => 'UserController',
        'roles' => 'RoleController',
    ]);
});
