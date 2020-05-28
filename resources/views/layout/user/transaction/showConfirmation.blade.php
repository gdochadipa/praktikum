@extends('components.user.app')
@section('title')
    Confirmation
@endsection
@section('component')

  <!--================ confirmation part start =================-->
  <section class="confirmation_part section_padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="confirmation_tittle">
            <span>Thank you. Your order has been received.</span>
          </div>
        </div>
        
        <div class="col-lg-6 col-lx-4">
          <div class="single_confirmation_details">
            <h4>order info</h4>
            <ul>
              <li>
                <p>order number</p><span>: {{$transaction->id}}</span>
              </li>
              <li>
              <p>Payment Time</p><span>: {{$time}}</span>
              </li>
              <li>
                <p>total</p><span>: Rp. {{number_format($transaction->total)}}</span>
              </li>
              <li>
                <p>Status Payment</p><span>: {{$transaction->status}}</span>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-6 col-lx-4">
          <div class="single_confirmation_details">
            <h4>Billing Address</h4>
            <ul>
              <li>
                <p>Street</p><span>: {{$transaction->address}}</span>
              </li>
              <li>
               <p>city</p><span>: {{$transaction->regency}}</span>
              </li>
              <li>
                <p>Province</p><span>: {{$transaction->province}}</span>
              </li>
              <li>
                <p>Courier</p><span>: {{$transaction->courier->courier}}</span>
              </li>
            </ul>
          </div>
        </div>
       
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="order_details_iner">
            <h3>Order Details</h3>
            <table class="table table-borderless">
              <thead>
                <tr>
                  <th scope="col" colspan="2">Product</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Price</th>
                  <th scope="col">Total</th>
                </tr>
              </thead>
              <tbody>
                @php
                    $sub_total=0;
                @endphp
                @foreach ($det_transaction as $d_item)
                  <tr>
                    <th colspan="2"><span>{{$d_item->product->product_name}}</span></th>
                    <th>x{{$d_item->qty}}</th>
                    @php
                        $qty_price = $d_item->qty*$d_item->selling_price;
                        $sub_total += $qty_price; 
                    @endphp
                    <th> <span>Rp. {{number_format($d_item->selling_price)}}</span></th>
                    <th> <span>Rp. {{number_format($qty_price)}}</span></th>
                  </tr>
                @endforeach
                <tr>
                  <th colspan="3">Subtotal</th>
                  <th> <span>Rp. {{number_format($sub_total)}}</span></th>
                </tr>
                <tr>
                  <th colspan="3">shipping</th>
                  <th><span>Rp. {{number_format($transaction->shipping_cost)}}</span></th>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <th scope="col" colspan="3">Quantity</th>
                  <th scope="col">Total</th>
                  <th scope="col">Rp. {{number_format($transaction->total)}}</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
      @if ($transaction->proof_of_payment!=null)
        <div class="row gallery-item">
        <div class="col-md-4">
						<a href="{{asset('proof_of_payment/'.$transaction->proof_of_payment)}}" class="img-pop-up">
							<div class="single-gallery-image" style="background: url({{asset('proof_of_payment/'.$transaction->proof_of_payment)}});"></div>
						</a>
					</div>
        </div>
      @endif

      @if ($transaction->status == 'unverified')
          <div class="row">
        <div class="col-lg-8 col-md-8">
          <br>
						<h3 class="mb-30">Form Element</h3>
						<form action="{{route('user.transaction.proof', ['id' => $transaction->id])}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="mt-10">
								<input type="file" name="proof_of_payment" accept="image/x-png,image/jpeg" placeholder="Proof of Payment"class="single-input">
              </div>
              <div class="mt-10">
                <input  class="genric-btn primary radius" value="Submit" type="submit">
              </div>
            </form>
        </div>
      </div>
      @endif
      >
    </div>
  </section>
  <!--================ confirmation part end =================-->


@endsection