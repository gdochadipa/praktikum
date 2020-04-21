@if ($errors->any())
    @foreach ($errors->all() as $message)
         <div class="alert alert-danger animated fadeInDown">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span>
                      <b> Danger - </b>{{ $message }}</span>
                  </div>
        
    @endforeach
@elseif (session('error'))
    <div class="alert alert-danger animated fadeInDown">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span>
                      <b> Danger - </b> {{ session('error') }}</span>
                  </div>
@elseif (session('success'))
    <div class="alert alert-success animated fadeInDown">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span>
                      <b> Success - </b> {{ session('success') }}</span>
                  </div>
@endif

 

                  