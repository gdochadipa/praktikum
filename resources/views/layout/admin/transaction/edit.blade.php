@extends('components.admin.app_dash')
@section('title')
   Edit Transaction
@endsection
@section('nav-transaction')
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
                  <form action="" method="POST" class="form">
                        @csrf
                      <div class="row">
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Timeout</label>
                                    <input type="text" readonly name="timeout" value="{{$transaction[0]->timeout}}"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Address</label>
                                    <input type="text" readonly name="address" value="{{$transaction[0]->address}}"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Regency</label>
                                    <input type="text" readonly name="regency" value="{{$transaction[0]->regency}}"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Province</label>
                                    <input type="text" readonly name="province" value="{{$transaction[0]->province}}"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Total</label>
                                    <input type="text" readonly name="total" value="{{$transaction[0]->total}}"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Shipping Cost</label>
                                    <input type="text" readonly name="shipping_cost" value="{{$transaction[0]->shipping_cost}}"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Sub Total</label>
                                    <input type="text" readonly name="sub_total" value="{{$transaction[0]->sub_total}}"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">User</label>
                                    <input type="text" hidden name="user_id" value="{{$transaction[0]->user_id}}"  class="form-control" >
                                    <input type="text" readonly name="user" value="{{$transaction[0]->user->name}}"  class="form-control" >
                                </div>
                                  <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Courier</label>
                                    <input type="text" hidden name="courier_id" value="{{$transaction[0]->courier_id}}"  class="form-control" >
                                    <input type="text" readonly name="courier" value="{{$transaction[0]->courier->courier}}"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Proof of Payment</label>
                                    <input type="text" readonly name="proof_of_payment" value="{{$transaction[0]->proof_of_payment}}"  class="form-control" >
                                </div>
                                <div class="form-group bmd-form-group">
                                  
                                  @if ($transaction[0]->status=='unverified')
                                      
                                      <div class="alert alert-primary">
                                          <span><b> Unverified </b></span>
                                     </div>
                                      <a href="{{route('transaction.update',['id'=>$transaction[0]->id,'status'=>'verified'])}}" class="btn btn-success header-btn"><i class="material-icons">done</i> Verified</a>
                                  
                                  @elseif($transaction[0]->status=='verified')    
                                       
                                       <div class="alert alert-success">
                                          <span><b> Verified </b></span>
                                      </div>
                                      <a href="{{route('transaction.update',['id'=>$transaction[0]->id,'status'=>'delivered'])}}" class="btn btn-primary header-btn"><i class="material-icons">local_shipping</i> Delivered</a>

                                  @elseif($transaction[0]->status=='delivered')    
                                     <div class="alert alert-primary">
                                          <span><b> Delivered </b></span>
                                      </div>
                                    <a href="{{route('transaction.update',['id'=>$transaction[0]->id,'status'=>'canceled'])}}" class="btn btn-danger header-btn"><i class="material-icons">close</i> Canceled</a>
                                  
                                  @elseif($transaction[0]->status=='canceled')    
                                     <div class="alert alert-danger">
                                          <span><b> Canceled </b></span>
                                      </div>

                                  @elseif($transaction[0]->status=='success')    
                                   <div class="alert alert-success">
                                        <span><b> Success </b></span>
                                    </div>

                                  @elseif($transaction[0]->status=='expired')    
                                   <div class="alert alert-warning">
                                        <span><b> Expired </b></span>
                                    </div>  
                                     
                                  @endif
                                   
                                </div>
                            </div>
                        </div>
                        
                    </form>
                </div>
              </div>
            </div>

             {{-- product Category --}}
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Detail Transaction</h4>
                  <p class="card-category"> </p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          ID
                        </th>
                        <th>
                         Name Product
                        </th>
                        <th>
                          Qty
                        </th>
                        <th>
                          Discount
                        </th>
                        <th>
                          Selling Price
                        </th>
                      </thead>
                      <tbody>
                       @if ($transaction_d->isEmpty())
                           
                       @else
                        @foreach ($transaction_d as $det)
                            
                        <tr>
                          <td>
                          {{$loop->iteration}}
                          </td>
                          <td>
                            {{$det->product->product_name}}
                          </td>
                          <td>
                            {{$det->qty}}
                          </td>
                          <td>
                            {{$det->discount}}
                          </td>
                          <td>
                            {{$det->selling_price}}
                          </td>
                          {{-- <td class="td-actions text-left" >
                            <form style="display:inline-block;" action="{{route('product.delete_image',['id'=>$i->id])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                  <button type="submit" value="Delete"  rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                    <i class="material-icons">delete</i>
                                  </button>
                                </form>
                          </td> --}}
                        </tr>
                          @endforeach
                       @endif
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
