<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:view-product|create-product|edit-product|delete-product', ['only'=> ['index']]);
        $this->middleware('permission:create-product', ['only'=> ['create', 'store']]);
        $this->middleware('permission:edit-product', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-product', ['only'=> ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::paginate(5);
        $categories = Category::pluck("name", "id");
        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::pluck("name", "id");
        $selectedID = 0; 
        return view('products.create', compact('categories', 'selectedID'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        request()->validate([
            'name' => 'required',
            'brand' => 'required',
            'price' => 'required',
            'image' => 'required',
            'categoryid' => 'required',
        ]);

        $product = $request->all();

        if($image = $request->file('image')) {
            $SaveImgpath = 'img/';
            $imageProductName = date('YmdHis').".".$image->getClientOriginalExtension();
            $image->move($SaveImgpath, $imageProductName);
            $product['image'] = "$imageProductName";
        }
        Product::create($product);

        return redirect()->route('products.index');
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
        //
        $categories = Category::pluck("name", "id");
        $selectedID = 0; 
        $product = Product::find($id);
        return view('products.edit', compact('categories', 'selectedID', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
        request()->validate([
            'name' => 'required', 'brand' => 'required', 'categoryid' => 'required',
        ]);
        $prod = $request->all();
        if($image = $request->file('image')){
            $SaveImgpath = 'img/';
            $imageProductName = date('YmdHis').".".$image->getClientOriginalExtension();
            $image->move($SaveImgpath, $imageProductName);
            $prod['image'] = "$imageProductName";
        }else {
            unset($prod['image']);
        }
        $product->update($prod);
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
        $product->delete();
        return redirect()->route('products.index')->with('del', 'ok');
    }
}
