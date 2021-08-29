<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lang extends Model
{
   
    protected $table            =    'tbl_lang';
    
    protected $primaryKey       =    'id_lang';
    
    
    protected $fillable         =    [ 	 'name'   ];
    
    public $timestamps          =    false; //set time to false
    
    
    public function post(){
        
        return              $this    ->belongsToMany('App\PostLang');
    }
    
 	
}
