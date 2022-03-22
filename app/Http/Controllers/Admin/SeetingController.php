<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Seeting;

class SeetingController extends Controller
{
    public function editShippingMethods($type){
      if($type == 'free'){
           $data = Seeting::where('key','free_shipping_cost')->first();

      }elseif($type == 'outer'){
        $data = Seeting::where('key','outer_shipping_cost')->first();
      }elseif($type == 'inner'){
        $data = Seeting::where('key','local_shipping_cost')->first();
      }
       return view('dashboard.seetings.edit',compact('data'));
    }
}
