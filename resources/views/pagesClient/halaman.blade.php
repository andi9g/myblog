@extends('layout/layoutUI')

@section('judul')
    {{ empty($web->title)?'':$web->title }}
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
                <li ><a href="#beranda" class="scrollpage beranda activeku">Beranda</a></li>
                <li><a href="#" class="profileku">Profil</a>
                    <ul class="dropdown">
                        <li><a href="#visidanmisi" class="scrollpage visidanmisi">Visi & Misi</a></li>
                        <li><a href="#struktur" class="scrollpage struktur" >Struktur Kabinet</a></li>
                    </ul>
                </li>
                <li><a href="#dokumentasi" class="scrollpage dokumentasi">Dokumentasi</a></li>
                
                <li><a href="#" class="formMenu">Daftar/Aspirasi</a>
                    <ul class="dropdown">
                        <li><a href="#pendaftaran" class="scrollpage pendaftaran">Pendaftaran Anggota</a></li>
                        <li><a href="{{ url('#kritikdansaran', []) }}" class="scrollpage kritikdansaran">Kritik/Saran</a></li>
                    </ul>
                </li>
                
                <li><a href="#linimasa" class="scrollpage linimasa">Linimasa</a></li>
                <li><a href="#kontak" class="scrollpage kontak">Kontak</a></li>

                <li><a href="{{ url('/login', []) }}">Login</a></li>
                
            </ul>
            
        </div>
        <!-- Nav End -->
    </div>
    
@endsection

