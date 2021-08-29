<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    
    protected $table        =    'tbl_brand';
    protected $primaryKey   =    'brand_id';
    
    
    
    protected $fillable     =    [ 	'brand_name'    ,    'brand_slug'   ,    'brand_desc'   ,   'brand_status'    ];
    
    public    $timestamps   =    false; //set time to false

}
