@extends('components.admin.app_dash')
@section('title')
    Courier
@endsection
@section('nav-courier')
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
                  <h4 class="card-title ">  Courier</h4>
                <li class="d-none d-lg-block"> <a href="{{route('courier.add')}}" class="btn header-btn">Add Courier</a>
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
                          Courier
                        </th>
                        
                      </thead>
                      <tbody>
                                        
                            @foreach ($all_courier as $crier)
                              <tr>
                                <td>
                                  {{$loop->iteration}}
                                </td>
                                <td>
                                  {{$crier->courier}}
                                </td>
                                <td class="td-actions text-left">
                                <a href="{{route('courier.edit',$crier->id)}}"  rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                   <i class="material-icons">edit</i>
                                </a>
                                <form style="display:inline-block;" action="{{route('courier.destroy',['id'=>$crier->id])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                  <button type="submit" value="Delete"  rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                    <i class="material-icons">close</i>
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