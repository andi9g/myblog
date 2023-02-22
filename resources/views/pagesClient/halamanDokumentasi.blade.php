@extends('layout/layoutUI')

@section('judul')
    Dokumentasi
@endsection

@section('menu')

    <!-- Menu -->
    <div class="classy-menu">

        <!-- Close Button -->
        <div class="classycloseIcon">
            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
        </div>

        <!-- Nav Start -->
        <div class="classynav">
            <ul>
                <li><a href="{{ url('/', []) }}">Halaman Utama</a></li>
                <li><a href="{{ url('/postingan', []) }}">Postingan</a></li>
                <li><a href="{{ url('/dokumentasi', []) }}" class="activeku">Dokumentasi</a></li>
                <li><a href="{{ url('/login', []) }}">Login</a></li>
            </ul>
            
        </div>
        <!-- Nav End -->
    </div>
    
    
@endsection

@section('body')
   

    <section class="news-area my-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('/', []) }}">Beranda</a></li>
                  <li class="breadcrumb-item active">Dokumentasi</li>
                </ol>
              </nav>

              <div class="row">
                <div class="col-12 col-md-6 col-lg-6 posisiku2">
                  <h5 class="mt-2">
                      {{ empty($_GET['keyword'])?'Keseluruhan':'Kunci : '.$_GET['keyword'] }}
                  </h5>
                </div>

                <div class="col-12 col-md-6 col-lg-6 searchku posisiku">
                    <form action="{{ url()->current() }}">
                        <input type="text" name="keyword" value="{{empty($_GET['keyword'])?'':$_GET['keyword']}}" class="d-inline" >
                        <button type="submit" ><i class="fa fa-search"></i></button>
                    </form>
                </div>
                
                <div class="col-12">
                    <hr class="my-2 py-2">
                </div>
            </div>
            
                <div class="container">
      
                      <div class="row justify-content-center">
                  
                        @foreach ($dokumentasi as $tampil)
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="single-features-area mb-5 pb-2 wow fadeInUp center-text" data-wow-delay="300ms">
                                <img src="{{ url('/images/dokumentasi', $tampil->gambar) }}" class="img-dokumentasi" alt="">
                                <h5>{{ $tampil->judul }}</h5>
                            </div>
                        </div>
                            
                        @endforeach
                          
                      </div>

                </div>
    
                  </div>



                  <div class="row mb-100">
                      <div class="col-12 d-block example justify-content-center align-content-center text-center ">
                        {{ $dokumentasi->links('vendor.pagination.bootstrap-4') }}
                      </div>
                  </div>

        </div>
    </section>


@endsection