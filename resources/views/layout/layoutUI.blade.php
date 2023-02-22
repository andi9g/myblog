@php
    $logo = DB::table('logo')->first();    
    $kontak = DB::table('kontak')->first();    
    $sosmed = DB::table('sosialmedia')->first();   
    $footer = DB::table('web')->first();   
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>@yield('judul')</title>

    <!-- Favicon -->
    <link rel="icon" href="
    @if (!empty($logo->logo1))
    {{ url('images/logo', $logo->logo1) }}
    @endif
    ">

    <!-- Font Awesome -->
    <link href="{{ url('admin/font-awesome/css/font-awesome.min.css', []) }}" rel="stylesheet">
   
    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ url('HalamanUser/style.css', []) }}">

</head>

<body>
    <!-- Preloader -->
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">
        <!-- Navbar Area -->
        <div class="credit-main-menu" id="sticker">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="creditNav">

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        @yield('menu')

                        <!-- Contact -->
                        <div class="contact">
                            <a href="{{ url('/', []) }}">
                                <img src="
                                @if (!empty($logo->logo1))
                                {{ url('images/logo', $logo->logo1) }}
                                @endif
                                " class="ukuranLogo"  alt="" >
                            </a>

                            @if (!(empty($logo->logo2)))
                            <a href="{{ url('/', []) }}" class="mx-2">
                                <img src="{{ url('images/logo', empty($logo->logo2)?'':$logo->logo2) }}" class="ukuranLogo"  alt="">
                            </a>
                            @endif

                           
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->

    @yield('body')

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area section-padding-100-0">
        <div class="container">
            <div class="row">

                <!-- Single Footer Widget -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-footer-widget mb-100">
                        <h5 class="widget-title pb-0 mb-0">Kontak</h5>
                        <!-- Nav -->
                        <hr class="bg-white">
                        <div class="row">
                            @if (!empty($kontak->hp))
                            <div class="col-12 fontFoot mb-3">
                                <div class="row">
                                    <div class="col d-inline">
                                        <i class="fa fa-phone pr-2"> <font style="font-family: Arial, Helvetica, sans-serif">Kontak Admin</font></i>
                                        
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <a href="#kontak">
                                            {{ $kontak->hp }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if (!empty($kontak->wa))
                            <div class="col-12 fontFoot ">
                                <div class="row">
                                    <div class="col d-inline">
                                        <i class="fa fa-whatsapp pr-2"> <font style="font-family: Arial, Helvetica, sans-serif">Whatsapp Admin</font></i>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <a href="#kontak">
                                            {{ $kontak->wa }}
                                        </a>
                                    </div>
                                </div>
                                
                            </div>    
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Single Footer Widget -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-footer-widget mb-100">
                        <h5 class="widget-title pb-0 mb-0">Sosial Media</h5>
                        <!-- Nav -->
                        <hr class="bg-white">
                        <div class="row">
                            @if (!empty($sosmed->instagram))
                            <div class="col-12 fontFoot">
                                <a href="https://www.instagram.com/{{ empty($sosmed->instagram)?'':$sosmed->instagram }}" target="_blank">
                                    <i class="fa fa-instagram pr-2"></i>
                                    {{ empty($sosmed->instagram)?'':$sosmed->instagram }}
                                </a>
                            </div>
                            
                            @endif

                            @if (!empty($sosmed->facebook))
                            <div class="col-12 fontFoot">
                                <a href="https://www.facebook.com/{{ empty($sosmed->facebook)?'':$sosmed->facebook }}" target="_blank">
                                    <i class="fa fa-facebook-square pr-2"></i>
                                    {{ empty($sosmed->facebook)?'':$sosmed->facebook }}
                                </a>
                            </div>
                                
                            @endif

                            @if (!empty($sosmed->twitter))
                            <div class="col-12 fontFoot">
                                <a href="https://www.twitter.com/{{ empty($sosmed->twitter)?'':$sosmed->twitter }}" target="_blank">
                                    <i class="fa fa-twitter pr-2"></i>
                                    {{ empty($sosmed->twitter)?'':$sosmed->twitter }}
                                </a>
                            </div>
                          
                            @endif


                            @if (!empty($sosmed->pinterest))
                            <div class="col-12 fontFoot">
                                <a href="https://www.pinterest.com/{{ empty($sosmed->pinterest)?'':$sosmed->pinterest }}" target="_blank">
                                    <i class="fa fa-pinterest pr-2"></i>
                                    {{ empty($sosmed->pinterest)?'':$sosmed->pinterest }}
                                </a>
                            </div>
                            
                            @endif



                        </div>
                    </div>
                </div>

                <!-- Single Footer Widget -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-footer-widget mb-100">
                        <h5 class="widget-title pb-0 mb-0">Lokasi Kampus</h5>
                        <hr class="bg-white">
                        <!-- Single News Area -->
                        <div class="single-latest-news-area d-flex align-items-center">
                            <div id="map" style="width: 100%;height: 350px;"></div>

                        </div>


                        

                    </div>
                </div>
            </div>
        </div>

        <!-- Copywrite Area -->
        <div class="copywrite-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="copywrite-content d-flex flex-wrap justify-content-center align-items-center">
                            <center>
                                <!-- Copywrite Text -->
                                <p class="copywrite-text"><a href="#"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | ARBP & RFP <i class="fa fa-genderless px-2"></i> {{ empty($footer->footer)?'':$footer->footer }}
                                    </p>
                            </center>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area Start ##### -->

    <!-- ##### All Javascript Script ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="{{ url('HalamanUser/js/jquery/jquery-2.2.4.min.js', []) }}"></script>
    
    <!-- Popper js -->
    <script src="{{ url('HalamanUser/js/bootstrap/popper.min.js', []) }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ url('HalamanUser/js/bootstrap/bootstrap.min.js', []) }}"></script>
    <!-- All Plugins js -->
    <script src="{{ url('HalamanUser/js/plugins/plugins.js', []) }}"></script>
    <!-- Active js -->
    <script src="{{ url('HalamanUser/js/active.js', []) }}"></script>
    <script src="{{ url('HalamanUser/js/script.js?v=6', []) }}"></script>
    
    
    <script
      src="https://maps.googleapis.com/maps/api/js?key={{ empty($footer->api_key)?'':$footer->api_key }}&callback=initMap&libraries=&v=weekly"
      async
      
    ></script>
   

    @include('sweetalert::alert')

    @yield('jquery')

    @php
        $data = explode(',',empty($footer->map)?'0.9211083,104.4519044':$footer->map);
        $lat = $data[0];
        $lng = $data[1];
    @endphp

    <script>
        $('.has-down').removeClass('has-down');

        
        let marker;

        function initMap() {
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 18,
            center: { lat: {{ $lat }}, lng: {{ $lng }} },
        });
        marker = new google.maps.Marker({
            map,
            draggable: false,
            animation: google.maps.Animation.BOUNCE,
            position: { lat: {{ $lat }}, lng: {{ $lng }} },
        });
        marker.addListener("click",toggleBounce);
        }

        function toggleBounce() {
        if (marker.getAnimation() !== null) {
            marker.setAnimation(null);
        } else {
            marker.setAnimation(google.maps.Animation.DROP);
        }
        }
        
        

        
        
    </script>

</body>

</html>
