<?php

namespace App\Helpers;

use App\Models\User;
use App\Models\Verification;

class OTP {

    public static function generate():int{
        return(rand(rand(100000,999999),rand(100000,999999)));
    }
    public static function verify($phone,$code){
        $verification = Verification::query()->where('phone',$phone)->first();
        if ($verification['code'] == $code){
            $verification->verified = true;
            $verification->save();
            return true;
        }
        else{
            return false;
        }
    }


}
