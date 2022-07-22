<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
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
    public function home()
    {
        $data =[];
        $sliders = Slider::get();
        $categories = Category::with('parent1')->with('childrens')->with('childrens')->get();
       // $categories1 = Category::with('childrens')->get();
        //return $data;
        return view('front.home',compact('sliders','categories'));
    }
}
