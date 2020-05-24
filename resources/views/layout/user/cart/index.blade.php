@extends('components.user.app')
@section('title')
    Carts
@endsection
@section('component')

  <!--================Cart Area =================-->
  <section class="cart_area section_padding">
    <div class="container">
      <div class="cart_inner">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
              </tr>
            </thead>
            <tbody>
              @php
                  $subtotal = 0;
              @endphp
              <form action="{{route('user.carts.update')}}" method="post">
              @csrf
             @foreach ($carts as $item)
                  <tr>
                <td>
                  <div class="media">
                    <div class="d-flex">
                        @php
                            $img = DB::table('product_images')->where('product_id','=',$item->product->id)->get();
                            
                        @endphp
                      <img src="{{asset('product_images/'.$img[0]->image_name)}}" alt="" />
                    </div>
                    <div class="media-body">
                      <p>{{$item->product->product_name}}</p>
                    </div>
                  </div>
                </td>
                <td>
                  <h5>Rp. {{number_format($item->product->price)}}</h5>
                </td>
                <td>
                  <div class="product_count">
                    
                    {{-- <span class="input-number-decrement"> <i class="ti-minus"></i></span> --}}
                    <input class="input-number" name="qty[]" type="number" value="{{$item->qty}}" min="0" max="10">
                    {{-- <span class="input-number-increment"> <i class="ti-plus"></i></span> --}}
                     <input name="id[]"  type="hidden" value="{{$item->id}}" >
                  </div>
                </td>
                <td>
                    @php
                        $price = $item->product->price * $item->qty;
                        $subtotal += $price;
                    @endphp
                  <h5>Rp. {{number_format($price)}}</h5>
                </td>
              </tr>
             @endforeach
             
              
              <tr class="bottom_button">
                <td>
                  <input type="submit" value="Update Cart" class="btn_1">
                </td>
                <td></td>
                <td></td>
                
              </tr>
              </form>
              <tr>
                <td></td>
                <td></td>
                <td>
                  <h5>Subtotal</h5>
                </td>
                <td>
                  <h5>Rp. {{number_format($subtotal)}}</h5>
                </td>
              </tr>
              
            </tbody>
          </table>
          <div class="checkout_btn_inner float-right">
            <a class="btn_1" href="{{route('dashboard')}}">Continue Shopping</a>
            <a class="btn_1 checkout_btn_1" href="{{route('user.transaction.check')}}">Proceed to checkout</a>
          </div>
        </div>
      </div>
  </section>
  <!--================End Cart Area =================-->


@endsection