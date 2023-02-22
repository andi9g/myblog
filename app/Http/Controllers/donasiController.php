<?php

namespace App\Http\Controllers;

use App\Models\donasi;
use App\Models\bank;
use Illuminate\Http\Request;

class donasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tampil = donasi::when($request->keyword, function($query) use ($request){
            $query->where('judul','like',"%{$request->keyword}%");
        })->orderBy('id','DESC')
        ->paginate($request->limit ? $request->limit : 5);

        $tampil2 = bank::when($request->keyword2, function($query) use ($request){
            $query->where('nama','like',"%{$request->keyword2}%")
            ->orWhere('donasi.judul','like',"%{$request->keyword2}%");
        })->join('donasi','donasi.id','=','bank.id_donasi')
        ->select('donasi.judul','bank.*')
        ->orderBy('id','DESC')->get();


        $tampilList = donasi::where('ket','none')->get();

        $tampil->appends($request->only('keyword','limit'));

        return view('pagesServer.donasi',[
            'donasi' => $tampil,
            'bank' => $tampil2,
            'listdonasi' => $tampilList
        ]);
    }

    public function hapusbank(Request $request, $id)
    {
        try {
            $delete = bank::destroy($id);
            if ($delete) {
                return redirect('/donasi')->with('toast_success', 'Data transfer berhasil dihapus');
            }
        } catch (\Throwable $th) {
            return redirect('/donasi')->with('toast_error', 'Terjadi Kesalahan');
        }
    }

    public function tambahBank(Request $request)
    {
        $request->validate([
            'id_donasi' => 'required',
            'rekening' => 'required',
            'bank' => 'required',
            'nama' => 'required'
        ]);
        try {
            $bank = $request->bank;
            $id_donasi = $request->id_donasi;
            $rekening = $request->rekening;
            $nama = $request->nama;

            $tambah = new bank;
            $tambah->bank = $bank;
            $tambah->rekening = $rekening;
            $tambah->nama = $nama;
            $tambah->id_donasi = $id_donasi;
            $tambah->save();

            if ($tambah) {
                return redirect('/donasi')->with('toast_success', 'Data donasi ditampilkan di halaman web');
            }
        } catch (\Throwable $th) {
            return redirect('/donasi')->with('toast_error', 'Terjadi Kesalahan');
        }
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'judul' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'total' => 'required',
        ]);

        try {
            $judul = $request->judul;
            $tgl_mulai = $request->tgl_mulai;
            $tgl_selesai = $request->tgl_selesai;
            $total = $request->total;
            $ket = 'none';

            $tambah = new donasi;
            $tambah->judul = $judul;
            $tambah->tgl_mulai = $tgl_mulai;
            $tambah->tgl_selesai = $tgl_selesai;
            $tambah->total = $total;
            $tambah->ket = $ket;
            $tambah->save();

            if ($tambah) {
                return redirect('/donasi')->with('toast_success', 'Penggalangan baru berhasil di tambahkan!');
            }

        } catch (\Throwable $th) {
            return redirect('/donasi')->with('toast_error', 'Terjadi Kesalahan!');
        }
    }


    public function donasiselesai($id)
    {
        try {
            $update = donasi::where('id',$id)->update([
                'ket' => 'selesai'
            ]);
            bank::where('id_donasi',$id)->delete();
            if ($update) {
                return redirect('/donasi')->with('toast_success', 'Donasi telah diakhiri');
            }
        } catch (\Throwable $th) {
            return redirect('/donasi')->with('toast_error', 'Terjadi Kesalahan!');
        }
    }
    

    public function updatedonasi(Request $request, $id)
    {
        try {
            $cek = donasi::where('id',$id)->first();
            if($cek->ket=='selesai') {
                return redirect('/donasi')->with('toast_error', 'Terjadi Kesalahan!');
            }

            $total = $request->total;
            $update = donasi::where('id', $id)->update([
                'total' => $total
            ]); 
            if ($update) {
                return redirect('/donasi')->with('toast_success', 'Angggaran Terupdate');
            }
            
        } catch (\Throwable $th) {
            return redirect('/donasi')->with('toast_error', 'Terjadi Kesalahan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\donasi  $donasi
     * @return \Illuminate\Http\Response
     */
    public function show(donasi $donasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\donasi  $donasi
     * @return \Illuminate\Http\Response
     */
    public function edit(donasi $donasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\donasi  $donasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, donasi $donasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\donasi  $donasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(donasi $don, $id)
    {
        try {
            $cek = $don->where('id',$id)->first();
            if($cek->ket=='selesai') {
                return redirect('/donasi')->with('toast_error', 'Terjadi Kesalahan!');
            }
            $hapus = donasi::destroy($id);
            $hapus2 = bank::where('id_donasi',$id)->delete();
            if($hapus) {
                return redirect('/donasi')->with('toast_success', 'Penggalangan baru berhasil di tambahkan!');
            }
        } catch (\Throwable $th) {
            return redirect('/donasi')->with('toast_error', 'Terjadi Kesalahan!');
        }
    }
}
