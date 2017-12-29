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
Route::get('/',[
    'as' => 'index',
    'uses' => 'OverviewController@index'
]);

Auth::routes();

// Route::get('/sector', 'RevisionController@edit')->name('revision.editSec');
// Route::put('/sector', 'RevisionController@update')->name('revision.updateSec');

// Route::get('/countryOfOrigin', 'RevisionController@edit')->name('revision.editCoo');
// Route::post('/edit/{id}', 'RevisionController@update')->name('revision.updateCoo');

// Route::resource('editToken','RevisionController');

//update Token
//Route::post('editToken', 'RevisionController@update');

Route::put('/edit/{token_id}', 'InstrumentsController@store');

