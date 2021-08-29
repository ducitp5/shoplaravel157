<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
	
    protected $table        = 'tbl_statistical';
    
    protected $primaryKey   = 'id_statistical';
    
    
    protected $fillable     = [
        
    	'order_date'   ,  'sales'  ,  'profit'   ,   'quantity'  ,   'total_order'
    ];
   
 	
 	
 	public $timestamps = false; //set time to false
}
