<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'room_id',
        'accompany_number',
        'paid_price',
        'status'        
        
    ];
}
