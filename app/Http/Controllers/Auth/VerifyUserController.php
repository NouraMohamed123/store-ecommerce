<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\VerficationUser;
use Illuminate\Http\Request;

class VerifyUserController extends Controller
{
    public $verfictionCode;
    public function __construct(VerficationUser $verfictionCode)
    {
        $this->verfictionCode =$verfictionCode;
    }
    public function verfiy( Request $request){
      $check =  $this->verfictionCode->checkCode($request->code);
        if(!$check){
               return 'wrong code';
        }else{
            return 'wright code';
        }
      return $request;
    }
}

