<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;
use Closure;

class AdminDucAuth
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
        if( Session::get('DucAuth')){
            
            return $next($request);
        }
     
        return      redirect('/duc-login-auth');
    }
}
