<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Lpl2;
use app\DucClass\mySql\myModel;
use shopbanhanglaravel\app\DucClass\mySql\myDB;

require_once 'app\DucClass\mySql\myDB.php';

class PostLang2 extends Model
{
   
    protected $table            =    'tbl_posts';
    
    protected $primaryKey       =    'post_id';
    
    protected $fillable         =    [ 	'post_title'        ,   'post_slug'     ,  'post_desc'   ,   'post_content'    ,   'post_meta_desc'    ,
        
                                        'post_meta_keywords',   'post_status'   ,  'post_image'  ,   'cate_post_id'
                                     ];
    
 	
    static      $i              =    0;
    
 	public    $timestamps       =    false ; //set time to false
 	
 	
 	public function getprikey(){
 	    
 	    return        $this->primaryKey;      // return       'post_id'
 	}
 	

 	
 	public function cate_post(){
 	    
 	    $query    =   $this     ->belongsTo('App\CatePost'   ,   'cate_post_id');
 	    
 	    DB::enableQueryLog();
 	  
 	    consolelog('pl42');
 	    
 	    ++$this::$i;              // ++self::$i;
 	    
 	    consolelog_json2('43 - ' .$this::$i  ,   DB::getQueryLog());
 	    
 	    consolelog('pl44');
 	    consolelog(myModel::getSql($query ) );      
 	     	    
 	    return        $query;
 	}
 	
 	
 	public static function Sql_cate_post(){ 	    
 	    
 	    $query    
 	    
 	          =    "select    * 

                    from        tbl_posts   ,     tbl_category_post 

                    where       tbl_posts.cate_post_id      =    tbl_category_post.cate_post_id  ";
 	
 	          
        return      myDB::executer($query);
 	}
 	
 	
 	public static function Sql_cate_post2($page_first_result , $results_per_page){
 	       
 	    
 	    $query      
 	    
 	          =    "select    *
 	    
                    from        tbl_posts   ,     tbl_category_post
                    
                    where       tbl_posts.cate_post_id      =    tbl_category_post.cate_post_id
                    
                 	LIMIT       $page_first_result    ,    $results_per_page";
 	    
 	          
 	    return      myDB::executer($query);
 	}
 	

 	public static function Sql_cate_post3($row , $rowperpage){
 	    
 	    
 	    $query
 	    
 	          =    "select    *
 	    
                    from        tbl_posts   ,     tbl_category_post
                    
                    where       tbl_posts.cate_post_id      =    tbl_category_post.cate_post_id
                    
                 	LIMIT       $row    ,    $rowperpage";        // start at $row , get  $rowperpage firsts rows
 	    
 	    
 	    return      myDB::executer($query);
 	}
 	
 	
 	 
 	
}
