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
        
        return $this->belongsTo(User::class)->name;
    }

    public function room(){
        
        return $this->belongsTo(Room::class);
    }
}
