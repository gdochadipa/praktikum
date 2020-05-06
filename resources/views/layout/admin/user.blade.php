@extends('components.admin.app_dash')
@section('title')
    Users
@endsection
@section('nav-users')
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
                  <h4 class="card-title ">Users</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    
                   @if ($user->isEmpty())
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
                          Name
                        </th>
                        <th>
                          email
                        </th>
                        <th>
                         Email Verifeid
                        </th>
                             
                      </thead>
                      <tbody>
                   
                            @foreach ($user as $i)
                              <tr>
                            <td>
                              {{$loop->iteration}}
                            </td>
                            <td>
                              {{$i->name}}
                            </td>
                            <td>
                              {{$i->email}}
                            </td>
                            <td>
                              @if ($i->status==1)
                                  <p class="text-success">Activated</p>
                              @else
                                  <p class="text-danger">Deactivated</p>
                              @endif
                            </td>
                           
                            <td class="td-actions text-left">
                                
                                <form style="display:inline-block;" action="{{route('admin.users.status',['id'=>$i->id])}}" method="post">
                                    @csrf
                                    @method('PUT')
                                  <button type="submit" value="Change Status"  rel="tooltip" title="Change Status" class="btn btn-danger btn-link btn-sm">
                                    <i class="material-icons">assignment</i>
                                  </button>
                                </form>
                                
                            
                              </td>
                            
                          </tr>
                          @endforeach
                      
                    
                     {{$user->links()}}
                    @endif 
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