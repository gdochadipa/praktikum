@extends('components.admin.app_dash')
@section('title')
    Notification
@endsection
@section('nav-dashboard')
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
                  <h4 class="card-title ">Notification</h4>
                <li class="d-none d-lg-block"> <a href="{{route('admin.markAsReadAll')}}" class="btn btn-primary header-btn"><i class="material-icons">visibility</i> Mark All as Read</a>
                    </li>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    @if (auth()->user()->notifications->isEmpty())
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
                         Order
                        </th>
                        <th>
                          Message
                        </th>
                        <th>
                          Date
                        </th>
                        <th>
                          Action
                        </th>
                        
                      </thead>
                      <tbody>   
                          
                        @foreach (auth()->user()->notifications as $item)
                          <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$item->data['order']}}</td>
                          <td>{{$item->data['body']}}</td>
                          <td>{{$item->created_at}}</td>
                           <td class="td-actions text-left">
                                
                                <a href="{{url($item->data['link'])}}"  rel="tooltip" title="Link" class="btn btn-primary btn-link btn-sm">
                                   <i class="material-icons">library_books</i>
                                </a>
                               @if ($item->read_at == null)
                                  <a href="{{route('admin.markAsRead')}}"  rel="tooltip" title="Mark As Read" class="btn btn-success btn-link btn-sm">
                                   <i class="material-icons">visibility</i>
                                </a>
                               @endif
                            
                              </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            
          </div>

          
        </div>
      </div>
      
@endsection