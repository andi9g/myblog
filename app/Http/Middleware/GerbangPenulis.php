<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\anggota;

class GerbangPenulis
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
        if ($request->session()->get('penulis')=='penulis') {
            return $next($request);
        }else {
            return redirect('home')->with('toast_warning','Anda tidak memiliki akses');
        }
    }
}
