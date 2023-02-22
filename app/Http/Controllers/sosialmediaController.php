<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sosialmedia;

class sosialmediaController extends Controller
{
    public function index(Request $request) 
    {
        $id_admin = $request->session()->get('id_admin');
        $tampil = sosialmedia::where('id_admin', $id_admin)->first();

        return view('pagesServer.sosialmedia',[
            'sosialmedia' => $tampil
        ]);

    }


    public function update(Request $request)
    {
        $facebook = $request->facebook;
        $instagram = $request->instagram;
        $pinterest = $request->pinterest;
        $twitter = $request->twitter;
        $whatsapp = $request->whatsapp;
        $telpon = $request->telpon;

        $id_admin = $request->session()->get('id_admin');
        $cek = sosialmedia::where('id_admin',$id_admin)->count();

        if($cek == 1) {
            $sql = sosialmedia::where('id_admin',$id_admin)->update([
                'facebook' => $facebook,
                'instagram' => $instagram,
                'pinterest' => $pinterest,
                'twitter' => $twitter,
                'whatsapp' => $whatsapp,
                'telpon' => $telpon,
            ]);
        }else{
            $sql = sosialmedia::where('id_admin',$id_admin)->insert([
                'id_admin' => $id_admin,
                'facebook' => $facebook,
                'instagram' => $instagram,
                'pinterest' => $pinterest,
                'twitter' => $twitter,
                'whatsapp' => $whatsapp,
                'telpon' => $telpon,
            ]);
        }

        if ($sql) {
            return redirect('sosial_media')->with('toast_success','Data berhasil di update');
        }else{
            return redirect('sosial_media')->with('toast_error','Error..');
        }


    }
}
