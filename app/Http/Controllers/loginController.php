<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\anggota;
use App\Models\sosialmedia;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function proses(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request->username;
        $password = $request->password;
        $anggota = anggota::where('nim', $username)->first();

        if($anggota){
            $pengecekan = $anggota->password;
            if (Hash::check($password, $pengecekan)) {
                $request->session()->put('nama', $anggota->nama);            
                $request->session()->put('nim', $anggota->nim);

                if($anggota->ket=='penulis'){
                    $request->session()->put('penulis', $anggota->ket);
                }else {
                    $request->session()->put('penulis', 'none');
                }
                
                $request->session()->put('posisi', $anggota->posisi);
                
                return redirect('/home')->with('toast_success', 'WELCOME');

            }else{
                return redirect('login')->with('toast_error','username atau password salah.');
            }

        }else{
            return redirect('login')->with('toast_error','username atau password salah.');
        }
    }




    public function logout(Request $request)
    {
        $request->session()->forget('nama');
        $request->session()->forget('nim');
        $request->session()->forget('posisi');
        $request->session()->forget('penulis');

        return redirect('login');
    }
}
