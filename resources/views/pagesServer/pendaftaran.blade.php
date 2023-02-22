@extends('layout/layoutServer')

@section('activePendaftaran')
    activeku
@endsection


@section('title')
    Pendaftaran
@endsection

@section('judul')
    
@endsection

@section('content')

<div class="col-md-12 ">
  {{-- aksi form  --}}
  <div class="x_panel">
    <div class="x_title">
      <h2>Pendaftar 
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
        <li><a href="{{ route('pendaftaran.index') }}"><i class="fa fa-refresh fa-lg"></i> Refresh</a></li>
        
        
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="row">
          <div class="col-sm-6 tulisan-tengah">
                <form action="{{ route('openPendaftaran.open') }}" method="post">
                    @csrf
                    @method('PUT')
                    @if ($cek==0 || $ket=='close')
                        <button type="submit" class="btn btn-primary px-4 d-inline mx-2">
                            Buka Pendaftaran
                        </button>
                        <font class="text-danger">&emsp; <b>Pendaftaran Ditutup</b></font>
                    @elseif ($ket=='open')
                        <button type="submit" class="btn btn-danger px-4 d-inline mx-2">
                            Tutup Pendaftaran
                        </button>
                        <font class="text-success">&emsp;<b>Pendaftaran Dibuka</b></font>
                    @endif
                    
                </form>
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
                      <th scope="col">Hp</th>
                      <th scope="col">Opsi</th>
                      <th scope="col">Persetujuan</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($calon as $tampil)
                    <tr class="py-0">
                      <td class="tulisan-kiri "> {{$tampil->nim}}</td>
                      <td class="tulisan-kiri  text-left text-capitalize"> {{$tampil->nama}}</td>
                      <td class="tulisan-kiri "> {{$tampil->hp}}</td>
                      <td class="tulisan-kanan " scope="row" >
                        
                        <button type="button" class="btn-kecil bg-secondary d-inline" title="detail" data-toggle="modal" data-target="#lihat{{ $tampil->nim }}">
                            <i class="fa fa-eye"></i>
                        </button> 
                        
                        <form action="{{ route('pendaftaran.destroy', $tampil->id) }}" method="post" class="d-inline">
                          @csrf
                          @method('DELETE')
                          <button class="btn-kecil bg-danger mx-0" onclick="return confirm('Yakin ingin dihapus?..')">
                            <i class="fa fa-trash m-0"></i>
                          </button>
                        </form>

                      </td>
                      <td>
                        <form action="{{ route('angkat.anggota',$tampil->id) }}" method="post">
                          @csrf
                          @method('put')
                          <button type="submit" class="btn-kecil bg-success py-1 btn-block" onclick="return confirm('Lanjutkan Proses?...')">
                            <i class="fa fa-pencil "></i> SETUJU 
                          </button>
                        </form>
                      </td>
                    </tr>


                    <!-- Modal -->
                    <div class="modal fade" id="lihat{{ $tampil->nim }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">NIM : {{ $tampil->nim }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">

                                  <div class="row">
                                    <div class="col-12 col-md-6">
                                      <center>
                                        <p class="mt-2"><b>Pasfoto</b></p>
                                        <img src="{{ url('images/profile', $tampil->pasfoto) }}" alt="" width="70%" style="border: 1px solid grey" class="p-1">
                                      </center>
                                    </div>
                                    <div class="col-12 col-md-6">
                                      <center>
                                        <p class="mt-2"><b>Selfie</b></p>
                                        <img src="{{ url('images/selfie', $tampil->selfie) }}" alt="" width="70%" style="border: 1px solid grey" class="p-1">
                                      </center>
                                    </div>
                                  </div>

                                  <hr>

                                  <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" class="form-control text-capitalize" disabled id="" value="{{ $tampil->nama }}">
                                  </div>

                                  <div class="form-group">
                                    <label for="">Tempat Lahir</label>
                                    <input type="text" class="form-control text-capitalize" disabled id="" value="{{ $tampil->tempatlahir }}">
                                  </div>

                                  <div class="form-group">
                                    <label for="">Tanggal Lahir</label>
                                    <input type="text" class="form-control text-capitalize" disabled id="" value="{{ date('d F Y', strtotime($tampil->tanggallahir)) }}">
                                  </div>


                                  <div class="form-group">
                                    <label for="">Jenis Kelamin</label>
                                    <input type="text" class="form-control text-capitalize" disabled id="" value="{{ $tampil->jeniskelamin }}">
                                  </div>

                                  <div class="form-group">
                                    <label for="">Program Studi</label>
                                    <input type="text" class="form-control text-capitalize" disabled id="" value="{{ $tampil->jurusan }}">
                                  </div>


                                  <div class="form-group">
                                    <label for="">Semester</label>
                                    <input type="text" class="form-control text-capitalize" disabled id="" value="{{ $tampil->semester }}">
                                  </div>

                                  <div class="form-group">
                                    <label for="">Asal Sekolah</label>
                                    <input type="text" class="form-control" disabled id="" value="{{ $tampil->asalsekolah }}">
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
                                    <label for="">No Hp</label>
                                    <input type="text" class="form-control" disabled id="" value="{{ $tampil->email }}">
                                  </div>
                                  
                                  <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Moto Hidup</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" disabled rows="3">{{ $tampil->motohidup }}</textarea>
                                  </div>

                                  <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Alasan Bergabung</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" disabled rows="3">{{ $tampil->pesan }}</textarea>
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
              {{ $calon->links('vendor.pagination.bootstrap-4') }}
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
  



    
@endsection




@section('js')



@endsection