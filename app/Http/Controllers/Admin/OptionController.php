<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $options =  Option::with(['Product' => function($prod){
        $prod->select('id');
      }
      ,'Attribute' => function($attr){
          $attr->select('id');
      }])->get();
     // return  $options;

        return view('dashboard.options.index', compact('options'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        $data['products'] = Product::get();
        $data['attributes'] = Attribute::get();

        return view('dashboard.options.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // return $request;
        $option = Option::create([
            'name'=>$request->name,
            'attribute_id' => $request->attribute_id,
            'product_id' => $request->product_id,
            'price' => $request->price,
        ]);

        return redirect()->back()->with(['success' => 'تم ألاضافة بنجاح']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];
        $data['products'] = Product::get();
        $data['attributes'] = Attribute::get();
        $data['option'] = Option::find($id);
        return view('dashboard.options.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $option = Option::find($id);
        $option->update([
            'name'=>$request->name,
            'attribute_id' => $request->attribute_id,
            'product_id' => $request->product_id,
            'price' => $request->price,
        ]);
        return redirect()->route('admin.attributes')->with(['success' => 'تم ألتحديث بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $option = Option::find($id);

        $option->delete();

        return redirect()->back()->with(['success' => 'تم  الحذف بنجاح']);
    }
}
