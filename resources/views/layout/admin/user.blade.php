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
                    
                   {{-- @if ($pemilih->isEmpty()) --}}
                        {{-- <div class="row">
                            <div class="col-md-12">
                              <div class="alert alert-danger">
							                  <div>Data kosong</div>
					                  	</div>
                            </div>
                        </div> --}}
                  {{-- @else --}}
                    <table class="table">
                      <thead class=" text-info">
                        <th>
                          ID
                        </th>
                        <th>
                          Nama Barang
                        </th>
                        
                      </thead>
                      <tbody>
{{--                         
                            @foreach ($pemilih as $i)
                              <tr>
                            <td>
                              {{$loop->iteration}}
                            </td>
                            <td>
                              {{$i->nama}}
                            </td>
                            <td>
                              {{$i->fakultas}}
                            </td>
                            <td>
                              {{$i->prodi}}
                            </td>
                           
                            
                            <td class="td-actions text-left">
                                @if ($i->id_calon==null)
                                    <p class="text-danger">Belum</p>
                                @else
                                     <p class="text-success">Sudah</p>
                                @endif
                                
                              </td>
                          </tr>
                          @endforeach
                      
                    
                     {{$pemilih->links()}}
                    @endif --}}
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