<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Room;

class Reservation extends Model
{
    protected $fillable = [
        'room_id',
        'accompany_number',
        'paid_price',
        'client_id'
        
        
    ];
    /**
     * relation one to meny
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    /**
     * change format of price
     */
    public function getDollarPriceAttribute($value){
        return $this->paid_price/100;
    }
}
