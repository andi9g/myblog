@extends('layout/layoutServer')

@section('activeOpsiHalaman')
    activeku
@endsection

@section('activeOpsiJabatan')
    activeku2
@endsection

@section('title')
    Kelola Jabatan
@endsection

@section('judul')
    
@endsection

@section('content')

<div class="col-md-12 ">
  {{-- aksi form  --}}
  <div class="x_panel">
    <div class="x_title">
      <h2>Kelola Jabatan
        
      </h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        <li><a href="{{ route('opsiJabatan.index') }}"><i class="fa fa-refresh fa-lg"></i> Refresh</a></li>
        
        
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
        
        <div class="row">

            {{-- ketua --}}
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="card-box table-responsive tabelku2">
                    <table  class="table tableku table-sm table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr >
                          <th scope="col">KETUA</th>
                          <th scope="col">Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($ketua as $ketua)
                          <tr>
                            <td class="tulisan-kiri text-capitalize text-bold"><b>{{ $ketua->nama }}</b></td>
                            <td class="text-center" scope="row" >
                             
                              <form action="{{ route('deleteJabatan.delete', $ketua->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn-kecil bg-danger mx-0" onclick="return confirm('Yakin ingin menghapus jabatan?..')">
                                  <i class="fa fa-trash m-0"></i>
                                </button>
                              </form>
      
                            </td>
                          </tr>
                          @endforeach

                        <tr>
                            <td colspan="2" class="bg-light">
                                <form action="{{ url('/ketua', []) }}" method="post">
                                    @csrf
                                    <select class="form-control select2" name="ketua" style="width: 100%;">
                                        <option value="">-- none --</option>
                                        @foreach ($select as $tampil)
                                        <option value="{{ $tampil->id }}" style="text-transform: capitalize">
                                            {{ $tampil->nim }} - {{ strtoupper($tampil->nama) }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append float-left">
                                        @error('ketua')
                                            <font color="red">Pilih anggota..</font>
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


            {{-- wakil --}}
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="card-box table-responsive tabelku2">
                    <table  class="table tableku table-sm table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr >
                          <th scope="col" class="text-uppercase">wakil ketua</th>
                          <th scope="col">Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($wakil as $wakil)
                          <tr>
                            <td class="tulisan-kiri text-capitalize text-bold"><b>{{ $wakil->nama }}</b></td>
                            <td class="text-center" scope="row" >
                             
                              <form action="{{ route('deleteJabatan.delete', $wakil->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn-kecil bg-danger mx-0" onclick="return confirm('Yakin ingin menghapus jabatan?..')">
                                  <i class="fa fa-trash m-0"></i>
                                </button>
                              </form>
      
                            </td>
                          </tr>
                          @endforeach

                        <tr>
                            <td colspan="2" class="bg-light">
                                <form action="{{ url('/wakil', []) }}" method="post">
                                    @csrf
                                    <select class="form-control select2" name="wakil" style="width: 100%;">
                                        <option value="">-- none --</option>
                                        @foreach ($select as $tampil)
                                        <option value="{{ $tampil->id }}" style="text-transform: capitalize">
                                            {{ $tampil->nim }} - {{ strtoupper($tampil->nama) }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append float-left">
                                        @error('wakil')
                                            <font color="red">Pilih anggota..</font>
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



            {{-- sekertaris --}}
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="card-box table-responsive tabelku2">
                    <table  class="table tableku table-sm table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr >
                          <th scope="col" class="text-uppercase">sekertaris</th>
                          <th scope="col">Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($sekertaris as $sekertaris)
                          <tr>
                            <td class="tulisan-kiri text-capitalize text-bold"><b>{{ $sekertaris->nama }}</b></td>
                            <td class="text-center" scope="row" >
                             
                              <form action="{{ route('deleteJabatan.delete', $sekertaris->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn-kecil bg-danger mx-0" onclick="return confirm('Yakin ingin menghapus jabatan?..')">
                                  <i class="fa fa-trash m-0"></i>
                                </button>
                              </form>
      
                            </td>
                          </tr>
                          @endforeach

                        <tr>
                            <td colspan="2" class="bg-light">
                                <form action="{{ url('/sekertaris', []) }}" method="post">
                                    @csrf
                                    <select class="form-control select2" name="sekertaris" style="width: 100%;">
                                        <option value="">-- none --</option>
                                        @foreach ($select as $tampil)
                                        <option value="{{ $tampil->id }}" style="text-transform: capitalize">
                                            {{ $tampil->nim }} - {{ strtoupper($tampil->nama) }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append float-left">
                                        @error('sekertaris')
                                            <font color="red">Pilih anggota..</font>
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


            {{-- bendahara --}}
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="card-box table-responsive tabelku2">
                    <table  class="table tableku table-sm table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr >
                          <th scope="col" class="text-uppercase">bendahara</th>
                          <th scope="col">Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($bendahara as $bendahara)
                          <tr>
                            <td class="tulisan-kiri text-capitalize text-bold"><b>{{ $bendahara->nama }}</b></td>
                            <td class="text-center" scope="row" >
                             
                              <form action="{{ route('deleteJabatan.delete', $bendahara->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn-kecil bg-danger mx-0" onclick="return confirm('Yakin ingin menghapus jabatan?..')">
                                  <i class="fa fa-trash m-0"></i>
                                </button>
                              </form>
      
                            </td>
                          </tr>
                          @endforeach

                        <tr>
                            <td colspan="2" class="bg-light">
                                <form action="{{ url('/bendahara', []) }}" method="post">
                                    @csrf
                                    <select class="form-control select2" name="bendahara" style="width: 100%;">
                                        <option value="">-- none --</option>
                                        @foreach ($select as $tampil)
                                        <option value="{{ $tampil->id }}" style="text-transform: capitalize">
                                            {{ $tampil->nim }} - {{ strtoupper($tampil->nama) }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append float-left">
                                        @error('bendahara')
                                            <font color="red">Pilih anggota..</font>
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



            {{-- mentriDalamNegri --}}
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="card-box table-responsive tabelku2">
                    <table  class="table tableku table-sm table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr >
                          <th scope="col" class="text-uppercase">Mentri dalam negri</th>
                          <th scope="col">Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($mentriDalamNegri as $mentriDalamNegri)
                          <tr>
                            <td class="tulisan-kiri text-capitalize text-bold"><b>{{ $mentriDalamNegri->nama }}</b></td>
                            <td class="text-center" scope="row" >
                             
                              <form action="{{ route('deleteJabatan.delete', $mentriDalamNegri->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn-kecil bg-danger mx-0" onclick="return confirm('Yakin ingin menghapus jabatan?..')">
                                  <i class="fa fa-trash m-0"></i>
                                </button>
                              </form>
      
                            </td>
                          </tr>
                          @endforeach

                        <tr>
                            <td colspan="2" class="bg-light">
                                <form action="{{ url('/mentriDalamNegri', []) }}" method="post">
                                    @csrf
                                    <select class="form-control select2" name="mentriDalamNegri" style="width: 100%;">
                                        <option value="">-- none --</option>
                                        @foreach ($select as $tampil)
                                        <option value="{{ $tampil->id }}" style="text-transform: capitalize">
                                            {{ $tampil->nim }} - {{ strtoupper($tampil->nama) }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append float-left">
                                        @error('mentriDalamNegri')
                                            <font color="red">Pilih anggota..</font>
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



            {{-- mentriLuarNegri --}}
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="card-box table-responsive tabelku2">
                    <table  class="table tableku table-sm table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr >
                          <th scope="col" class="text-uppercase">Mentri luar negri</th>
                          <th scope="col">Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($mentriLuarNegri as $mentriLuarNegri)
                          <tr>
                            <td class="tulisan-kiri text-capitalize text-bold"><b>{{ $mentriLuarNegri->nama }}</b></td>
                            <td class="text-center" scope="row" >
                             
                              <form action="{{ route('deleteJabatan.delete', $mentriLuarNegri->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn-kecil bg-danger mx-0" onclick="return confirm('Yakin ingin menghapus jabatan?..')">
                                  <i class="fa fa-trash m-0"></i>
                                </button>
                              </form>
      
                            </td>
                          </tr>
                          @endforeach

                        <tr>
                            <td colspan="2" class="bg-light">
                                <form action="{{ url('/mentriLuarNegri', []) }}" method="post">
                                    @csrf
                                    <select class="form-control select2" name="mentriLuarNegri" style="width: 100%;">
                                        <option value="">-- none --</option>
                                        @foreach ($select as $tampil)
                                        <option value="{{ $tampil->id }}" style="text-transform: capitalize">
                                            {{ $tampil->nim }} - {{ strtoupper($tampil->nama) }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append float-left">
                                        @error('mentriLuarNegri')
                                            <font color="red">Pilih anggota..</font>
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




            {{-- mentriKomunikasiDanInformasi --}}
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="card-box table-responsive tabelku2">
                    <table  class="table tableku table-sm table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr >
                          <th scope="col" class="text-uppercase">Mentri Komunikasi dan Informasi</th>
                          <th scope="col" valign="center">Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($mentriKomunikasiDanInformasi as $mentriKomunikasiDanInformasi)
                          <tr>
                            <td class="tulisan-kiri text-capitalize text-bold"><b>{{ $mentriKomunikasiDanInformasi->nama }}</b></td>
                            <td class="text-center" scope="row" >
                             
                              <form action="{{ route('deleteJabatan.delete', $mentriKomunikasiDanInformasi->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn-kecil bg-danger mx-0" onclick="return confirm('Yakin ingin menghapus jabatan?..')">
                                  <i class="fa fa-trash m-0"></i>
                                </button>
                              </form>
      
                            </td>
                          </tr>
                          @endforeach

                        <tr>
                            <td colspan="2" class="bg-light">
                                <form action="{{ url('/mentriKomunikasiDanInformasi', []) }}" method="post">
                                    @csrf
                                    <select class="form-control select2" name="mentriKomunikasiDanInformasi" style="width: 100%;">
                                        <option value="">-- none --</option>
                                        @foreach ($select as $tampil)
                                        <option value="{{ $tampil->id }}" style="text-transform: capitalize">
                                            {{ $tampil->nim }} - {{ strtoupper($tampil->nama) }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append float-left">
                                        @error('mentriKomunikasiDanInformasi')
                                            <font color="red">Pilih anggota..</font>
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





            {{-- mentriPenelitianDanPengembangan --}}
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="card-box table-responsive tabelku2">
                    <table  class="table tableku table-sm table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr >
                          <th scope="col" class="text-uppercase">Mentri Penelitian dan pengembangan</th>
                          <th scope="col" valign="center">Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($mentriPenelitianDanPengembangan as $mentriPenelitianDanPengembangan)
                          <tr>
                            <td class="tulisan-kiri text-capitalize text-bold"><b>{{ $mentriPenelitianDanPengembangan->nama }}</b></td>
                            <td class="text-center" scope="row" >
                             
                              <form action="{{ route('deleteJabatan.delete', $mentriPenelitianDanPengembangan->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn-kecil bg-danger mx-0" onclick="return confirm('Yakin ingin menghapus jabatan?..')">
                                  <i class="fa fa-trash m-0"></i>
                                </button>
                              </form>
      
                            </td>
                          </tr>
                          @endforeach

                        <tr>
                            <td colspan="2" class="bg-light">
                                <form action="{{ url('/mentriPenelitianDanPengembangan', []) }}" method="post">
                                    @csrf
                                    <select class="form-control select2" name="mentriPenelitianDanPengembangan" style="width: 100%;">
                                        <option value="">-- none --</option>
                                        @foreach ($select as $tampil)
                                        <option value="{{ $tampil->id }}" style="text-transform: capitalize">
                                            {{ $tampil->nim }} - {{ strtoupper($tampil->nama) }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append float-left">
                                        @error('mentriPenelitianDanPengembangan')
                                            <font color="red">Pilih anggota..</font>
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
        <div class="row">
          <div class="col-sm-12">
            <div class="col-12 ">
              {{-- {{ $postingan->links('vendor.pagination.bootstrap-4') }} --}}
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
  



    
@endsection




@section('js')



@endsection