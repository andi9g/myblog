@extends('layout/layoutServer')

@section('activeAnggota')
    activeku
@endsection


@section('title')
    Anggota
@endsection

@section('judul')
    
@endsection

@section('content')

<div class="col-md-12 ">
  {{-- aksi form  --}}
  <div class="x_panel">
    <div class="x_title">
      <h2>Anggota 
        <small>
          <?php
            if (empty($_GET['keyword'])) {
              echo "Keseluruhan";
            }else {
              echo 'Kunci : "'.$_GET['keyword'].'"';
            }  
          ?>
        </small>
      </h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        <li><a href="{{ route('anggota.index') }}"><i class="fa fa-refresh fa-lg"></i> Refresh</a></li>
        
        
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="row">
          <div class="col-sm-6 tulisan-tengah">
                
          </div>
          <div class="col-md-6 ">
            <div class="title_right ">

              <form action="{{ url()->current() }}" class="d-inline">
              <div class="form-group top_search">
                <div class="input-group">
                    <input type="text" class="form-control bgku3" name="keyword" value="{{empty($_GET['keyword'])?'':$_GET['keyword']}}" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-default"  type="button">Search</button>
                    </span>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
              
              <div class="card-box modelku">
                <table  class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr >
                      <th scope="col">Nim</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Posisi</th>
                      <th scope="col">Ket</th>
                      <th scope="col">password</th>
                      <th scope="col">Opsi</th>
                      <th scope="col">Persetujuan</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($anggota as $tampil)
                    <tr class="py-0">
                      <td data-label="nim : &nbsp;" class="tulisan-kiri "> {{$tampil->nim}}</td>
                      <td data-label="nama : &nbsp;" class="tulisan-kiri  text-left text-capitalize"> {{$tampil->nama}}</td>
                      <td class="text-center"> 
                          <form action="{{ route('posisi.ubah', $tampil->id) }}" method="post">
                            @csrf
                            @method('PUT')
                                <select name="posisi" id="" class="py-1 justify-content-center" style="width:80%" onchange="submit()">
                                    <option value="anggota" @if ($tampil->posisi=='anggota')
                                        selected
                                    @endif>anggota</option>
                                    <option value="admin" @if ($tampil->posisi=='admin')
                                    selected
                                @endif>admin</option>
                                </select> 
                          </form>
                          
                      </td>

                      <td class="text-center "> 
                        <form action="{{ route('ket.ubah', $tampil->id) }}" method="post">
                            @csrf
                            @method('PUT')
                                <select name="ket" id="" class="py-1 justify-content-center" style="width:80%" onchange="submit()">
                                    <option value="none" @if ($tampil->ket=='none')
                                        selected
                                    @endif>none</option>
                                    <option value="penulis" @if ($tampil->ket=='penulis')
                                    selected
                                @endif>penulis</option>
                                </select>
                        </form>
                      </td>
                      <td data-label="password : &nbsp;" class="tulisan-kiri ">
                          @if (Hash::check('anggotabaru'.date('Ymd',strtotime($tampil->created_at)),$tampil->password))
                              Default
                          @else 
                                -
                          @endif
                      </td>
                      <td class="tulisan-kanan " scope="row" >
                        @php
                            $numberCek = substr($tampil->hp,0,2);
                            $nowa = '';
                            if($numberCek=='08'){
                                $nowa = '62'.substr($tampil->hp,1,12);
                            }else if($numberCek=='62'){
                                $nowa = $tampil->hp;
                            }
                        @endphp
                        
                        <button type="button" class="btn btn-secondary d-inline py-0" title="detail" data-toggle="modal" data-target="#lihat{{ $tampil->nim }}">
                            <i class="fa fa-eye"></i>
                        </button> 

                        @if(Hash::check('anggotabaru'.date('Ymd',strtotime($tampil->created_at)), $tampil->password))
                                      <a href="https://api.whatsapp.com/send?phone={{ $nowa }}&text=Kami dari pihak BEM memberikan data login anda sebagai anggota BEM %3A %0A%0AUsername %3A {{ $tampil->nim }} %0APassword %3A {{ 'anggotabaru'.date('Ymd',strtotime($tampil->created_at)) }}" class="btn btn-success py-0" target="_blank"><i class="fa fa-key"></i> = <i class="fa fa-whatsapp"></i></a>
                                      @endif
                        
                        <form action="{{ route('anggota.destroy', $tampil->id) }}" method="post" class="d-inline">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger py-0 mx-0" onclick="return confirm('Yakin ingin dihapus?..')">
                            <i class="fa fa-trash m-0"></i>
                          </button>
                        </form>

                      </td>
                      <td>
                        <form action="{{ route('reset.password',$tampil->id) }}" method="post">
                          @csrf
                          @method('put')
                          <button type="submit" class="btn-kecil bg-success py-1 btn-block" onclick="return confirm('Lanjutkan Proses?...')">
                            <i class="fa fa-pencil "></i> Reset Password 
                          </button>
                        </form>
                      </td>
                    </tr>


                    <!-- Modal -->
                    <div class="modal fade" id="lihat{{ $tampil->nim }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ $tampil->nim }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">

                                <div class="row justify-content-center">
                                  <div class="col-12 col-md-6">
                                    <center>
                                      <p class="mt-2"><b>Foto</b></p>
                                      <img src="{{ url('images/profile', $tampil->gambar) }}" alt="" width="70%" style="border: 1px solid grey" class="p-1">
                                    </center>
                                  </div>
                                </div>
                                

                                <div class="row justify-content-center">
                                  <div class="col-12 col-md-6">
                                    <center>
                                      @if(Hash::check('anggotabaru'.date('Ymd',strtotime($tampil->created_at)), $tampil->password))
                                      <a href="https://api.whatsapp.com/send?phone={{ $nowa }}&text=Kami dari pihak BEM memberikan data login anda sebagai anggota BEM %3A %0A%0AUsername %3A {{ $tampil->nim }} %0APassword %3A {{ 'anggotabaru'.date('Ymd',strtotime($tampil->created_at)) }}" class="btn btn-success" target="_blank"><i class="fa fa-whatsapp"></i> Infokan Data Login Anggota</a>
                                      @endif
                                    </center>
                                  </div>
                                </div>
                                
                                <hr>

                                  <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" class="form-control text-capitalize" disabled id="" value="{{ $tampil->nama }}">
                                  </div>

                                  <div class="form-group">
                                    <label for="">Alamat</label>
                                    <input type="text" class="form-control" disabled id="" value="{{ $tampil->alamat }}">
                                  </div>
                                  
                                  <div class="form-group">
                                    <label for="">No Hp</label>
                                    <input type="text" class="form-control" disabled id="" value="{{ $tampil->hp }}">
                                  </div>
                                 
                                  <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control" disabled id="" value="{{ $tampil->email }}">
                                  </div>

                                  <div class="form-group">
                                    <label for="">Jabatan</label>
                                    <input type="text" class="form-control" disabled id="" value="{{ $tampil->jabatan }}">
                                  </div>
                                  
                                  <div class="form-group">
                                    <label for="">Posisi</label>
                                    <input type="text" class="form-control" disabled id="" value="{{ $tampil->posisi }}">
                                  </div>
                                  
                                  
                            </div>
                            
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                           
                        </div>
                        </div>
                    </div>

                    @endforeach
                    
                  </tbody>
                </table>
                
              </div>
              
            </div>
           

        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="col-12 ">
              {{ $anggota->links('vendor.pagination.bootstrap-4') }}
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
  



    
@endsection




@section('js')



@endsection