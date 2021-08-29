<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    
    protected   $table          =   'tbl_cart';
    
    protected   $primaryKey     =   'cart_id';
    
    protected   $fillable       =   [  	'customer_id'        ,   'sid'            ,   'product_id'     ,    'product_name'    ,    'product_price'    ,   
        
                                        'product_qty_get'    ,   'product_image'  ,    'date_add'      ,    'date_del'
                                    ];
   
    
    public      $timestamps     =    false; //set time to false
    
    
    
    public function is_produit_in_cart($id){
                
        $sId                 =    session_id();
        
        
        $result_check_cart   =    $this     ::where('product_id'    ,   $id) 
        
                                            ->where('sid'           ,   $sId)       ->get();        
        
        $msg                 =    false;
        
        if($result_check_cart){
            
            $msg        =       true;
        }
        
        return               $msg;
    }
    
    
    
    public function addProduct(array $data){
        
        
    }
}
