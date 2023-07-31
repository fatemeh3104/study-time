<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login()
    {
        \request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where('email', \request('email'))->first();
        if (! $user || ! Hash::check(\request('password'), $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        return $user->createToken('token_base_name')->plainTextToken;
    }
}
