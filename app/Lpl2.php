<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lpl2 extends Model
{
   
    protected $table            =    'lang_post_lang_2';
    
    protected $primaryKey       =    'id';
    
    
    protected $fillable         =    [ 	 'post_id'   ,   'lang_id'   ];
    
    public $timestamps          =    false; //set time to false
    

    public function lang(){
        
        
        return       $this   ->belongTo('App\PostLang2'   ,   'post_id');   // tbl_lang
        
    }
    
    public function hasLang($langid){
        
        return    null  !==   $this->lang()   ->where('lang_id' , $langid) ->first();
    }
}
