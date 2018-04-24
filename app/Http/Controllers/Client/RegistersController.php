<?php
namespace App\Http\Controllers\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cache;
class RegistersController extends Controller
{
   public function show(){
       if(!Cache::get('countries')){
            Cache::put('countries', countries(), 1440);
       }
     
       return view('auth/register',[
           'countries'=> Cache::get('countries')
           ]);
   }
}