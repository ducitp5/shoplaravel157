<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    
    protected $table        =    'tbl_roles';
    
    protected $primaryKey   =    'id_roles';    
    
    
    protected $fillable     =    [ 	 'name'   ];
    
    public $timestamps      =    false;                 //set time to false

    
 	public function admin(){
 	    
 		return              $this    ->belongsToMany('App\Admin');
 	}
 	
}
