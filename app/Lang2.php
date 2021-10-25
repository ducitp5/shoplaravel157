<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lang2 extends Model
{
   
    protected $table            =    'tbl_lang2';
    
    protected $primaryKey       =    'id_lang';
    
    
    protected $fillable         =    [ 	 'name'   ];
    
    public $timestamps          =    false; //set time to false
    
    
//     public function post(){
        
//         return              $this    ->belongsToMany('App\Post2');
//     }
    
    
    public function lang(){
        
        return              $this    ->hasMany('App\Lpl2' , 'lang_id');
    }
    
    
    public function post(){
        
        return              $this    ->hasManyThrough('App\Post2' , 'App\Lpl2' , 'lang_id' ,  'post_id'   );
    }
    
    
 	
}
