<?php

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

Route::group(['middleware' => ['api']], function () {

	Route::resource('users', \Api\UsersController::class);
	Route::resource('currencies', \Api\CurrenciesController::class);
	Route::resource('countries', \Api\CountriesController::class);
});