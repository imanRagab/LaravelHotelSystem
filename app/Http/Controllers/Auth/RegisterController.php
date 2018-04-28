<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'mobile' => 'required|string|size:11',
            'gender' =>'required|in:female,male',
            'country' =>'required|string',
            'avatar_image.*' => 'mimes:jpg,jpeg',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $request=request();
        if(empty($data['avatar_image'])){
            $data['avatar_image']="storage/images/avatar.jpg";
        }else{
            $image=$request->file('avatar_image');
            $path=$image->store('public/images');
            $splitPath=explode('/', $path, 3);
            $data['avatar_image']="storage/".$splitPath[1]."/".$splitPath[2];
        }
         $client=User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'mobile' =>$data['mobile'],
            'gender' => $data['gender'],
            'country' => $data['country'],
            'avatar_image' => $data['avatar_image'],
            'approved_state' => 0
            
        ]);
        $client->assignRole('client');
        return $client;
    }
}
