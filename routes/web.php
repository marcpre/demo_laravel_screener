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

// Main Homepage
Route::get('/',[
    'as' => 'index',
    'uses' => 'OverviewController@index'
]);

Route::get('/details/{instrument_id}', 'InstrumentsController@details')->name('instrument.details');
Route::get('/details/{instrument_id}/edit', 'InstrumentsController@editDetails')->name('instrument.editDetails');
Route::post('/details/{instrument_id}/update', 'InstrumentsController@updateDetails')->name('instrument.updateDetails');

// Auth
Auth::routes();

Route::post('/token/edit/{token_id}', 'InstrumentsController@store');

// Populate Data in Edit Modal Form
Route::get('/token/{token_id?}', 'InstrumentsController@show');

Route::get('/revision', 'RevisionController@index')->name('revision.rindex');

Route::post('/revision/approve/{rev}', 'RevisionController@approve')->name('revision.approve');

Route::post('/revision/disapprove/{rev}', 'RevisionController@disapprove')->name('revision.disapprove');

Route::post('/revision/filter', 'RevisionController@filter')->name('revision.filter');

//edit revision
Route::get('/revision/{instruments_id}/edit', 'InstrumentsController@editAdmin')->name('revision.edit');

Route::post('/revision/{instruments_id}', 'InstrumentsController@updateAdmin')->name('revision.update');

Route::post('/revision/command/updateOverview', 'InstrumentsController@updateOverview')->name('revision.updateOverview');
