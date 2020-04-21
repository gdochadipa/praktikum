@extends('components.admin.app_dash')
@section('title')
   Tambah Product
@endsection
@section('nav-product')
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
                  <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data" class="form">
                        @csrf
                      <div class="row">
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Product Name</label>
                                    <input type="text" name="product_name" value="{{ old('product_name') }}"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">price</label>
                                    <input type="number" name="price" value="{{ old('price') }}"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Description</label>
                                    <input type="text" name="description" value="{{ old('description') }}"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Product Rate</label>
                                    <input type="number" name="product_rate" value="{{ old('product_rate') }}"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Stock</label>
                                    <input type="number" name="stock" value="{{ old('stock') }}"  class="form-control"  >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Weight</label>
                                    <input type="number" name="weight" value="{{ old('weight') }}"  class="form-control" step="0.01" min="0" max="999">
                                </div>
                                <div class="form-group bmd-form-group form-file-upload form-file-multiple">
                                <input type="file" multiple="" name="product_images[]" class="inputFileHidden">
                                <div class="input-group">
                                    <input type="text" class="form-control inputFileVisible" placeholder="Product Images" multiple>
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-fab btn-round btn-info">
                                            <i class="material-icons">layers</i>
                                        </button>
                                    </span>
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
      
@endsection
