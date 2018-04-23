<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{
    public function index(){

    /**
     * find clients user.
     *
     * @return User with role client 
     */
        return view ('clients/index',[
            'clients'=>User::role('admin')->get() 
        ]);
    }
}
