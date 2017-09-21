<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;
//use Illuminate\Http\Request;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
 
 
        
        if (Auth::guard($guard)->guest()){
           // return $next($request);
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                if($request->path()=="/")
                {
                    return redirect()->guest('login');
                }
                //echo "asd";die();
                return  $next($request);
           //     return redirect()->guest('login');
            }
        }
        // Redirect to login if not activate account
        if (Auth::user()->active) { 
            return $next($request);
        } else {
                Auth::logout();
                return back()->with('message', 'Debe Confirmar Correo Electronico para poder Ingresar al Sistema.'); 
        }

        return $next($request);
    }
}
