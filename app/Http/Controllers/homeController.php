<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\postingan;
use App\Models\rapat;
use App\Models\anggota;
use App\Models\calonanggota;
use App\Models\kategori;

class homeController extends Controller
{
    public function index(Request $request)
    {
        $tampil = rapat::orderBy('tgl','DESC')
        ->where('tgl','>=',strtotime(date('Y-m-d')))->get();

        $anggota = anggota::where('nim','!=','4321')->count();

        $pendaftar = calonanggota::count();

        return view('pagesServer.home', [
            'rapat' => $tampil,
            'anggota' => $anggota,
            'calonanggota' => $pendaftar
        ]);
        
    }
}
