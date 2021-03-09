<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','PagesController@index')->name('home');
Route::get('/trial','PagesController@trial');
Route::get('/coba','PagesController@coba');


Route::post('/fcr', 'AutofeedController@proses');


Route::get('login', 'AuthController@showFormLogin')->name('login');
Route::post('login', 'AuthController@login');
Route::get('harus_login', 'AuthController@harus_login')->name('harus_login');

Route::get('register', 'AuthController@showFormRegister')->name('register');
Route::post('register', 'AuthController@register');

//Google Login
Route::get('login/google', 'OAuthController@redirectToGoogle')->name('login.google');
Route::get('login/google/callback', 'OAuthController@handleGoogleCallback');

//Facebook Login
Route::get('login/facebook', 'OAuthController@redirectToFacebook')->name('login.facebook');
Route::get('login/facebook/callback', 'OAuthController@handleFacebookCallback');


 

Route::group(['middleware' => 'auth'], function () {
 
Route::get('index', 'PagesController@index')->name('index');
Route::get('logout', 'AuthController@logout')->name('logout');
Route::get('/fcr','PagesController@form')->name('fcr');

Route::get('edit_profile/{id}', 'AuthController@showFormEdit')->name('edit');
Route::patch('edit_profile/{id}','AuthController@update')->middleware('auth');

//Histori
Route::get('/histori','HistoriesController@show_histori')->name('histori');
Route::delete('/histori/{his}','HistoriesController@destroy')->middleware('auth');
Route::get('/histori/{his}/edit','HistoriesController@edit')->middleware('auth');
Route::get('/histori/{his}','HistoriesController@show')->middleware('auth');
Route::patch('/histori/{his}','HistoriesController@update')->middleware('auth');

});