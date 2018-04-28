<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\Room;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReservationRequest;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;

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

        $room=Room::where('id',$request->id)->first();
        Reservation::create([
            'room_id' => $request->id,
            'accompany_number' => $request->accompany_number,
            'paid_price' => $room->price,
            'client_id' => Auth::user()->id
        ]);
        Room::where('id',$request->id)->update(['status' => 0]);
        Stripe::setApiKey ( env('STRIPE_SECRET_KEY') );
        Customer::create(array(
            'email' => Auth::user()->email,
            'source'  => $request->stripeToken
        ));
        Charge::create ( array (
            "amount" => $room->price,
            "currency" => "usd",
            "description" => "Test payment.", 
            "source" => "tok_amex"
        ) );
        return redirect('/reservations/all');
    }

}
