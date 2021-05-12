<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['db_transaction', 'log.route']], function () {

    Route::prefix('regis')->group(function () {
        Route::post('regis-account', 'UserAccountRegisterController@registerNewUser');
    });

    Route::prefix('auth')->group(function () {
        Route::post('login', 'AuthController@login');
    });
});

Route::group(['middleware' => ['api_auth', 'db_transaction', 'log.route']], function () {
    Route::prefix('auth')->group(function () {
        Route::post('logout', 'AuthController@logout');
    });
});
