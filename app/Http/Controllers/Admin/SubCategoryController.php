<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('parent_id','!=',Null)->paginate(15);
        return view('dashboard.subcategories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::where('parent_id',Null)->get();
        return view('dashboard.subcategories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      //  return $request;
        if($request->has('is_active')){
          $request->request->add(['is_active' => 1]);


        }else{
        $request->request->add(['is_active' => 0]);

        }
        Category::create($request->except('_token'));
        return redirect()->back()->with(['success' => 'تمت إضافة القسم بنجاح']);

    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $category = Category::find($id);
       $categories = Category::where('parent_id',Null)->get();
        return view('dashboard.subcategories.edit',compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $category = Category::find($id);
        if($request->has('is_active')){
            $request->request->add(['is_active' => 1]);


          }else{
          $request->request->add(['is_active' => 0]);

          }
          $category->update($request->except('_token'));
          return redirect()->back()->with(['success' => 'تم تحديث القسم بنجاح']);

      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->back()->with(['success' => 'تم الحذف  بنجاح']) ;
    }
}
