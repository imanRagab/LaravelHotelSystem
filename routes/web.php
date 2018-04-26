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

/**
 * reservation routes, show client's reversation
 */
Route::get('reservations/all','Reservations\ReservationsController@index');
/**
 * reservation routes, show available rooms
 */
Route::get('reservations','ReservationsController@index');
/**
 * reservation routes, create reservation
 */
Route::get('reservations/{room}','ReservationsController@create');

/**
 * reservation routes, store reservation
 */
Route::post('reservations','ReservationsController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('clients','Client\UsersController@index')->name('clients');
Route::get('register','Client\RegistersController@show')->name('register');

