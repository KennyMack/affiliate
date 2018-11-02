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
    Route::get('/', 'Demograph\CountryController@index');
    Route::get('/create', 'Demograph\CountryController@create');
    Route::post('/save', 'Demograph\CountryController@store');

    Route::get('/{id}/edit', 'Demograph\CountryController@edit');
    Route::put('/{id}/update', 'Demograph\CountryController@update');

    Route::delete('/{id}/destroy', 'Demograph\CountryController@destroy');
});

Route::group(['prefix' => 'admin/states', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'Demograph\StateController@index');
    Route::get('/create', 'Demograph\StateController@create');
    Route::post('/save', 'Demograph\StateController@store');

    Route::get('/{id}/edit', 'Demograph\StateController@edit');
    Route::put('/{id}/update', 'Demograph\StateController@update');

    Route::delete('/{id}/destroy', 'Demograph\StateController@destroy');
});

Route::group(['prefix' => 'admin/cities', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'Demograph\CityController@index');
    Route::get('/create', 'Demograph\CityController@create');
    Route::post('/save', 'Demograph\CityController@store');

    Route::get('/{id}/edit', 'Demograph\CityController@edit');
    Route::put('/{id}/update', 'Demograph\CityController@update');

    Route::delete('/{id}/destroy', 'Demograph\CityController@destroy');
});

Route::group(['prefix' => 'admin/categories', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'Category\CategoryController@index');
    Route::get('/create', 'Category\CategoryController@create');
    Route::post('/save', 'Category\CategoryController@store');

    Route::get('/{id}/edit', 'Category\CategoryController@edit');
    Route::put('/{id}/update', 'Category\CategoryController@update');

    Route::delete('/{id}/destroy', 'Category\CategoryController@destroy');
});

Route::group(['prefix' => 'api/categories'], function () {
    Route::get('/main/{type}', 'Category\CategoryController@main');
    Route::get('/{id}/child/{type}', 'Category\CategoryController@child');
});

Route::group(['prefix' => 'admin/companies', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'Company\CompanyController@index');
    Route::get('/create', 'Company\CompanyController@create');
    Route::post('/save', 'Company\CompanyController@store');

    Route::get('/{id}/edit', 'Company\CompanyController@edit');
    Route::put('/{id}/update', 'Company\CompanyController@update');

    Route::delete('/{id}/destroy', 'Company\CompanyController@destroy');
});
