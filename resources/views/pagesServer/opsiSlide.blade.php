@extends('layout/layoutServer')

@section('activeOpsiHalaman')
    activeku
@endsection

@section('activeOpsiSlide')
    activeku2
@endsection

@section('title')
    Gambar Slide
@endsection

@section('judul')
    
@endsection

@section('content')

<div class="col-md-12 ">
  {{-- aksi form  --}}
  <div class="x_panel">
    <div class="x_title">
      <h2>Gambar Slide
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
        <li><a href="{{ route('opsiSlide.index') }}"><i class="fa fa-refresh fa-lg"></i> Refresh</a></li>
        
        
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="row">
          <div class="col-sm-6 tulisan-tengah">
            <a href="{{ route('opsiSlide.create') }}" class="btn btn-info btn-md">
              <i class="fa fa-edit"></i> 
              Tambah Gambar Slide
            </a>
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

            @foreach ($slide as $tampil)
                <div class="col-12 col-md-4 col-lg-4 my-2">
                    <div class="card box-shadow" style="width: 100%">
                        <img src="{{ url('/images/slide', $tampil->gambar) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">{{ $tampil->judul }}</h5>
                        <p class="card-text">{{ $tampil->pesan }}</p>
                        
                        <div class="row">
                            <div class="col-6 px-1">
                                <a href="{{ route('opsiSlide.edit', $tampil->id) }}" class="btn btn-info btn-sm btn-block mx-0"><i class="fa fa-pencil"></i></a>
                                
                            </div>
                            <div class="col-6 px-1">
                                <form action="{{ route('opsiSlide.destroy', $tampil->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                    <button type="submit" onclick="return confirm('yakin ingin dihapus?')" class="btn btn-danger btn-sm btn-block"><i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                            
                        </div>
                        
                    </div>
                    </div>
                </div>
            @endforeach

            
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="col-12 ">
              {{ $slide->links('vendor.pagination.bootstrap-4') }}
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
  



    
@endsection

