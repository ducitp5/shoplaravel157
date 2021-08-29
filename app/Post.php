<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   
    protected $table            =    'tbl_posts';
    
    protected $primaryKey       =    'post_id';
    
    protected $fillable         =    [ 	'post_title'        ,   'post_slug'      ,  'post_desc'   ,   'post_content'    ,
        
                                        'post_meta_desc'    ,   'post_meta_keywords',   'post_status'   ,  'post_image'  ,   'cate_post_id'
                                     ];
    
 	

 	public    $timestamps       =    false; //set time to false
 	
 	
 	public function cate_post(){
 	    
 		return $this     ->belongsTo('App\CatePost'   ,   'cate_post_id');
 	}
 	
}
