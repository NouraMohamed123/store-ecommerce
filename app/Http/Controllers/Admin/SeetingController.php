<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Seeting;

class SeetingController extends Controller
{
    public function editShippingMethods($type){
      if($type == 'free'){
           $shippingMethod = Seeting::where('key','free_shipping_cost')->first();

      }elseif($type == 'outer'){
        $shippingMethod = Seeting::where('key','outer_shipping_cost')->first();
      }elseif($type == 'inner'){
        $shippingMethod = Seeting::where('key','local_shipping_cost')->first();
      }
       return view('dashboard.seetings.edit',compact('shippingMethod'));
    }

    public function updateShippingMethods(Request $request,$id){

    $shipping = Seeting::find($id);
    $shipping->update([
        'key'=> $request->key,
        'value'=>$request->value
    ]);
    return redirect()->back()->with(['success' => 'تم تحديث بنجاح']);

    }


}


