@extends('layout/layoutUI')

@section('judul')
    Postingan
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
                <li><a href="{{ url('/postingan', []) }}" class="activeku">Postingan</a></li>
                <li><a href="{{ url('/dokumentasi', []) }}">Dokumentasi</a></li>
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
                  <li class="breadcrumb-item active">Postingan</li>
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

                  <div class="row">
    
                        <!-- Single Sidebar Widget -->
                        @foreach ($postingan as $tampil)
                        <div class="col-12 col-md-6 col-lg-6 mb-4 ">
                            <div class="single-news-area d-flex garis-bawah pb-ku">
                                <div class="news-thumbnail">
                                    <img src="{{ url('images/postingan', $tampil->gambar_utama) }}" alt="" class="img-baru">
                                </div>
                                @php
                                    $judul = str_replace(' ','_',$tampil->judul).'.BEM';
                                @endphp
                                <div class="news-content">
                                    <a href="{{ url('/postingan', $judul) }}"> {{$tampil->judul}} </a>
                                    <p style="line-height: 20px" class="konteks">
                                        
                                            @php
                                                $kovertHtml = htmlspecialchars_decode($tampil->konten);
                                                $hasilHtml = strip_tags($kovertHtml);
                                            @endphp
                                            {{ substr($hasilHtml, 0 ,45 ).'...' }}
                                        
                                    </p>
                                    <span class="warna-biru">July 18, 2018</span>
                                </div>
                            </div>
                        </div>    
                        @endforeach
                    
    
    
                  </div>

                  <div class="row my-4 mb-100">
                      <div class="col-12 d-block example justify-content-center align-content-center text-center">
                        {{ $postingan->links('vendor.pagination.bootstrap-4') }}
                      </div>
                  </div>


        </div>
    </section>


@endsection