@extends('components.admin.app_dash')
@section('title')
    Transaction
@endsection
@section('nav-transaction')
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
                  <h4 class="card-title ">Transaction</h4>
                   
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <form action="" method="POST" enctype="" class="form">
                        @csrf
                         <div class="row">
                            {{-- <div class="col-md-4">
                              <div class="form-group bmd-form-group">
                                     <label >Find</label>
                                    <input type="text" name="description" value=""  class="form-control" > 
                                </div>
                              
                            </div> --}}
                            <div class="col-md-4">
                             <div class="form-group bmd-form-group">
                                 <label >Status</label>
                                <select  class="form-control" name="product_category" data-style=" btn btn-link">
                                   <option selected disabled>-- Status --</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                             <div class="form-group bmd-form-group">
                                 <label >Urutan</label>
                                <select  class="form-control" name="product_category" data-style=" btn btn-link">
                                   <option selected disabled>-- Urutan --</option>
                                   <option>Terbaru</option>
                                   <option>Lama</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <input type="submit" name="submit" value="Find" class="btn btn-success pull-right">
                            </div>
                         </div>
                          
                    </form>
                  </div> 
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
                            <a href=""  rel="tooltip" title="View Detail" class="btn btn-primary btn-link btn-sm">
                                   <i class="material-icons">assignment</i>
                                </a>
                          </td>
                          </tr>
                          {{$transaction->links()}}
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