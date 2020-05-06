<?php

namespace App\Http\Controllers;

use App\transaction;
use App\transaction_detail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = transaction::with('user','courier')->paginate(15);
        return view('layout.admin.transaction',compact('transaction'));
    }

    public function filter()
    {
        $transaction = DB::table('transactions')->paginate(15);
        return view('layout.admin.transaction.transaction_filter', compact('transaction'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit_admin(transaction $transaction)
    {   
       
        $transaction=transaction::where('id','=', $transaction->id)->with('user', 'courier')->get();
        $transaction_d = transaction_detail::where('transaction_id','=', $transaction[0]->id)->with('product')->paginate(15);
        
        
        return view('layout.admin.transaction.edit',compact('transaction', 'transaction_d'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, transaction $transaction)
    {
        //
    }

    public function update_admin($id, $status){
        $transaction= transaction::find($id);
        $transaction->status = $status;
        
        if ($transaction->save()) {
            return redirect()->back()->with("success", "Successfully Edit Status");
        }
        return redirect()->back()->with("error", "Error Edit Status");
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(transaction $transaction)
    {
        //
    }
}
