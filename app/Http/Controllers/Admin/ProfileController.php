<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Models\Admin;

class ProfileController extends Controller
{
    public function edit(){
   $admin  =  Admin::find(auth('admin')->user()->id);
    return view('dashboard.profile.edit',compact('admin'));
    }
    public function update(ProfileRequest $request){
        $admin  =  Admin::find(auth('admin')->user()->id);
        if(!$request->filled('password')){
            $admin->update($request->only(['name','email']));
            return redirect()->back()->with(['success' => 'تم تحديث بنجاح']);
        }
        unset($request['password_confirmation']);
        $request->merge(['password' => bcrypt($request->password)]);
        $admin->update($request->all());
        return redirect()->back()->with(['success' => 'تم تحديث بنجاح']);
    }
}
