@extends('components.auth.app')

@section('title')
    Login
@endsection

@section('component')
    

  <div class="page-header header-filter" style="background-image: url('auth_user/assets/img/bg7.jpg'); background-size: cover; background-position: top center;">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6 ml-auto mr-auto">
          <div class="card card-login">
          <form class="form" method="POST" action="{{route('user.loginUser')}}">
              <div class="card-header card-header-primary text-center">
                <h4 class="card-title">Login</h4>
                <div class="social-line">
                  @csrf
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
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">lock_outline</i>
                    </span>
                  </div>
                  <input type="password" name="password" class="form-control" placeholder="Password...">
                </div>
                <div class="input-group">
                  <button type="submit" style="width:1000px!important;margin-left:10px;" class="btn btn-primary" placeholder="">LOGIN </button>
                  <a href="/register" style="width:1000px!important;margin-left:10px;" class="btn btn-danger">Register</a>
                </div>
              </div>
              <div class="footer text-center">
              <a href="{{route('user.forget')}}" class="btn btn-primary btn-link btn-wd btn-lg">Forget password?</a>
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