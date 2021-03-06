@extends('components.admin.app_dash')
@section('title')
    Discount
@endsection
@section('nav-discount')
    active
@endsection
@section('content')
    <div class="content">
      @include('components.notification')
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-info">
                    <i class="material-icons">content_paste</i>
                  <h4 class="card-title ">Discount</h4>
                <li class="d-none d-lg-block"> <a href="{{route('discount.add')}}" class="btn btn-primary header-btn"><i class="material-icons">add</i>Add Discount</a>
                    </li>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    
                   @if ($discount->isEmpty())
                        <div class="row">
                            <div class="col-md-12">
                              <div class="alert alert-danger">
							                  <div>Data kosong</div>
					                  	</div>
                            </div>
                        </div>
                  @else
                    <table class="table">
                      <thead class=" text-info">
                        <th>
                          ID
                        </th>
                        <th>
                         Product
                        </th>
                        <th>
                          Precentage
                        </th>
                        <th>
                          Start
                        </th>
                        <th>
                          End
                        </th>
                        <th>
                          Action
                        </th>
                        
                      </thead>
                      <tbody>   
                        @foreach ($discount as $item)
                          <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$item->product->product_name}}</td>
                          <td>{{$item->percentage}}</td>
                          <td>{{$item->start}}</td>
                          <td>{{$item->end}}</td>
                          <td class="td-actions text-left">
                                
                                <form style="display:inline-block;" action="{{route('discount.destroy',['id'=>$item->id])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                  <button type="submit" value="Delete"  rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                    <i class="material-icons">delete</i>
                                  </button>
                                </form>
                                <a href="{{route('discount.edit',$item->id)}}"  rel="tooltip" title="Review Product" class="btn btn-primary btn-link btn-sm">
                                   <i class="material-icons">assignment</i>
                                </a>
                            
                              </td>
                          </tr>
                          {{$discount->links()}}
                        @endforeach
                      </tbody>
                    </table>
                    
                  </div>
                    @endif   
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
      
@endsection