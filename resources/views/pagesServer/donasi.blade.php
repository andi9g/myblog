@extends('layout/layoutServer')

@section('activeDonasi')
    activeku
@endsection


@section('title')
    Donasi
@endsection

@section('judul')
    
@endsection

@section('content')

<div class="col-md-12">
  {{-- aksi form  --}}
  <div class="x_panel">
    <div class="x_title">
      <h2>Penggalangan Dana 
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
        <li><a href="{{ route('opsiLinimasa.index') }}"><i class="fa fa-refresh fa-lg"></i> Refresh</a></li>
        
        
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="row">
          <div class="col-sm-6 tulisan-tengah">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahDonasi">
                <i class="fa fa-plus-circle"></i> Tambah Penggalangan
            </button>

            <!-- tambah donasi -->
            <div class="modal fade" id="tambahDonasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Penggalangan Dana</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('donasi.store') }}" method="post">
                    @csrf
                
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                          <input type="text" name="judul" class="form-control" id="judul" placeholder="Judul Penggalangan">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tgl_mulai" class="col-sm-2 col-form-label">tgl mulai</label>
                        <div class="col-sm-10">
                          <input type="date" name="tgl_mulai" class="form-control" id="tgl_mulai">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tgl_selesai" class="col-sm-2 col-form-label">tgl selesai</label>
                        <div class="col-sm-10">
                          <input type="date" name="tgl_selesai" class="form-control" id="tgl_selesai">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="total" class="col-sm-2 col-form-label">Total</label>
                        <div class="col-sm-10">
                          <input type="number" name="total" class="form-control" id="total" placeholder="Total uang yang telah terkumpul">
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="Submit" class="btn btn-primary">Tambah</button>
                </div>
                </form>
                </div>
            </div>
            </div>


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
                <table  class="table table-sm table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr >
                      <th scope="col">Judul</th>
                      <th scope="col">Tgl</th>
                      <th scope="col">Total</th>
                      <th scope="col">Opsi</th>
                      <th scope="col">Update</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($donasi as $tampil)
                      <tr>
                          <td>{{ ucfirst($tampil->judul) }}</td>
                          <td>
                            {{ date('d F',strtotime($tampil->tgl_mulai)) }} s/d 
                            {{ date('d F',strtotime($tampil->tgl_selesai)) }}
                            {{ date(' Y',strtotime($tampil->tgl_selesai)) }}
                          </td>
                          <td>Rp{{ number_format($tampil->total,0,',','.') }}</td>
                          <td nowrap>
                            @if ($tampil->ket=='selesai')
                                <font>-</font>
                            @elseif($tampil->ket == 'none')
                              <form action="{{ route('donasi.destroy', $tampil->id ) }}" method="post" class="d-inline">
                                  @csrf
                                  @method('DELETE')
                                  <button class="btn btn-danger btn-sm py-0" onclick="return confirm('yakin ingin dihapus')"><i class="fa fa-trash"></i></button>
                              </form>
  
                              <form action="{{ route('selesai.donasi', $tampil->id) }}" method="post" class="d-inline">
                                  @csrf
                                  @method('PUT')
                                  <button class="btn btn-success btn-sm py-0" onclick="return confirm('Donasi Selesai')"><i class="fa fa-check"></i> Donasi Selesai</button>
                              </form>
                              @endif
                          </td>
                          <td>
                            @if ($tampil->ket=='selesai')
                              <font class="text-success">Donasi Selesai</font>
                            @elseif($tampil->ket == 'none')
                              <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#updateDonasi{{ $tampil->id }}"><i class="fa fa-edit"></i> Update Total</button>
                            @endif
                          </td>
                      </tr>

                      @if($tampil->ket == 'none')
                      <div class="modal fade" id="updateDonasi{{ $tampil->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update Anggaran</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('update.donasi', $tampil->id) }}" method="post">
                                @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="total" class="col-sm-3 col-form-label">Total Sebelumnya</label>
                                    <div class="col-sm-9">
                                      <input type="number" id="jumlah1{{ $tampil->id }}" class="form-control" readonly value="{{ $tampil->total }}">
                                    </div>
                                </div>
                                
                                <div class="form-group row text-center">
                                    <label class="col-sm-12 col-form-label"><h5>+</h5></label>
                                </div>
            
                                <div class="form-group row">
                                    <label for="total"  class="col-sm-3 col-form-label">Jumlah Kenaikan</label>
                                    <div class="col-sm-9">
                                      <input type="number" onkeyup="sum{{ $tampil->id }}()" id="jumlah2{{ $tampil->id }}" class="form-control" >
                                    </div>
                                </div>

                                <div class="form-group row text-center">
                                    <label class="col-sm-12 col-form-label"><h5>=</h5></label>
                                </div>
            
                                <div class="form-group row">
                                    <label for="total" class="col-sm-3 col-form-label">Total Keseluruhan</label>
                                    <div class="col-sm-9">
                                      <input type="number" name="total" id="total{{ $tampil->id }}" class="form-control" style="background-color: rgb(164, 255, 164)" value="{{ $tampil->total }}">
                                    </div>
                                </div>
            
            
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="Submit" class="btn btn-primary">Update</button>
                            </div>
                            </form>
                            </div>
                        </div>
                        </div>

                        <script>
                            function sum{{ $tampil->id }}() {
                                var txtFirstNumberValue = document.getElementById('jumlah1{{ $tampil->id }}').value;
                                var txtSecondNumberValue = document.getElementById('jumlah2{{ $tampil->id }}').value;
                                var result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue);
                                if (!isNaN(result)) {
                                    document.getElementById('total{{ $tampil->id }}').value = result;
                                }else {
                                    document.getElementById('total{{ $tampil->id }}').value = txtFirstNumberValue;
                                }
                            }
                        </script>
                        @endif
                      
                          
                      @endforeach
                    
                  </tbody>
                </table>
                
              </div>
              
            </div>
           

        </div>
        <div class="row mt-3">
          <div class="col-sm-12">
            <div class="col-12 ">
              {{ $donasi->links('vendor.pagination.bootstrap-4') }}
            </div>
          </div>
        </div>
    </div>
  </div>
