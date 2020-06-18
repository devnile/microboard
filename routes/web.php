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
    Route::get('/settings', 'SettingController@index')->name('settings.index');
    Route::post('/settings', 'SettingController@store')->name('settings.store');
    Route::patch('/settings', 'SettingController@update')->name('settings.update');
    Route::post('/media/upload', 'MediaLibraryController@store')->name('media.store');
    Route::delete('/media/delete', 'MediaLibraryController@destroy')->name('media.destroy');
});
