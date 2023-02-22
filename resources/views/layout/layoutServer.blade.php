@php
    $posisi = Session::get('posisi');
    $penulis = Session::get('penulis');
    $nim = Session::get('nim');
    $anggota = DB::table('anggota')->where('nim',$nim)->first();
    $logo = DB::table('logo')->first();   
    $footer = DB::table('web')->first();   
@endphp


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link href="{{ url('admin/bootstrap/dist/css/bootstrap.min.css', []) }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ url('admin/font-awesome/css/font-awesome.min.css', []) }}" rel="stylesheet">
    

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ url('admin/select2/css/select2.min.css', []) }}">
    <link rel="stylesheet" href="{{ url('admin/select2-bootstrap4-theme/select2-bootstrap4.min.css', []) }}">

    <!-- Favicon -->
    <link rel="icon" href="
    @if (!empty($logo->logo1))
    {{ url('images/logo', $logo->logo1) }}
    @endif
    ">
    
    <!-- Datatables -->
    <link href="{{ url('admin/datatables.net-bs/css/dataTables.bootstrap.min.css', []) }}" rel="stylesheet">
    <link href="{{ url('admin/datatables.net-buttons-bs/css/buttons.bootstrap.min.css', []) }}" rel="stylesheet">
    <link href="{{ url('admin/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css', []) }}" rel="stylesheet">
    <link href="{{ url('admin/datatables.net-responsive-bs/css/responsive.bootstrap.min.css', []) }}" rel="stylesheet">
    <link href="{{ url('admin/datatables.net-scroller-bs/css/scroller.bootstrap.min.css', []) }}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ url('build/css/custom.css', []) }}" rel="stylesheet">
    <link href="{{ url('build/css/styleku.css', []) }}" rel="stylesheet">
    
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{ url('/home', []) }}" class="site_title"><i class="fa fa-server" aria-hidden="true"> </i> 
                <span>
                   SERVER
                </span>
              </a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix profile_latar">
              <div class="profile_pic">
                <img src="{{ url('images/profile',$anggota->gambar) }}" alt="..." class="img-circle profile_img" width="40px" height="55px">
              </div>
              <div class="profile_info">
                <span>{{Session::get('nama')}}, </span>
                <h2 class="text-capitalize">{{Session::get('posisi')}}</h2>
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu">

                  <li class="@yield('activeHome')">
                    <a href="{{ url('/home', []) }}">
                      <i class="fa fa-home"></i> Home
                    </a>
                  </li>

                  <li class="@yield('activeAspirasi')">
                    <a href="{{ url('/aspirasi', []) }}">
                      <i class="fa fa-send"></i> Kritik dan Saran
                    </a>
                  </li>

                  @if ($anggota->jabatan=='bendahara' || $anggota->jabatan=='ketua' || $anggota->jabatan=='wakil' || $anggota->jabatan=='sekertaris')
                  <li class="@yield('activeDonasi')">
                    <a href="{{ url('/donasi', []) }}">
                      <i class="fa fa-dollar"></i> Penggalangan Dana
                    </a>
                  </li>
            
                  @endif

                  @if ($penulis=='penulis')
                  <li class="@yield('activePostingan')">
                    <a>
                      <i class="fa fa-pencil"></i> Postingan 
                      <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                      <li class="@yield('activeDataPostingan')">
                        <a href="{{ url('/data_postingan', []) }}">
                          Data Postingan
                        </a>
                      </li>
                      <li class="@yield('activeTulisPostingan')">
                        <a href="{{ route('data_postingan.create') }}">
                          Tulis Postingan
                        </a>
                      </li>
                    </ul>
                  </li>

                  <li class="@yield('activeDokumentasi')">
                    <a href="{{ url('/doc', []) }}">
                      <i class="fa fa-check"></i> Dokumentasi 
                    </a>
                  </li>
                  @endif

                  @if ($posisi=='admin')
                  <li class="@yield('activePendaftaran')">
                    <a href="{{ url('/pendaftaran', []) }}">
                      <i class="fa fa-edit"></i> Pendaftaran 
                    </a>
                  </li>
                  @endif

                  @if ($posisi=='admin' || $nim=='4321')
                  <li class="@yield('activeAnggota')">
                    <a href="{{ url('/anggota', []) }}">
                      <i class="fa fa-users"></i> Anggota 
                    </a>
                  </li> 
                  @endif
                  

                  @if ($posisi=='admin')
                  <li class="@yield('activeOpsiHalaman')">
                    <a>
                      <i class="fa fa-wrench"></i> Opsi Halaman
                      <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">

                      <li class="@yield('activeOpsiSlide')">
                        <a href="{{ url('/opsiSlide', []) }}">
                          Gambar Slide
                        </a>
                      </li>

                      <li class="@yield('activeOpsiVisiDanMisi')">
                        <a href="{{ url('/opsiVisiDanMisi', []) }}">
                          Visi dan Misi
                        </a>
                      </li>

                      <li class="@yield('activeOpsiLinimasa')">
                        <a href="{{ url('/opsiLinimasa', []) }}">
                          Linimasa
                        </a>
                      </li>

                      <li class="@yield('activeOpsiJabatan')">
                        <a href="{{ url('/opsiJabatan', []) }}">
                          Kelola Jabatan
                        </a>
                      </li>

                      <li class="@yield('activePengaturan')">
                        <a href="{{ url('/opsiPengaturan', []) }}">
                          Pengaturan Lanjutan
                        </a>
                      </li>

                    </ul>
                  </li>
                  @endif
                  

                  
                </ul>
                <br><br><br><br>
              </div>

            </div>
            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ url('/logout', []) }}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                  <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                      <img src="{{ url('images/profile',$anggota->gambar) }}" alt="">{{ substr($anggota->nama,0,12) }}
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                      
                      <a class="dropdown-item"  href="{{ url('profile', []) }}"> Profile</a>
                      <a class="dropdown-item"  href="{{ route('logout.logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </div>
                  </li>
  
                  
                </ul>
              </nav>
            </div>
          </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>@yield('judul')</h3>
              </div>

              {{--  --}}
              
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                  @yield('content')
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | ARBP & RFP <i class="fa fa-genderless px-2"></i> {{ empty($footer->footer)?'':$footer->footer }}
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
        
    
      
    <!-- jQuery -->
    
    
    <!-- Bootstrap -->
   <script src="{{ url('admin/jquery-3.6.0.min.js', []) }}"></script>

   <script src="{{ url('admin/bootstrap/dist/js/bootstrap.bundle.min.js', []) }}"></script>
    
    <!-- Select2 -->
    <script src="{{ url('admin/select2/js/select2.full.min.js', []) }}"></script>

   <!-- FastClick -->
    <script src="{{ url('admin/fastclick/lib/fastclick.js', []) }}"></script>
    
    @yield('js')
    <!-- Chart.js -->
    <script src="{{ url('admin/Chart.js/dist/Chart.js', []) }}"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{ url('build/js/custom.js', []) }}"></script>
    
    <script>
      $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
    
        //Initialize Select2 Elements
        $('.select2bs4').select2({
          theme: 'bootstrap4'
        })
        
    
        $("input[data-bootstrap-switch]").each(function(){
          $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
    
      })
    </script>
    <script type="text/javascript">
      $(document).ready(function () {
        bsCustomFileInput.init();
      });
      </script>
    @include('sweetalert::alert')

    

  </body>
</html>
