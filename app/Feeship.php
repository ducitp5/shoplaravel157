<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feeship extends Model
{
    
    protected $table            =    'tbl_feeship';
    
    protected $primaryKey       =    'fee_id';
    
    protected $fillable         =    [   'fee_matp'  , 'fee_maqh'   ,   'fee_xaid'   ,   'fee_feeship'   ];
    
    
    public $timestamps          =    false;         //set time to false
    
    
 	

 	public function city(){
 	    
 		return $this->belongsTo('App\City'        ,    'fee_matp');
 	}
 	
 	public function province(){
 	
 	    return $this->belongsTo('App\Province'    ,    'fee_maqh');
 	}
 	
 	public function wards(){
 		
 	    return $this->belongsTo('App\Wards'       ,    'fee_xaid');
 	}
}
