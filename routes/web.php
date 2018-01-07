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

Route::get('/',[
    'as' => 'index',
    'uses' => 'OverviewController@index'
]);

Auth::routes();

Route::post('/token/edit/{token_id}', 'InstrumentsController@store');

// Populate Data in Edit Modal Form
Route::get('/token/{token_id?}', 'InstrumentsController@show');

Route::get('/revision', 'RevisionController@index')->name('revision.rindex');

Route::post('/revision/approve/{rev}', 'RevisionController@approve')->name('revision.approve');

Route::post('/revision/disapprove/{rev}', 'RevisionController@disapprove')->name('revision.disapprove');

Route::post('/revision/filter', 'RevisionController@filter')->name('revision.filter');

//edit revision
Route::get('/revision/{revision}/edit', 'RevisionController@edit')->name('revision.edit');

Route::post('/revision/{revision}', 'RevisionController@update')->name('revision.update');
