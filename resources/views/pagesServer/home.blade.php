
@extends('layout/layoutServer')

@section('activeHome')
    activeku
@endsection

{{-- @section('activeDataPostingan')
    activeku2
@endsection --}}

@section('title')
    Home
@endsection

@section('judul')
    
@endsection

@section('content')
<div class="top_tiles">
  <div class="animated flipInY col-lg-3 col-md-4 col-sm-6 ">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-users"></i></div>
      <div class="count info">{{ $anggota }}</div>
      <h3 class="my-2">Jumlah Anggota</h3>
    </div>
  </div>

    <div class="animated flipInY col-lg-3 col-md-4 col-sm-6 ">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-edit"></i></div>
        <div class="count info">{{ $calonanggota }}</div>
        <h3 class="my-2">Pendaftar</h3>
      </div>
    </div>
    
    
</div>

@if (Session::get('posisi')=='admin')
<!-- Modal -->
<div class="modal fade" id="tambahRapat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Rapat Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('jadwalRapat.store') }}" method="post">
        @csrf
      <div class="modal-body">
          <div class="form-group">
            <label for="jenisRapat">Jenis Rapat</label>
            <select class="form-control" id="jenisRapat" name="rapat">
              <option value="rapat umum">Rapat Umum</option>
              <option value="rapat khusus">Rapat Khusus</option>
            </select>
          </div>

          <div class="form-group">
            <label for="ket">Keterangan</label>
            <textarea class="form-control" id="ket" name="ket" placeholder="Kepada seluruh anggota bem diharapkan hadir dalam agenda rapat"></textarea>
            
          </div>

          <div class="form-group">
            <label for="tanggal">Tanggal Pelaksanaan</label>
            <input type="date" class="form-control" id="tanggal" name="tgl" >
          </div>

          <div class="form-group">
            <label for="jam">Jam</label>
            <input type="text" class="form-control text-capitalize" id="jam" name="jam" placeholder="06.00 - 24.59 / 06.00 Pagi">
          </div>

          <div class="form-group">
            <label for="tempat">Tempat</label>
            <input type="text" class="form-control text-capitalize" id="tempat" name="tempat" placeholder="Tempat Rapat">
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endif

{{-- <div class="col-md-1 col-sm-1"></div> --}}
<div class="col-md-12 col-sm-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Jadwal Rapat <small></small></h2>
      @if (Session::get('posisi')=='admin')
      <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#tambahRapat">
        <i class="fa fa-plus-circle"></i> Add
      </button>
      @endif
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <ul class="list-unstyled timeline">
        @foreach ($rapat as $tampil)
            
        
        <li>
          <div class="block">
            <div class="tags">
              <a href="" class="tag text-capitalize">
                <span>{{ date('d M', $tampil->tgl) }}</span>
              </a>
              @if (Session::get('posisi')=='admin')
              <p>
                <form action="{{ route('jadwalRapat.destroy', $tampil->id) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="bg-transparent" style="border:none" onclick="return confirm('yakin ingin dihapus?')"><i class="fa fa-close"></i></button>
                </form>
              </p>
              @endif
              
            </div>
            <div class="block_content">
              
              <h2 class="title text-capitalize">
                  <a>{{ $tampil->rapat }} : {{ $tampil->ket }}</a>
              </h2>
              <div class="byline text-success">
                <span>Jam : {{ $tampil->jam }}</a>
              </div>

              @php
                  $hari = date ("D",$tampil->tgl);
 
                  switch($hari){
                    case 'Sun':
                      $hari_ini = "Minggu";
                    break;

                    case 'Mon':			
                      $hari_ini = "Senin";
                    break;

                    case 'Tue':
                      $hari_ini = "Selasa";
                    break;

                    case 'Wed':
                      $hari_ini = "Rabu";
                    break;

                    case 'Thu':
                      $hari_ini = "Kamis";
                    break;

                    case 'Fri':
                      $hari_ini = "Jumat";
                    break;

                    case 'Sat':
                      $hari_ini = "Sabtu";
                    break;
                    
                    default:
                      $hari_ini = "Tidak di ketahui";		
                    break;
                  }
              @endphp

              <p class="excerpt">
                <a href="whatsapp://send?text=*{{ ucfirst($tampil->rapat) }}*, %0A{{ ucfirst($tampil->ket) }} yang akan dilaksanakan pada : %0A%0AHari/TGL : {{ $hari_ini }}, {{ date('d F Y', $tampil->tgl) }} %0AJam         : {{ $tampil->jam }}%0ATempat    : {{ $tampil->tempat }}" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-whatsapp"></i> Bagikan..</a>
              </p>
            </div>
          </div>
        </li>

        @endforeach
        
      </ul>

    </div>
  </div>
</div>
{{-- <div class="col-md-1 col-sm-1"></div> --}}
</div>
    
@endsection




@section('js')

@endsection