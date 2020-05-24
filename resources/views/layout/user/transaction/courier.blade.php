@extends('components.user.app')
@section('title')
    Check
@endsection

@section('component')

  <!--================Cart Area =================-->
  	<!-- Start Align Area -->
	<div class="whole-wrap">
		<div class="container box_1170">
            <div class="section-top-border">
                <div class="row">
					<div class="col-lg-8 col-md-8">
                        <form action="{{route('user.transaction.purchase')}}" method="POST">
                            @csrf
							<div class="input-group-icon mt-10">
								<div class="icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i></div>
								<input type="text" name="address" readonly value="{{$address}}" placeholder="" class="single-input">
                            </div>
                            <div class="input-group-icon mt-10">
								<div class="icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i></div>
								<input type="text" name="province" readonly value="{{$province}}" placeholder="" class="single-input">
                            </div>
                            <div class="input-group-icon mt-10">
								<div class="icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i></div>
								<input type="text" name="city" readonly value="{{$city}}" placeholder="" class="single-input">
                            </div>
                            <div class="input-group-icon mt-10">
                                <div class="icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i></div>
                                <input type="hidden" name="courier_id"  value="{{$courier->id}}" placeholder="" class="single-input">
								<input type="text" name="" readonly value="{{$courier->courier}}" placeholder="" class="single-input">
                            </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="order_box">
                        <h2>Your Order</h2>
                        <ul class="list">
                            <li>
                            <a>Product
                                <span>Total</span>
                            </a>
                            </li>
                            @php
                                $subtotal=0;
                            @endphp
                            @foreach ($carts as $cart)
                                <li>
                                    <a href="#">
                                        {{$cart->product->product_name}}
                                        <span class="middle">x {{$cart->qty}}</span>
                                        @php
                                            $today = date('Y-m-d');
                                            $discount = DB::table('discounts')->where('start','<=',$today)
                                            ->where('end','>=',$today)->where('id_product','=', $cart->product->id)->get();
                                            if($discount->isEmpty()){
                                                $diskon = 0;
                                            }else{
                                                $diskon = ($cart->product->price*$discount->percentage)/100;
                                            }
                                            $disc_price = $cart->product->price - $diskon;
                                            $price = $disc_price*$cart->qty;
                                            
                                            $subtotal += $price;
                                        @endphp
                                        <span class="last">Rp. {{number_format($price)}}</span>
                                    </a>
                                </li>
                            @endforeach
                            
                        </ul>
                        <ul class="list list_2">
                            <li>
                            <a >Subtotal
                                <span>Rp. {{number_format($subtotal)}}</span>
                            </a>
                            </li>
                            
                        </ul>
                        
                        </div>
                    </div>
        
                </div>
            </div>

            <div class="section-top-border">
				<h3 class="mb-30">Courier</h3>
				<div class="progress-table-wrap">
					<div class="progress-table">
						<div class="table-head">
							<div class="serial">#</div>
							<div class="country">Service</div>
							<div class="visit">Description</div>
                            <div class="percentage">ETD</div>
                            <div class="percentage">Cost</div>
                            <div class="percentage">Action</div>
						</div>
						@foreach ($result[0]["costs"] as $item)
                            <div class="table-row">
                            <div class="serial">{{$loop->iteration}}</div>
                            <div class="country">{{$item["service"]}}</div>
							<div class="visit">{{$item["description"]}}</div>
                            <div class="percentage">{{$item["cost"][0]["etd"]}}</div>
                            <div class="percentage">Rp. {{number_format($item["cost"][0]["value"])}}</div>
                            <div class="percentage">
                                <div class="confirm-checkbox">
									<input type="radio"  name="cost" required id="{{$item["service"]}}" value="{{$item["cost"][0]["value"]}}">
									<label for="{{$item["service"]}}"></label>
								</div>
                               
                            </div>
							
						</div>
                        @endforeach
                    </div>
                    <div class="button-group-area mt-40">
                         <input type="submit" value="Checkout"  class="genric-btn success radius" />
                    </div>
                    </form>
				</div>
			</div>
        </div>
	</div>                        
  <!--================End Cart Area =================-->


@endsection

@section('js')
    <script>
             $('#province_id').on('change', function() {
             var city = $('#city_id');
            $.ajax({
                url: "{{ url('/city') }}",
                type: "GET",
                data: { province_id: $(this).val() },
                success: function(html){
                    
                   
                    $.each(html.data, function(key, item) {
                        city.append('<option value="'+item.city_id+'">'+item.city_name+'</option>')
                        
                    })
                }
            });
        });
  </script>
@endsection
