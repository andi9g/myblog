<?php

namespace App\Http\Controllers;

use App\Models\anggota;
use Illuminate\Http\Request;

class jabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $select = anggota::where('jabatan','none')->get();
        $ketua = anggota::where('jabatan','ketua')->get();

        $wakil = anggota::where('jabatan','wakil')->get();
        $sekertaris = anggota::where('jabatan','sekertaris')->get();
        $bendahara = anggota::where('jabatan','bendahara')->get();
        $mentridalamnegri = anggota::where('jabatan','mentri dalam negri')->get();
        $mentriluarnegri = anggota::where('jabatan','mentri luar negri')->get();
        $mentrikomunikasidaninformasi = anggota::where('jabatan','mentri komunikasi dan informasi')->get();
        $mentripenelitiandanpengembangan = anggota::where('jabatan','mentri penelitian dan pengembangan')->get();

        return view('pagesServer.opsiJabatan',[
            'select' => $select,
            'ketua' => $ketua,
            'wakil' => $wakil,
            'sekertaris' => $sekertaris,
            'bendahara' => $bendahara,
            'mentriDalamNegri' =>$mentridalamnegri,
            'mentriLuarNegri' =>$mentriluarnegri,
            'mentriKomunikasiDanInformasi' =>$mentrikomunikasidaninformasi,
            'mentriPenelitianDanPengembangan' =>$mentripenelitiandanpengembangan
        ]);
    }

    public function ketua(Request $request)
    {
        $request->validate([
            'ketua' => 'required'
        ]);

        try {
            $data = $request->ketua;
            $cek = anggota::where('jabatan','ketua')->count();

            if($cek>0){
                return redirect('/opsiJabatan')->with('toast_error','Hanya boleh 1 ketua!!');
            }

            $update = anggota::where('id',$data)->update([
                'jabatan' => 'ketua'
            ]);

            if($update) {
                return redirect('/opsiJabatan')->with('toast_success','data berhasil diupdate!');
            }

        }catch (\Throwable $th){
            return redirect('/opsiJabatan')->with('toast_error','Terjadi Kesalahan!');
        }
    }


    public function wakil(Request $request)
    {
        $request->validate([
            'wakil' => 'required'
        ]);

        try {
            $data = $request->wakil;

            $update = anggota::where('id',$data)->update([
                'jabatan' => 'wakil'
            ]);

            if($update) {
                return redirect('/opsiJabatan')->with('toast_success','data berhasil diupdate!');
            }

        }catch (\Throwable $th){
            return redirect('/opsiJabatan')->with('toast_error','Terjadi Kesalahan!');
        }
    }


    public function sekertaris(Request $request)
    {
        $request->validate([
            'sekertaris' => 'required'
        ]);

        try {
            $data = $request->sekertaris;

            $update = anggota::where('id',$data)->update([
                'jabatan' => 'sekertaris'
            ]);

            if($update) {
                return redirect('/opsiJabatan')->with('toast_success','data berhasil diupdate!');
            }

        }catch (\Throwable $th){
            return redirect('/opsiJabatan')->with('toast_error','Terjadi Kesalahan!');
        }
    }


    public function bendahara(Request $request)
    {
        $request->validate([
            'bendahara' => 'required'
        ]);

        try {
            $data = $request->bendahara;

            $update = anggota::where('id',$data)->update([
                'jabatan' => 'bendahara'
            ]);

            if($update) {
                return redirect('/opsiJabatan')->with('toast_success','data berhasil diupdate!');
            }

        }catch (\Throwable $th){
            return redirect('/opsiJabatan')->with('toast_error','Terjadi Kesalahan!');
        }
    }


    public function mentriDalamNegri(Request $request)
    {
        $request->validate([
            'mentriDalamNegri' => 'required'
        ]);

        try {
            $data = $request->mentriDalamNegri;

            $update = anggota::where('id',$data)->update([
                'jabatan' => 'mentri dalam negri'
            ]);

            if($update) {
                return redirect('/opsiJabatan')->with('toast_success','data berhasil diupdate!');
            }

        }catch (\Throwable $th){
            return redirect('/opsiJabatan')->with('toast_error','Terjadi Kesalahan!');
        }
    }


    public function mentriLuarNegri(Request $request)
    {
        $request->validate([
            'mentriLuarNegri' => 'required'
        ]);

        try {
            $data = $request->mentriLuarNegri;

            $update = anggota::where('id',$data)->update([
                'jabatan' => 'mentri luar negri'
            ]);

            if($update) {
                return redirect('/opsiJabatan')->with('toast_success','data berhasil diupdate!');
            }

        }catch (\Throwable $th){
            return redirect('/opsiJabatan')->with('toast_error','Terjadi Kesalahan!');
        }
    }


    public function mentriKomunikasiDanInformasi(Request $request)
    {
        $request->validate([
            'mentriKomunikasiDanInformasi' => 'required'
        ]);

        try {
            $data = $request->mentriKomunikasiDanInformasi;

            $update = anggota::where('id',$data)->update([
                'jabatan' => 'mentri komunikasi dan informasi'
            ]);

            if($update) {
                return redirect('/opsiJabatan')->with('toast_success','data berhasil diupdate!');
            }

        }catch (\Throwable $th){
            return redirect('/opsiJabatan')->with('toast_error','Terjadi Kesalahan!');
        }
    }


    public function mentriPenelitianDanPengembangan(Request $request)
    {
        $request->validate([
            'mentriPenelitianDanPengembangan' => 'required'
        ]);

        try {
            $data = $request->mentriPenelitianDanPengembangan;

            $update = anggota::where('id',$data)->update([
                'jabatan' => 'mentri penelitian dan pengembangan'
            ]);

            if($update) {
                return redirect('/opsiJabatan')->with('toast_success','data berhasil diupdate!');
            }

        }catch (\Throwable $th){
            return redirect('/opsiJabatan')->with('toast_error','Terjadi Kesalahan!');
        }
    }




    
    public function delete(Request $request, $id)
    {
        try {
            $update = anggota::where('id',$id)->update([
                'jabatan' => 'none'
            ]);

            if($update) {
                return redirect('/opsiJabatan')->with('toast_success','jabatan berhasil di cabut!');
            }
        } catch (\Throwable $th) {
            return redirect('/opsiJabatan')->with('toast_error','Terjadi Kesalahan!');
        }
    }
}
