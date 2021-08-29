<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolesUser extends Model
{
    
    protected $table        =    'tbl_role_user';
    
    protected $primaryKey   =    'id_role_user';
    
    protected $fillable     =    [  'role_id'   ,   'admin_id'  ,   'role_id'   ];
    
    
    
    public $timestamps      =    false; //set time to false
   
 	
}
