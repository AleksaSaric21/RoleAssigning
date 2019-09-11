<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credetials = $request->validate([
                'name' => 'required',
                'password' => 'required',
            ]
        );
        if (Auth::attempt($credetials)) {
            $user = Auth::user();
            $user->roles = $user->roles;
        }

    }

    public function register()
    {

    }
}
