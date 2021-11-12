<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;
use Closure;

class AdminAuth
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
        if( Session::get('admin_name')){
            
            return $next($request);
        }
     
        return      redirect('/admin');
    }
}
