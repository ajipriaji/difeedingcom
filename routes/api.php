<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Login
Route::middleware('auth.token')->get('/datauser_api','AuthController@tampildata_api');

Route::middleware('auth.token')->post('/post_login_api', 'AuthController@api_login');
Route::post('/token_login_api', 'AuthController@api_login');

Route::middleware('auth.token')->post('/post_register_api', 'AuthController@api_register');
Route::post('/token_register_api', 'AuthController@api_register');


Route::middleware('auth.token')->get('/datahis_api','HistoriesController@tampildata_api');
Route::middleware('auth.token')->get('/datahis_api/{id}','HistoriesController@tampildatauser_api');


Route::middleware('auth.token')->post('/datahis_api','HistoriesController@tambahdata_api');
