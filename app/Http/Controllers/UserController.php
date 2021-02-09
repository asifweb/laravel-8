<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        dd($id);
        return view('user.profile', [
            'user' => User::findOrFail($id)
        ]);
    }
}
