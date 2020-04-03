<?php

namespace App\Http\Controllers;

use App\product_categories as product_categories;
use App\transaction;
use Illuminate\Http\Request;


class ProductCategoriesController extends Controller
{

    public function index()
    {
        $all_category = product_categories::select('product_categories.id','product_categories.category_name')
            ->get();
        return view('layout.admin.product_categories',compact('all_category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layout.admin.category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $category = new product_categories;
        $category->category_name= $request->category_name;
        $category->save();
    
        return redirect()->intended(route('admin.category'));
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
        $category = product_categories::find($id);
        return view('layout.admin.category.edit', compact('category'));
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
        $category = new product_categories();
        $category = product_categories::find($id);

        $category->category_name= $request->category_name;
        $category->save();
        return redirect()->intended(route('admin.category'));
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
