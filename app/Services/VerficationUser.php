<?php

namespace App\Services;

use App\Models\User;
use App\Models\verify_user;
use Illuminate\Support\Facades\Auth;

/**
 * Class VerficationUser.
 */
class VerficationUser
{
    public function Fto(){
        return 55;
    }
    public function setVerificationCode($data)
    {
        $code = mt_rand(100000, 999999);
        $data['code'] = $code;
        verify_user::whereNotNull('user_id')->where(['user_id' => $data['user_id']])->delete();
        return verify_user::create($data);
    }
    public function checkCode($code){
        if(Auth::guard()->check()){
     $vericationData =   verify_user::where('user_id',Auth::id())->first();
     if($vericationData -> code == $code){
         User::whereId(Auth::id())->update(['verfied_code'=> now()]);
        return true;
        }else{
         return false;
     }
    }else{
        return false;
    }
    }
}
