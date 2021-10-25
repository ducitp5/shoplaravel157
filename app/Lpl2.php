<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lpl2 extends Model
{
   
    protected $table            =    'lang_post_2';
    
    protected $primaryKey       =    'id';
    
    
    protected $fillable         =    [ 	 'post_id'   ,   'lang_id'   ];
    
    public $timestamps          =    false; //set time to false
    

    public function post(){        
    //                                                      Post2            Lpl2  
        return       $this   ->hasOne('App\Post2'      ,   'post_id'   ,   'post_id');   // tbl_posts        
    }
    
    public function post2(){
    //                                                       Lpl2           Post2    
        return       $this   ->belongsTo('App\Post2'   ,   'post_id'   ,   'post_id');   // tbl_posts
    }
    
    
    public function lang(){
    //                                                   Lang2            Lpl2                                           
        return       $this   ->hasOne('App\Lang2'   ,   'id_lang'   ,   'lang_id');   // tbl_lang2      
    }
    
    
    public function lang2(){
        //                                                  Lpl2             Lang2
        return       $this   ->belongsTo('App\Lang2'   ,   'lang_id'   ,   'id_lang');   // tbl_lang2
    }
    
    
    public function hasLang($langid){
        
        return    null  !==   $this->lang()   ->where('lang_id' , $langid) ->first();
    }
}
