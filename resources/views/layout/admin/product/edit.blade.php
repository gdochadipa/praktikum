@extends('components.admin.app_dash')
@section('title')
   Edit Product
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
                <div class="card-header card-header-primary>
                    <i class="material-icons">people_alt</i>
                  <h4 class="card-title "> </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
					            	</div>
                    </div>
                  <form action="{{route('product.edit',['id'=>$product->id])}}" method="POST" class="form">
                        @csrf
                      <div class="row">
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Product Name</label>
                                    <input type="text" name="product_name" value="{{$product->product_name}}"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">price</label>
                                    <input type="text" name="price" value="{{$product->price}}"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Description</label>
                                    <input type="text" name="description" value="{{$product->description}}"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Product Rate</label>
                                    <input type="text" name="product_rate" value="{{$product->product_rate}}"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Stock</label>
                                    <input type="text" name="stock" value="{{$product->stock}}"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Weight</label>
                                    <input type="text" name="weight" value="{{$product->weight}}"  class="form-control" >
                                </div>
                            </div>
                        </div>
                        
                        <input type="submit" value="Change" class="btn btn-success pull-right">
                    </form>
                </div>
              </div>
            </div>
            
            {{-- producImage --}}
             <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Product Images</h4>
                  <p class="card-category"> Here is a subtitle for this table</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                      <form action="" method="POST" enctype="multipart/form-data" class="form">
                        @csrf
                         <div class="row">
                            <div class="col-md-12">
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
                      </form>
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          ID
                        </th>
                        <th>
                          Image
                        </th>
                        <th>
                          Action
                        </th>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            1
                          </td>
                          <td>
                            Dakota Rice
                          </td>
                          <td>
                            $36,738
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            {{-- productImage end --}}
             {{-- product Category --}}
             <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Product Images</h4>
                  <p class="card-category"> Here is a subtitle for this table</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <form action="" method="post"  class="form">
                      @csrf
                      <div class="form-group">
                        <label >Product Categories</label>
                        <select  class="form-control" data-style=" btn btn-link">
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                        </select>
                        <input type="submit" name="submit" value="">
                      </div>
                    </form>

                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          ID
                        </th>
                        <th>
                          Name
                        </th>
                        <th>
                          Country
                        </th>
                        <th>
                          City
                        </th>
                        <th>
                          Salary
                        </th>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            1
                          </td>
                          <td>
                            Dakota Rice
                          </td>
                          <td>
                            Niger
                          </td>
                          <td>
                            Oud-Turnhout
                          </td>
                          <td class="text-primary">
                            $36,738
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            {{-- product Category  end--}}

          </div>


        </div>
      </div>
      
@endsection
