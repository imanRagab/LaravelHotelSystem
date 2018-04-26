<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'room_num',
        'capacity',
        'price',
        'status' 
    ];
}
