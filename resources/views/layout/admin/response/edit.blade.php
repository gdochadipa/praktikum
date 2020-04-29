@extends('components.admin.app_dash')
@section('title')
    Response
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
                  <h4 class="card-title ">Review</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    
                    <table class="table">
                      <tbody>
                             
                            <tr>
                                   <td>ID :</td>
                                   <td>
                                     {{$product_review[0]->id}}
                                    </td>
                              </tr>
                            <tr>
                                   <td>User name:</td>
                                   <td>
                                     {{$product_review[0]->user->name}}
                                    </td>
                            </tr>
                                
                            <tr>
                                   <td>Product :</td>
                                   <td>
                                     {{$product_review[0]->product->product_name}}
                                    </td>
                              </tr>
                              <tr>
                                   <td>Rate :</td>
                                   <td>
                                     {{$product_review[0]->rate}}
                                    </td>
                              </tr>
                              <tr>
                                   <td>Content :</td>
                                   <td>
                                     {{$product_review[0]->content}}
                                    </td>
                              </tr>
                 
                    </tbody>
                    </table>
                  </div>
                  
                </div>
              </div>
            </div>
            

              {{-- Response--}}
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Reponse</h4>
                  <p class="card-category"> </p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <form action="{{route('response.update',['id'=>$response->id])}}" method="post"  class="form">
                      @csrf
                      @method('PUT')
                      <div class="form-group bmd-form-group">
                        <label class="bmd-label-floating">Review ID</label>
                      <input type="text" readonly name="review_id" value="{{$response->review_id}}"  class="form-control" >
                      </div>
                      <div class="form-group bmd-form-group">
                        <label class="bmd-label-floating">Admin</label>
                        <input type="text" readonly name="admin_id" value="{{$response->admin_id}}"  class="form-control" >
                      </div>
                      <div class="form-group bmd-form-group">
                        <label class="bmd-label-floating">Content</label>
                       
                      <input type="text" name="content" value="{{$response->content}}"  class="form-control" >
                      </div>
                      <div class="form-group">
                        
                        <input type="submit" name="submit" value="Add Category" class="btn btn-success pull-right">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            {{-- Response--}}
          </div>
        </div>
      </div>
      
@endsection