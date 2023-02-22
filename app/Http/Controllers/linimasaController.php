<?php

namespace App\Http\Controllers;

use App\Models\Linimasa;
use App\Models\anggota;
use Illuminate\Http\Request;

class linimasaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tampil = Linimasa::when($request->keyword, function($query) use ($request){
            $query->where('linimasa.judul','like',"%{$request->keyword}%");
        })->leftJoin('anggota','anggota.id','=','linimasa.id_anggota')
        ->select('anggota.nama','linimasa.*')
        ->orderBy('linimasa.tgl_mulai','ASC')
        ->paginate($request->limit ? $request->limit : 10);

        

        $tampil->appends($request->only('keyword','limit'));

        return view('pagesServer.opsiLinimasa', [
            'linimasa' => $tampil
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $anggota = anggota::orderBy('nama','ASC')->get();
        return view('pagesServer.opsiTambahLinimasa',[
            'anggota' => $anggota
        ]);
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
            'tgl_mulai' => 'required'
        ]);

        try {
            $judul = $request->judul;
            $tgl_mulai = $request->tgl_mulai;
            $tgl_akhir = empty($request->tgl_akhir)?'':$request->tgl_akhir;
            $id_anggota = empty($request->id_anggota)?'':$request->id_anggota;

            $tambah = new Linimasa;
            $tambah->judul = $judul;
            $tambah->tgl_mulai = $tgl_mulai;
            $tambah->tgl_akhir = $tgl_akhir;
            $tambah->id_anggota = $id_anggota;
            $tambah->save();

            if($tambah) {
                return redirect('/opsiLinimasa')->with('toast_success','Data berhasil ditambahkan!');
            }
        } catch (\Throwable $th) {
            return redirect('/opsiLinimasa')->with('toast_error','Terjadi kesalahan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Linimasa  $linimasa
     * @return \Illuminate\Http\Response
     */
    public function show(Linimasa $linimasa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Linimasa  $linimasa
     * @return \Illuminate\Http\Response
     */
    public function edit(Linimasa $linimasa, $id)
    {
        $linimasa = $linimasa->where('id',$id)->first();
        $anggota = anggota::orderBy('nama','ASC')->get();

        return view('pagesServer.opsiEditLinimasa',[
            'linimasa' => $linimasa,
            'anggota' => $anggota
        ]);

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Linimasa  $linimasa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Linimasa $linimasa, $id)
    {
        $request->validate([
            'judul' => 'required',
            'tgl_mulai' => 'required'
        ]);

        try {
            $judul = $request->judul;
            $tgl_mulai = $request->tgl_mulai;
            $tgl_akhir = empty($request->tgl_akhir)?'':$request->tgl_akhir;
            $id_anggota = empty($request->id_anggota)?'':$request->id_anggota;

            $update = $linimasa->where('id', $id)->update([
                'judul' => $judul,
                'tgl_mulai' => $tgl_mulai,
                'tgl_akhir' => $tgl_akhir,
                'id_anggota' => $id_anggota
            ]);
            

            if($update) {
                return redirect('/opsiLinimasa')->with('toast_success','Data berhasil diupdate!');
            }
        } catch (\Throwable $th) {
            return redirect('/opsiLinimasa')->with('toast_error','Terjadi kesalahan!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Linimasa  $linimasa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Linimasa $linimasa, $id)
    {
        try {
            
            $hapus = $linimasa->destroy($id);

            if($hapus) {
                return redirect('/opsiLinimasa')->with('toast_success','Data berhasil dihapus!');
            }

        } catch (\Throwable $th) {
            return redirect('/opsiLinimasa')->with('toast_error','Terjadi kesalahan!');
        }
    }
}
