<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdmilLoginRequest;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(){
        return view('dashboard.auth.login');
    }
    public function postLogin(Request $request){

        $remember_me = $request->has('remember_me')?true:false;
        if(auth()->guard('admin')->attempt(['email' => $request->email,'password' =>$request->password],$remember_me)){
            return redirect()->route('admin.dashboard');
        }
        return redirect()->back()->with(['error' => 'هناك خطأ بالبينات']);
    }


 public function logout(){
    $guard = $this->getGaurd();
    $guard->logout();
    return redirect()->route('admin.login');
  }
  public function getGaurd(){
      return auth('admin');
  }
}
