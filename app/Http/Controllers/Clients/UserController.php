<?php

namespace App\Http\Controllers\Clients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function index(){
        return view ('clients/index',[
            'clients'=>User::paginate(3) //rule
        ]);
    }
}
