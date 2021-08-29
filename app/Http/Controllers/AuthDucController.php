<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;



class AuthDucController extends Controller
{
    
    public static function AuthLogin(){
        
        $admin_id           =        Session::get('admin_id');
        
 //       setcookie ("member_login"  , Session::get('admin_id'),time()+ (10 * 365 * 24 * 60 * 60));
        
        //        if(isset($_COOKIE["member_login"]))
        
        if($admin_id  || isset($_COOKIE["admin_name"]) ){
            
//            return         Redirect::to('dashboard');
        }
        
        
//        else{                        return         Redirect::to('admin')->send();        }
    }
    
}