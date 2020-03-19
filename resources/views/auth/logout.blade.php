@extends('components.auth.app')

@section('title')
    Verify
@endsection

@section('component')
    
<body class="login-page sidebar-collapse">
  <div class="page-header header-filter" style="background-image: url('auth_user/assets/img/bg7.jpg'); background-size: cover; background-position: top center;">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6 ml-auto mr-auto">
          <div class="card card-login">
          <form class="form" method="POST" action="{{route('user.regisUser')}}">
            @csrf  
            <div class="card-header card-header-primary text-center">
                <h4 class="card-title">Verify</h4>
                <div class="social-line">
                  
                  </a>
                </div>
              </div>
              <div class="card-body">
                <div class="input-group">
                </div>
              
                 <div class="input-group">
                 <a href="{{route('logout')}}" class="btn btn-primary btn-link btn-wd btn-lg">Logout</a>
                 
                </div>
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