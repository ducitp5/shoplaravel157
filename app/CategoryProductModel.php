<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryProductModel extends Model
{
    
    protected   $table          =   'tbl_category_product';
    
    protected   $primaryKey     =   'category_id';
    
    protected   $fillable       =   [  	'category_id'       ,   'meta_keywords'     ,    'category_name'    ,    'slug_category_product'    ,   
        
                                        'category_desc'     ,   'category_parent'   ,   'category_status'   ,       'category_order'
                                    ];
   
    
    public function product(){
    
        return $this->hasMany('App\Product');
    }
    
    public      $timestamps     =    false; //set time to false
}
