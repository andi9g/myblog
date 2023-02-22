<?php

namespace App\Http\Controllers;

use App\Models\pesan;
use Illuminate\Http\Request;

class aspirasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tampil = pesan::when($request->keyword, function($query) use ($request){
            $query->where('pesan','like',"%{$request->keyword}%")
            ->orWhere('nama','like',"%{$request->keyword}%");
        })->orderBy('id','DESC')
        ->paginate($request->limit ? $request->limit : 10);

        return view('pagesServer.aspirasi',[
            'aspirasi' => $tampil
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pesan  $pesan
     * @return \Illuminate\Http\Response
     */
    public function show(pesan $pesan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pesan  $pesan
     * @return \Illuminate\Http\Response
     */
    public function edit(pesan $pesan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pesan  $pesan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pesan $pesan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pesan  $pesan
     * @return \Illuminate\Http\Response
     */
    public function destroy(pesan $pesan, $id)
    {
        try {
            $hapus = $pesan->destroy($id);
            if($hapus) {
                return redirect('/aspirasi')->with('toast_success','Pesan telah dihapus..');
            }
        } catch (\Throwable $th) {
            return redirect('/aspirasi')->with('toast_success','Terjadi Kesalahan!!');
        }
    }
}
