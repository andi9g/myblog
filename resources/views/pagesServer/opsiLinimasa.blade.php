@extends('layout/layoutServer')

@section('activeOpsiHalaman')
    activeku
@endsection

@section('activeOpsiLinimasa')
    activeku2
@endsection

@section('title')
    Linimasa
@endsection

@section('judul')
    
@endsection

@section('content')

<div class="col-md-12 ">
  {{-- aksi form  --}}
  <div class="x_panel">
    <div class="x_title">
      <h2>Linimasa 
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
            <a href="{{ route('opsiLinimasa.create') }}" class="btn btn-info btn-md">
              <i class="fa fa-edit"></i> 
              Tambah Linimasa
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
            <div class="col-sm-12">

              <div class="card-box modelku">
                <table  class="table table-sm table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr >
                      <th scope="col">Tgl</th>
                      <th scope="col">Agenda</th>
                      <th scope="col">Pengurus</th>
                      <th scope="col">Opsi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($linimasa as $tampil)
                    <tr>
                      
                      <td class="tulisan-kiri text-left"> 
                          {{

                            date('d', strtotime($tampil->tgl_mulai))

                          }}
                          @if (!empty($tampil->tgl_akhir))
                              - {{ date('d',strtotime($tampil->tgl_akhir)) }}
                          @endif
                          {{ date(' F Y', strtotime($tampil->tgl_mulai)) }}
                      </td>
                      <td class="tulisan-kiri text-left"> {{$tampil->judul}}</td>
                      <td data-label="pengurus : &nbsp;" class="tulisan-kiri text-capitalize">{{empty($tampil->nama)?'-':$tampil->nama}}</td>
                      
                      <td class="tulisan-kanan" scope="row" >
                        <a href="{{ route('opsiLinimasa.edit', $tampil->id) }}">
                          <button class="btn-kecil bg-primary mx-1">
                            <i class="fa fa-pencil m-0"></i>
                          </button>
                        </a>
                        <form action="{{ route('opsiLinimasa.destroy', $tampil->id) }}" method="post" class="d-inline">
                          @csrf
                          @method('DELETE')
                          <button class="btn-kecil bg-danger mx-0" onclick="return confirm('Yakin ingin dihapus?..')">
                            <i class="fa fa-trash m-0"></i>
                          </button>
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
              {{ $linimasa->links('vendor.pagination.bootstrap-4') }}
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
  



    
@endsection




@section('js')



@endsection