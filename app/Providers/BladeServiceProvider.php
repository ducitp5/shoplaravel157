<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Admin;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('hasrole'  ,  function($expression){ 
            
            if(Auth::user()){
                
                if(Auth::user()     ->hasAnyRoles($expression)){
                    
                    return true;
                }
            }
            
//                          Admin extend    Model

            if(Session::get('DucAuth')){       
                
                var_dump(Session::get('dbbAuth')); 
                var_dump(Session::get('DucAuth'));
                
 //               echo   json_encode(Session::get('dbbAuth'));
                
                
        /*         consolelog("he lo");
                consolelog1(Session::get('dbbAuth'));
                consolelog11(Session::get('dbbAuth'));
                
                consolelog("byeee 1");
                consolelog2(Session::get('dbbAuth'));
                
                
                consolelog("DucAuth");
                consolelog11(Session::get('DucAuth'));               
 */               
                consolelog("byeee");
                consolevar(Session::get('DucAuth'));
                 
                
                
                if(  Session::get('DucAuth')  ->hasAnyRoles($expression)  ){
                    
                    return true;
                } 
//                return true;
            }
            
            return false;
        });
        
        
        Blade::if('impersonate',function(){
            
            if(session()->get('impersonate')){
            
                return true;
            }
            return false;
        });
    }
}
