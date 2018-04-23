<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{
    /**
     * find clients user.
     *
     * @return User with role client 
     */
    public function index(){
        return view ('clients/index',[
            'clients'=>User::role('client')->get() 
        ]);
    }


}
