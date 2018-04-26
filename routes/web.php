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

Route::get('reservations', 'ReservationsController@index');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

////////Floors Routes/////////////

Route::get('floors','FloorsController@index')->middleware('auth');
Route::post('update/{floor}','FloorsController@update')->middleware('auth');
Route::get('floors/{floor_num}/edit','FloorsController@edit')->middleware('auth');
Route::delete('floors/{floor_num}','FloorsController@destroy')->middleware('auth');
Route::get('floors/create','FloorsController@create')->middleware('auth');
Route::post('floors','FloorsController@store')->middleware('auth');

//////////Rooms Routes/////////////////////////
Route::get('rooms','RoomsController@index')->middleware('auth');
Route::get('getRoomsData', 'RoomsController@getData')->name('rooms.data')->middleware('auth');
Route::post('update/{room}','RoomsController@update')->middleware('auth');
Route::get('rooms/{room_num}/edit','RoomsController@edit')->middleware('auth');
Route::delete('floors/{room_num}','RoomsController@destroy')->middleware('auth');




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

/** Ban Or UnBan Receptionist */
Route::post('receptionists/ban','ReceptionistsController@banOrunban');
/** Delete Receptionist */
Route::post('receptionists/delete','ReceptionistsController@destroy');
///////////////////////////////////////////


//Managers Routes

/** dispaly all Managers */
Route::get('/managers', 'ManagersController@index')->name('managers');
Route::get('/managers/get_all_managers', ['as'=>'managers.get_all_managers','uses'=>'ManagersController@get_all_managers']);

/** create Managers */
Route::get('managers/create','ManagersController@create')->name('managers.create');
Route::post('/managers','ManagersController@store');

///////////////////////////////////////////

Route::get('managers', 'ManagersController@index');

Route::get('clients','Client\UsersController@index')->name('clients');

/////// Reservations Routes /////////////////////////

///////////CRUD Routes /////////////////////////

Route::get('reservations', 'ReservationsController@index');

///////////////////////////////////////////////


/////// Clients Routes /////////////////////////

///////////CRUD Routes /////////////////////////
// Route::get('clients', 'ClientsController@index')->middleware('auth');
Route::post('clients/delete', 'ClientsController@delete')->middleware('auth');
Route::get('clients/{client}/edit', 'ClientsController@edit')->middleware('auth');
Route::patch('clients/{client}', 'ClientsController@update')->middleware('auth');
Route::delete('clients/{client}', 'ClientsController@destroy')->middleware('auth');
Route::get('clients/approved', 'ClientsController@index')->middleware('auth');
Route::get('getApprovedClientsData', 'ClientsController@getApprovedData')->name('approvedClients.data')->middleware('auth');
Route::post('clients/{client}/approve', 'ClientsController@approve')->middleware('auth');
Route::get('getPendingClientsData', 'ClientsController@getPendingData')->name('pendingClients.data')->middleware('auth');
Route::get('clients/manage', 'ClientsController@manage')->middleware('auth');
Route::get('clients/reservations', 'ClientsController@showReservations')->middleware('auth');
Route::get('getReservationsData', 'ClientsController@getReservationsData')->name('clientsReservations.data')->middleware('auth');
///////////////////////////////////////////////

Route::get('register','Client\RegistersController@show')->name('register');






