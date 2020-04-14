@extends('components.auth.app')

@section('title')
    Register
@endsection

@section('component')
    
  <div class="page-header header-filter" style="background-image: url('auth_user/assets/img/bg7.jpg'); background-size: cover; background-position: top center;">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-8 ml-auto mr-auto">
          <div class="card card-login">
          <form class="form" method="POST" action="{{route('user.forgetPass')}}">
            @csrf  
            <div class="card-header card-header-primary text-center">
                <h4 class="card-title">Forget Password</h4>
                <div class="social-line">
                  
                  </a>
                </div>
              </div>
              <div class="card-body">
                <div class="input-group">
                </div>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"> 
                      <i class="material-icons">mail</i>
                    </span>
                  </div>
                  <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email...">
                </div>
                <div class="input-group">
                  <input type="submit" style="width:1000px!important;margin-left:10px;" class="btn btn-primary" placeholder="" value="REGISTRATION">
                 
                </div>
                @include('components.notification')
              </div>
              
            </form>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer">
      
    </footer>
  </div>


@endsection