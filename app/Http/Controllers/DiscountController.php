<?php

namespace App\Http\Controllers;

use App\discount;
use App\product;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discount=discount::with('product')->paginate('15');
        
        return view('layout.admin.discount',compact('discount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = product::all();
        return view('layout.admin.discount.add',compact('product'));
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
            'id_product' => ['required'],
            'percentage' => ['required', 'between:0,99.99'],
            'start' => ['required'],
            'end' => ['required']
        ]);

        $discount = new discount();
        $discount->id_product = $request->id_product;
        $discount->percentage = $request->percentage;
        $discount->start = $request->start;
        $discount->end = $request->end;
        
        if($discount->save()){
            return redirect()->intended(route('admin.discount'))->with("success", "Successfully Add Discount");
        }
        return redirect()->back()->withInput($request->only('percentage', 'start', 'end'))->with("error", "Failed Add Discount");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show(discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(discount $discount)
    {
        $product = product::all();
        return view('layout.admin.discount.edit',compact('discount','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_product' => ['required'],
            'percentage' => ['required', 'between:0,99.99'],
            'start' => ['required'],
            'end' => ['required']
        ]);
        $discount = discount::find($id);
        $discount->id_product = $request->id_product;
        $discount->percentage = $request->percentage;
        $discount->start = $request->start;
        $discount->end = $request->end;

        if ($discount->save()) {
            return redirect()->intended(route('admin.discount'))->with("success", "Successfully Update Discount");
        }
        return redirect()->back()->withInput($request->only('percentage', 'start', 'end'))->with("error", "Failed Update Discount");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(discount $discount)
    {
        $discount->delete();
        return redirect()->intended(route('admin.discount'))->with("success", "Successfully Delete Discount");
    }
}
