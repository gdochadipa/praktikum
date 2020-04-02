<?php

namespace App\Http\Controllers;

use App\courier;
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
        return view('layout.admin.CreateCourier', compact('courier'));
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
    public function edit(courier $courier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\courier  $courier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, courier $courier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\courier  $courier
     * @return \Illuminate\Http\Response
     */
    public function destroy(courier $courier)
    {
        //
    }
}
