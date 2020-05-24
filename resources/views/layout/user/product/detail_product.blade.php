@extends('components.user.app')
@section('title')
    Product
@endsection
@section('component')
<!--================Single Product Area =================-->
  <div class="product_image_area">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="product_img_slide owl-carousel">
            @foreach ($product_images as $image)
           
             <div class="single_product_img" style="">
              <img src="{{asset('product_images/'.$image->image_name)}}" style="width:500px; height:500px; text-align: center" alt="#" class="img-fluid">
            </div>
            @endforeach
            
          </div>
        </div>
        <div class="col-lg-8">
          <div class="single_product_text text-center">
          <h3>{{$product->product_name}}</h3>
            <p>
                {{$product->description}}
            </p>
            <form action="{{route('user.carts.store')}}" method="post">
                @csrf
            <div class="card_area">
                <div class="product_count_area">
                    <p>Quantity</p>
                    <input type="text" name="user_id" value="{{$user->id}}" hidden />
                    <input type="text" name="product_id"  value="{{$product->id}}" hidden />
                    <div class="product_count d-inline-block">
                        <span class="product_count_item inumber-decrement"> <i class="ti-minus"></i></span>
                        <input class="product_count_item input-number" name="qty" type="text" value="1" min="0" max="10">
                        <span class="product_count_item number-increment"> <i class="ti-plus"></i></span>
                    </div>
                <p>Rp. {{$product->price}}</p>
                </div>
              <div class="add_to_cart">
                  <input type="submit" value="add to cart" class="btn_3"/>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
 	<div class="whole-wrap">
		<div class="container box_1170">
            <div class="section-top-border">
        <h3 class="mb-30">Review</h3>
        <div class="row">
					<div class="col-lg-12 col-md-12">
						<form action="" method="">
              @csrf
              <input type="text" name="user_id" value="{{$user->id}}" hidden />
              <input type="text" name="product_id"  value="{{$product->id}}" hidden />
              <div class="input-group-icon mt-10">
								<div class="icon"><i class="fa fa-star" aria-hidden="true"></i></div>
								<div class="form-select" id="default-select">
								<select name="rate">
												<option disabled selected>Rating</option>
									<option value="1">★</option>
									<option value="2">★★</option>
									<option value="3">★★★</option>
                  <option value="4">★★★★</option>
                  <option value="5">★★★★★</option>
									</select>
								</div>
              </div>
              <div class="mt-20">
								<input type="text" name="content" placeholder="Content"
									onfocus="this.placeholder = ''" onblur="this.placeholder = 'Content'" required
									class="single-input">
              </div>
              <div class="button-group-area mt-10">
                <input type="submit" class="genric-btn success radius" value="Submit" />
              </div>  
            </form>
          </div>
        </div>
        <br>
        <br>
        	@foreach ($product_reviews as $item)
         <div class="row">
					<div class="col-md-3">
          <img src="{{asset('image_user/'.$item->user->profile_image)}}" style="width: 200px; height:200px" alt="" class="img-fluid">
					</div>
					<div class="col-md-9 mt-sm-20">
            <h4 style="">{{$item->user->name}}</h4>
            <p>
              @for ($i = 1; $i <= $item->rate; $i++)
                  ★
              @endfor
            </p>
            <p>{{$item->content}}</p>
					</div>
        </div>
        @endforeach
        
        
			</div>
			
        </div>
 	</div>   
  <!--================End Single Product Area =================-->
@endsection