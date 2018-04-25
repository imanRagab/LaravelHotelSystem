<?php

namespace App;

use App\User;
use App\Room;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'room_id',
        'accompany_number',
        'paid_price',
        'client_id',               
        
    ];

    public function client(){
        
        // $client = User::where('id', $this->client_id);
        // return $client;
        return $this->belongsTo(User::class);
    }

    public function room(){
        
        // $room = Room::where('id', $this->room_id);
        // return $clients;
        return $this->belongsTo(Room::class);
    }
}
