<?php

namespace App\Http\Controllers;

use App\Models\dokumentasi;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class dokumentasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tampil = dokumentasi::when($request->keyword, function($query) use ($request){
            $query->where('judul','like',"%{$request->keyword}%");
        })->orderBy('id','DESC')
        ->paginate($request->limit ? $request->limit : 8);

        $tampil->appends($request->only('keyword','limit'));

        return view('pagesServer.dokumentasi',[
            'dokumentasi' => $tampil
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pagesServer.tambahDokumentasi');
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
            'judul' => 'required'
        ]);

        // try {
            if ($request->hasFile('gambar')) {
                $originName = $request->file('gambar')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('gambar')->getClientOriginalExtension();
                $size = $request->file('gambar')->getSize();


                $format = strtolower($extension);
                if($format == 'jpg' || $format == 'jpeg' || $format == 'png') {
                    if($size <= 3500000) {
                        $fileName = $fileName.'_'.time().'.'.$extension;
                        $judul = $request->judul;
                    }else {
                        return redirect('/doc')->with('toast_success','Maksimal gambar berukuran 3,5Mb!');
                    }
                }else {
                    return redirect('/doc/create')->with('toast_error','Pastikan yang diinputkan adalah gambar dengan format jpg, jpeg atau png!');
                }

            }

            $tambah = new dokumentasi;
            $tambah->gambar = $fileName;
            $tambah->judul = $judul;
            $tambah->save();

            if($tambah) {
                if ($request->hasFile('gambar')) {
                    $upload = $request->file('gambar')->move(\base_path() ."/public/images/dokumentasi", $fileName);
                }
                return redirect('/doc')->with('toast_success','Slide berhasil ditambahkan!');
            }

        // } catch (\Throwable $th) {
        //     return redirect('/doc')->with('toast_error','Terjadi Kesalahan!');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\dokumentasi  $dokumentasi
     * @return \Illuminate\Http\Response
     */
    public function show(dokumentasi $dokumentasi)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\dokumentasi  $dokumentasi
     * @return \Illuminate\Http\Response
     */
    public function edit(dokumentasi $dokumentasi, $id)
    {
        $tampil = $dokumentasi->where('id', $id)->first();

        return view('pagesServer/editDokumentasi',[
            'tampil' => $tampil
        ]);   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\dokumentasi  $dokumentasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, dokumentasi $dokumentasi, $id)
    {
        $request->validate([
            'judul' => 'required'
        ]);

        try {
            $kosong = false;

            if ($request->hasFile('gambar')) {
                $originName = $request->file('gambar')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('gambar')->getClientOriginalExtension();
                $size = $request->file('gambar')->getSize();

                $format = strtolower($extension);
                if($format == 'jpg' || $format == 'jpeg' || $format == 'png') {
                    if($size <= 3500000){
                        $gambar = $fileName.'_'.time().'.'.$extension;
                    }else {
                        return redirect('/doc')->with('toast_success','Maksimal gambar berukuran 3,5Mb!');
                    }
                }else {
                    $kosong=true;
                }
            }else {
                $kosong=true;
            }

            $cek = $dokumentasi->where('id',$id)->first();
            if($kosong){
                $gambar = $cek->gambar;
            }else {
                if(!($cek->gambar == 'none.jpg')){
                    File::delete('images/dokumentasi/'.$cek->gambar);
                }
            }

            $judul = $request->judul;

            $update = $dokumentasi->where('id',$id)->update([
                'gambar' => $gambar,
                'judul' => $judul
            ]);

            if($update) {
                if ($request->hasFile('gambar')) {
                    $upload = $request->file('gambar')->move(\base_path() ."/public/images/dokumentasi", $gambar);
                }
                return redirect('/doc')->with('toast_success','Slide berhasil diupdate!');
            }
            
        } catch (\Throwable $th) {
            return redirect('/doc')->with('toast_error','Terjadi Kesalahan!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\dokumentasi  $dokumentasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(dokumentasi $dokumentasi, $id)
    {
        try {
            //code...
            $ambil = $dokumentasi->where('id',$id)->first();

            if(!($ambil->gambar == 'none.jpg')){
                File::delete('images/dokumentasi/'.$ambil->gambar);
            }

            $hapus = $dokumentasi->destroy($id);
            if($hapus) {
                return redirect('/doc')->with('toast_success','Slide berhasil dihapus!');
            }else {
                return redirect('/doc')->with('toast_error','Slide gagal dihapus!');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('/doc')->with('toast_error','Terjadi Kesalahan!');
        }
    }
}
