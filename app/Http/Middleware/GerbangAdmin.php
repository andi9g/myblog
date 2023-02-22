<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\anggota;

class GerbangAdmin
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
        try {
            if($request->session()->get('nim')==!NULL){
                $nim = $request->session()->get('nim');
                $ambil = anggota::where('nim', $nim)->first();
        
                $request->session()->put('posisi', $ambil->posisi);
                $request->session()->put('penulis', $ambil->ket);
            }else {
                return redirect('/login')->with('toast_warning','Silahkan Login!!');
            }
        
        

        if ($request->session()->get('posisi')=='admin' || $request->session()->get('posisi')=='anggota') {
            return $next($request);
        }else {
            return redirect('/login')->with('toast_warning','Silahkan Login!!');
        }

        } catch (\Throwable $th) {
            return redirect('/login')->with('toast_warning','Silahkan Login!!');
        }
    }
}
