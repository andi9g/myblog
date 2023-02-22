<?php

namespace App\Http\Controllers;

use App\Models\slideGambar;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class slideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tampil = slideGambar::when($request->keyword, function($query) use ($request){
            $query->where('judul','like',"%{$request->keyword}%")
                ->orWhere('pesan','like',"%{$request->keyword}%");
        })->orderBy('id','DESC')
        ->paginate($request->limit ? $request->limit : 5);
        
        return view('pagesServer/opsiSlide',[
            'slide' => $tampil
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pagesServer/opsiTambahSlide');
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
            'gambar_utama' => 'required',
            'judul' => 'required',
            'pesan' => 'required'
        ]);

        try {
            if ($request->hasFile('gambar_utama')) {
                $originName = $request->file('gambar_utama')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('gambar_utama')->getClientOriginalExtension();
                $size = $request->file('gambar_utama')->getSize();

                $format = strtolower($extension);
                if($format == 'jpg' || $format == 'jpeg' || $format == 'png') {
                    if($size <=2505000){
                        $fileName = $fileName.'_'.time().'.'.$extension;
                        $judul = $request->judul;
                        $pesan = $request->pesan;
                    }else {
                        return redirect('/opsiSlide/create')->with('toast_error','Pastikan gambar berukuran maximal 2,5Mb');
                    }
                    
                }else {
                    return redirect('/opsiSlide/create')->with('toast_error','Pastikan yang diinputkan adalah gambar dengan format jpg, jpeg atau png!');
                }

            }

            $tambah = new slideGambar;
            $tambah->gambar = $fileName;
            $tambah->judul = $judul;
            $tambah->pesan = $pesan;
            $tambah->save();

            if($tambah) {
                if ($request->hasFile('gambar_utama')) {
                    $upload = $request->file('gambar_utama')->move(\base_path() ."/public/images/slide", $fileName);
                }
                return redirect('/opsiSlide')->with('toast_success','Slide berhasil ditambahkan!');
            }

        } catch (\Throwable $th) {
            return redirect('/opsiSlide')->with('toast_error','Terjadi Kesalahan!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\slideGambar  $slideGambar
     * @return \Illuminate\Http\Response
     */
    public function show(slideGambar $slideGambar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\slideGambar  $slideGambar
     * @return \Illuminate\Http\Response
     */
    public function edit(slideGambar $slideGambar, $id)
    {
        $tampil = $slideGambar->where('id', $id)->first();

        return view('pagesServer/editOpsiSlide',[
            'tampil' => $tampil
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\slideGambar  $slideGambar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, slideGambar $slideGambar, $id)
    {
        $request->validate([
            'judul' => 'required',
            'pesan'=> 'required'
        ]);

        try {
            $kosong = false;

            if ($request->hasFile('gambar_utama')) {
                $originName = $request->file('gambar_utama')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('gambar_utama')->getClientOriginalExtension();
                $size = $request->file('gambar_utama')->getSize();

                $format = strtolower($extension);
                if($format == 'jpg' || $format == 'jpeg' || $format == 'png') {
                    if($size<= 2505000){
                        $gambar = $fileName.'_'.time().'.'.$extension;
                    }else {
                        $kosong=true;
                    }
                }else {
                    $kosong=true;
                }
            }else {
                $kosong=true;
            }

            $cek = $slideGambar->where('id',$id)->first();
            if($kosong){
                $gambar = $cek->gambar;
            }else {
                File::delete('images/slide/'.$cek->gambar);
            }

            $judul = $request->judul;
            $pesan = $request->pesan;

            $update = $slideGambar->where('id',$id)->update([
                'gambar' => $gambar,
                'judul' => $judul,
                'pesan' => $pesan
            ]);

            if($update) {
                if ($request->hasFile('gambar_utama')) {
                    $upload = $request->file('gambar_utama')->move(\base_path() ."/public/images/slide", $gambar);
                }
                return redirect('/opsiSlide')->with('toast_success','Slide berhasil diupdate!');
            }
            
        } catch (\Throwable $th) {
            return redirect('/opsiSlide')->with('toast_error','Terjadi Kesalahan!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\slideGambar  $slideGambar
     * @return \Illuminate\Http\Response
     */
    public function destroy(slideGambar $slideGambar, $id)
    {
        try {
            //code...

            $ambil = $slideGambar->where('id',$id)->first();
            File::delete('images/slide/'.$ambil->gambar);

            $hapus = $slideGambar->destroy($id);
            if($hapus) {
                return redirect('/opsiSlide')->with('toast_success','Slide berhasil dihapus!');
            }else {
                return redirect('/opsiSlide')->with('toast_error','Slide gagal dihapus!');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('/opsiSlide')->with('toast_error','Terjadi Kesalahan!');
        }
    }
}
