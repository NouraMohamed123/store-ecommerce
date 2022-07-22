<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function slug($slug)
    {
        $data= [];

   $data['category'] = Category::where('slug',$slug)->first();
      if($data['category']){
        $data['products']  = $data['category']->with('products')->get();
        return view('front.products',$data);
      }
    }
}
