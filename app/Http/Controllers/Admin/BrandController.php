<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = brand::paginate(15);
        return view('dashboard.brands.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->has('is_active')){
            $request->request->add(['is_active' => 1]);


          }else{
          $request->request->add(['is_active' => 0]);

          }

       // $brand = brand::create($request->except('_token','photo'));
       $photo ='';
            if($request->hasfile('photo')){


            $photo = $request->file('photo')->getClientOriginalName();

            $request->file('photo')->storeAs('brand/'.$photo,$photo,'brands');
            //$brand->photo =  $photo;
        }
 brand::create([
     'name'=> $request->name,
     'is_active' => $request->is_active,
     'photo'=> $photo
 ]);
          return redirect()->back()->with(['success' => 'تمت إضافة القسم بنجاح']);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\brand  $brand
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = brand::find($id);

         return view('dashboard.brands.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $brand= brand::find($id);
        if($request->has('is_active')){
            $request->request->add(['is_active' => 1]);


          }else{
          $request->request->add(['is_active' => 0]);

          }
          $photo_new = '';
          if($request->hasfile('photo')){

           // Storage::disk('brands')->delete('brand/'.$photo);


            $photo_new = $request->file('photo')->getClientOriginalName();

            $request->file('photo')->storeAs('brand/'.$photo_new,$photo_new,'brands');

        }

            $brand->update([
           'name' => $request->name,
            'is_active' => $request->is_active,
            'photo'=> $photo_new
            ]);

          return redirect()->back()->with(['success' => 'تم تحديث القسم بنجاح']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$photo)
    {

        $brand = brand::find($id);
         Storage::disk('brands')->delete('brand/'.$photo);
        $brand->delete();
        return redirect()->back()->with(['success' => 'تم الحذف  بنجاح']) ;
    }
}
