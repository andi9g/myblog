<?php

namespace App\Http\Controllers;

use App\Models\pendaftaran;
use App\Models\calonanggota;
use App\Models\anggota;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class pendaftaranController extends Controller
{

    public function openPendaftaran(Type $var = null)
    {
        try {
            $cek = pendaftaran::count();
            if($cek>0){
                $sql = pendaftaran::first();
                $ket = $sql->pendaftaran;
                $id = $sql->id;

                if($ket=='open'){
                    $ex = pendaftaran::where('id',$id)->update([
                        'pendaftaran'=>'close'
                    ]);
                    $pesan = 'DITUTUP';
                    $toast = 'toast_success';
                }else{
                    $ex = pendaftaran::where('id',$id)->update([
                        'pendaftaran'=>'open'
                    ]);
                    $pesan = 'DIBUKA';
                    $toast = 'toast_warning';
                }
            }else{
                $ex = new pendaftaran;
                $ex->pendaftaran = 'open';
                $ex->save();
                $pesan = 'DIBUKA';
                $toast = 'toast_warning';
            }

            if($ex) {
                return redirect('/pendaftaran')->with($toast,'Pendaftaran '.$pesan);
            }

        } catch (\Throwable $th) {
            return redirect('/pendaftaran')->with('toast_error','Terjadi Kesalahan');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(calonanggota $calon, Request $request)
    {
        // try {
            $calon = $calon->when($request->keyword, function($query) use ($request){
                $query->where('nim','like',"%{$request->keyword}%")
                    ->orWhere('nama','like',"%{$request->keyword}%");
            })->join('programstudi','programstudi.id','=','calonanggota.programstudi')
            ->select('programstudi.jurusan','calonanggota.*')
            ->orderBy('id','ASC')
            ->paginate($request->limit ? $request->limit : 15);

            $cek = pendaftaran::count();
            $ket = pendaftaran::first();
            $ket = empty($ket->pendaftaran)?'close':$ket->pendaftaran;
            return view('pagesServer.pendaftaran',[
                'calon' => $calon,
                'cek' => $cek,
                'ket' => $ket
            ]);
            
        // } catch (\Throwable $th) {
        //     echo $th;
        // }
    }



    public function angkatanggota(calonanggota $calon, anggota $anggota ,$id)
    {
        try {
            $ambil = $calon->where('id',$id)->first();
            $nim = $ambil->nim;
            $nama = $ambil->nama;
            $alamat = $ambil->alamat;
            $hp = $ambil->hp;
            $email = $ambil->email;
            $posisi = 'anggota';
            $password = Hash::make('anggotabaru'.date('Ymd',strtotime($ambil->created_at)));
            $ket = 'none';
            $jabatan = 'none';
            $gambar = $ambil->pasfoto;
            $tempatlahir = $ambil->tempatlahir;
            $tanggallahir = $ambil->tanggallahir;
            $jeniskelamin = $ambil->jeniskelamin;
            $programstudi = $ambil->programstudi;
            $semester = $ambil->semester;
            $motohidup = $ambil->motohidup;
            $asalsekolah = $ambil->asalsekolah;
            $selfie = $ambil->selfie;

            $tambah = new anggota;
            $tambah->nim = $nim;
            $tambah->nama = $nama;
            $tambah->alamat = $alamat;
            $tambah->hp = $hp;
            $tambah->email = $email;
            $tambah->posisi = $posisi;
            $tambah->password = $password;
            $tambah->ket = $ket;
            $tambah->jabatan = $jabatan;
            $tambah->gambar = $gambar;
            $tambah->tempatlahir = $tempatlahir;
            $tambah->tanggallahir = $tanggallahir;
            $tambah->jeniskelamin = $jeniskelamin;
            $tambah->programstudi = $programstudi;
            $tambah->semester = $semester;
            $tambah->motohidup = $motohidup;
            $tambah->asalsekolah = $asalsekolah;
            $tambah->selfie = $selfie;
            $tambah->save();

            if($tambah) {
                return redirect('/anggota')->with('toast_success','Data berhasil ditambahkan');
            }


        } catch (\Throwable $th) {
            return redirect('/pendaftaran')->with('toast_error','Terjadi Kesalahan!!');
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
     * @param  \App\Models\pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function show(pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function edit(pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(calonanggota $daftar, $id)
    {
        try {
            $hapus = $daftar->destroy($id);
            if($hapus) {
                return redirect('/pendaftaran')->with('toast_success','Data berhasil dihapus');
            }
        } catch (\Throwable $th) {
            return redirect('/pendaftaran')->with('toast_error','Terjadi Kesalahan!!');
        }
        
    }
}
