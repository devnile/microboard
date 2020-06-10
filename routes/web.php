<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes(config('microboard.routes.auth', []));

Route::group([
    'middleware' => config('microboard.routes.middleware', []),
    'as' => 'microboard.'
], function() {
    Route::get('/', 'DashboardController')->name('home');
    Route::resource('users', 'UserController');
});
