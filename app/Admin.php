<?php

namespace App;

use App\DucClass\mySql\myModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Request;



class Admin extends  Authenticatable        // Model
{
    
    protected $table         =    'tbl_admin';
        
    protected $primaryKey    =    'admin_id';
    
    protected $fillable      =    [   'admin_email'   ,  'admin_password'   ,  'admin_name'   ,   'admin_phone'   ];
    
    
    public    $timestamps    =    false;            //set time to false
       
 	

 	public function roles(){
 	    
 	    $query    =    $this   ->belongsToMany('App\Roles');
 	    
 //	    consolelog('Admin::roles 34');
 //	    consolelog(   myModel::getSql($query)); 
 	    
 	    return       $query;   // tbl_roles
 	}
 	

 	public function getAuthPassword(){
 	
 	    return       $this->admin_password;
 	}
 	
 	
 	
 	
 	public function hasAnyRoles($roles){
 	
 	    $result    =   $this   ->roles()
 	    
 	                           ->whereIn('name'    ,   $roles)   ->first()  ;
 	    
 	                           
        consolelog( myModel::getSql($result) );
        
 	    consolelog('Admin.php 41');
 	    
 	    
 	    $query2   =    $this  ->roles()
 	    
 	                          ->whereIn('name'    ,   $roles)    ; 	    
    
 	    consolelog('p55');
 	     	    
 	    consolelog(   myModel::getSql($query2)); 
 	    
        consolelog('65');
        
 	    
 	    return    null   !==   $result;
 	}
 	
 	
 	public function hasRole($role){
 		
 //	    consolelog('123');
/*  	    consolelog2( $this  ->roles()
 	        
 	        ->where('name'      ,   $role)      ->first());
  */	    
 	    return    null   !==   $this  ->roles()
 	    
 	                                  ->where('name'      ,   $role)      ->first();
 	}
 	
 	 	
}
