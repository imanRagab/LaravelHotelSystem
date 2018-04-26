<?php

namespace App\Http\Controllers\Reservations;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        $Reservations = Reservation::with('room')->where('client_id',Auth::user()->id)->get();
        return view('reservations.show',['user' => Auth::user(),'reservations' => $Reservations]);
    }
}
