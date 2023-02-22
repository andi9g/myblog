@extends('layout/layoutServer')

@section('activeOpsiHalaman')
    activeku
@endsection

@section('activeOpsiSlide')
    activeku2
@endsection

@section('title')
    Tambah Slide
@endsection

@section('judul')
    
@endsection

@section('content')

<div class="col-md-12 ">
  {{-- aksi form  --}}
  <form class="form-horizontal form-label-left" action="{{ route('opsiSlide.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="x_panel">
      <div class="x_title">
        <h2>Tambah Gambar Slide <small> <i class="">new</i> </small></h2>
        <ul class="nav navbar-right panel_toolbox text-right">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
         
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-2 fontku">Gambar utama</label>
            <div class="col-md-10 col-sm-10 ">
              <input type="file" class="form-control py-1" name="gambar_utama" value="{{old('gambar_utama')}}">
            </div>
          </div>  

          <div class="form-group row ">
            <label class="control-label col-md-2 col-sm-2 fontku">Judul *</label>
            <div class="col-md-10 col-sm-10 ">
              <input type="text" class="form-control @error('judul')
                  is-invalid
              @enderror" name="judul" placeholder="Masukan judul" value="{{old('judul')}}">
              @error('judul')
              <ul class="parsley-errors-list filled" id="parsley-id-5">
                <li class="parsley-required">
                  {{$message}}
                </li>
              </ul>
              @enderror

            </div>
          </div>

          
          
          
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-2 fontku">Pesan</label>
            <div class="col-md-10 col-sm-10 ">
              <textarea name="pesan" id="" cols="20" rows="5" class="form-control @error('pesan')
                  is-invalid
              @enderror" placeholder="pesan"></textarea>
              @error('pesan')
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
          <i class="fa fa-save"></i> Posting
      </button>
    </div>

  </form>
</div>
  



    
@endsection



