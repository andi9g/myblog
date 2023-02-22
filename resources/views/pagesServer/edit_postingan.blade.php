@extends('layout/layoutServer')

@section('activePostingan')
    activeku
@endsection


@section('title')
    Edit Postingan
@endsection


@section('content')

<div class="col-md-12 ">
  {{-- aksi form  --}}
  <form class="form-horizontal form-label-left" action="{{ route('data_postingan.update',$postingan->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="x_panel">
      <div class="x_title">
          
        <h2><a href="{{ route('data_postingan.index') }}" class="btn btn-danger btn-sm"><< Back</a> Edit Artike <small> <i class="">{{$postingan->id}}</i> </small></h2>
        <ul class="nav navbar-right panel_toolbox text-right">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
         
          
          <div class="form-group row ">
            <label class="control-label col-md-2 col-sm-2 fontku">Judul *</label>
            <div class="col-md-10 col-sm-10 ">
              <input type="text" class="form-control @error('judul')
                  is-invalid
              @enderror" name="judul" placeholder="Masukan judul" value="{{$postingan->judul}}">
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
            <label class="control-label col-md-2 col-sm-2 fontku">Gambar utama</label>
            <div class="col-md-10 col-sm-10 ">
              <input type="file" class="form-control py-1" name="gambar_utama" value="{{$postingan->gambar_utama}}">
            </div>
          </div>
          
          
          <div class="form-group row">
            <label class="control-label col-md-2 col-sm-2 fontku">Tags</label>
            <div class="col-md-10 col-sm-10 ">
              <input id="tags_1" type="text" name="tag_postingan" class="tags form-control my-0 py-0" placeholder="Masukan tags" value="{{$postingan->tag}}">
              <div style="position: relative; float: left; width: 250px; margin: 10px;"></div>
            </div>
          </div>

          

      </div>
    </div>
    
    <div class="x_panel">
      <textarea class="form-control" name="konten" rows="20" cols="100">
        {{htmlspecialchars_decode($postingan->konten)}}
      </textarea>
    </div>



    <div class="x_panel shadow-sm">
      <button type="submit" class="btn btn-primary px-5 float-right">
          <i class="fa fa-save"></i> Edit Postingan
      </button>
    </div>

  </form>
</div>
  



    
@endsection




@section('js')

<!-- jQuery Tags Input -->
<script src="{{ url('admin/jquery.tagsinput/src/jquery.tagsinput.js', []) }}"></script>
<script src="{{ url('js/ckeditor/ckeditor.js', []) }}"></script>
<script>

     CKEDITOR.replace('konten',{
      filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
      filebrowserUploadMethod: 'form',
      
     language:'en-gb'
   });
   
   CKEDITOR.config.allowedContent = true;
   

</script>

@endsection