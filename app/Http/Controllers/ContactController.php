<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\CatePost;
use App\Slider;
use App\Contact;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();



class ContactController extends Controller
{
    public function lien_he(Request $request){
        
        //seo 
        $meta_desc          = "Liên hệ"; 
        $meta_keywords      = "Liên hệ";
        $meta_title         = "Liên hệ chúng tôi";
        
        $url_canonical      = $request->url();
        //--seo
        
		$contact            =    Contact::where('info_id' , 1)    ->get();

    	return         view('pages.lienhe.contact')
    	
                            	->with('meta_desc'         ,   $meta_desc)
                            	->with('meta_keywords'     ,   $meta_keywords)
                            	->with('meta_title'        ,   $meta_title)
                            	->with('url_canonical'     ,   $url_canonical)
                            	
                            	->with('contact'           ,   $contact);
    }
    
    
    public function information(){
        
    	$contact       =    Contact    ::where('info_id'   ,   1)      ->first();

    	
    	return         view('admin.information.add_information')      ->with('cont' , $contact);
    	
//    	->with(compact('contact'));
    }
    
    
    
    
    public function update_info(Request $request,$info_id){
        
    	$data                      =    $request->all();
    	
    	$contact                   =    Contact::find($info_id);
    	
    	$contact->info_contact     =    $data['info_contact'];	
    	$contact->info_map         =    $data['info_map'];
    	$contact->info_fanpage     =    $data['info_fanpage'];	
    	
    	
    	$get_image                 =    $request->file('info_image');
    	
    	$path                      =    'public/uploads/contact/';
    	
    	if($get_image){
    	
    	    unlink($path.  $contact->info_logo);
    		
    	    $get_name_image        =    $get_image     ->getClientOriginalName();
    	    
            $name_image            =    current(    explode('.'     ,   $get_name_image));
            
            $new_image             =    $name_image     .rand(0,99).     '.'     .$get_image ->getClientOriginalExtension();
            
            $get_image      ->move($path    ,   $new_image);
            
            $contact        ->info_logo     =    $new_image;
    	}

    	$contact           ->save();
    	
    	return             redirect()  ->back()    ->with('message'    ,   'Cập nhật thông tin website thành công');
    }
    
    
    
    
    
    public function save_info(Request $request){
        
    	$data = $request->all();
    	
    	$contact = new Contact();
    	
    	$contact->info_contact = $data['info_contact'];	
    	$contact->info_map     = $data['info_map'];
    	$contact->info_fanpage = $data['info_fanpage'];	
    	
    	$get_image = $request->file('info_image');
    	
    	$path = 'public/uploads/contact/';
    	
    	if($get_image){
    		$get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $contact->info_logo = $new_image;
    	}

    	$contact->save();
    	
    	return redirect()  ->back()    ->with('message','Cập nhật thông tin website thành công');

    }
}
