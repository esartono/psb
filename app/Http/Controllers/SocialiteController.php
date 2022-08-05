<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Exception;
use Auth;
use Socialite;

use App\User;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->with(["prompt" => "select_account"])->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $finduser = User::where('email', $user->email)->first();
            // $finduser = User::where('google_id', $user->id)->first();
            // if($finduser){
            //     Auth::login($finduser);
            //     return redirect()->intended('dashboard');
            // } else {
            //     $newUser = User::create([
            //         'name' => $user->name,
            //         'email' => $user->email,
            //         'google_id'=> $user->id,
            //         'password' => encrypt('123456dummy')
            //     ]);

            //     Auth::login($newUser);
            //     return redirect()->intended('dashboard');
            // }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
