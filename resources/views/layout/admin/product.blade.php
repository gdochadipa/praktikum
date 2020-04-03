@extends('components.admin.app_dash')
@section('title')
    Product
@endsection
@section('nav-product')
    active
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-info">
                    <i class="material-icons">content_paste</i>
                  <h4 class="card-title "> Product </h4>
                <li class="d-none d-lg-block"> <a href="{{route('product.add')}}" class="btn header-btn">Add Product</a>
                    </li>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    
                    <table class="table">
                      <thead class=" text-info">
                        <th>
                          ID
                        </th>
                        <th>
                          Product Name
                        </th>
                        <th>
                          Category Name
                        </th>
                        <th>
                          Price
                        </th>
                        <th>
                          Description
                        </th>
                        <th>
                          Product Rate
                        </th>
                        <th>
                          Stock
                        </th>
                        <th>
                          Weight
                        </th>
                        
                      </thead>
                      <tbody>              
                            @foreach ($all_product as $produk)
                              <tr>
                            <td>
                              {{$loop->iteration}}
                            </td>
                            <td>
                              {{$produk->product_name}}
                            </td>
                              {{$produk->categories_name}}
                            <td>
                              {{$produk->price}}
                            </td>
                            <td>
                              {{$produk->description}}
                            </td>
                            <td>
                              {{$produk->product_rate}}
                            </td>
                            <td>
                              {{$produk->stock}}
                            </td>
                            <td>
                              {{$produk->weight}}
                            </td>
                            <td class="td-actions text-left">
                                <a href="{{route('product.edit',$produk->id)}}"  rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                   <i class="material-icons">edit</i>
                                </a>
                                <form style="display:inline-block;" action="{{route('product.destroy',['id'=>$produk->id])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                  <button type="submit" value="Delete"  rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                    <i class="material-icons">delete</i>
                                  </button>
                                </form>
                            
                              </td>
                          </tr>
                          @endforeach

                    </tbody>
                    </table>
                  </div>
                  
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
      
@endsection