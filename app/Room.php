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
    /**
     * change format of price
     */
    public function getDollarPriceAttribute($value){
        return $this->price/100;
    }
}