@section('body')




    <!-- ##### BERANDA ##### -->
    <div class="hero-area" id="beranda">
        <div class="hero-slideshow owl-carousel">

            @foreach ($slide as $tampilSlide)
            <!-- Single Slide -->
                <div class="single-slide bg-img">
                    <!-- Background Image-->
                    <div class="slide-bg-img bg-img bg-overlay" style="background-image: url(images/slide/{{ $tampilSlide->gambar }});"></div>
                    <!-- Welcome Text -->
                    <div class="container h-100">
                        <div class="row h-100 align-items-center justify-content-center">
                            <div class="col-12 col-lg-9">
                                <div class="welcome-text text-center fontku-judul">
                                    <h2 class="h3" data-animation="fadeInUp" data-delay="300ms"> 
                                        <span>
                                            {{ $tampilSlide->judul }}
                                        </span> 
                                    </h2>
                                    <p data-animation="fadeInUp" data-delay="500ms">
                                        {{ $tampilSlide->pesan }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Slide Duration Indicator -->
                    <div class="slide-du-indicator"></div>
                </div>
            @endforeach

            
           

        </div>
    </div>

   

    <!-- ##### POSTINGAN ###### -->
    <section class="features-area pt-5" >
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section Heading -->
                    <div class="section-heading text-center wow fadeInUp" data-wow-delay="100ms">
                        <div class="line"></div>
                        <p><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></p>
                        <h2>POSTINGAN</h2>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                @php
                    $jumlahPostingan = 0;
                @endphp
                @foreach ($postingan as $postingan)
                @php
                    $jumlahPostingan++;
                @endphp
                <div class="col-12 col-sm-6 col-lg-3 garis-bawah mb-4">
                    <div class="single-features-area wow fadeInUp" data-wow-delay="300ms">
                        
                        <img src="{{ url('/images/postingan', $postingan->gambar_utama) }}" class="gambarPostingan border-styleku" alt="">
                       

                        <div class="px-1">
                            <h5>
                                @php
                                    $judul = str_replace(' ','_',$postingan->judul).'.BEM';
                                @endphp
                                <a href="{{ url('/postingan',$judul) }}" class="bjudul">
                                    {{$postingan->judul}}
                                </a>
                            </h5>

                            <p>
                                @php
                                    $kovertHtml = htmlspecialchars_decode($postingan->konten);
                                    $hasilHtml = strip_tags($kovertHtml);
                                @endphp
                                {{ substr($hasilHtml, 0 ,75 ).'...' }}
                            </p>

                            <div class="single-news-area">
                                <div class="news-content p-0">
                                <span class="warna-putih"><i class="fa fa-pencil"></i> {{date('F d,Y', strtotime($postingan->created_at))}}</span>
                                </div>
                            </div>
    
                            <div class="text-right">
                                <p>
                                    <a href="{{ url('/postingan', $judul) }}" class="bselengkapnya">Baca Selengkapnya</a>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
               
            </div>

            <div class="row py-3 mt-0 mb-5">
                <div class="col-12 justify-content-center text-center">
                    
                    <a href="{{ url('/postingan', []) }}" class="btn btn-sm credit-btn box-shadow mb-4">Postingan lainnya..</a>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Features Area End ###### -->






    <!-- VISI dan MISI -->
    <section class="cta-area d-flex flex-wrap" id="visidanmisi">
        <!-- Cta Thumbnail -->
        @if (empty($visidanmisi))
        <div class="cta-thumbnail bg-img jarallax" style="background-image: url(images/aksimuda.png)"></div>
        
        @else
        <div class="cta-thumbnail bg-img jarallax" style="background-image: url(images/visidanmisi/{{ $visidanmisi->gambar }});"></div>
            
        @endif

        <!-- Cta Content -->
        <div class="cta-content">
            <!-- Section Heading -->
            <div class="visimisiColor container">
                <div class="section-heading white my-0 py-0">
                    <div class="line"></div>
                    <p>Visi dan Misi</p>
                    <h1 class="mt-4 pb-2">VISI </h1>
                </div>
                    @php
                        echo empty($visidanmisi->visi)?'':strip_tags(htmlspecialchars_decode($visidanmisi->visi),'<p><img><ul><li><ol><strong><i><u><center><b><h1><h2><h3><h4><h5><a><table><tr><td><th><div>')
                    @endphp   
                <div class="section-heading white mt-4 mb-0 py-0">
                    <h1 class="mt-5  pb-2">MISI </h1>
                </div>
    
                    @php
                        echo empty($visidanmisi->misi)?'':strip_tags(htmlspecialchars_decode($visidanmisi->misi),'<p><img><ul><li><ol><strong><i><u><center><b><h1><h2><h3><h4><h5><a><table><tr><td><th><div>')
                    @endphp   
            </div>
        </div>
    </section>
    <!-- ##### Call To Action End ###### -->

    <!-- ##### Call To Action Start ###### -->
    <section class="cta-2-area wow fadeInUp" data-wow-delay="100ms">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Cta Content -->
                    <div class="cta-content d-flex flex-wrap align-items-center justify-content-between">
                        <div class="cta-text">
                            <h4>Ingin Bergabung?.</h4>
                        </div>
                        <div class="cta-btn">
                            <a href="#pendaftaran" class="scrollpage btn credit-btn box-shadow">Daftar Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Call To Action End ###### -->



    <!--  STRUKTUR  -->
    <section class="services-area section-padding-100-0" id="struktur">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section Heading -->
                    <div class="section-heading text-center  wow fadeInUp" data-wow-delay="100ms">
                        <div class="line"></div>
                        <p><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></p>
                        <h2>STRUKTUR KABINET</h2>
                    </div>
                </div>
            </div>
            <div class="tabel-desain">
                

                {{-- ketua & wakil --}}
                <div class="row mb-2 justify-content-center">
                
                    <div class="col-12 col-md-4 col-lg-4 p-4">
                        <table width="100%">
                            <tr>
                                <th>Ketua</th>
                            </tr>
                            @foreach ($ketua as $ketua)
                            <tr>
                                <td>
                                    {{ $ketua->nama }}
                                </td>
                            </tr>
                            @endforeach
                            
                        </table>
                    </div>

                    <div class="col-12 col-md-4 col-lg-4 p-4">
                        <table width="100%">
                            <tr>
                                <th>Wakil</th>
                            </tr>
                            @foreach ($wakil as $wakil)
                            <tr>
                                <td>
                                    {{ $wakil->nama }}
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>

                    
                </div>


                {{-- sekertaris --}}
                <div class="row mb-2 justify-content-center">
                
                    <div class="col-12 col-md-4 col-lg-4 p-4">
                        <table width="100%">
                            <tr>
                                <th>Sekertaris</th>
                            </tr>
                            @foreach ($sekertaris as $sekertaris)
                            <tr>
                                <td>
                                    {{ $sekertaris->nama }}
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    
                </div>


                {{-- bendahara --}}
                <div class="row mb-2 justify-content-center">
                
                    <div class="col-12 col-md-4 col-lg-4 p-4">
                        <table width="100%">
                            <tr>
                                <th class="borderku-table">BENDAHARA</th>
                            </tr>
                            @foreach ($bendahara as $bendahara)
                            <tr>
                                <td>
                                    {{ $bendahara->nama }}
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    
                </div>

                


                
                <div class="row mb-2 justify-content-center mb-100">
                    {{-- mentri dalam negri --}}
                    <div class="col-12 col-md-4 col-lg-4 p-4">
                        <table width="100%">
                            <tr>
                                <th class="">MENTRI DALAM NEGRI</th>
                            </tr>
                            @foreach ($mentridalamnegri as $mentridalamnegri)
                            <tr>
                                <td>
                                    {{ $mentridalamnegri->nama }}
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>


                    {{-- mentri luar negri --}}
                    <div class="col-12 col-md-4 col-lg-4 p-4">
                        <table width="100%">
                            <tr>
                                <th class="">MENTRI LUAR NEGRI</th>
                            </tr>
                            @foreach ($mentriluarnegri as $mentriluarnegri)
                            <tr>
                                <td>
                                    {{ $mentriluarnegri->nama }}
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>


                    {{-- mentri KOMUNIKASI DAN INFORMASI --}}
                    <div class="col-12 col-md-4 col-lg-4 p-4">
                        <table width="100%">
                            <tr>
                                <th class="ukuran-font">MENTRI KOMUNIKASI DAN INFORMASI</th>
                            </tr>
                            @foreach ($mentrikomunikasidaninformasi as $mentrikomunikasidaninformasi)
                            <tr>
                                <td>
                                    {{ $mentrikomunikasidaninformasi->nama }}
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>

                    {{-- mentri PENELITIAN DAN PENGEMBANGAN --}}
                    <div class="col-12 col-md-4 col-lg-4 p-4">
                        <table width="100%">
                            <tr>
                                <th class="ukuran-font">MENTRI PENELITIAN DAN PENGEMBANGAN</th>
                            </tr>
                            @foreach ($mentripenelitiandanpengembangan as $mentripenelitiandanpengembangan)
                            <tr>
                                <td>
                                    {{ $mentripenelitiandanpengembangan->nama }}
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>



                </div>

            </div>
                

                

                
            </div>
        </div>
    </section>
    <!-- ##### Services Area End ###### -->




    <!-- ##### DOKUMENTASI ###### -->
    <section class="miscellaneous-area bg-gray section-padding-100-0" id="dokumentasi">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section Heading -->
                    <div class="section-heading text-center pb-4 wow fadeInUp" data-wow-delay="100ms">
                        <div class="line"></div>
                        <p><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></p>
                        <h2>DOKUMENTASI</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                
                @foreach ($dokumentasi as $dokumentasi)
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-features-area wow fadeInUp center-text" data-wow-delay="300ms">
                        <img src="{{ url('/images/dokumentasi', $dokumentasi->gambar) }}" class="img-dokumentasi" alt="">
                        <h5 class="mb-4">{{ $dokumentasi->judul }}</h5>
                    </div>
                </div>
                @endforeach
                
                
            </div>

            <div class="row py-3 my-4 pb-5">
                <div class="col-12 justify-content-center text-center mb-3">
                    <a href="{{ url('/dokumentasi', []) }}" class="btn btn-sm credit-btn box-shadow mb-4">Dokumentasi Lainnya</a>
                </div>
            </div>
        </div>
    </section>



    {{-- PENDAFTARAN --}}
    <section class="services-area section-padding-100-0" id="pendaftaran">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section Heading -->
                    <div class="section-heading text-center pb-3 wow fadeInUp" data-wow-delay="100ms">
                        <div class="line"></div>
                        <p><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></p>
                        <h2>PENDAFTARAN</h2>
                    </div>
                </div>
            </div>
            
            

            <div class="mb-100">
                <!-- Single Service Area -->
                
                <div class="contact---area">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <div class="row">
                                    <!-- Single Service Area -->
                                    <div class="col-12">
                                        <div class="single-service-area d-flex mb-4 wow fadeInUp" data-wow-delay="200ms">
                                            <div class="icon">
                                                <i class="fa fa-arrow-right"></i>
                                            </div>
                                            <div class="text">
                                                <h5>Pendaftaran</h5>
                                                <p>Lengkapi identitas anggota pada form perndaftaran.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="single-service-area d-flex mb-4 wow fadeInUp" data-wow-delay="200ms">
                                            <div class="icon">
                                                <i class="fa fa-arrow-right"></i>
                                            </div>
                                            <div class="text">
                                                <h5>Verifikasi</h5>
                                                <p>Data yang telah dikirim akan diverifikasi oleh admin.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="single-service-area d-flex mb-4 wow fadeInUp" data-wow-delay="200ms">
                                            <div class="icon">
                                                <i class="fa fa-arrow-right"></i>
                                            </div>
                                            <div class="text">
                                                <h5>Konfirmasi</h5>
                                                <p>Admin akan mengkonfirmasi melalui nomor whatsapp yang aktif.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="single-service-area d-flex mt-5 mb-4 wow fadeInUp" data-wow-delay="200ms">
                                            <div class="icon bg-warning">
                                                <i class="fa fa-warning"></i>
                                            </div>
                                            <div class="text">
                                                <h5>Perhatian!</h5>
                                                <p>Pendaftaran hanya dapat dilakukan sekali setiap perangkat, pastikan mengisi data pribadi dengan benar.</p>
                                            </div>
                                        </div>
                                    </div>
                                    

                                    <div class="col-12">
                                        <div class="single-service-area d-flex mt-4 mb-5 wow fadeInUp" data-wow-delay="200ms">
                                            <div class="icon bg-danger">
                                                <i class="fa fa-times"></i>
                                            </div>
                                            <div class="text">
                                                <h5>Error!</h5>
                                                <p>Jika terdapat pesan error saat mengirim data hubungi admin.</p>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="col-12 col-lg-8 py-5 px-4 borderku">
                                
                                @if ($cekPendaftaran=='open')
                                @if ($telahmendaftar>0)
                                <center>
                                    <h2 class="text-warning">ANDA TELAH MENDAFTAR</h2>
                                    <h4 class="text-white">Admin akan mengkonfirmasi anggota-anggota yang terpilih melalui nomor whatsapp yang aktif</h4>
                                </center>
                                @else
                                

                                <!-- Contact Area -->
                                <div class="contact-form-area contact-page ">
                                    
                                    <form action="{{ url('/daftaranggota', []) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="" class="fontku-judul">NIM *</label>
                                                <div class="form-group">
                                                    <input type="number" class="form-control text-dark text-capitalize text-bold @error('nim')
                                                        invalidku
                                                    @enderror " name="nim" placeholder="Nomor Induk Mahasiswa *" value="{{ old('nim') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="" class="fontku-judul">Nama Lengkap *</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control text-dark text-capitalize text-bold @error('nama')
                                                    invalidku
                                                    @enderror" name="nama" value="{{ old('nama') }}" placeholder="Nama Lengkap *">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="" class="fontku-judul">Tempat lahir *</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control text-dark text-capitalize text-bold @error('tempatlahir')
                                                    invalidku
                                                    @enderror" name="tempatlahir" value="{{ old('tempatlahir') }}" placeholder="Tempat Lahir *">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="" class="fontku-judul">Tanggal lahir *</label>
                                                <div class="form-group">
                                                    <input type="date" class="form-control text-dark text-bold @error('tanggallahir')
                                                    invalidku
                                                    @enderror" name="tanggallahir" value="{{ old('tanggallahir') }}" placeholder="Tgl Lahir *">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="" class="fontku-judul">Jenis Kleamin *</label>
                                                <select name="jeniskelamin" id="" class="form-control text-dark">
                                                    <option value="pria">Pria</option>
                                                    <option value="perempuan">Perempuan</option>
                                                </select>
                                                
                                            </div>


                                            <div class="col-md-6">
                                                <label for="" class="fontku-judul">Semester *</label>
                                                <div class="form-group">
                                                    <input type="number" class="form-control text-dark text-capitalize text-bold @error('semester')
                                                    invalidku
                                                    @enderror" name="semester" value="{{ old('semester') }}" placeholder="Semester *">
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <label for="" class="fontku-judul">Program Studi *</label>
                                                <select name="programstudi" id="" class="form-control text-dark font-bold @error('programstudi')
                                                invalidku
                                                @enderror" style="font-weight: bold">
                                                    <option value="">-- Pilih --</option>
                                                    @foreach ($jurusan as $jurusan)
                                                        <option value="{{ $jurusan->id }}" class="font-bold">{{ ucfirst($jurusan->jurusan) }}</option>
                                                    @endforeach
                                                </select>
                                                
                                            </div>

                                            <div class="col-12">
                                                <label for="" class="fontku-judul">Alamat *</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control text-dark text-bold @error('alamat')
                                                    invalidku
                                                    @enderror" name="alamat" value="{{ old('alamat') }}" placeholder="alamat *">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="" class="fontku-judul">Moto Hidup *</label>
                                                <div class="form-group">
                                                    <textarea name="motohidup" class="form-control text-dark text-bold @error('motohidup')
                                                    invalidku
                                                    @enderror" cols="10" rows="10" placeholder="Moto hidup **">{{ old('motohidup') }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="" class="fontku-judul">Asal Sekolah *</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control text-dark text-bold @error('asalsekolah')
                                                    invalidku
                                                    @enderror" name="asalsekolah" value="{{ old('asalsekolah') }}" placeholder="Asal sekolah *">
                                                </div>
                                            </div>

                                            
                                            <div class="col-12">
                                                <label for="" class="fontku-judul">Email *</label>
                                                <div class="form-group">
                                                    <input type="email" class="form-control text-dark text-bold @error('email')
                                                    invalidku
                                                    @enderror" name="email" value="{{ old('email') }}" placeholder="email : example@email.com *">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="" class="fontku-judul">Whatsapp *</label>
                                                <div class="form-group">
                                                    <input type="number" class="form-control text-dark text-capitalize text-bold @error('wa')
                                                    invalidku
                                                    @enderror" name="wa" value="{{ old('wa') }}" placeholder="Nomor Whatsapp Aktif *">
                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <label for="" class="fontku-judul">Motifasi Bergabung *</label>
                                                <div class="form-group">
                                                    <textarea name="alasan" class="form-control text-dark text-bold @error('alasan')
                                                    invalidku
                                                    @enderror" cols="30" rows="10" placeholder="Alasan ingin bergabung **">{{ old('alasan') }}</textarea>
                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <label for="" class="fontku-judul">Gambar Pasfoto * <i>Max 2Mb</i></label>
                                                <div class="form-group">
                                                    <input type="file" class="form-control text-dark text-bold @error('pasfoto')
                                                    invalidku
                                                    @enderror" name="pasfoto" value="{{ old('pasfoto') }}">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="" class="fontku-judul">Gambar Selfie * <i>Max 2Mb</i></label>
                                                <div class="form-group">
                                                    <input type="file" class="form-control text-dark text-bold @error('selfie')
                                                    invalidku
                                                    @enderror" name="selfie" value="{{ old('selfie') }}">
                                                </div>
                                            </div>



                                            <div class="col-12 text-right">
                                                <button class="btn btn-bgku mt-30" type="submit">Daftar Anggota</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                @endif
                                @else 
                                    <center>
                                        <h3 class="text-warning">PENDAFTARAN DITUTUP</h3>
                                        <h4 class="text-white">Pendaftaran akan dibuka lain waktu</h4>
                                    </center>
                                @endif
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
              
                
            </div>

            
        </div>
    </section>





    <!-- ##### LINIMASA ###### -->
    <section class="miscellaneous-area bg-gray section-padding-100-0 pb-4" id="linimasa">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section Heading -->
                    <div class="section-heading text-center pb-4 wow fadeInUp" data-wow-delay="100ms">
                        <div class="line"></div>
                        <p><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></p>
                        <h2>LINIMASA</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="container">
                        <div class="row mb-100">
                            <div class="col-md-12">
                                <div class="main-timeline">
                                    @foreach ($linimasa as $linimasa)
                                    <div class="timeline">
                                        <a href="#" class="timeline-content">
                                            <div class="timeline-year">
                                                {{ date('M',strtotime($linimasa->tgl_mulai)) }}
                                            </div>
                                            <p class="description">
                                                {{ date('d',strtotime($linimasa->tgl_mulai)) }}
                                                @if (!empty($linimasa->tgl_akhir))
                                                {{ date(' - d M',strtotime($linimasa->tgl_akhir)) }}
                                                @endif


                                            </p>
                                            <h3 class="title">{{ $linimasa->judul }}</h3>
                                            
                                            <div class="timeline-icon">{{ date('Y', strtotime($linimasa->tgl_mulai)) }}</div>
                                        </a>
                                    </div>
                                    @endforeach
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ##### KRITIK DAN SARAN ###### -->
    <section class="services-area section-padding-100-0" id="kritikdansaran">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section Heading -->
                    <div class="section-heading text-center pb-3 wow fadeInUp" data-wow-delay="100ms">
                        <div class="line"></div>
                        <P><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></P>
                        <h2>KRITIK DAN SARAN</h2>
                    </div>
                </div>
            </div>

            <div>
                <!-- Single Service Area -->
                
                <div class="contact---area">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12 col-lg-8 mb-5 py-5 px-4 borderku">

                                @if ($tutupPesan==true)
                                <center>
                                    <h2 class="text-warning">PESAN TELAH TERKIRIM</h2>
                                    <h4 class="text-white">Terima kasih telah memberikan masukan</h4>
                                    <h5 class="text-danger">Aspirasi 1x perhari</h5>
                                </center>
                                @else
                                <!-- Contact Area -->
                                <div class="contact-form-area contact-page mb-4">
    
                                    <form action="{{ route('aspirasi.user') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control text-dark text-capitalize text-bold @error('namaPesan')
                                                    invalidku
                                                @enderror" name="namaPesan" placeholder="Nama">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input type="number" class="form-control text-dark text-capitalize text-bold @error('waPesan')
                                                    invalidku
                                                @enderror" name="waPesan" placeholder="Nomor Whatsapp (opsional))">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input type="email" class="form-control text-dark text-bold @error('emailPesan')
                                                    invalidku
                                                @enderror" name="emailPesan" placeholder="email : example@email.com">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <textarea name="pesanPesan" class="form-control text-dark text-bold @error('pesanPesan')
                                                    invalidku
                                                @enderror" cols="30" rows="10" placeholder="Pesan.."></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 text-right">
                                                <button class="btn btn-bgku mt-30" type="submit">Kirim Pesan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @endif
                            </div>

                            
                            <div class="col-12 col-lg-4">
                                <div class="row">
                                    <!-- Single Service Area -->
                                    <div class="col-12">
                                        <div class="single-service-area d-flex mb-4 wow fadeInUp" data-wow-delay="200ms">
                                            <div class="icon bg-danger">
                                                <i class="fa fa-times"></i>
                                            </div>
                                            <div class="text">
                                                <h5>Pemberitahuan!</h5>
                                                <p>Pastikan pesan yang dikirim tidak menggunakan kata-kata kotor, rasis dan menjatuhkan orang lain.</p>
                                            </div>
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


    @if ($cekDonasi > 0)
    <div id="activeDonasi">
        <div class="tombolclosedonasi" onclick="matikanDonasi()">
            <p><i class="fa fa-close"></i></p>
        </div>
        <div class="donasiJudul">
            <p>DONASI</p>
        </div>
        <div class="donasiku">
            <marquee behavior="" direction="" onMouseOver="this.stop()" onMouseOut="this.start()">
                <p>
                    @foreach ($donasi as $donasi)
    
                    @php
                        $bankcek = DB::table('bank')->where('id_donasi',$donasi->id)->count();
                    @endphp
                    @if ($bankcek > 0)
                        <b>{{ $donasi->judul }} </b>
                        <i class="fa fa-genderless px-2"></i>
                        {{ date('d',strtotime($donasi->tgl_mulai)) }} 
                        {{ date(' - d F',strtotime($donasi->tgl_selesai)) }}
                        {{ date(' Y',strtotime($donasi->tgl_selesai)) }}
                        <i class="fa fa-genderless px-2"></i>
                        @if (!empty($donasi->judul))
                        Dana Terkumpul : Rp
                        @endif{{ number_format($donasi->total,0,',','.') }} 
                        <i class="fa fa-genderless px-2"></i>
                        Anda dapat menyalurkan melalui bank berikut : &nbsp;
                        
                        @php
                            $bank = DB::table('bank')->where('id_donasi',$donasi->id)->get();
                        @endphp
                        @foreach ($bank as $bank)
                        {{ $bank->bank }}&nbsp; : &nbsp;<span>{{ $bank->rekening }}</span> | {{ strtoupper($bank->nama) }} <i class="fa fa-genderless px-2"></i>
                        
                        @endforeach
                        
                        &emsp;&emsp;
                        
                    @endif
                    
                        
                    @endforeach
        
                </p>
            </marquee>
        </div>
    </div>
    @endif


    <script>
        function matikanDonasi() {
            document.getElementById('activeDonasi').style.display='none';
        }
    </script>
    

    
    
    <!-- ##### Miscellaneous Area End ###### -->

    <!-- ##### MAPS ###### -->
    <section class="newsletter-area py-2 bg-img jarallax" id="kontak">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-4">
                    
                </div>
                <div class="col-12 col-lg-8">
                    
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Newsletter Area End ###### -->
@endsection




