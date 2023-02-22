@extends('layout/layoutServer')

@section('activeDokumentasi')
    activeku
@endsection

@section('title')
    Dokumentasi
@endsection

@section('judul')
    
@endsection

@section('content')

<div class="col-md-12 ">
  {{-- aksi form  --}}
  <div class="x_panel">
    <div class="x_title">
      <h2>Dokumentasi
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
        <li><a href="{{ route('doc.index') }}"><i class="fa fa-refresh fa-lg"></i> Refresh</a></li>
        
        
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="row">
          <div class="col-sm-6 tulisan-tengah">
            <a href="{{ route('doc.create') }}" class="btn btn-info btn-md">
              <i class="fa fa-edit"></i> 
              Tambah Dokumentasi
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
        <div class="row justify-content-center">

            @foreach ($dokumentasi as $tampil)
                <div class="col-12 col-md-3 col-lg-3 my-2">
                    <div class="card box-shadow" style="width: 100%">
                        <img src="{{ url('/images/dokumentasi', $tampil->gambar) }}" class="card-img-top img-dokumentasi" alt="...">
                        <div class="card-body">
                        <h5 class="card-title text-center">{{ $tampil->judul }}</h5>
                        
                        <div class="row">
                            <div class="col-6 px-1">
                                <a href="{{ route('doc.edit', $tampil->id) }}" class="btn btn-info btn-sm btn-block mx-0"><i class="fa fa-pencil"></i></a>
                                
                            </div>
                            <div class="col-6 px-1">
                                <form action="{{ route('doc.destroy', $tampil->id) }}" method="post" class="d-inline">
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
          <div class="col-sm-12 justify-content-center align-content-center">
            <div class="col-12 ">
              {{ $dokumentasi->links('vendor.pagination.bootstrap-4') }}
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
  



    
@endsection

