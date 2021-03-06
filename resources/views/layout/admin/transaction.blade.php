@extends('components.admin.app_dash')
@section('title')
    Transaction
@endsection
@section('nav-transaction')
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
                  <h4 class="card-title ">Transaction</h4>
                <li class="d-none d-lg-block"> <a href="{{route('admin.filter')}}" class="btn btn-primary header-btn"><i class="material-icons">assignment</i>Filter Transaction</a>
                    </li>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    
                   @if ($transaction->isEmpty())
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
                          Timeout
                        </th>
                        <th>
                          Address
                        </th>
                        <th>
                          Regency
                        </th>
                        <th>
                          Province
                        </th>
                        <th>
                          Total
                        </th>
                        <th>
                          Shipping Cost
                        </th>
                        <th>
                          Sub Total
                        </th>
                        <th>
                          User Name
                        </th>
                        <th>
                          Courier
                        </th>
                        <th>
                          Proof of payment
                        </th>
                        <th>
                          Status
                        </th>
                        <th>
                          Action
                        </th>
                        
                      </thead>
                      <tbody>   
                        @foreach ($transaction as $item)
                          <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$item->timeout}}</td>
                          <td>{{$item->address}}</td>
                          <td>{{$item->regency}}</td>
                          <td>{{$item->province}}</td>
                          <td>{{$item->total}}</td>
                          <td>{{$item->shipping_cost}}</td>
                          <td>{{$item->sub_total}}</td>
                          <td>{{$item->user_id}}</td>
                          <td>{{$item->courier_id}}</td>
                          <td>{{$item->proof_of_payment}}</td>
                          <td>{{$item->status}}</td>
                          <td class="td-actions text-left">
                          <a href="{{route('transaction.edit',$item)}}"  rel="tooltip" title="View Detail" class="btn btn-primary btn-link btn-sm">
                                   <i class="material-icons">assignment</i>
                                </a>
                          </td>
                          </tr>
                          {{$transaction->links()}}
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