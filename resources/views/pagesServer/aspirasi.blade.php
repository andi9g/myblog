@extends('layout/layoutServer')

@section('activeAspirasi')
    activeku
@endsection


@section('title')
    Kritik dan Saran
@endsection

@section('judul')
    
@endsection

@section('content')
@php
function hari_ini($tgl)
{
    switch($tgl){
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

    return $hari_ini;
}
@endphp
<div class="row px-3">
  <div class="col-md-8"></div>
    <div class="col-md-4 ">
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
<div class="col-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Kritik dan Saran
            <small>
                <?php
                  if (empty($_GET['keyword'])) {
                    echo "Keseluruhan";
                  }else {
                    echo 'Kunci : "'.$_GET['keyword'].'"';
                  }  
                ?>
        </h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
          


        <ul class="list-unstyled msg_list">
            @foreach ($aspirasi as $tampil)
            <li>
              <a>
                <span class="image">
                  <img src="{{ url('images/profile/profile.png', ) }}" alt="img"  />
                </span>
                <span>
                  <span class="text-capitalize" style="font-size: 11pt"><b>{{ $tampil->nama }} <i class="text-secondary"> ({{ date('H:i', strtotime($tampil->created_at)) }})</i></b></span>
                  <span class="time px-3">{{ hari_ini(date('D',strtotime($tampil->created_at))) }}, {{ date('d F Y', strtotime($tampil->created_at)) }}
                    
                    @if (Session::get('posisi')=='admin')
                    <form action="{{ route('aspirasi.delete',$tampil->id) }}" class="d-inline" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin dihapus?')" class="btn m-0 p-0 btn-xs"><i class="fa fa-times text-danger"></i></button>
                    </form>
                    @endif
                    
                </span>
                </span>
                <span class="message" style="font-size: 11pt">
                  {{ $tampil->pesan }}
                </span>
                
              </a>
            </li>
            @endforeach

          
      </div>


      <div class="row">
        <div class="col-sm-12 my-3">
          <div class="col-12 ">
            {{ $aspirasi->links('vendor.pagination.bootstrap-4') }}
          </div>
        </div>
      </div>
    </div>
  </div>
  
 
@endsection




@section('js')



@endsection