<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\Room;
use App\User;

use Illuminate\Http\Request;


class ReservationsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reservations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }
}