</div>





<div class="col-md-2"></div>

<div class="col-md-8 mt-2">
  {{-- aksi form  --}}
  <div class="x_panel" >
    <div class="x_title" >
      <h2>Tampilkan Pada halaman web
      </h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        <li><a href="{{ route('opsiLinimasa.index') }}"><i class="fa fa-refresh fa-lg"></i> Refresh</a></li>
        
        
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="row">
          <div class="col-sm-6 tulisan-tengah">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tampilDonasi">
                <i class="fa fa-plus-circle"></i> Tambah Saluran
            </button>

            <!-- tambah donasi -->
            <div class="modal fade" id="tampilDonasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Saluran Bank</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('bank.tambah') }}" method="post">
                    @csrf
                
                <div class="modal-body">
                  <div class="form-group row">
                      <label for="judul" class="col-sm-3 col-form-label">Nama Bank</label>
                      <div class="col-sm-9">
                        <select name="bank" id="" class="form-control">
                          <option value="BRI">BRI</option>
                          <option value="BNI">BNI</option>
                          <option value="BCA">BCA</option>
                        </select>
                      </div>
                  </div>


                    <div class="form-group row">
                        <label for="judul" class="col-sm-3 col-form-label">Judul Donasi</label>
                        <div class="col-sm-9">
                          <select name="id_donasi" id="" class="form-control">
                            <option value="">None</option>
                            @foreach ($listdonasi as $items)
                            <option value="{{ $items->id }}">{{ ucfirst($items->judul) }}</option>
                                
                            @endforeach
                          </select>
                        </div>
                    </div>

                    <div class="form-group row">
                      <label for="judul" class="col-sm-3 col-form-label">No Rekening</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="rekening" placeholder="xxxx-xxx-xxx">
                      </div>
                   </div>

                    <div class="form-group row">
                      <label for="judul" class="col-sm-3 col-form-label">Atas Nama</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="nama" placeholder="nama pemilik rekening">
                      </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="Submit" class="btn btn-primary">Tambah</button>
                </div>
                </form>
                </div>
            </div>
            </div>


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
                <table  class="table table-sm table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr >
                      <th scope="col">Judul</th>
                      <th scope="col">No Rekening</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Opsi</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($bank as $tampilBank)
                      <tr>
                          <td>{{ ucfirst($tampilBank->judul) }}</td>
                          <td>
                            {{ $tampilBank->rekening }} 
                          </td>
                          <td>{{ ucfirst($tampilBank->nama) }}</td>
                          <td>
                              <form action="{{ route('donasi.hapusBank', $tampilBank->id ) }}" method="post" class="d-inline">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger btn-sm py-0" onclick="return confirm('yakin ingin menghapus?')"><i class="fa fa-trash"></i></button>
                              </form>
  
                              
                          </td>
                          
                      </tr>

                      @endforeach
                    
                  </tbody>
                </table>
                
              </div>
              
            </div>
           

        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="col-12 ">
              {{-- {{ $linimasa->links('vendor.pagination.bootstrap-4') }} --}}
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
  



    
@endsection




@section('js')



@endsection