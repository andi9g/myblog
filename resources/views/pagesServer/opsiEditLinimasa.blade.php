@extends('layout/layoutServer')

@section('activeOpsiHalaman')
    activeku
@endsection

@section('activeOpsiLinimasa')
    activeku2
@endsection

@section('title')
    Tambah Linimasa
@endsection

@section('judul')
    
@endsection

@section('content')

<div class="col-md-12 ">
  {{-- aksi form  --}}
  <form class="form-horizontal form-label-left" action="{{ route('opsiLinimasa.update', $linimasa->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="x_panel">
      <div class="x_title">
        <h2>Tambah Linimasa <small> <i class="">new</i> </small></h2>
        <ul class="nav navbar-right panel_toolbox text-right">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
          <div class="form-group row ">
            <label class="control-label col-md-2 col-sm-2 fontku text-primary">Nama Kegiatan *</label>
            <div class="col-md-10 col-sm-10 ">
              <input type="text" class="form-control @error('judul')
                  is-invalid
              @enderror" name="judul" placeholder="Masukan judul" value="{{ $linimasa->judul }}">
              @error('judul')
              <ul class="parsley-errors-list filled" id="parsley-id-5">
                <li class="parsley-required">
                  {{$message}}
                </li>
              </ul>
              @enderror

            </div>
          </div>

          
          <div class="form-group row ">
            <label class="control-label col-md-2 col-sm-2 fontku text-primary">TGL Mulai *</label>
            <div class="col-md-10 col-sm-10 ">
              <input type="date" class="form-control @error('tgl_mulai')
                  is-invalid
              @enderror" name="tgl_mulai" value="{{ $linimasa->tgl_mulai }}">
              @error('tgl_mulai')
              <ul class="parsley-errors-list filled" id="parsley-id-5">
                <li class="parsley-required">
                  {{$message}}
                </li>
              </ul>
              @enderror

            </div>
          </div>

          <div class="form-group row my-4">
            <label class="control-label col-md-2 col-sm-2 fontku"><b><i>-- OPSIONAL --</i></b></label>
          </div>

          
          <div class="form-group row ">
            <label class="control-label col-md-2 col-sm-2 fontku">TGL Selesai </label>
            <div class="col-md-10 col-sm-10 ">
              <input type="date" class="form-control" name="tgl_akhir" value="{{ $linimasa->tgl_akhir}}">
            </div>
          </div>


          <div class="form-group row ">
            <label class="control-label col-md-2 col-sm-2 fontku">Pengurus </label>
                <div class="col-md-10 col-sm-10 ">
                    <select class="form-control select2 text-capitalize" name="id_anggota" style="width: 100%;">
                        <option value="">-- none --</option>
                        @foreach ($anggota as $tampil)
                        <option value="{{ $tampil->id }}" @if ($tampil->id==$linimasa->id_anggota)
                            selected
                        @endif style="text-transform: capitalize">
                            {{ $tampil->nim }} - {{ strtoupper($tampil->nama) }}
                        </option>
                        @endforeach
                    </select>
                </div>

          </div>

      </div>
    </div>

    <div class="x_panel shadow-sm">
      <a href="{{ url('/opsiLinimasa', []) }}" class="btn btn-secondary px-3 float-left">
            << Back
      </a>

      <button type="submit" class="btn btn-primary px-5 float-right">
          <i class="fa fa-save"></i> Edit
      </button>
    </div>

  </form>
</div>
  



    
@endsection




