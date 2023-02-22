<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\anggota;
use Illuminate\Http\Request;

class gerbangBendahara
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $nim = $request->session()->get('nim');
        $ambilJabatan = anggota::where('nim',$nim)->first();

        if($ambilJabatan->jabatan=='bendahara' || $ambilJabatan->jabatan=='ketua' || $ambilJabatan->jabatan=='wakil' || $ambilJabatan->jabatan=='sekertaris') {
            return $next($request);
        }else {
            return redirect('home')->with('toast_warning','Anda tidak memiliki akses');
        }

    }
}
