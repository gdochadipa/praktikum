<?php

namespace App\Http\Controllers;

use App\carts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\product;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $user = Auth::user();
       $carts = carts::where('user_id','=',$user->id)->where('status', '=', 'notyet')->with('product')->paginate();
       return view('layout.user.cart.index',compact('carts'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage. 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $carts = new carts();
        $carts->product_id = $request->product_id;
        $carts->user_id = Auth::user()->id;
        $carts->qty = $request->qty;
        $carts->status = 'notyet';

        $product=product::find($request->product_id);
        if($product->stock > 0 && $request->qty <= $product->stock){
            if ($carts->save()) {
                return redirect()->intended(route('user.carts'))->with("successful", "Success");
            }
        }
        return redirect()->intended(route('detail_product'))->with("error", "Failed ");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function show(carts $carts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function edit(carts $carts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, carts $carts)
    {
        //
    }

    public function update_carts(Request $request)
    {
        
        foreach ($request->id as $key => $row) {
            $carts = carts::find($row);
            
            if($request->qty[$key] == 0){
                $carts->delete();
            }else{
                $carts->qty = $request->qty[$key];
                $carts->save();
            }

        }
        return redirect()->intended(route('user.carts'))->with("successful", "Success");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function destroy(carts $carts)
    {
        //
    }
}
