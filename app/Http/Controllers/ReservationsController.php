<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\Room;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReservationRequest;
use Yajra\Datatables\Datatables;
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
        return view('reservations.index',['user' => Auth::user()]);
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
        ));
        Charge::create ( array (
            "amount" => $room->price,
            "currency" => "usd",
            "description" => "Test payment.", 
            "source" => $request->stripeToken
        ) );
        return redirect('/reservations/all');
    }
    public function get_available_rooms()
    {
        $AvailableRooms = Room::all()->where('status',1);
        return Datatables::of($AvailableRooms)
        ->addColumn('paid_price',function($AvailableRoom){
            return $AvailableRoom->dollar_price;
        })->addColumn('action',function($AvailableRoom){
            return '<a href="/reservations/'.$AvailableRoom->id.'" class="btn btn-xs btn-primary">Make</a>';
        })
        ->make(true);
    }

}
