<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\OTP;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\SignUpUserRequest;
use App\Http\Requests\VerificationRequest;
use App\Models\User;
use App\Models\Verification;
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
    public function sign_up(SignUpUserRequest $request):bool
    {
        $validatedData= $request->validated();
        $phone = $validatedData['phone'];
        $code = OTP::generate();
        $verification = new Verification();
        try {
            $verification['phone']=$phone;
            $verification['code'] = $code;
            $verification->save();
            return true;
        }catch (\Exception $e){
            return false;
        }
    }
    public function verification(VerificationRequest $request):bool
    {
        $validatedData = $request->validated();
        $phone = $validatedData['phone'];
        $code = $validatedData['code'];
        return OTP::verify($phone,$code);

    }
    public function register(RegisterRequest $request)
    {
        $validated_data = $request->validated();
        $phone = $validated_data['phone'];
        $verified_phones = Verification::query()->where('verified',true)->get();
        $user = new User();
        foreach ($verified_phones as $verified_phone){
            if ($phone==$verified_phone['phone']){
                try {
                    foreach ($validated_data as $key => $item) {
                        $user->{$key} = $item;
                    }
                    $user->save();
                }catch (\Exception $e){
                    dd($e);
                }
            }
        }




    }
}
