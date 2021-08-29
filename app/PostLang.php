<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use app\DucClass\mySql\myModel;

class PostLang extends Model
{
   
    protected $table            =    'tbl_posts';
    
    protected $primaryKey       =    'post_id';
    
    protected $fillable         =    [ 	'post_title'        ,   'post_slug'     ,  'post_desc'   ,   'post_content'    ,   'post_meta_desc'    ,
        
                                        'post_meta_keywords',   'post_status'   ,  'post_image'  ,   'cate_post_id'
                                     ];
    
 	

 	public    $timestamps       =    false; //set time to false
 	
 	
 	public function lang(){
 	     	    
 	    $query    =   $this   ->belongsToMany('App\Lang');	     
 	        
 //	    consolelog(myModel::getSql( $query));
 	        
 	    return        $query;   // tbl_lang
 	}
 	
 	
 	public function hasLang($lang){
 	    
 //	    consolelog(myModel::getSql( $this   ->belongsToMany('App\Lang')));
 	    
 	    return    null  !==   $this->lang()   ->where('name' , $lang) ->first();
 	}
 	
 	
 	public function cate_post(){
 	    
 	    $query    =   $this     ->belongsTo('App\CatePost'   ,   'cate_post_id');
 	    
 //	    consolelog(myModel::getSql( $query));
 	    
 	    return        $query;
 	}
 	
}
