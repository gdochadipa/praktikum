<?php

namespace App\Http\Controllers;

use App\product as product;
use App\product_categories;
use App\product_category_details;
use Illuminate\Http\Request;


class ProductController extends Controller
{

    public function index()
    {
        $all_product = product::select('products.id','products.product_name','products.price', 'products.description', 'products.product_rate','products.stock', 'products.weight')
            ->join('product_category_details', 'product_category_details.product_id', '=', 'products.id')
            ->join('product_categories', 'product_categories.id', '=', 'product_category_details.category_id')
            ->get();
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

        $product = new product;
        $product->product_name= $request->name;
        $product->price= $request->price;
        $product->description= $request->description;
        $product->product_rate= $request->rate;
        $product->stock= $request->stock;
        $product->weight= $request->weight;
        $product->save();
    
        return redirect()->intended(route('admin.product'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\courier  $courier
     * @return \Illuminate\Http\Response
     */
    public function show(courier $courier)
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
        return view('layout.admin.product.edit', compact('product'));
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
