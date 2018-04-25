<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Laravel\Socialite\Facades\Socialite;
use App\User;
use Auth;
class SocialAuthController extends Controller
{
     /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
    	return Socialite::driver($provider)->redirect();
    }
 
    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

    	$authUser = User::firstOrNew(['email'=>$user->email]);
        $authUser -> name = ($user -> name == null) ? $user -> nickname : $user -> name;
        $authUser -> provider_id = $user -> id;
        $authUser -> provider = $provider;
        $authUser -> save();

        Auth::guest() ? auth()->login($authUser) : '';

        session(['user' => $user]);

        return redirect('/home');
    }
}
