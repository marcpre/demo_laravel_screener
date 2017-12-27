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

/*
Route::get('/', function () {
    return view('index');
});
*/
Auth::routes();

Route::get('/', 'OverviewController@index');

Route::post('/sector', 'RevisionController@update')->name('revision.updateSec');

Route::post('/countryOfOrigin', 'RevisionController@update')->name('revision.updateCoo');


