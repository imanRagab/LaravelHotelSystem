<?php
use App\User;
use App\Notifications\greetClient;
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

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


/**************************************** Routes For Admin Only ***********************************/


Route::group(['middleware' => ['role:admin']], function () {
    //Managers Routes
    /** dispaly all Managers */
    Route::get('/managers', 'ManagersController@index')->name('managers');
    Route::get('/managers/get_all_managers', ['as'=>'managers.get_all_managers','uses'=>'ManagersController@get_all_managers']);
    
    /** create Managers */
    Route::get('managers/create','ManagersController@create')->name('managers.create');
    Route::post('/managers','ManagersController@store');
    
    
    /** Edit Manager Info */
    Route::get('managers/{manager}/edit','ManagersController@edit')->name('managers.edit');
    Route::put('managers/{id}','ManagersController@update');
    
    /** Delete Receptionist */
    Route::post('managers/delete','ManagersController@destroy');
    
    });


/**************************************** Routes For Admin and Managers ***********************************/
Route::group(['middleware' => ['role:admin|manager']], function () {
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
   

////////Floors Routes/////////////

Route::get('floors','FloorsController@index')->middleware('auth');
Route::patch('floors/{floor}', 'FloorsController@update')->middleware('auth');
Route::get('floors/{floor}/edit','FloorsController@edit')->middleware('auth');
Route::delete('floors/{floor}','FloorsController@destroy')->middleware('auth');
Route::get('floors/create','FloorsController@create')->middleware('auth');
Route::post('floors','FloorsController@store')->middleware('auth');
Route::get('getFloorsData', 'FloorsController@getData')->name('floors.data')->middleware('auth');






   
     //////////Rooms Routes/////////////////////////
Route::get('rooms','RoomsController@index')->middleware('auth');
Route::get('getRoomsData', 'RoomsController@getData')->name('rooms.data')->middleware('auth');
Route::patch('rooms/{room}', 'RoomsController@update')->middleware('auth');
Route::get('rooms/{id}/edit','RoomsController@edit')->middleware('auth');
Route::delete('rooms/{room}','RoomsController@destroy')->middleware('auth');
Route::get('rooms/create','RoomsController@create')->middleware('auth');
Route::post('rooms','RoomsController@store')->middleware('auth');
});


/**************************************** Routes For Admin && Managers && Receptionists ***********************************/


Route::group(['middleware' => ['role:admin|manager|receptionist']], function () {
   
});
/**************************************** Routes For Clients only ***********************************/


Route::group(['middleware' => ['role:client']], function () {
  /**
 * reservation routes, show client's reversation
 */
Route::get('reservations/all','Reservations\ReservationsController@index')->name('reservations');
/**
 * reservation routes, show client's reversation
 */
Route::get('reservations/all/get_all_reservation','Reservations\ReservationsController@get_all_reservation')->name('reservations/all');
/**
 * reservation routes, show available rooms
 */
Route::get('reservations','ReservationsController@index');
/**
 * reservation routes, show available rooms
 */
Route::get('reservations/get_available_rooms','ReservationsController@get_available_rooms')->name('availablerooms');

/**
 * reservation routes, create reservation
 */
Route::get('reservations/{room}','ReservationsController@create');

/**
 * reservation routes, store reservation
 */

Route::post('reservations','ReservationsController@store'); 
});


///////////////////////////////////////////


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


/**
 * Edit profile for all users
 */
Route::get('users/{user}/edit', 'ClientsController@editProfile')->middleware('auth')->name('editProfile');
/**
 * Show profile for all users
 */
Route::get('users/{user}/', 'ClientsController@show')->middleware('auth')->name('users.show');
/**
 * Update profile for all users
 */
Route::put('users/{user}', 'ClientsController@updateProfile')->middleware('auth')->name('updateProfile');
Route::get('/signout','ClientsController@signOut')->middleware('auth')->name('signOut');

Route::post('checkout','ReservationsController@store');

