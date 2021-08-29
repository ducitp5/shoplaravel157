<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;


class IncludeController extends Controller
{

    
    public function leftside(){
        
        return              view('include.leftside');
    }
  
    
    public function header(){
        
        return              view('include.header');
    }
    
    
    public function slider(){
        
        return              view('include.slider');
    }
    
    
    
    public function adminheader(){
        
        return              view('admin.include.header');
    }
    
    
    public function adminaside(){
        
        return              view('admin.include.aside');
    }
}
