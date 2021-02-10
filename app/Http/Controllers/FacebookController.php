<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();
        dd($user);
        try {
        } catch (Exception $e) {
            dd($e->getMessage());
        }
        // $user = Socialite::driver('facebook')->user();
        // dd($user);
    }
}
