<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;

class CheckDatosUsuario
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
        if (Auth::check()) {
            // return redirect()->route('perfil.index'); 
        } else {
            return $next($request);
        }
        
        return $next($request);
    }
}
