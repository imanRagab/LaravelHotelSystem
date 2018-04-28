<?php

namespace App\Http\Controllers\Reservations;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use App\Reservation;

class ReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * show all reservations for certain client 
         */
        return view('reservations.show',['user' => Auth::user()]);
    }
    public function get_all_reservation()
    {
        $Reservations = Reservation::with('room')->where('client_id',Auth::user()->id)->get();
        return Datatables::of($Reservations)->addColumn('paid_price',function($Reservation){
            return $Reservation->dollar_price;
        })->addColumn('number',function($Reservation){
            return $Reservation->room->number;
        })->make(true);
    }
}
