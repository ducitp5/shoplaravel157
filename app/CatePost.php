<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use app\DucClass\mySql\myModel;

class CatePost extends Model
{
    
    protected   $table          =   'tbl_category_post';
    
    protected   $primaryKey     =   'cate_post_id';
    
    protected   $fillable       =   [  'cate_post_name'  , 'cate_post_status'   ,   'cate_post_slug'    ,   'cate_post_desc'    ];
    
    
    public      $timestamps     =    false;          //set time to false
        

 	public function post(){
 	
 	    $query    =    $this     ->hasMany('App\Post');
 	    
 	    consolelog("cp 25");
 	    
 	    consolelog(myModel::getSql($query));
 	    
 	    
        return    $query;
 	}
}
