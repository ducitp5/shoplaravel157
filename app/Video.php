<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    
    protected $table            =    'tbl_videos';
    protected $primaryKey       =    'video_id';
    
    protected $fillable         =    [
                                    	'video_title'  ,  'video_link'  , 'video_desc'  ,  'video_slug'  ,  'video_image'
                                     ];
    
    
    public $timestamps          =    false;         //set time to false
}
