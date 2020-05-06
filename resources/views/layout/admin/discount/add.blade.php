@extends('components.admin.app_dash')
@section('title')
   Add Discount
@endsection
@section('nav-discount')
    active
@endsection
@section('content')
<style>
.row{
  margin: 10px;
}

.bmd-label-floating{
  margin-bottom: 5px;
}
</style>

 <div class="content">
   @include('components.notification')
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-rose">
                    <i class="material-icons">people_alt</i>
                  <h4 class="card-title "> </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
					            	</div>
                    </div>
                  <form action="{{route('discount.store')}}" method="POST" class="form">
                        @csrf
                      <div class="row">
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                   <select  class="form-control" name="id_product" data-style=" btn btn-link">
                                          @if ($product->isEmpty())
                                              <option disabled>Product</option>
                                          @else
                                              <option selected disabled>--  Product --</option>
                                              @foreach ($product as $p)
                                                <option value="{{$p->id}}">{{$p->product_name}}</option>
                                              @endforeach
                                          @endif
                                   <select>
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Percentage</label>
                                    <input type="number" name="percentage"  step="0.01" min="0" max="99" value="{{ old('percentage') }}"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Start</label>
                                    <input type="date" name="start" value="{{ old('start') }}"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">End</label>
                                    <input type="date" name="end" value="{{ old('end') }}"  class="form-control" >
                                </div>
                              </div>
                                </div>
                            </div>
                        </div>
                        
                        <input type="submit" value="Tambah" class="btn btn-success pull-right">
                    </form>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
      <script>
        var today = new Date().toISOString().split('T')[0];
        document.getElementsByName("start")[0].setAttribute('min', today);
        document.getElementsByName("end")[0].setAttribute('min', today);
      </script>
@endsection
