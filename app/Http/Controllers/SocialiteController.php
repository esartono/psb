<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Exception;
use Auth;
use Socialite;
use Carbon\Carbon;

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
            if ($finduser) {
                Auth::login($finduser);
                return redirect()->intended('home');
            } else {
                $random_password = Hash::make(Str::random(8));
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => Hash::make($random_password),
                    'email_verified_at' => Carbon::now(),
                ]);

                Auth::login($newUser);
                return redirect()->intended('home');
            }
        } catch (Exception $e) {
            return redirect()->intended('login');
            // dd($e->getMessage());
        }
    }
}
