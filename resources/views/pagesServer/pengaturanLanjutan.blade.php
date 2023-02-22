@extends('layout/layoutServer')


@section('title')
    Edit Profile
@endsection

@section('content')

<div class="col-12">
    <div class="row">
        <div class="col-12 ">
            <div class="x_panel">
                <div class="x_title">
                  <h2>Sosial Media</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content ">
                    <div class="col-md-3">
                        <div class="x_panel bg-light">
                            {{-- <div class="x_content"> --}}
                                
                                <div class="row">
                                    <div class="col-12 justify-content-center">
                                        <center>
                                            <h5>Logo</h5>
                                        </center>
                                    </div>
                                    <div class="col-md-12 justify-content-center">
                                        <center>
                                        <img src="
                                        @if (!empty($logo->logo1))
                                        {{ url('images/logo', $logo->logo1) }}
                                        @endif
                                        " alt="" class="profile1" width="60%">
                                        </center>
                                    </div>
                                </div>
                
                                <div class="row">
                                    <div class="col-md-12 my-3 text-center">
                                        <hr>
                
                                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#ubahLogo">Update Logo</button>
                                        <form action="{{ route('reset.logo') }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Yakin ingin mereset Logo?')">Reset Logo
                                            </button>
                                        </form>
                                        @error('logo1')
                                            <font color="red">{{ $message }}</font>
                                        @enderror
                
                                        <div class="modal fade" id="ubahLogo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Ubah Gambar</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('ubah.logo','logo1') }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <input type="file" name="logo1" class="form-control py-1">
                    
                                                            <button type="submit" class="pull-right btn btn-primary mt-3 ">Update Logo</button>
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
                
                
                    @if ($cekLogo>0)
                    <div class="col-md-3">
                        <div class="x_panel bg-light">
                            {{-- <div class="x_content"> --}}
                                
                                <div class="row">
                                    <div class="col-12 justify-content-center">
                                        <center>
                                            <h5>Logo Ke 2</h5>
                                        </center>
                                    </div>
                                    <div class="col-md-12 justify-content-center">
                                        <center>
                                            <img src="
                                            @if (!empty($logo->logo2))
                                            {{ url('images/logo', $logo->logo2) }}
                                            @endif
                                            " alt="" class="profile1" width="60%">
                                            </center>
                                    </div>
                                </div>
                
                                <div class="row">
                                    <div class="col-md-12 my-3 text-center">
                                        <hr>
                
                                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#ubahLogo2">Update Logo2</button>
                                        <form action="{{ route('hapus.logo','logo2') }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-warning btn-block" onclick="return confirm('Yakin ingin mereset Logo?')">Hapus Logo 2
                                            </button>
                                        </form>
                                        
                                        @error('logo2')
                                            <font color="red">{{ $message }}</font>
                                        @enderror
                
                                        <div class="modal fade" id="ubahLogo2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Ubah Gambar</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('ubah.logo','logo2') }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <input type="file" name="logo2" class="form-control py-1">
                    
                                                            <button type="submit" class="pull-right btn btn-primary mt-3 ">Update Logo</button>
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
                    @endif


                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="card-box table-responsive tabelku2">
                            <table  class="table tableku table-sm table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr >
                                <th scope="col">Jurusan</th>
                                <th scope="col">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jurusan as $jurusan)
                                <tr>
                                    <td class="tulisan-kiri text-capitalize text-bold"><b>{{ $jurusan->jurusan }}</b></td>
                                    <td class="text-center" scope="row" >
                                    
                                    <form action="{{ route('hapus.jurusan', $jurusan->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-kecil bg-danger mx-0" onclick="return confirm('Yakin ingin menghapus Jurusan?..')">
                                        <i class="fa fa-trash m-0"></i>
                                        </button>
                                    </form>
            
                                    </td>
                                </tr>
                                @endforeach

                                <tr>
                                    <td colspan="2" class="bg-light">
                                        <form action="{{ route('tambah.jurusan', []) }}" method="post">
                                            @csrf
                                            <input type="text" class="form-control" width="100%" name="jurusan">
                                            <div class="input-group-append float-left">
                                                @error('jurusan')
                                                    <font color="red">Tidak boleh kosong..</font>
                                                @enderror
                                            </div>
                                            <div class="input-group-append float-right">
                                                <button class="btn btn-success btn-sm my-1" type="submit" id="button-addon2"><i class="fa fa-save"></i> Add</button>
                                            </div>
                                        </form>
                                        
            
                                    </td>
                                </tr>
                                
                            </tbody>
                            </table>
                            
                        </div>
                    
                    
                    </div>


                    


                </div>
            </div>

        </div>
        
    </div>



    <div class="row">
        <div class="col-sm-12 col-md-4 col-lg-4">
            <div class="card-box table-responsive tabelku2">
                <div class="x_panel">
                    <div class="x_title">
                      <h2>Pengaturan Website</h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form action="{{ route('web.setting') }}" method="post">
                            @csrf  
                            <div class="form-group">
                              <label for="title">Title Web</label>
                              <input type="text" class="form-control" id="title" placeholder="Title Website" name="title" value="{{ empty($web->title)?'':$web->title }}">
                            </div>

                            <div class="form-group">
                                <label for="footer">footer Web</label>
                                <input type="text" class="form-control" id="footer" placeholder="Footer Website" name="footer" value="{{ empty($web->footer)?'':$web->footer }}">
                            </div>

                            <div class="form-group">
                                <label for="gogmap">Google Maps : latitude,longitude</label>
                                <input type="text" class="form-control" id="gogmap" placeholder="contoh : 0.9211083,104.4519044" name="maps" value="{{ empty($web->map)?'':$web->map }}">
                            </div>
                            <div class="form-group">
                                <label for="" class="text-success"> lokasi STTI : 0.921193998060887,104.45409807605799 </label>
                            </div>

                            <div class="form-group">
                                <label for="api_key">API KEY</label>
                                <input type="text" class="form-control" id="api_key" placeholder="masukan API_KEY" name="api_key" value="{{ empty($web->api_key)?'':$web->api_key }}">
                            </div>
                            <div class="form-group">
                                <label for="" class="text-success"> Free Key : AIzaSyAi_ZtCBdcUz0clLktV25topK35zMgFSTA
                                <br><br>
                                Maps dapat berjalan sempurna setelah memiliki domain dan mendaftarkan domain tersebut pada API_KEY     
                                </label>
                            </div>

                            <div class="form-group row float-right">
                                <div class="col-12 float-right">
                                    <button class="btn btn-primary text-right">Update</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="x_panel">
                <div class="x_title">
                  <h2>Sosial Media</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form action="{{ route('update.sosialmedia') }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="facebook" class="col-sm-3 col-form-label">Facebook</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="facebook" name="facebook" placeholder="name_group" value="{{ empty($sosialmedia->facebook)?'':$sosialmedia->facebook }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="instagram" class="col-sm-3 col-form-label">instagram</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="instagram" name="instagram" placeholder="name_group" value="{{ empty($sosialmedia->instagram)?'':$sosialmedia->instagram }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="twitter" class="col-sm-3 col-form-label">twitter</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="twitter" name="twitter" placeholder="name_group" value="{{ empty($sosialmedia->twitter)?'':$sosialmedia->twitter }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pinterest" class="col-sm-3 col-form-label">pinterest</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="pinterest" name="pinterest" placeholder="name_group" value="{{ empty($sosialmedia->pinterest)?'':$sosialmedia->pinterest }}">
                                    </div>
                                </div>
                                <div class="form-group row float-right">
                                    <div class="col-12 float-right">
                                        <button type="submit" class="btn btn-primary text-right">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="x_panel">
                <div class="x_title">
                  <h2>Sosial Media</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form action="{{ route('update.kontak') }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <div class="col-12">
                                
                                <div class="form-group row">
                                    <label for="hp" class="col-sm-3 col-form-label">No. Hp</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="hp" name="hp" placeholder="0812345678xx" value="{{ empty($kontak->hp)?'':$kontak->hp }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="wa" class="col-sm-3 col-form-label">Whatsapp</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="wa" name="wa" placeholder="0812345678xx" value="{{ empty($kontak->wa)?'':$kontak->wa }}">
                                    </div>
                                </div>
                                
                                <div class="form-group row float-right">
                                    <div class="col-12 float-right">
                                        <button type="submit" class="btn btn-primary text-right">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
                  
    
    
  



    
@endsection




