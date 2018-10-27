<?php

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

Route::group(['prefix' => '', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');
});
/*
Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();
/*
Route::get('/home', 'HomeController@index')->name('home');*/

Route::group(['prefix' => 'admin/countries', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'Demograph\CountryController@index');/*
    Route::get('/create', 'CountryController@newCountry');
    Route::get('/{id}/change', 'CountryController@changeCountry');
    Route::post('/save', 'CountryController@saveCountry');
    Route::put('/{id}/update', 'CountryController@updateCountry');
    Route::delete('/{id}/remove', 'CountryController@deleteCountry');*/
});
