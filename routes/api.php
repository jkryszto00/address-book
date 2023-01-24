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

Route::get('addresses/search', \App\Http\Controllers\IndexController::class);
Route::apiResource('addresses', \App\Http\Controllers\AddressController::class);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/user', \App\Http\Controllers\UserController::class);
});
