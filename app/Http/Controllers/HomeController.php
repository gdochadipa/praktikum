<?php

namespace App\Http\Controllers;

use App\Notifications\admin_notification;
use Illuminate\Http\Request;
use App\admin;
use App\product;
use App\product_images;
use App\product_review;
use App\response;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

        public function dashboard()
    {
        $product = product::paginate(9);
        return view('layout.user.index',compact('product'));
    }

    public function notify()
    {
        
        return view('layout.user.notify');
    }

    public function markAsRead()
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();
        return redirect()->back();
    }

    function detail_product($id)
    {
        
        $product = product::find($id);
        $product_images = product_images::where('product_id','=',$product->id)->get();
        $product_reviews = product_review::where('product_id', '=', $product->id)->with('user')->paginate(5);
        $user = Auth::user();
        $user_review = product_review::where('product_id', '=', $product->id)->where('user_id', '=', $user->id)->with('user')->first();
        return view('layout.user.product.detail_product',compact('product', 'product_images', 'product_reviews','user','user_review'));
    }

    public function review_product($id, Request $request)
    {
        $request->validate([
            'rate' => ['required'],
            'content' => ['required', 'max:100']
        ]);

        $user = Auth::user();
        $review = new product_review();
        $review->product_id = $id;
        $review->user_id = $user->id;
        $review->rate = $request->rate;
        $review->content = $request->content;
        if($review->save()){
            $product = product::find($id);
            $avg_rate = DB::select('SELECT AVG(rate) as avg_rate FROM product_reviews WHERE product_id=?', [$id]);
            $avg_rate = json_decode(json_encode($avg_rate), true);
            $product->product_rate = (int)round($avg_rate[0]["avg_rate"]);
            $product->save();

            $admin = admin::find(2);
            $details = [
                'order' => 'Review',
                'body' => 'User has review our Product!',
                'link' => url(route('product.edit',['id'=> $id])),
            ];
            $admin->notify(new admin_notification($details));

            return redirect()->back()->with("Success", "Successfully Comment");
        }
        return redirect()->back()->with("error", "Failed Comment");
    }

    public function getProvince()
    {
        $url = "https://api.rajaongkir.com/starter/province";
        $client = new Client();
        $response = $client->request('GET',$url,[
            'headers' => [
                'key' => '10de7057ed3ada18440c48fd279101d6'
            ]
        ]);
        $body = json_decode($response->getBody(),true);
        
        return $body['rajaongkir']['results'];
    }

    public function getCity()
    {
        
        $url = "https://api.rajaongkir.com/starter/city?province=".request()->province_id;
        $client = new Client();
        $response = $client->request('GET', $url, [
            'headers' => [
                'key' => '10de7057ed3ada18440c48fd279101d6'
            ]
        ]);
        $body = json_decode($response->getBody(), true);

        return response()->json(['status' => 'success', 'data' => $body['rajaongkir']['results']]);
        
    }


}
