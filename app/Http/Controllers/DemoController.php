<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;


class DemoController extends Controller
{
    public function suggestion(){
        
        return              view('demo.suggestion');
    }
    
    
    public function slider(){
        
        return              view('demo.slider');        
    }
    
    
    public function home(){                      
        
        return              view('demo.component.Demohome'); 
    }
    
    
    public function index(Request $request){
        
        $meta_desc          = "Chuyên bán những phụ kiện ,thiết bị game";
        $meta_keywords      = "thiet bi game,phu kien game,game phu kien,game giai tri";
        $meta_title         = "Phụ kiện,máy chơi game chính hãng";
        $url_canonical      = $request->url();
        //--seo
        
        
        return              view('demo.pages.home')      ->with('meta_desc'      ,$meta_desc)
                                                         ->with('meta_keywords'  ,$meta_keywords)
                                                         ->with('meta_title'     ,$meta_title)
                                                         ->with('url_canonical'  ,$url_canonical)  ; //1
                                                    
    }
    
  
}
