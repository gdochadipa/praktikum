<?php

namespace App\Http\Controllers;

use App\transaction;
use Carbon\Carbon;
use App\carts;
use App\admin;
use App\Notifications\admin_notification;
use App\discount;
use App\transaction_detail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\courier;
use App\Notifications\user_notification;
use App\product_review;
use App\user;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update_transaction()
    {
        
        $today = Carbon::now();
        $transaction = transaction::all();
        foreach ($transaction as $index) {
            $expired = Carbon::parse($index->timeout);
            if ($today->lte($expired) && $index->proof_of_payment==null) {
                
                $index->status = 'expired';
                $index->save();
            }
        }
        
    }

    public function index()
    {
        $this->update_transaction();
        $transaction = transaction::with('user','courier')->orderBy('id','DESC')->paginate(15);
        return view('layout.admin.transaction',compact('transaction'));
    }

    public function filter()
    {
        $transaction = DB::table('transactions')->paginate(15);
        return view('layout.admin.transaction.transaction_filter', compact('transaction'));
    }

    public function history()
    {   
        $this->update_transaction();
        $user =  Auth::user();
        $transaction = transaction::where('user_id','=',$user->id)->orderBy('id','DESC')->with('courier')->paginate(10);
        return view('layout.user.transaction.history',compact('transaction'));
    }

    public function getProvince($id)
    {
        $url = "https://api.rajaongkir.com/starter/province?id=".$id;
        $client = new Client();
        $response = $client->request('GET', $url, [
            'headers' => [
                'key' => '10de7057ed3ada18440c48fd279101d6'
            ]
        ]);
        $body = json_decode($response->getBody(), true);

        $province = $body['rajaongkir']['results']["province"];
        return $province;
    }

    public function getCity($id)
    {
        $url = "https://api.rajaongkir.com/starter/city?id=".$id;
        $client = new Client();
        $response = $client->request('GET', $url, [
            'headers' => [
                'key' => '10de7057ed3ada18440c48fd279101d6'
            ]
        ]);
        $body = json_decode($response->getBody(), true);

        $city = $body['rajaongkir']['results']["city_name"];
        return $city;
    }

    public function getAllCity()
    {
        $url = "https://api.rajaongkir.com/starter/city";
        $client = new Client();
        $response = $client->request('GET', $url, [
            'headers' => [
                'key' => '10de7057ed3ada18440c48fd279101d6'
            ]
        ]);
        $body = json_decode($response->getBody(), true);

        $city = $body['rajaongkir']['results'];
        return $city;
    }

    public function check(){
        $url = "https://api.rajaongkir.com/starter/province";
        $client = new Client();
        $response = $client->request('GET', $url, [
            'headers' => [
                'key' => '10de7057ed3ada18440c48fd279101d6'
            ]
        ]);
        $body = json_decode($response->getBody(), true);

        $province = $body['rajaongkir']['results'];
        $cities = $this->getAllCity();
        $user = Auth::user();
        $courier = courier::all();
       
        $carts = carts::where('user_id','=',$user->id)->where('status','=','notyet');

        return view('layout.user.transaction.check',compact('province','carts','user','courier','cities'));
    }

    public function courierPilih(Request $request)
    {
        $url = "https://api.rajaongkir.com/starter/cost";
        $client = new Client();
        $courier = courier::find($request->courier_id);
        $address = $request->address;
        $province = $this->getProvince($request->province_id);
        $city = $this->getCity($request->city_id);
        $carts = carts::where('status','=','notyet')->with('product')->get();
        $weight = 0;
        foreach ($carts as $cart ) {
            $weight += $cart->product->weight;
        }
        //  dd($carts[0]->product->product_name);
        $response = $client->request('POST', $url, [
            'headers' => [
                'key' => '10de7057ed3ada18440c48fd279101d6',
                'content-type'=> 'application/x-www-form-urlencoded'
            ],
            'form_params' => [
                'origin' => 114, 
                'destination' => $request->city_id,
                'weight' => $weight,
                'courier' => strtolower($courier->courier)
            ]
        ]);
        $body = json_decode($response->getBody(), true);
        $result = $body['rajaongkir']['results'];
        return view('layout.user.transaction.courier',compact('result','address', 'province','city','carts','courier'));
    }



    public function purchase(Request $request)
    {   
        $carts = carts::where('status', '=', 'notyet')->with('product')->get();
        $today = date('Y-m-d H:i:s');
        $todayD = date('Y-m-d');
        $time = Carbon::parse($today);
        $next_time = $time->addDay();
        $user = Auth::user();
        $carts = carts::where('user_id','=', $user->id)->where('status', '=', 'notyet')->with('product')->get();
        $transaction =  new transaction();
        $transaction->timeout = $next_time;
        $transaction->address = $request->address;
        $transaction->regency = $request->city;
        $transaction->province = $request->province;
        $transaction->user_id = $user->id;
        $transaction->courier_id = $request->courier_id;
        $transaction->shipping_cost = $request->cost;
        $transaction->total = 0;
        $transaction->sub_total = 0;
        $transaction->status = 'unverified';
        $total = 0;
        $subtotal = 0;

        

        if($transaction->save()){
            $getTrans = transaction::where('user_id','=', $user->id)->where('status','=', 'unverified')
            ->orderBy('id','desc')->first();
            $admin = admin::find(2);
            $details = [
                'order' => 'Transaction',
                'body' => 'User has Buy our Product!',
                'link' => url(route('transaction.edit', ['transaction' => $getTrans])),
            ];
            $admin->notify(new admin_notification($details));
             foreach ($carts as $cart ){
                $transaction_det = new transaction_detail();
                $transaction_det->transaction_id = $getTrans->id;
                $transaction_det->product_id = $cart->product_id;
                $transaction_det->qty = $cart->qty;
                
                
                $discount = DB::table('discounts')->where('start', '<=', $todayD)
                    ->where('end', '>=', $todayD)->where('id_product', '=', $cart->product->id)->get();
                if ($discount->isEmpty()) {
                    $diskon = 0;
                } else {
                    $diskon = ($cart->product->price * $discount->percentage) / 100;
                }
                $transaction_det->discount = $diskon;
                $transaction_det->selling_price = $cart->product->price - $diskon;
                $transaction_det->save();
                $disc_price = $cart->product->price - $diskon;
                $price = $disc_price * $cart->qty;
                $subtotal += $price;
                $cart->status = 'checkedout';
                $cart->save();

                
             }
             $getTrans->sub_total = $subtotal;
             $total = $subtotal + $request->cost;
             $getTrans->total = $total;
             $getTrans->save();
            return redirect()->intended(route('user.transaction.showConfirmation', ['id' => $getTrans->id]))->with("success", "Successfully Edit Product");
        }
       return redirect()->back()->with("error", "Successfully Edit Status");
    }

    public function showConfirmation($id)
    {
        $transaction = transaction::where('id', '=', $id)->with('courier')->first();
        $det_transaction = transaction_detail::where('transaction_id','=',$id)->with('product')->get();
        $startTime = Carbon::now();
        $finishTime = Carbon::parse($transaction->timeout);
        $totalDuration = $finishTime->diffInSeconds($startTime);
        $time = gmdate('H : i : s', $totalDuration);
        return view('layout.user.transaction.showConfirmation',compact('transaction', 'det_transaction','time'));
    }

    public function proof($id,Request $request)
    {
        $transaction = transaction::where('id', '=', $id)->with('courier')->first();
        $proof = $request->proof_of_payment;
        $name = time() . '_.' . $proof->extension();
        $proof->move("proof_of_payment/", $name);
        $transaction->proof_of_payment = $name;

        $admin = admin::find(2);
        $details = [
            'order' => 'Transaction',
            'body' => 'User has give Proof of payment!',
            'link' => url(route('transaction.edit', ['transaction' => $transaction])),
        ];
        $admin->notify(new admin_notification($details));
        
        $transaction->save();
        return redirect()->back();
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

       
        $user = user::find($transaction->user_id);
        $details = [
            'order' => 'Response',
            'body' => 'Admin has update your transaction!',
            'link' => url(route('user.transaction.showConfirmation', ['id' => $id])),
        ];
        $user->notify(new user_notification($details));

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
