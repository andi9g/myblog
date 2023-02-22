<?php

namespace App\Http\Controllers;

use File;
use App\Models\anggota;
use Hash;
use Illuminate\Http\Request;

class editProfile extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nim = $request->session()->get('nim');
        $tampil = anggota::where('nim',$nim)->first();

        return view('pagesServer.edit_profile',[
            'profile' => $tampil
        ]);
    }

    public function edit_gambar(Request $request)
    {
        $request->validate([
            'ubahGambar' => 'required'
        ]);

        try {    
            $nim = $request->session()->get('nim');
            $cek = anggota::where('nim', $nim)->first();

            if($cek->nim==$nim) {
                if($request->hasFile('ubahGambar')) {
                    $gambar = $request->file('ubahGambar');
                    $nama_gambar = $gambar->getClientOriginalName();
                    $format = $gambar->getClientOriginalExtension();
                    $format_cek = strtolower($format);
                    $size = $gambar->getSize();
                    $fileName = $nama_gambar.'_'.time().'.'.$format;
                    
                    if($format_cek == 'jpg' || $format_cek == 'jpeg' || $format_cek == 'png'){
                        
                        if ($size <= 2097152) {
                            if (!($cek->gambar == 'profile.png')) {
                                File::delete('images/profile/'.$cek->gambar);
                            }
    
                            $upload = $gambar->move(\base_path() ."/public/images/profile", $fileName);
                            if($upload){
                                $update = anggota::where('nim',$nim)->update([
                                    'gambar' => $fileName
                                ]);
                                if ($update) {
                                    return redirect('profile')->with('toast_success', 'Data  berhasil diupdate');
                                }
                            }
                        }else {
                            return redirect('profile')->with('toast_warning', 'Ukuran Maximal 2Mb!');
                        }                
                    }else {
                        return redirect('profile')->with('toast_warning', 'Format bukan gambar!');
                    }
            
                }
            }else {
                return redirect('profile')->with('toast_warning', 'Terjadi Kesalahan');
            }
            
        } catch (\Throwable $th) {
            return redirect('profile')->with('warning', 'terjadi kesalahan..');
        }
    }

    public function ubah_password(Request $request)
    {
        
        $message = ([
            'regex' => 'Terdapat karakter yang dilarang.'
        ]);
        $request->validate([
            'password1' => 'required|regex:/^\S*$/u',
            'password2' => 'required|regex:/^\S*$/u',
        ],$message);
        
        try {
            $nim = $request->session()->get('nim');
            $cek = anggota::where('nim', $nim)->first();

            $password1 = $request->password1;
            $password2 = $request->password2;
    
            if($cek->nim==$nim) {
                if ($password1 == $password2) {
                    $password = Hash::make($password1);
                    
                    $update = anggota::where('nim',$nim)->update([
                        'password' => $password
                    ]);
        
                    if ($update) {
                        $request->session()->forget('nama');
                        $request->session()->forget('nim');
                        $request->session()->forget('posisi');
                        $request->session()->forget('penulis');
                        return redirect('login')->with('success','Berhasil merubah password, silahkan login kembali');
                    }
        
                }else {
                    return redirect('profile')->with('toast_error','Gagal merubah password..');
                }

            }else {
                return redirect('profile')->with('toast_warning', 'Terjadi Kesalahan');
            }
            
        } catch (\Throwable $th) {
            return redirect('profile')->with('toast_warning','terjadi kesalahan');
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
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(admin $admin)
    {
        //
    }
}
