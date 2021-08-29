<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    
    protected $table        =    'tbl_quanhuyen';
    
    protected $primaryKey   =    'maqh';
    
    
    protected $fillable     =    [   'name_quanhuyen'   ,  'type'   ,  'matp'   ];
    
    
    public $timestamps      =    false; //set time to false
    
   
 	
}
