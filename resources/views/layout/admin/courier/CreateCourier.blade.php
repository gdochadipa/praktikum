@extends('components.admin.app_dash')
@section('title')
   Tambah Courier
@endsection
@section('nav-courier')
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
                  <form action="{{route('courier.store')}}" method="POST" class="form">
                        @csrf
                      <div class="row">
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Courier</label>
<<<<<<< HEAD:resources/views/layout/admin/CreateCourier.blade.php
                                    <input type="text" name="courier" >
=======
                                    <input type="text" name="courier" value="{{ old('courier') }}"  class="form-control" >
>>>>>>> ca2789f54c375428dd2ee207b8dedf5cbb37aba3:resources/views/layout/admin/courier/CreateCourier.blade.php
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
      
@endsection
