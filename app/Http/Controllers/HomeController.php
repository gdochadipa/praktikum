<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;
use App\product_images;
use App\product_review;
use App\response;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

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

    function detail_product($id)
    {
        $product = product::find($id);
        $product_images = product_images::where('product_id','=',$product->id)->get();
        $product_reviews = product_review::where('product_id', '=', $product->id)->with('user')->paginate(5);
        $user = Auth::user();
        return view('layout.user.product.detail_product',compact('product', 'product_images', 'product_reviews','user'));
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
