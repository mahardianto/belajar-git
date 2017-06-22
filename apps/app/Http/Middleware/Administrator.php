<?php

namespace App\Http\Middleware;

use Closure;

//ngambil session
use Auth;

class Administrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      $level = Auth::user()->level;
      if ($level!='') {
          return redirect('/home')->with('error', 'Maaf anda tidak memiliki hak akses untuk aksi ini');
      }
      return $next($request);
    }
}
