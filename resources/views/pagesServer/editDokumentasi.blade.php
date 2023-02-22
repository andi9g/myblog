@extends('layout/layoutServer')

@section('activeDokumentasi')
    activeku
@endsection

@section('title')
    Tambah Dokumentasi
@endsection

@section('judul')
    
@endsection

@section('content')

<div class="col-md-12 ">
  {{-- aksi form  --}}
  <form class="form-horizontal form-label-left" action="{{ route('doc.update', $tampil->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="x_panel">
      <div class="x_title">
        <h2>Edit Dokumentasi <small> <i class="">new</i> </small></h2>
        <ul class="nav navbar-right panel_toolbox text-right">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
         
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-2 fontku">Gambar *</label>
            <div class="col-md-10 col-sm-10 ">
              <input type="file" class="form-control py-1" name="gambar" value="{{ $tampil->gamabar }}">
            </div>
          </div>  

          <div class="form-group row ">
            <label class="control-label col-md-2 col-sm-2 fontku">Judul *</label>
            <div class="col-md-10 col-sm-10 ">
              <input type="text" class="form-control @error('judul')
                  is-invalid
              @enderror" name="judul" placeholder="Masukan judul" value="{{ $tampil->judul}}">
              @error('judul')
              <ul class="parsley-errors-list filled" id="parsley-id-5">
                <li class="parsley-required">
                  {{$message}}
                </li>
              </ul>
              @enderror

            </div>
          </div>
          

      </div>
    </div>



    <div class="x_panel shadow-sm">
      <a href="{{ url('/opsiSlide', []) }}" class="btn btn-secondary px-3 float-left">
            << Back
      </a>

      <button type="submit" class="btn btn-primary px-5 float-right">
          <i class="fa fa-save"></i> Edit Dokumentasi
      </button>
    </div>

  </form>
</div>
  



    
@endsection




