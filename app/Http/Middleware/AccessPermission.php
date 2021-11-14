<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;



class AccessPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    
    
    public function handle($request     ,    Closure $next)
    {   
        if(Session::get('DucAuth')){
            
            if(Hasrole(['admin','author'] , Session::get('Role'))){
             
                return      $next($request);
            }
            else{
                return      redirect()->back()->with('message' , 'you dont have the permission');
            }
        }
                
        if( !Auth::user() ){
        
            return      redirect('login-auth')->with('message' , 'you must login as an administor to continu');
        } 
        
        if(Auth::user()->hasAnyRoles(['admin' , 'author'])){
            
            return      $next($request);
        }
                
        Session::put('message' ,  'you dont have the permission go into this site');
        
        return      redirect('/dashboard');
         
        
        return      $next($request);
      
    }
}
