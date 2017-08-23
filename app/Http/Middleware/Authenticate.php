<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

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

        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
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
