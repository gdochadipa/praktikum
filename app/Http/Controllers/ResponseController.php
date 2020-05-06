<?php

namespace App\Http\Controllers;

use App\response ;
use App\product_review;
use App\admin;
use Auth as Auth;

use Illuminate\Auth\SessionGuard;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
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

    public function add_response($review)
    {
        $response = response::where('review_id','=',$review)->get();
        if (!$response->isEmpty()) {
            // dd($response);
           return redirect()->intended(route('response.edit',['response'=>$response[0]]));
        }
        $product_review = product_review::where('id','=',$review)->with('user','product')->get();
        $admin = \Auth::user();
     
        //$admin_id=1;
        return view('layout.admin.response.response',compact('product_review','admin'));
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
            'content' => ['required'],
        ]);


        $response = new response();
        $response->review_id = $request->review_id;
        $response->admin_id = $request->admin_id;
        $response->content = $request->content;

        if ($response->save()) {
            return redirect()->intended(route('admin.product'))->with("success", "Successfully Add Product");
        }
        return redirect()->back()->with('error', 'Please fill in all fields with valid value');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\response  $response
     * @return \Illuminate\Http\Response
     */
    public function show(response $response)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\response  $response
     * @return \Illuminate\Http\Response
     */
    public function edit(response $response)
    {
        
        $product_review = product_review::where('id', '=', $response->review_id)->with('user', 'product')->get();
        $admin = \Auth::user();
        $content = $response->content;
        return view('layout.admin.response.edit', compact('product_review', 'admin','response','content'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\response  $response
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, response $response, $id)
    {
        $request->validate([
            'content' => ['required'],
        ]);

        $response=new response();
        $response=response::find($id);
        $response->review_id = $request->review_id;
        $response->admin_id = $request->admin_id;
        $response->content = $request->content;

        if ($response->save()) {
            return redirect()->intended(route('admin.product'))->with("success", "Successfully Edit Product");
        }
        return redirect()->back()->with('error', 'Please fill in all fields with valid value');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\response  $response
     * @return \Illuminate\Http\Response
     */
    public function destroy(response $response)
    {
        //
    }
}
