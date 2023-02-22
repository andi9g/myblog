@extends('layout/layoutServer')

@section('activeOpsiHalaman')
    activeku
@endsection

@section('activeOpsiVisiDanMisi')
    activeku2
@endsection

@section('title')
    Visi dan Misi
@endsection

@section('judul')
    
@endsection

@section('content')

<div class="col-md-12 ">
  {{-- aksi form  --}}
  
  <div class="row">
      <div class="col-12 col-md-4 col-lg-4">
          <div class="x_panel">
            <div class="x_title">
              <h2>Gambar Hiasan <small> <i class=""></i> </small></h2>
              <ul class="nav navbar-right panel_toolbox text-right">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="form-group row">
                    @if ($ketemu==0)
                        <img src="{{ url('/images/aksimuda.png',) }}" style="width: 100%" alt="">
                    @else
                        <img src="{{ url('/images/visidanmisi',$tampil->gambar) }}" width="100%" alt="">
                    @endif
                </div>
            </div>
          </div>
      </div>
      <div class="col-12 col-md-8 col-lg-8">
          @if ($ketemu == 0)
            <form class="form-horizontal form-label-left" action="{{ route('opsiVisiDanMisi.store') }}" method="post" enctype="multipart/form-data">
                @csrf
          @else
                <form class="form-horizontal form-label-left" action="{{ route('opsiVisiDanMisi.update', $tampil->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
          @endif
              <div class="x_panel">
                  <h3>Visi</h3> @error('visi')
                      <font color="red">{{ $message }}</font>
                  @enderror
                  <textarea class="form-control" name="visi" rows="20" cols="100">
                    {{
                        empty($tampil->visi)?'':htmlspecialchars_decode($tampil->visi)
                    }}
                  </textarea>
        
                  <h3>Misi</h3> @error('misi')
                    <font color="red">{{ $message }}</font>
                @enderror
                  <textarea class="form-control" name="misi" rows="20" cols="100">
                      {{
                        empty($tampil->misi)?'':htmlspecialchars_decode($tampil->misi)
                      }}
                  </textarea>
                  
                  <br>
                  <br>
                  @error('misi')
                    <font color="red">{{ $message }}</font>
                  @enderror
                  <label class="control-label col-md-3 col-sm-3 fontku">Upload Gambar</label>
                  
                  <div class="col-md-9 col-sm-9 ">
                      <input type="file" class="form-control " name="gambar" value="{{old('gambar')}}">
                  </div>
                  
                  <br>
                  <br>
        
              </div>
        
              <div class="x_panel shadow-sm">
              <button type="submit" class="btn btn-primary px-5 float-right">
                  <i class="fa fa-save"></i> Posting
              </button>
              </div>
        
        </form>

      </div>
  </div>
    
</div>
  



    
@endsection




@section('js')

<!-- jQuery Tags Input -->
<script src="{{ url('admin/jquery.tagsinput/src/jquery.tagsinput.js', []) }}"></script>
<script src="{{ url('js/ckeditor/ckeditor.js', []) }}"></script>
<script>

     CKEDITOR.replace('visi',{
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form',
        
        language:'en-gb'
     });

     CKEDITOR.replace('misi',{
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form',
        
        language:'en-gb'
     });
   
   CKEDITOR.config.allowedContent = true;
   

</script>

@endsection