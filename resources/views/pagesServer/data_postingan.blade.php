@extends('layout/layoutServer')

@section('activePostingan')
    activeku
@endsection

@section('activeDataPostingan')
    activeku2
@endsection

@section('title')
    Postingan
@endsection

@section('judul')
    
@endsection

@section('content')

<div class="col-md-12 ">
  {{-- aksi form  --}}
  <div class="x_panel">
    <div class="x_title">
      <h2>Data Postingan 
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
        <li><a href="{{ route('data_postingan.index') }}"><i class="fa fa-refresh fa-lg"></i> Refresh</a></li>
        
        
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="row">
          <div class="col-sm-6 tulisan-tengah">
            <a href="{{ route('data_postingan.create') }}" class="btn btn-info btn-md">
              <i class="fa fa-edit"></i> 
              Tambah Postingan
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
                <table  class="table tableku table-sm table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr >
                      <th scope="col">No</th>
                      <th scope="col">Judul</th>
                      <th scope="col">Tags</th>
                      <th scope="col">Penulis</th>
                      <th scope="col">Tgl Pembuatan</th>
                      <th scope="col">Opsi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      
                      $nomor = empty($_GET['page'])?'1':(($_GET['page']==1)?'1':($_GET['page']*10)-9);  
                    ?>
                    @foreach ($postingan as $tampil)
                    <tr>
                      
                      <td scope="row" data-label="" class="tulisan-tengah"><b>{{$nomor++}}</b></td>
                      <td class="tulisan-kiri text-left"> {{$tampil->judul}}</td>
                      <td data-label="Penanda : &nbsp;" class="tulisan-kiri">{{str_replace(',',', ',$tampil->tag)}}</td>
                      <td data-label="penulis : &nbsp;" class="tulisan-kiri text-capitalize">{{($tampil->nama)}}</td>
                      <td data-label="tanggal : &nbsp;"class="tulisan-kiri">{{date('Y-m-d',strtotime($tampil->created_at))}}</td>
                      <td class="tulisan-kanan" scope="row" >
                        <a href="{{ url('/postingan', str_replace(' ','_',$tampil->judul).'.BEM') }}" target="_blank">
                          <button class="btn btn-secondary py-0 mx-0">
                            <i class="fa fa-eye fa m-0"></i>
                          </button>
                        </a>
                        <a href="{{ route('data_postingan.edit', $tampil->id) }}">
                          <button class="btn btn-primary py-0 mx-1">
                            <i class="fa fa-pencil m-0"></i>
                          </button>
                        </a>
                        <form action="{{ route('data_postingan.destroy', $tampil->id) }}" method="post" class="d-inline">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger py-0 mx-0" onclick="return confirm('Yakin ingin dihapus?..')">
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
              {{ $postingan->links('vendor.pagination.bootstrap-4') }}
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
  



    
@endsection




@section('js')



@endsection