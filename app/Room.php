<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'room_num',
        'capacity',
        'price',
        'status',
        'created_by'
        
        
    ];

    /**
     * change format of price
     */
    public function getDollarPriceAttribute($value){
        return $this->price/100;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    

}
