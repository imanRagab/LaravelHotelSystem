<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    protected $fillable = [
        'name'
    ];


    public function user()
    {
        
        return $this->hasMany(User::class,  'id','created_by');
    }

    public function rooms()
    {
        return $this->hasMany('App\Room');
    }


}