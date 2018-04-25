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
use DataTables;
Route::get('/', function () {
    return view('welcome');
});

Route::get('index', function () {
    return view('dashboard');
});

Route::get('reservations', 'ReservationsController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



//Receptionists Routes

/** dispaly all receptionists */
Route::get('/receptionists', 'ReceptionistsController@index')->name('receptionists');
Route::get('/receptionists/get_all_receptionists', ['as'=>'receptionists.get_all_receptionists','uses'=>'ReceptionistsController@get_all_receptionists']);
/** create Receptionist */
Route::get('receptionists/create','ReceptionistsController@create')->name('receptionists.create');
Route::post('/receptionists','ReceptionistsController@store');

/** Edit Receptionist Info */
Route::get('receptionists/{receptionist}/edit','ReceptionistsController@edit')->name('receptionists.edit');
Route::put('receptionists/{id}','ReceptionistsController@update');

