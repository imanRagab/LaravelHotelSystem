<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\Room;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReservationRequest;

class ReservationsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roomsAvailable = Room::all()->where('status',1);
        return view('reservations.index',['user' => Auth::user(),'rooms' => $roomsAvailable]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Room $room)
    {
        return view('reservations.create',['user' => Auth::user(),'room' => $room]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( ReservationRequest $request)
    {
       
        //

    }

}
