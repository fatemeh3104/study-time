<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\SignUpUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function login(LoginUserRequest $request)
    {
        $request = $request->validated();
        $user = User::where('email', $request['Email'])->first();
        if (! $user || ! Hash::check($request['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        return $user->createToken('token_base_name')->plainTextToken;
    }
    public function sign_up(SignUpUserRequest $request){
        $request = $request->validated();
        $code = OTP::generate();
        dd($code);
    }
}
