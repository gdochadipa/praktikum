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
                        <h3 class="mb-30">Sender Information </h3>
                        <form action="{{route('user.transaction.courierPilih')}}" method="POST">
                            @csrf
                            <div class="mt-10">
                            <input type="text" name="address" placeholder="Address" required
                                    class="single-input">
                            </div>
                            <div class="input-group-icon mt-10">
                                <div class="icon"><i class="fa fa-plane" aria-hidden="true"></i></div>
                                <div class="form-select" id="default-select">
                                    <select name="province_id" id="province_id">
                                        <option selected  disabled>Province</option>
                                       @foreach ($province as $p)
                                        <option value="{{$p['province_id']}}">{{$p['province']}}</option>
                                       @endforeach
                                        
                                    </select>
                                </div>
                            </div>
                            
                            <div class="input-group-icon mt-10">
                                <div class="icon"><i class="fa fa-plane" aria-hidden="true"></i></div>
                                <div class="form-select" id="default-select">
                                    <select name="city_id" class="city_id" id="city_id" required>
                                        <option selected  disabled>City</option>
                                        @foreach ($cities as $city)
                                            <option value="{{$city['city_id']}}">{{$city['city_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="input-group-icon mt-10">
                                <div class="icon"><i class="fa fa-plane" aria-hidden="true"></i></div>
                                <div class="form-select" id="default-select">
                                    <select name="courier_id"  required>
                                        <option selected  disabled>Courier</option>
                                         @foreach ($courier as $c)
                                        <option value="{{$c->id}}">{{$c->courier}}</option>
                                         @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="input-group-icon mt-10">
                                <input type="submit" class="genric-btn success radius" value="Checkout" >
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3 col-md-4 mt-sm-30">
						<div class="single-element-widget">
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>                        
  <!--================End Cart Area =================-->
    

@endsection

@section('js')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> --}}
    <script>
             $('#province_id').on('change', function() {
             

             function buildOption(value, text) {
                return $("#city_id", {
                    value: ""+value+"",
                    text: ""+text+""
                })
            }
            $.ajax({
                url: "{{ url('/city') }}",
                type: "GET",
                data: { province_id: $(this).val() },
                success: function(html){
                     var city = $('city_id');
                      
                    city.empty()
                    $.each(html.data, function(key, item) {
                        // city.append('<option value="'+item.city_id+'"><span>'+item.city_name+'</span></option>')
                        //city.append(new Option(''+item.city_name+'',''+item.city_id+'' ,true, true)
                        // city.append(buildOption(item.city_name, item.city_id))
                        // alert(item.city_name+" ada")
                         $("<option></option>",{  
                        value: item.city_id,  
                        text: item.city_name  
                         }).appendTo(city)
                    })
                }
            });
        });
  </script>
@endsection
