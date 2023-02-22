<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GerbangSuperAdmin
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
        if($request->session()->get('posisi')=='admin' || $request->session()->get('nim')=='4321'){
            return $next($request);
        }else {
            return redirect('home')->with('toast_warning','Anda tidak memiliki akses');
        }
    }
}
