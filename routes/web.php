<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(config('microboard.routes.auth', []));
Route::get('/lang/{code}', 'LanguageController')->name('switch.language');

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
    Route::post('/media/upload', 'MediaLibraryController@upload')->name('media.store');
    Route::delete('/media/delete', 'MediaLibraryController@delete')->name('media.destroy');
});
