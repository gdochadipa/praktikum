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
                    <li class="d-none d-lg-block"> <a href="/admin/tambahcourier" class="btn header-btn">Add Courier</a>
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
                                <td>
                                  <span>
                                    <input type="button" value="Edit" onclick="location.href='/courier/{{$crier->id}}/edit'">
                                      <form style="display:inline-block;" action="/courier/{{$crier->id}}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                    <input type="submit" value="Delete">
                                    </form>
                                    <input type="button" value="Details" onclick="location.href='/courier/{{$crier->id}}'">
                                  </span>
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