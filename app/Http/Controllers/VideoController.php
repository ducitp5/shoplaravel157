<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Video;

use App\CatePost;
use App\Slider;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
session_start();


class VideoController extends Controller
{
    
    public function video_shop(Request $request){
        
        //seo
        $meta_desc          =    "Video công ty TNHH một thành viên hiếushop";
        $meta_keywords      =    "thiết bị chơi game,thiet bi choi game";
        $meta_title         =    "Videos HiếuShop";
        
        $url_canonical      =    $request->url();
        //--seo
                
        
        $all_video          =    DB::table('tbl_videos')        ->paginate(6);
        
        
        return          view('pages.video.video')        
                           
                            ->with('meta_desc'          ,   $meta_desc)
                            ->with('meta_keywords'      ,   $meta_keywords)
                            ->with('meta_title'         ,   $meta_title)
                            ->with('url_canonical'      ,   $url_canonical)
                            
                            ->with('all_video'          ,   $all_video)
                        ;         
    }
    
    
    public function watch_video(Request $request){
        
        $video_id                   =    $request->video_id;
        
        $video                      =    Video::find($video_id);
        
        $output['video_title']      =    $video->video_title;
        $output['video_desc']       =    $video->video_desc;
        
        // $output['video_link'] = '<iframe width="100%" height="400" src="https://www.youtube.com/embed/'.$video->video_link.'?rel=0&modestbranding=1&autohide=1&showinfo=0&controls=0" frameborder="0" allowfullscreen" frameborder="0" allowfullscreen></iframe>';
                                                        
                                                            
        $output['video_link']       =   '<video  id                   ="my_yt_video"
					                             class                ="vlite-js"
					                             data-youtube-id      ="'.$video->sub_link.'">
					                     </video>';
        
        
        echo json_encode($output);
        
    }
    
    
    
    public function AuthLogin(){
        
        $admin_id = Session::get('admin_id');
        
        
        if($admin_id){            return Redirect::to('dashboard');        }
        
        else{                     return Redirect::to('admin')->send();    }
    }
    
    
    public function add_video(){
                
        return              view('admin.video.add_video');
    }
    
    
    public function list_video(){
        
        $all_video          =    DB::table('tbl_videos')        ->paginate(6);
        
        return      view('admin.video.list_video')
        
                        ->with(compact('all_video'));
    }
    
    
    public function edit_videoo(){
        
        $video      =    Video::find(3); 
        
        return           view('admin.video.edit_video')
        
                            ->with(compact('video'));
    } 
    
    
    public function edit_video($id){
        
        $video      =    Video::find($id);
        
        return           view('admin.video.edit_video')
        
                            ->with(compact('video'));
    } 

    
    
    public function update_video(Request $request){
        
        $data           =    $request->all();
        
        $video_id       =    $data['video_id'];
        
        $video          =    Video::find($video_id);
        
        
        $video->video_title     =    $data['video_title'];
        $video->video_slug      =    $data['video_slug'];
        $video->video_link      =    $data['video_link'];
        
        $video->video_desc      =    $data['video_desc'];
//        $video->video_image     =    $data['video_image'];
        $video->status          =    $data['status'];
        
        $get_image                  = $request->file('video_imagee');
        
        if($get_image){
            
            $get_name_image         = $get_image->getClientOriginalName(); //lay ten của hình ảnh
            
            $name_image             = current(explode('.',$get_name_image));
            
            $new_image              = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            
            $get_image->move('public/uploads/video'  ,   $new_image);
            
            $video->video_image       = $new_image;
            
            $video->save();
            
            Session::put('message','Thêm Video thành công');
            
            return      Redirect::to('list-video');
        }
/*         else{
            Session::put('message','Làm ơn thêm hình ảnh');
            
            return redirect()->back();
        } */

        $video->save();
                        
        return      Redirect::to('list-video')
        
                        ->with('message' , 'video saved success');
    }
    
    
    
    public function update_direct_video(Request $request){
        
        $data               =    $request->all();
        
        $video_id           =    $data['video_id'];        
        $video_colum_name   =    $data['video_check'];
        $video_edit         =    $data['video_edit'];
        
        $video              =    Video::find($video_id);
        
        if($video_colum_name  ==  'video_title'){
            
            $video->video_title     =    $video_edit;
            
        }
        elseif($video_colum_name  ==  'video_desc'){
            
            $video->video_desc      =    $video_edit;
            
        }
        elseif($video_colum_name  ==  'video_link'){
            
            $video->video_link      =    substr($video_edit, 17);
                                
        }
        else{
            
            $video->video_slug = $video_edit;
            
        }
        $video->save();
    }
    
    
    public function update_video_image(Request $request){
        
        $get_image     =    $request->file('file');
        
                
        if($get_image){
        
            $video_id           =    $request->video_id;
            
            $video              =    Video::find($video_id);
            
            unlink('public/uploads/videos/'.$video->video_image);
            
            $get_name_image     =    $get_image->getClientOriginalName();
            
            $name_image         =    current(explode('.',$get_name_image));
            
            $new_image          =    $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        
            $get_image  ->move('public/uploads/videos'   ,   $new_image);
            
            $video->video_image = $new_image;
            
            $video->save();
            
        }
    }
    
   
    
    
    public function insert_video(Request $request){
        
    	$data                  =    $request->all();
    	
    	$video                 =    new Video();
    	
//    	$sub_link              =    substr($data['video_link'], 23 );
    	
    	$video->video_title    =    $data['video_title'];
    	$video->video_slug     =    $data['video_slug'];
    	$video->video_link     =    $data['video_link'];
    	$video->sub_link       =    substr($data['video_link'], 32 , 11);
    	$video->video_desc     =    $data['video_desc'];
    	
    	echo "<script> console.log('full link : '" .$video->video_link.")</script>";
    	
    	
    	
    	$get_image             =    $request->file('file');
    	
    	if($get_image){
    	    
    		$get_name_image         =    $get_image   ->getClientOriginalName();
    		
            $name_image             =    current(explode('.'  ,  $get_name_image));
            
            $new_image              =    $name_image    
                                            .rand(0,99)     
                                            .'.'    
                                            .$get_image     ->getClientOriginalExtension();
      
            $get_image              ->move('public/uploads/videos'  ,  $new_image);
        
            $video->video_image     =    $new_image;
    	}
    	
    	$video->save();
    }
    
    
    public function delete_video_get($id){
                
        $video         =    Video::find($id);
        
        if($video->video_image)
            
            unlink('public/uploads/videos/'.$video->video_image);
            
        $video         ->delete();
        
        return redirect()->back()->with('message'  ,  'Xóa sản phẩm thành công');
        
    }
    
    
    public function delete_video(Request $request){
        
    	$data          =    $request->all();
    	
    	$video_id      =    $data['video_id'];

    	$video         =    Video::find($video_id);

    	if($video->video_image)
    	    
    	    unlink('public/uploads/videos/'.$video->video_image);

    	$video         ->delete();
    }
    
    
    
