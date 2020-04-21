<?php

namespace App\Http\Controllers;

use App\product as product;
use App\product_categories;
use App\product_category_details;
use App\product_images;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function index()
    {
        $all_product = product::all();
        return view('layout.admin.product',compact('all_product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layout.admin.product.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'product_images' => ['required'],
            'product_images.*' => [ 'mimes:jpg,jpeg,png', 'max:2000'],
            'product_name' => ['required','max:100'],
            'price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'description' => ['required'],
            'product_rate' => ['required','max:100'],
            'stock' => ['required', 'max:10'],
            'weight' => ['required', 'max:3'],

        ]);

        
        
        if($request->hasFile('product_images')){

            $product = new product;
            $product->product_name = $request->product_name;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->product_rate = $request->product_rate;
            $product->stock = $request->stock;
            $product->weight = $request->weight;
            $product->save();


            $product = DB::table('products')->where('product_name','=', $request->product_name)->first();
            foreach($request->file('product_images') as $file){
                $name = time() . '_.' . $file->extension();
                $file->move("product_images/", $name);
                $image = new product_images();
                $image->product_id= $product->id;
                $image->image_name=$name;
                $image->save();
            }
            return redirect()->intended(route('admin.product'))->with("success", "Successfully Add Product");
        }

        redirect()->back()->withInput($request->only('product_name', 'price', 'description', 'product_rate', 'stock', 'weight'))->with('error', 'Please fill in all fields with valid value');
    
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\courier  $courier
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\courier  $courier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = product::find($id);
        $image = DB::table('product_images')->where('product_id','=',$id)->get();
        $product_category= DB::table('product_categories')->get();
        $product_category_details = DB::table('product_categories_details')->where('product_id', '=', $id)->get();
        return view('layout.admin.product.edit', compact('product','image', 'product_category', 'product_category_details'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\courier  $courier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $product = new product();
        $product = product::find($id);

        $product->product_name= $request->product_name;
        $product->price= $request->price;
        $product->description= $request->description;
        $product->product_rate= $request->product_rate;
        $product->stock= $request->stock;
        $product->weight= $request->weight;
        $product->save();
        return redirect()->intended(route('admin.product'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\courier  $courier
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        $product->delete();
        return redirect()->intended(route('admin.product'));
    }
}
