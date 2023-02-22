<?php

namespace App\Http\Controllers;

use App\Models\visidanmisi;
use Illuminate\Http\Request;

class visimisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cek = visidanmisi::count();
        $tampil = visidanmisi::first();
        return view('pagesServer.opsiVisiDanMisi',[
            'ketemu' =>$cek,
            'tampil' =>$tampil
        ]);
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
        $request->validate([
            'gambar' => 'required',
            'visi' => 'required',
            'misi' => 'required'
        ]);

        try {
            if ($request->hasFile('gambar')) {
                $originName = $request->file('gambar')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('gambar')->getClientOriginalExtension();

                $format = strtolower($extension);
                if($format == 'jpg' || $format == 'jpeg' || $format == 'png') {
                    $fileName = $fileName.'_'.time().'.'.$extension;
                }else {
                    return redirect('opsiVisiDanMisi')->with('toast_error','Pastikan yang diinputkan adalah gambar dengan format jpg, jpeg atau png!');
                }
            }
           
            $visi = $request->visi;
            $visi = trim($visi);
            $visi = stripslashes($visi);
            $visi = htmlspecialchars($visi);

            $misi = $request->misi;
            $misi = trim($misi);
            $misi = stripslashes($misi);
            $misi = htmlspecialchars($misi);

            $tambah = new visidanmisi;
            $tambah->gambar = $fileName;
            $tambah->visi = $visi;
            $tambah->misi = $misi;
            $tambah->save();

            if ($tambah) {
                if ($request->hasFile('gambar')) {
                    $upload = $request->file('gambar')->move(\base_path() ."/public/images/visidanmisi", $fileName);
                }
                
                return redirect('opsiVisiDanMisi')->with('toast_success','Data berhasil ditambahkan');
            }else {
                return redirect('opsiVisiDanMisi')->with('toast_error','Data gagal ditambahkan');

            }

        } catch (\Throwable $th) {
            return redirect('opsiVisiDanMisi')->with('toast_error','Terjadi Kesalahan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\visidanmisi  $visidanmisi
     * @return \Illuminate\Http\Response
     */
    public function show(visidanmisi $visidanmisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\visidanmisi  $visidanmisi
     * @return \Illuminate\Http\Response
     */
    public function edit(visidanmisi $visidanmisi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\visidanmisi  $visidanmisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, visidanmisi $visidanmisi, $id)
    {
        $request->validate([
            'visi' => 'required',
            'misi' => 'required'
        ]);

        try {
            if ($request->hasFile('gambar')) {
                $originName = $request->file('gambar')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('gambar')->getClientOriginalExtension();
    
                $format = strtolower($extension);
                if($format == 'jpg' || $format == 'jpeg' || $format == 'png') {
                    $fileName = $fileName.'_'.time().'.'.$extension;
                }else {
                    $gambarLama = $visidanmisi->first();
                    $fileName = $gambarLama->gambar;
                }
            }else {
                $gambarLama = $visidanmisi->first();
                $fileName = $gambarLama->gambar;
            }
           
            $visi = $request->visi;
            $visi = trim($visi);
            $visi = stripslashes($visi);
            $visi = htmlspecialchars($visi);
    
            $misi = $request->misi;
            $misi = trim($misi);
            $misi = stripslashes($misi);
            $misi = htmlspecialchars($misi);

            $update = $visidanmisi->where('id',$id)->update([
                'gambar' => $fileName,
                'visi' => $visi,
                'misi' => $misi
            ]);

            if ($update) {
                if ($request->hasFile('gambar')) {
                    $upload = $request->file('gambar')->move(\base_path() ."/public/images/visidanmisi", $fileName);
                }
                
                return redirect('opsiVisiDanMisi')->with('toast_success','Data berhasil ditambahkan');
            }else {
                return redirect('opsiVisiDanMisi')->with('toast_error','Data gagal ditambahkan');

            }

        } catch (\Throwable $th) {
            return redirect('opsiVisiDanMisi')->with('toast_error','Terjadi Kesalahan!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\visidanmisi  $visidanmisi
     * @return \Illuminate\Http\Response
     */
    public function destroy(visidanmisi $visidanmisi)
    {
        //
    }
}
