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

Route::get('/', function () {
    return view('welcome');
});

Route::get('index', function () {
    return view('dashboard');
});

<<<<<<< HEAD
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/////// Reservations Routes /////////////////////////

///////////CRUD Routes /////////////////////////

Route::get('reservations', 'ReservationsController@index');

///////////////////////////////////////////////


/////// Clients Routes /////////////////////////

///////////CRUD Routes /////////////////////////
Route::get('clients', 'ClientsController@index')->middleware('auth');
Route::post('clients/delete', 'ClientsController@delete')->middleware('auth');
Route::get('clients/{client}/edit', 'ClientsController@edit')->middleware('auth');
Route::patch('clients/{client}', 'ClientsController@update') ;

///////////////////////////////////////////////

Route::get('register','Client\RegistersController@show')->name('register');

///////////////////////////////////////////////


=======
Route::get('reservations', 'ReservationsController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('clients','Client\UsersController@index')->name('clients');
Route::get('register','Client\RegistersController@show')->name('register');

>>>>>>> 574be324eabadabb0444aaa21422617dfada49fb
