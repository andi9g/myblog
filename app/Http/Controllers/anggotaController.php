<?php

namespace App\Http\Controllers;

use App\Models\anggota;
use Illuminate\Http\Request;
use Hash;

class anggotaController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tampil = anggota::when($request->keyword, function($query) use ($request){
            $query->where('nim','like',"%{$request->keyword}%")
            ->orWhere('nama','like',"%{$request->keyword}%");
        })->orderBy('id','desc')
        ->paginate($request->limit ? $request->limit : 10);

        $tampil->appends($request->only('keyword','limit'));
        return view('pagesServer.anggota', [
            'anggota' => $tampil
        ]);

    }
    
    public function ubahposisi(Request $request, $id)
    {
        try {
            $posisi = $request->posisi;

            if($posisi=='admin'){
                $update = anggota::where('id',$id)->update([
                    'posisi' => $posisi,
                    'ket' => 'penulis'
                ]);
            }else {
                $update = anggota::where('id',$id)->update([
                    'posisi' => $posisi
                ]);
            }

            if ($update) {
                return redirect('anggota')->with('toast_success','Data terupdate!');
            }
            
        } catch (\Throwable $th) {
            return redirect('anggota')->with('toast_error','Terjadi kesalahan');
        }
    }

    public function ubahket(Request $request, $id)
    {
        try {
            $ket = $request->ket;

            $update = anggota::where('id',$id)->update([
                'ket' => $ket
            ]);
            
            if ($update) {
                return redirect('anggota')->with('toast_success','Data terupdate!');
            }
            
        } catch (\Throwable $th) {
            return redirect('anggota')->with('toast_error','Terjadi kesalahan');
        }
    }

    public function resetPassword(Request $request, $id)
    {
        try {
            $ambil = anggota::where('id',$id)->first();
            if($ambil->nim=='4321') {
                $password = Hash::make('admin'.date('Y'));
            }else {
                $password = Hash::make('anggotabaru'.date('Ymd',strtotime($ambil->created_at)));
            }

            if($request->session()->get('nim')=='4321') {
                $update = anggota::where('id',$id)->update([
                    'password' => $password
                ]);
            }else {
                $update = anggota::where('id',$id)->where('nim','!=','4321')->update([
                    'password' => $password
                ]);
            }

            if ($update) {
                return redirect('anggota')->with('toast_success','Data terupdate!');
            }else {
                return redirect('anggota')->with('toast_warning','Akun induk tidak dapat direset');
            }
        } catch (\Throwable $th) {
            return redirect('anggota')->with('toast_error','Terjadi kesalahan');
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
     * @param  \App\Models\anggota  $team
     * @return \Illuminate\Http\Response
     */
    public function show(anggota $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\anggota  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(anggota $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\anggota  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, anggota $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\anggota  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(anggota $team, $id)
    {
        try {
            $hapus = $team->destroy($id);
            if ($hapus) {
                return redirect('anggota')->with('toast_success','Data terupdate!');
            }else {
                echo "gagal";
            }
        } catch (\Throwable $th) {
            return redirect('anggota')->with('toast_error','Terjadi Kesalahan!');
        }
    }
}