     public function select_video(Request $request){
    
    	$video             =    Video      ::orderBy('video_id'    ,   'DESC')     ->get();
    	
    	$video_count       =    $video     ->count();
    	
    	$output            =   '<form>

               					  '.csrf_field().'
			
                        		  <table  class="table myTable table-striped b-t b-light">
					    
                                      <thead>
					                      <tr>
            					              <th>Thứ tự</th>
                                              <th>ID</th>
            					              <th>Tên video</th>
            					              <th>Slug video</th>
            					              <th>Hình ảnh video</th>
            					              <th>Link</th>
                                              <th>sub Link</th>
            					              <th>Mô tả</th>
            					              <th>Demo video</th>
            					              <th style="width:30px;">Quản lý</th>
            					          </tr>
            					      </thead>

            					      <tbody>

    	';
    	
    	if($video_count>0){
    	
    	    $i = 0;
            
    		foreach($video as $key => $vid){
    		
    		    $i++;
    		    
    			$output      .='

    				                    <tr>
                                            <td>'.$i.'</td>

                                            <td>

                                                '.$vid->video_id.'
                                            </td>
                                            

                                            <td contenteditable     data-video_id = "'.$vid->video_id.'"      data-video_type = "video_title" 

                                                                    class = "video_edit"                      id="video_title_'.$vid->video_id.'">'
                                                    
                                                .$vid->video_title.'
                                            </td>
                                            

                                            <td contenteditable     data-video_id="'.$vid->video_id.'"      data-video_type="video_slug" 

                                                                    class="video_edit"                      id="video_slug_'.$vid->video_id.'">'
                                                                        
                                                .$vid->video_slug.'
                                            </td>
                                            

                                            <td>
                                                <img    src="'.url('public/uploads/videos/'.$vid->video_image).'" 

                                                        class="img-thumbnail" width="80" height="80">
                                            
                                                <input  type="file"     class="file_img_video"      data-video_id="'.$vid->video_id.'" 

                                                        id="file-video-'.$vid->video_id.'"          name="file"         accept="image/*" />
                                            
                                            </td>
                                            

                                            <td contenteditable     data-video_id="'.$vid->video_id.'"      data-video_type="video_link" 

                                                                    class="video_edit"                      id="video_link_'.$vid->video_id.'">

                                                '.$vid->video_link.'
                                            </td>


                                            <td contenteditable     data-video_id="'.$vid->video_id.'"      data-video_type="sub_link" 

                                                                    class="video_edit"                      id="video_link_'.$vid->video_id.'">

                                                '.$vid->sub_link.'
                                            </td>


                                            <td contenteditable     data-video_id="'.$vid->video_id.'"      data-video_type="video_desc" 

                                                                    class="video_edit"                      id="video_desc_'.$vid->video_id.'">'
                                                                        
                                                .$vid->video_desc.'
                                            </td>
                                            

                                            <td><iframe     width="200"     height="200"    src="https://www.youtube.com/embed/'.$vid->sub_link.'" 

                                                            frameborder="0"     allow="accelerometer;   autoplay;   encrypted-media; 

                                                            gyroscope;          picture-in-picture"     allowfullscreen>
                                                </iframe>
                                            </td>


                                            <td>
                                                <button     type="button"       data-video_id="'.$vid->video_id.'"  

                                                            class="btn btn-xs   btn-danger      btn-delete-video">

                                                    Xóa video

                                                </button>
                                            </td>
                                        </tr>
                                    



    			     ';
            }
    	}
    	else{
    	    
    		$output       .='
    				                    <tr>
                                            <td colspan="4">Chưa có video nào hết</td>
                                       
                                        </tr>


            ';
    	}
    	
    	$output.='
                                    </tbody>
				                </table>
				            </form>


        ';
    	
    	return       $output;
    }
    
    
    
    
    public function select_video2(Request $request){        
        
        echo    ' <hr> ';
        
        echo      view('admin.video.table_video');
 //       include ($_SERVER['DOCUMENT_ROOT']."/public/tesinclude.html");  //   ( asset('public/tesinclude.php'));
 //       echo      asset('public/tesinclude.html');
 //       @include      (asset('public/tesinclude.html'));
        
        echo    ' <hr> ';
 //       echo      url('admin.video.table_video');
 //       return      view('admin.video.table_video');      // ok echo too
        
 //       @include       ('admin.video.table_video');
    }
    
    
    
    

}
