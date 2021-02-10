<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        try {
            $user = Socialite::driver('google')->user();
            $findUser = User::where('provider_id', $user->id)->first();
            if ($findUser) {
                Auth::login($findUser);
                return redirect()->intended('dashboard');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'image' => $user->avatar,
                    'provider' => 'google',
                    'provider_id' => $user->id,
                    'password' => encrypt('test')
                ]);
                Auth::login($newUser);
                return redirect()->intended('dashboard');
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}
