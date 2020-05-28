@extends('components.user.app')
@section('title')
    Confirmation
@endsection
@section('component')

  <!--================ confirmation part start =================-->
  <div class="whole-wrap">
		<div class="container box_1170">
            				<div class="section-top-border">
					<h3 class="mb-30">Table</h3>
					<div class="progress-table-wrap">
						<div class="progress-table">
							<div class="table-head">
								<div class="country">Batas</div>
								<div class="country">Total</div>
								<div class="country">Courier</div>
								<div class="visit">Status</div>
								<div class="percentage">Action</div>
							</div>
							@foreach ($transaction as $item)
                                <div class="table-row">
								<div class="country">{{$item->timeout}}</div>
                                <div class="country">{{number_format($item->total)}}</div>
                                <div class="country">{{$item->courier->courier}}</div>
								<div class="visit">{{$item->status}}</div>
								<div class="percentage"><a href="{{route('user.transaction.showConfirmation',['id'=>$item->id])}}" class="genric-btn success radius">See Checkout</a></div>
							</div>
                            @endforeach
                            {{$transaction->links()}}
						</div>
					</div>
				</div>

        </div>
  </div>
  <!--================ confirmation part end =================-->


@endsection