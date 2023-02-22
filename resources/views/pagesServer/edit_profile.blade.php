@extends('layout/layoutServer')


@section('title')
    Edit Profile
@endsection

@section('content')

                  
    <div class="col-md-3">
        <div class="x_panel ">
            {{-- <div class="x_content"> --}}
                
                <div class="row">
                    <div class="col-md-12">
                        <img src="{{ url('images/profile/', $profile->gambar) }}" alt="" class="profile1" width="100%">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 my-3 text-center">
                        <h5 class="text-capitalize">{{$profile->nama}}</h5>
                        <p class="text-capitalize">{{$profile->posisi}}</p>

                        <hr>

                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#ubahGambar">Ubah Gambar</button>

                        <div class="modal fade" id="ubahGambar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Ubah Gambar</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('profile.edit_gambar') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <input type="file" name="ubahGambar" class="form-control py-1">
    
                                            <button type="submit" class="pull-right btn btn-primary mt-3 ">Ubah Gambar</button>
                                    </div>

                                    </form>

                                </div>
                                
                              </div>
                            </div>
                          </div>


                    </div>
                </div>

            {{-- </div> --}}
        </div>
    </div>
<div class="col-md-9">
    
        
  {{-- aksi form  --}}
  <form class="form-horizontal form-label-left" action="{{ route('profile.ubah_password') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="x_panel ">
      <div class="x_title">
        <h2>Ubah Password</h2>
        <ul class="nav navbar-right panel_toolbox text-right">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
         
          
        <div class="field item form-group">
          <label class="col-form-label col-md-3 col-sm-3  label-align">Password<span class="required">*</span></label>
          <div class="col-md-7 col-sm-7">
            <input class="form-control @error('password1')
                is-invalid
            @enderror" type="password" onkeyup="cek()" id="inputPassword1" name="password1" required />
            
            <span style="position: absolute;right:15px;top:7px;" onclick="hideshow()">
              <i id="slash" class="fa fa-eye-slash"></i>
              <i id="eye" class="fa fa-eye" style="display: none"></i>
            </span>
            @error('password1')
              <div class="text-danger">{{$message}}</div>  
            @enderror
          </div>
          
        </div>

        <div class="field item form-group">
          <label class="col-form-label col-md-3 col-sm-3  label-align">Repeat password<span class="required">*</span></label>
          <div class="col-md-7 col-sm-7">
              <input class="form-control" type="password" onkeyup="cek()" id="inputPassword2" name="password2" data-validate-linked='password' required='required' /></div>
          </div>
          

          

      </div>
    </div>
    
   



    <div class="x_panel shadow-sm">
       
      <button type="submit" class="btn btn-danger px-5 float-right">
          <i class="fa fa-save"></i> Ubah Password
      </button>
    </div>

  </form>

</div>
</div>
  



    
@endsection




@section('js')

<script src="{{ url('admin/validator/validator.js', []) }}"></script>
<script>
  function hideshow(){
    var password = document.getElementById("inputPassword1");
    var slash = document.getElementById("slash");
    var eye = document.getElementById("eye");
    
    if(password.type === 'password'){
      password.type = "text";
      slash.style.display = "block";
      eye.style.display = "none";
    }
    else{
      password.type = "password";
      slash.style.display = "none";
      eye.style.display = "block";
    }

  }
</script>
<script>
  function cek(){
      var pass1 = document.getElementById('inputPassword1').value;
      var pass2 = document.getElementById('inputPassword2').value;

      if(pass1.length >=7 ){
              document.getElementById('inputPassword1').className="form-control";
          if(pass1 == pass2){
              document.getElementById('inputPassword1').className="form-control is-valid";
              document.getElementById('inputPassword2').className="form-control is-valid";
          }else if(pass2.length == 0){
              document.getElementById('inputPassword2').className="form-control";

          }else {
               document.getElementById('inputPassword2').className="form-control is-invalid";
          }
      }else if(pass1.length==0){
              document.getElementById('inputPassword1').className="form-control";
      }else {
          document.getElementById('inputPassword1').className="form-control is-invalid";

      }
     

  }
</script>



@endsection