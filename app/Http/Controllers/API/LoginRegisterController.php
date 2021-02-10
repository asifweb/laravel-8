<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginRegisterController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'image' => '',
            'provider' => '',
            'provider_id' => '',
            'password' => bcrypt($request->password)
        ]);
        $success['token'] = $user->createToken('access_token')->accessToken;
        $success['name'] = $user->name;

        $response = [
            'success' => true,
            'data' => $success,
            'message' => 'Registered Successfully'
        ];
        return response()->json($response, 200);
    }
    public function login(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('access_token')->accessToken;
            $success['name'] = $user->name;
            $response = [
                'success' => true,
                'data' => $success,
                'message' => 'Logged In'
            ];
        } else {
            $response = [
                'success' => false,
                'data' => '',
                'message' => 'Login Failed'
            ];
        }
        return response()->json($response, 200);
    }
}
