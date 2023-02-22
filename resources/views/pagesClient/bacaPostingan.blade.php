@extends('layout/layoutUI')

@section('judul')
    {{$judul}}
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
                <li><a href="#" class="activeku">Postingan</a>
                    <ul class="dropdown">
                        <li><a href="{{ url('/postingan', []) }}">Semua Postingan</a></li>
                        <li><a href="#" class="activeku" >Sedang Dibaca</a></li>
                    </ul>
                </li>
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
                  <li class="breadcrumb-item"><a href="{{ url('/postingan', []) }}">Postingan</a></li>
                  <li class="breadcrumb-item active text-capitalize" aria-current="page">{{$judul}}</li>
                </ol>
              </nav>


              <div class="row">
                <!-- Single News Area -->
                <div class="col-12 col-lg-8 mt-3">

                    <!-- Single Blog Area -->
                    <div class="single-blog-area">
                        <div class="blog-content">
                            
                            <a href="#" class="post-title"><h2>{{ $judul }}</h2></a>
                            <p class="my-1 font-text color-greyku text-capitalize">
                                <i class="fa fa-pencil"></i> {{$penulis->nama}} ({{$penulis->posisi}})
                            </p>
                            <span >{{ date('F d, Y', strtotime($postingan->created_at)) }}</span>
                            
                            
                        </div>
                        
                        <div class="blog-thumbnail">
                            <a href="#"><img src="{{ url('images/postingan', $postingan->gambar_utama) }}" alt="" class="img-postingan"></a>
                        </div>

                        
                        <div class="kontenku">
                                @php
                                    echo strip_tags(htmlspecialchars_decode($postingan->konten),'<p><img><ul><li><ol><strong><i><u><center><b><h1><h2><h3><h4><h5><a><table><tr><td><th><div>');
                                    
                                @endphp
                        </div>
                       

                        <div class="blog-content mt-5">
                            @php
                                $tags = explode(',',$postingan->tag);
                            @endphp

                            @foreach ($tags as $tag)
                                <div class="tag-konten d-inline"><i class="fa fa-tag"></i> {{$tag}}</div>
                            @endforeach
                        </div>


                        <div class="blog-content">
                            <div class="row justify-content-center text-center">
                                <div class="col-12 m-5">

                                    <h5><i class="fa fa-arrow-circle-down"></i> BAGIKAN <i class="fa fa-arrow-circle-down"></i></h5>
                                    <hr class="mb-4">

                                    
                                    @php
                                        $url = url('/postingan', str_replace(' ','_',$judul).'.BEM');
                                    @endphp
                                       
                                    <a href="https://www.facebook.com/share.php?u={{$url}}" target="_blank">
                                        <div class="kotak-bagikan facebook-logo">
                                            <i class="fa fa-facebook-square pl-1 fa-lg text-white"></i>
                                        </div>
                                    </a>
                                    
                                    <a href="https://twitter.com/intent/tweet?url={{$url}}" target="_blank">
                                        <div class="kotak-bagikan twitter-logo">
                                            <i class="fa fa-twitter-square pl-1 fa-lg text-white"></i>
                                        </div>
                                    </a>
                                    
                                    <a href="whatsapp://send?text={{ $url }}" target="_blank">
                                        <div class="kotak-bagikan whatsapp-logo">
                                            <i class="fa fa-whatsapp pl-1 fa-lg text-white"></i>
                                        </div>
                                    </a>

                                    <a href="http://pinterest.com/pin/create/button/?url={{ $url }}" target="_blank">
                                        <div class="kotak-bagikan pinterest-logo">
                                            <i class="fa fa-pinterest pl-1 fa-lg text-white"></i>
                                        </div>
                                    </a>

                                    <a href="https://t.me/share/url?url={{ $url }}" target="_blank">
                                        <div class="kotak-bagikan telegram-logo">
                                            <i class="fa fa-send px-1 fa-sm text-white"></i>
                                        </div>
                                    </a>

                                </div>
                            </div>
                        </div>


                        <a href="{{ url('/postingan', []) }}" class="btn btn-warning">Lihat Postingan Lainnya...</a>
                       
                    </div>


                </div>

                <div class="col-12 col-sm-9 col-md-6 col-lg-4 my-3">
                    <div class="sidebar-area">

                        <!-- Single Sidebar Widget -->
                        <div class="single-widget-area tabs-widget">
                            <div class="widget-heading ">
                                <div class="line"></div>
                                <h4>Postingan Terbaru</h4>
                            </div>

                                <div >
                                    <div class="tab-pane" >
                                        <div class="credit-tab-content">
                                            <!-- Single News Area -->
                                            @foreach ($terbaru as $terbaru)
                                            <div class="single-news-area d-flex garis-bawah pb-3">
                                                <div class="news-thumbnail">
                                                    <img src="{{ url('images/postingan', $terbaru->gambar_utama) }}" alt="" class="img-baru">
                                                </div>
                                                
                                                @php
                                                    $judul = str_replace(' ','_',$terbaru->judul).'.BEM';
                                                @endphp
                                                <div class="news-content">
                                                    <a href="{{ url('/postingan', $judul) }}">{{$terbaru->judul}}</a>

                                                    <p class="my-1 font-text color-greyku text-capitalize">
                                                        <i class="fa fa-pencil"></i> {{$terbaru->nama}} ({{$terbaru->posisi}})
                                                    </p>
                                                    <span>{{ date('F d, Y', strtotime($terbaru->created_at)) }}</span>
                                                    
                                                </div>
                                            </div>
                                            @endforeach

                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>



                </div>


              </div>

        </div>
    </section>


@endsection