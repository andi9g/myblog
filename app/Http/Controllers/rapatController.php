<?php

namespace App\Http\Controllers;

use App\Models\rapat;
use Illuminate\Http\Request;

class rapatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
            'rapat' => 'required',
            'ket' => 'required',
            'jam' => 'required',
            'tgl' => 'required',
            'tempat' => 'required'
        ]);
        
        try {
            $rapat = $request->rapat;
            $ket = $request->ket;
            $jam = $request->jam;
            $tgl = strtotime($request->tgl);
            $tempat = $request->tempat;
            $nim = $request->session()->get('nim');

            $tambah = new rapat;
            $tambah->rapat = $rapat;
            $tambah->ket = $ket;
            $tambah->jam = $jam;
            $tambah->tgl = $tgl;
            $tambah->tempat = $tempat;
            $tambah->nim = $nim;
            $tambah->save();

            if($tambah) {
                return redirect('home')->with('toast_success','Data berhasil ditambahkan..');
            }
        } catch (\Throwable $th) {
            return redirect('home')->with('toast_error','Terjadi kesalahan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\rapat  $rapat
     * @return \Illuminate\Http\Response
     */
    public function show(rapat $rapat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\rapat  $rapat
     * @return \Illuminate\Http\Response
     */
    public function edit(rapat $rapat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\rapat  $rapat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, rapat $rapat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\rapat  $rapat
     * @return \Illuminate\Http\Response
     */
    public function destroy(rapat $rapat, $id)
    {
        try {
            $delete = $rapat->destroy($id);
            if($delete) {
                return redirect('home')->with('toast_success','Jadwal Rapat Berhasil dihapus..');
            }
        } catch (\Throwable $th) {
            return redirect('home')->with('toast_error','Terjadi kesalahan!');
        }
    }
}
