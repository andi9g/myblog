<?php

namespace App\Http\Controllers;

use App\Models\postingan;
use App\Models\anggota;
use App\Models\slideGambar;
use App\Models\visidanmisi;
use App\Models\dokumentasi;
use App\Models\Linimasa;
use App\Models\pesan;
use App\Models\pendaftaran;
use App\Models\calonanggota;
use App\Models\programstudi;
use App\Models\donasi;
use App\Models\bank;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class halamanController extends Controller
{

    public function bacaPostingan($judul)
    {
        try {
            //code...
            $judul = str_replace('.BEM','',$judul);
            $judul = str_replace('_',' ',$judul);
    
            $postingan = postingan::where('judul',$judul)->first();
    
            $postinganTerbaru = postingan::join('anggota','anggota.nim','=','postingan.penulis')
            ->select('postingan.id','postingan.judul','postingan.created_at','anggota.nama','anggota.posisi','postingan.gambar_utama')
            ->orderBy('id','DESC'
            )->take(4)
            ->get();
    
            $penulis = anggota::where('nim',$postingan->penulis)->first();
    
            return view('pagesClient/bacaPostingan', [
                'postingan' => $postingan,
                'judul' => $postingan->judul,
                'penulis'=>$penulis,
                'terbaru' => $postinganTerbaru
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('/postingan');
        }
    }

    function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'IP tidak dikenali';
        return $ipaddress;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postingan = postingan::orderBy('id','DESC')->take(4)->get();

        $slide = slideGambar::orderBy('id','DESC')->take(4)->get();

        $dokumentasi = dokumentasi::orderBy('id','DESC')->take(4)->get();

        $visidanmisi = visidanmisi::first();

        $ketua = anggota::where('jabatan','ketua')->get();
        $wakil = anggota::where('jabatan','wakil')->get();
        $sekertaris = anggota::where('jabatan','sekertaris')->get();
        $bendahara = anggota::where('jabatan','bendahara')->get();
        $mentridalamnegri = anggota::where('jabatan','mentri dalam negri')->get();
        $mentriluarnegri = anggota::where('jabatan','mentri luar negri')->get();
        $mentrikomunikasidaninformasi = anggota::where('jabatan','mentri komunikasi dan informasi')->get();
        $mentripenelitiandanpengembangan = anggota::where('jabatan','mentri penelitian dan pengembangan')->get();


        // linimasa
        $linimasa = Linimasa::leftJoin('anggota','anggota.id','=','linimasa.id_anggota')
        ->select('anggota.nama','linimasa.*')
        ->orderBy('linimasa.tgl_mulai','ASC')
        ->get();

        //pendaftaran
        $cekPendaftaran = pendaftaran::first();
        $cekPendaftaran = empty($cekPendaftaran->pendaftaran)?'close':$cekPendaftaran->pendaftaran;


        //telah mendaftar
        $ip = $this->get_client_ip();
        $server = $_SERVER['HTTP_USER_AGENT'];
        $perangkat = $ip."_".$server;
        $telahmendaftar = calonanggota::where('perangkat',$perangkat)->count();

        //tutup pesan
        $cekPesan = pesan::where('perangkat',$perangkat)->orderBy('id','DESC')->take(1)->count();
        $tutupPesan = false;
        if($cekPesan==1) {
            $ambilPesan = pesan::where('perangkat',$perangkat)->orderBy('id','DESC')->first();
            $pesan_kiriman = strtotime(date('Y-m-d',strtotime($ambilPesan->created_at)));
            $pesan_sekarang = strtotime(date('Y-m-d'));
            if($pesan_kiriman>=$pesan_sekarang) {
                $tutupPesan = true;
            }
        }

        $programstudi = programstudi::get();

        
        //donasi
        $donasi = donasi::get();
        $cekDonasi = donasi::join('bank','bank.id_donasi','=','donasi.id')->count();


        //title and footer 
        $web = DB::table('web')->first(); 

        return view('pagesClient/halaman',[
            'postingan' => $postingan,
            'slide' => $slide,
            'visidanmisi' => $visidanmisi,
            'dokumentasi' => $dokumentasi,
            'ketua' => $ketua,
            'wakil' => $wakil,
            'sekertaris' => $sekertaris,
            'bendahara' => $bendahara,
            'mentridalamnegri' => $mentridalamnegri,
            'mentriluarnegri' => $mentriluarnegri,
            'mentrikomunikasidaninformasi' => $mentrikomunikasidaninformasi,
            'mentripenelitiandanpengembangan' => $mentripenelitiandanpengembangan,
            'linimasa' => $linimasa,
            'cekPendaftaran' => $cekPendaftaran,
            'telahmendaftar' => $telahmendaftar,
            'tutupPesan' => $tutupPesan,
            'jurusan' => $programstudi,
            'donasi' => $donasi,
            'cekDonasi' => $cekDonasi,
            'web' => $web
        ]);
    }

    public function dokumentasi(Request $request)
    {
        $tampil = dokumentasi::when($request->keyword, function($query) use ($request){
            $query->where('judul','like',"%{$request->keyword}%");
        })->orderBy('id','DESC')
        ->paginate($request->limit ? $request->limit : 8);

        $tampil->appends($request->only('keyword','limit'));

        return view('pagesClient/halamanDokumentasi', [
            'dokumentasi' => $tampil
        ]);
    }


    public function postingan(Request $request)
    {
        $tampil = postingan::when($request->keyword, function($query) use ($request){
            $query->where('postingan.judul','like',"%{$request->keyword}%")
                ->orWhere('postingan.created_at','like',"%{$request->keyword}%")
                ->orWhere('anggota.nama','like',"%{$request->keyword}%")
                ->orWhere('tag','like',"%{$request->keyword}%");
        })->join('anggota','anggota.nim','=','postingan.penulis')
        ->select('postingan.*')
        ->orderBy('postingan.id','DESC')
        ->paginate($request->limit ? $request->limit : 10);

        $tampil->appends($request->only('keyword','limit'));

        return view('pagesClient/halamanPostingan',[
            'postingan' => $tampil
        ]);
    }

    public function saran(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'namaPesan' => 'required',
            'emailPesan' => 'required',
            'pesanPesan' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/#kritikdansaran')->with('toast_warning','Pastikan melengkapi form dengan benar!')
                        ->withErrors($validator)
                        ->withInput();
        }

        try {
            //code...
            $ip = $this->get_client_ip();
            $server = $_SERVER['HTTP_USER_AGENT'];
            $perangkat = $ip.'_'.$server;

            $cek = pesan::where('perangkat',$perangkat)->count();
            $ambil = pesan::where('perangkat',$perangkat)->orderBy('id','DESC')->first();

            if($cek > 0){
                $hari_kiriman = strtotime(date('Y-m-d',strtotime($ambil->created_at)));
                $hari_ini = strtotime(date('Y-m-d'));
                if (($hari_kiriman==$hari_ini)) {
                    return redirect('/#kritikdansaran')->with('warning','1 hari hanya dapat mengirim 1 kritik dan saran..');
                }
            }

            $nama = $request->namaPesan;
            $wa = $request->waPesan;
            $email = $request->emailPesan;
            $pesan = $request->pesanPesan;

            $tambah = new pesan;
            $tambah->nama = $nama;
            $tambah->wa = $wa;
            $tambah->email = $email;
            $tambah->pesan = $pesan;
            $tambah->perangkat = $perangkat;
            $tambah->save();

            if($tambah) {
                return redirect('/#kritikdansaran')->with('toast_success','Pesan telah dikirim, Terima kasih');
            }
        } catch (\Throwable $th) {
            return redirect('/#kritikdansaran')->with('toast_error','Terjadi Kesalahan!!');
        }
    }
    
    
    public function daftar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nim' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'wa' => 'required',
            'email' => 'required',
            'alasan' => 'required',
            'tempatlahir' => 'required',
            'tanggallahir' => 'required',
            'jeniskelamin' => 'required',
            'programstudi' => 'required',
            'semester' => 'required',
            'motohidup' => 'required',
            'asalsekolah' => 'required',
            'pasfoto' => 'required',
            'selfie' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/#pendaftaran')->with('warning','Pastikan mengisi form dengan benar!')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        try {
            $ip = $this->get_client_ip();
            $server = $_SERVER['HTTP_USER_AGENT'];
            $perangkat = $ip.'_'.$server;

            $cek = calonanggota::where('perangkat',$perangkat)->count();

            if($cek > 0){
                return redirect('/#pendaftaran')->with('warning','Perangkat ini telah melakukan pendaftaran!');
            }

            $nim = $request->nim;
            $nama = $request->nama;
            $alamat = $request->alamat;
            $hp = $request->wa;
            $email = $request->email;
            $pesan = $request->alasan;

            $tempatlahir = $request->tempatlahir;
            $tanggallahir = $request->tanggallahir;
            $jeniskelamin = $request->jeniskelamin;
            $programstudi = $request->programstudi;
            $semester = $request->semester;
            $motohidup = $request->motohidup;
            $asalsekolah = $request->asalsekolah;
            $asalsekolah = $request->asalsekolah;
            

            $cekProgramstudi = programstudi::where('id',$programstudi)->count();
            if(!($cekProgramstudi==1)) {
                return redirect('/#pendaftaran')->with('warning','Terjadi Pelanggaran!');
            }


            if($request->hasFile('pasfoto') && $request->hasFile('selfie')) {
               
                $gambar_pasfoto = $request->file('pasfoto');
                $gambar_selfie = $request->file('selfie');

                //pasfoto
                $nama_gambar_pasfoto = $gambar_pasfoto->getClientOriginalName();
                $format_pasfoto = $gambar_pasfoto->getClientOriginalExtension();
                $format_cek_pasfoto = strtolower($format_pasfoto);
                $size_pasfoto = $gambar_pasfoto->getSize();

                //selfie
                $nama_gambar_selfie = $gambar_selfie->getClientOriginalName();
                $format_selfie = $gambar_selfie->getClientOriginalExtension();
                $format_cek_selfie = strtolower($format_selfie);
                $size_selfie = $gambar_selfie->getSize();
                
                $pasfoto = $nama_gambar_pasfoto.'_'.time().'.'.$format_pasfoto;
                $selfie = $nama_gambar_selfie.'_'.time().'.'.$format_selfie;
                
                if(($format_cek_pasfoto == 'jpg' || $format_cek_pasfoto == 'jpeg' || $format_cek_pasfoto == 'png') && ($format_cek_selfie == 'jpg' || $format_cek_selfie == 'jpeg' || $format_cek_selfie == 'png') ){
                    
                    if ($size_pasfoto <= 2097152 && $size_selfie <= 2097152) {
                        
                        $upload1 = $gambar_pasfoto->move(\base_path() ."/public/images/profile", $pasfoto);
                        $upload2 = $gambar_selfie->move(\base_path() ."/public/images/selfie", $selfie);
                        if($upload1 && $upload2){
                            $tambah = new calonanggota;
                            $tambah->nim = $nim;
                            $tambah->nama = $nama;
                            $tambah->alamat = $alamat;
                            $tambah->hp = $hp;
                            $tambah->email = $email;
                            $tambah->pesan = $pesan;
                            $tambah->perangkat = $perangkat;
                            $tambah->tempatlahir = $tempatlahir;
                            $tambah->tanggallahir = $tanggallahir;
                            $tambah->jeniskelamin = $jeniskelamin;
                            $tambah->programstudi = $programstudi;
                            $tambah->semester = $semester;
                            $tambah->motohidup = $motohidup;
                            $tambah->asalsekolah = $asalsekolah;
                            $tambah->pasfoto = $pasfoto;
                            $tambah->selfie = $selfie;
                            $tambah->save();

                            if($tambah) {
                                return redirect('/#pendaftaran')->with('success','Anda telah berhasil mendaftar');
                            }
                        }
                    }else {
                        return redirect('/#pendaftaran')->with('toast_warning', 'Ukuran Maximal 2Mb!');
                    }                
                }else {
                    return redirect('/#pendaftaran')->with('toast_warning', 'Format bukan gambar!');
                }
        
            }

        } catch (\Throwable $th) {
            //throw $th;
            return redirect('/#pendaftaran')->with('toast_error','Terjadi Pelanggaran!!');
        }

 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\postingan  $postingan
     * @return \Illuminate\Http\Response
     */
    public function show(postingan $postingan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\postingan  $postingan
     * @return \Illuminate\Http\Response
     */
    public function edit(postingan $postingan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\postingan  $postingan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, postingan $postingan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\postingan  $postingan
     * @return \Illuminate\Http\Response
     */
    public function destroy(postingan $postingan)
    {
        //
    }
}
