<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table        =    'tbl_infomation';
    
    protected $primaryKey   =    'info_id';
    
    protected $fillable     =    [   	'info_contact'    ,   'info_map'   ,  'info_logo'     ,   'info_fanpage'    ];
    
 	
    public    $timestamps   =    false; //set time to false
}
