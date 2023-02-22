<?php

namespace App\Http\Controllers;

use App\Models\logo;
use App\Models\kontak;
use App\Models\sosialmedia;
use App\Models\programstudi;
use App\Models\setweb;
use Illuminate\Http\Request;
use File;

class pengaturanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logo = logo::first();
        $cekLogo = logo::count();
        $sosialmedia = sosialmedia::first();
        $kontak = kontak::first();
        $programstudi = programstudi::get();
        $web = setweb::first();

        return view('pagesServer.pengaturanLanjutan',[
            'logo' => $logo,
            'cekLogo' => $cekLogo,
            'sosialmedia' => $sosialmedia,
            'kontak' => $kontak,
            'jurusan' => $programstudi,
            'web' => $web
        ]);
    }

    public function hapusLogo($ket)
    {
        try {
            $cek = logo::first();
            
            $update = logo::where('id',$cek->id)->update([
                $ket => ''
            ]);
            File::delete('images/logo/'.$cek->$ket);
            if($update) {
                return redirect('opsiPengaturan')->with('toast_success', 'Update Sosial Media Berhasil');
            }else {
                return redirect('opsiPengaturan')->with('toast_error', 'Terjadi Kesalahan!!');
            }
            
        } catch (\Throwable $th) {
            return redirect('opsiPengaturan')->with('toast_error', 'Terjadi Kesalahan!!');
            
        }
        
        
    }

    public function logo(Request $request, $ket)
    {
        $message = [
            'required' => 'berkas tidak ada',
        ];
        $request->validate([
            $ket => 'required'
        ], $message);

       try {
           
            if($request->hasFile($ket)) {
                $gambar = $request->file($ket);
                $nama_gambar = $gambar->getClientOriginalName();
                $format = $gambar->getClientOriginalExtension();
                $format_cek = strtolower($format);
                $size = $gambar->getSize();
                $fileName = $nama_gambar.'_'.time().rand(0,500).'.'.$format;
                
                if($format_cek == 'jpg' || $format_cek == 'jpeg' || $format_cek == 'png'){
                    if ($size <= 2097152) {
                        $cek = logo::count();
                        $hapuslogo = logo::first();

                        if($cek==0) {
                            $proses = new logo;
                            $proses->$ket = $fileName;
                            $proses->save();
                        }else if($cek>0) {
                            if (!($hapuslogo->$ket == 'default.png' || $hapuslogo->$ket == '')) {
                                File::delete('images/logo/'.$hapuslogo->$ket);
                            }

                            $proses = logo::where('id',$hapuslogo->id)->update([
                                $ket => $fileName
                            ]);
                        }

                        if($proses){
                            $upload = $gambar->move(\base_path() ."/public/images/logo", $fileName);
                            if ($upload) {
                                return redirect('opsiPengaturan')->with('toast_success', 'Data  berhasil diupdate');
                            }else {
                                return redirect('opsiPengaturan')->with('toast_success', 'Gambar tidak berhasil diupload ke server');
                            }
                        }
                        
                    }else {
                        return redirect('opsiPengaturan')->with('toast_warning', 'Ukuran Maximal 2Mb!');
                    }                
                }else {
                    return redirect('opsiPengaturan')->with('toast_warning', 'Format bukan gambar!');
                }
            }
    
       }catch (\Throwable $th) {
            return redirect('opsiPengaturan')->with('toast_error', 'Terjadi Kesalahan');
       }
    }


    public function resetLogo()
    {
        try {
            $logo = logo::first();
            File::delete('images/logo/'.$logo->logo1);
            File::delete('images/logo/'.$logo->logo2);
            File::delete('images/logo/'.$logo->logo3);

            $delete = logo::truncate();
            if($delete) {
                return redirect('opsiPengaturan')->with('toast_success', 'Gambar logo berhasil direset');
            }
        } catch (\Throwable $th) {
            return redirect('opsiPengaturan')->with('toast_error', 'Terjadi Kesalahan');
        }
    }

    public function sosialmedia(Request $request)
    {
        try {
            sosialmedia::truncate();
            $facebook = $request->facebook;
            $instagram = $request->instagram;
            $twitter = $request->twitter;
            $pinterest = $request->pinterest;

            $tambah = new sosialmedia;
            $tambah->facebook = $facebook;
            $tambah->instagram = $instagram;
            $tambah->twitter = $twitter;
            $tambah->pinterest = $pinterest;
            $tambah->save();

            if($tambah){
                return redirect('opsiPengaturan')->with('toast_success', 'Update Sosial Media Berhasil');
            }
        } catch (\Throwable $th) {
            return redirect('opsiPengaturan')->with('toast_error', 'Terjadi Kesalahan');
        }
    }


    public function kontak(Request $request)
    {
        try {
            kontak::truncate();
            $hp = $request->hp;
            $wa = $request->wa;

            $tambah = new kontak;
            $tambah->hp = $hp;
            $tambah->wa = $wa;
            $tambah->save();

            if($tambah){
                return redirect('opsiPengaturan')->with('toast_success', 'Update Kontak Berhasil');
            }
        } catch (\Throwable $th) {
            return redirect('opsiPengaturan')->with('toast_error', 'Terjadi Kesalahan');
        }
    }


    public function programstudi(Request $request)
    {
        $request->validate([
            'jurusan' => 'required'
        ]);

        try {
            $jurusan = $request->jurusan;

            $tambah = new programstudi;
            $tambah->jurusan = $jurusan;
            $tambah->save();

            if($tambah) {
                return redirect('/opsiPengaturan')->with('toast_success','data berhasil diupdate!');
            }

        }catch (\Throwable $th){
            return redirect('/opsiPengaturan')->with('toast_error','Terjadi Kesalahan!');
        }
    }

    public function hapusJurusan($id)
    {
        try {
            $hapus = programstudi::destroy($id);
            if($hapus) {
                return redirect('/opsiPengaturan')->with('toast_success','data berhasil dihapus!');
            }
        } catch (\Throwable $th) {
            return redirect('/opsiPengaturan')->with('toast_error','Terjadi Kesalahan!');
            
        }
    }

    public function settingWeb(Request $request)
    {
       
        try {
            
            setweb::truncate();
            $title = $request->title;
            $footer = $request->footer;
            $maps = $request->maps;
            $api_key = $request->api_key;
            
            $proses = new setweb;
            $proses->title = $title;
            $proses->footer = $footer;
            $proses->map = $maps;
            $proses->api_key = $api_key;
            $proses->save();

            if($proses){
                return redirect('/opsiPengaturan')->with('toast_success','Settingan berhasil diupdate');
            }else {
                echo "asdasd";
            }

        } catch (\Throwable $th) {
           return redirect('/opsiPengaturan')->with('toast_error','Terjadi Kesalahan!');
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
     * @param  \App\Models\logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function show(logo $logo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function edit(logo $logo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, logo $logo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function destroy(logo $logo)
    {
        //
    }
}
