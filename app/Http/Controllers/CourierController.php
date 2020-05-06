<?php

namespace App\Http\Controllers;

use App\courier as Courier;
use App\transaction;
use Illuminate\Http\Request;


class CourierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_courier = courier::select('couriers.id','couriers.courier')
            ->get();
        return view('layout.admin.courier',compact('all_courier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layout.admin.courier.CreateCourier');
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
            'courier' => ['required','max:30']
        ]);

        $courier = new Courier;
        $courier->courier = $request->courier;
        
        if($courier->save()){
            return redirect()->intended(route('admin.courier'))->with("success", "Successfully Add Courier");
        }
        return redirect()->intended(route('admin.courier'))->with("success", "Error Add Courier");
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
        $courier = Courier::find($id);
        return view('layout.admin.courier.update', compact('courier'));
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

        $request->validate([
            'courier' => ['required','max:30']
        ]);

        $courier = new Courier();
        $courier = Courier::find($id);

        $courier->courier = $request->courier;
        if ($courier->save()) {
            return redirect()->intended(route('admin.courier'))->with("success", "Successfully Edit Courier");
        }
        return redirect()->intended(route('admin.courier'))->with("error", "Error Edit Courier");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\courier  $courier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $courier = Courier::find($id);
        $courier->delete();
        return redirect()->intended(route('admin.courier'))->with("success", "Successfully Delete Courier");
    }
}
