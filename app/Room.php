<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'id',
        'number',
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
        
        return $this->hasMany(User::class,  'id','created_by');
    }
    

}