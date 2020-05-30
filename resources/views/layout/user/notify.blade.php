@extends('components.user.app')
@section('title')
    Notify
@endsection
@section('component')

  <!--================ confirmation part start =================-->
  <div class="whole-wrap">
		<div class="container box_1170">
            				<div class="section-top-border">
					<h3 class="mb-30">Notification</h3>
					<div class="progress-table-wrap">
						<div class="progress-table">
							<div class="table-head">
                                <div class="country">ID</div>
                                <div class="country">Order</div>
								<div class="country">Message</div>
								<div class="visit">Time</div>
								<div class="percentage">Action</div>
								<div class="percentage">Action</div>
							</div>
							@foreach (auth()->user()->notifications as $item)
                            <div class="table-row">
								<div class="country">{{$loop->iteration}}</div>
                                <div class="country">{{$item->data['order']}}</div>
                                <div class="country">{{$item->data['body']}}</div>
                                <div class="visit">{{$item->created_at}}</div>
                                  <div class="percentage"><a href="{{url($item->data['link'])}}" class="genric-btn success radius">Check</a></div>
                                   @if ($item->read_at == null)
                                   <div class="percentage"><a href="{{route('markAsRead')}}" class="genric-btn primary radius">Mark as Read</a></div>
                                   @endif
							</div>
                            @endforeach
                          
						</div>
					</div>
				</div>

        </div>
  </div>
  <!--================ confirmation part end =================-->


@endsection