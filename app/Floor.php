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
        
        return $this->belongsTo(User::class);
    }

    public function rooms()
    {
        return $this->hasMany('App\Room');
    }


}
