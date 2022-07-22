<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StockProductRequest;
use App\Models\brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_image;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::select('id', 'slug', 'name', 'price', 'created_at')->paginate(15);
        return view('dashboard.products.general.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        $data['brands'] = brand::where('is_active', 1)->get();
        $data['tags'] = Tag::get();
        $data['categories'] = Category::where('is_active', 1)->get();

        return view('dashboard.products.general.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        DB::beginTransaction();

        //validation

        if (!$request->has('is_active'))
            $request->request->add(['is_active' => 0]);
        else
            $request->request->add(['is_active' => 1]);

        $product = Product::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'brand_id' => $request->brand_id,
            'is_active' => $request->is_active,


        ]);


        //save product categories

        $product->categories()->attach($request->categories);

        //save product tags

        DB::commit();
        return redirect()->back()->with(['success' => 'تم ألاضافة بنجاح']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function getPrice($id)
    {
        return view('dashboard.products.prices.create', compact('id'));
    }
    public function saveProductPrice(Request $request)
    {



        Product::whereId($request->product_id)->update($request->only(['price', 'special_price', 'special_price_type', 'special_price_start', 'special_price_end']));
    }
    public function getstock($id)
    {
        return view('dashboard.products.stock.create', compact('id'));
    }


    public function saveProductstock(StockProductRequest $request)
    {

        Product::whereId($request->product_id)->update($request->except(['_token', 'product_id']));

        return redirect()->back()->with(['success' => 'تم ألاضافة بنجاح']);
    }
    public function getimage($id)
    {
        return view('dashboard.products.images.create', compact('id'));
    }

    public function saveProductimage(Request $request)
    {
        $photo = '';
        if ($request->hasfile('photo')) {

            $photo = $request->file('photo')->getClientOriginalName();

            $request->file('photo')->storeAs('products/' . $photo, $photo, 'products');
            //$brand->photo =  $photo;
        }
        Product_image::create([
            'product_id' => $request->product_id,
            'photo' => $photo
        ]);
        return redirect()->back()->with(['success' => 'تمت إضافة القسم بنجاح']);
    }
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
