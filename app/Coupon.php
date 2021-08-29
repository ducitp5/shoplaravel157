<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table        =    'tbl_coupon';
   
    protected $primaryKey   =    'coupon_id';
    
    protected $fillable     =    [  'coupon_name'   ,    'coupon_time'    ,    'coupon_condition'     ,    'coupon_number'   ,    'coupon_code'     ];
    
    public  $timestamps     =    false; //set time to false
    
   
 	
}
