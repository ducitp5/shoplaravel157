<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    
    protected $table        =    'tbl_order_details';
    
    protected $primaryKey   =    'order_details_id';
    
    
    protected $fillable     =    [   'order_code'                ,    'product_id'       ,  'product_name'      ,   'product_price'     ,  
        
                                     'product_sales_quantity'    ,   'product_coupon'    ,   'product_feeship'
    ];
    
    
    public $timestamps      =    false; //set time to false

    
 	public function product(){
 	    
 		return $this     ->belongsTo('App\Product'    ,   'product_id');
 	}
}
