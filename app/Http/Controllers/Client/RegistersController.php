<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistersController extends Controller
{
   public function show(){
     
       return view('auth/register',[
           'countries'=> countries()
           ]);
   }
}
