<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

use App\Slider;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Post;
use App\CatePost;
session_start();


class PostController extends Controller
{
    
    public function danh_muc_bai_viet(Request $request      ,   $post_slug){
        
       
        
//        $catepost = CatePost::where('cate_post_slug',$post_slug)->take(1)->get();

        $catepost           =    CatePost   ::where('cate_post_slug'   ,   $post_slug)     ->first();
        
        
//        foreach($catepost as $key => $cate){
            //seo
           
        $meta_title         =    $catepost->cate_post_name;
        $meta_desc          =    $catepost->cate_post_desc;
        $meta_keywords      =    $catepost->cate_post_slug;
       
        
        
        $url_canonical      =    $request->url();
            //--seo
//        }
        
        $cate_id            =    $catepost->cate_post_id;
        
        $post               =    Post::with('cate_post')    ->where('post_status'   ,   0)
                                                            ->where('cate_post_id'  ,   $cate_id)   ->paginate(5);
        
        return      view('pages.baiviet.danhmucbaiviet')
        
                            ->with('meta_title'     ,   $meta_title)
                            ->with('meta_desc'      ,   $meta_desc)
                            ->with('meta_keywords'  ,   $meta_keywords)
                            
                            ->with('url_canonical'  ,   $url_canonical)
                            
                            ->with('post'           ,   $post);
    }
    
    
    
    public function bai_viet(Request $request   ,   $post_slug){
        
        
//        $post = Post::with('cate_post')->where('post_status',0)->where('post_slug',$post_slug)->take(1)->get();
        
        $post       =    Post::with('cate_post')    ->where('post_status'   ,   0)
                                                    ->where('post_slug'     ,   $post_slug)     ->first();
        
//        foreach($post as $key => $post){
            //seo
            
        $meta_title         =    $post->post_title;
        $post->post_views ++;
        
        echo("<script>      console.log('post_views "      .$post->post_views. "');                    </script>");
        
        $post->save();
        
        $meta_desc          =    $post->post_meta_desc;
        $meta_keywords      =    $post->post_meta_keywords;
        
        $cate_id            =    $post->cate_post_id;
        $url_canonical      =    $request->url();
        
        $cate_post_id       =    $post->cate_post_id;
            
            //--seo
//        }
        
        $related            =    Post::/* with('cate_post')    -> */where('post_status'       ,   0)
                                                            ->where('cate_post_id'      ,   $cate_post_id)
                                                    
                                                            ->whereNotIn('post_slug'    ,   [$post_slug] )  
        
                                                            ->take(5)                                           ->get();
        
        
        return          view('pages.baiviet.baiviet')
        
                            ->with('meta_desc'      ,   $meta_desc)
                            ->with('meta_keywords'  ,   $meta_keywords)
                            ->with('meta_title'     ,   $meta_title)
                            
                            ->with('url_canonical'  ,   $url_canonical)
                            
                            ->with('post'           ,   $post)
                            
                            ->with('related'        ,   $related);
    }
    
    
    
    public function AuthLogin(){
 /*        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        } */
        
        AuthDucController::AuthLogin();
    }
    
    
    public function all_post(){
        
        $this->AuthLogin();
        
        $all_post       =    Post   ::with('cate_post')
        
                                    ->orderBy('cate_post_id')   ->paginate(5)  ;
        
        return      view('admin.post.list_post')    ->with(compact('all_post'   ,   $all_post));        
    }
    
    
        
    public function add_post(){
        
        $this->AuthLogin();
        
        $cate_post      =    CatePost   ::orderBy('cate_post_id'  ,  'DESC')    ->get(); 
       
        return          view('admin.post.add_post')     ->with(compact('cate_post'));
    	

    }

    
    
    
    public function save_post(Request $request){
        
        $this->AuthLogin();
    	
        $data                       = $request->all();
    	
        $post                       = new Post();

    	$post->post_title           = $data['post_title'];
    	$post->post_slug            = $data['post_slug'];
    	$post->post_desc            = $data['post_desc'];
    	$post->post_content         = $data['post_content'];
    	$post->post_meta_desc       = $data['post_meta_desc'];
    	$post->post_meta_keywords   = $data['post_meta_keywords'];
    	$post->cate_post_id         = $data['cate_post_id'];
    	$post->post_status          = $data['post_status'];

        $get_image                  = $request->file('post_image');
      
        if($get_image){
            
            $get_name_image         = $get_image->getClientOriginalName(); //lay ten của hình ảnh
            
            $name_image             = current(explode('.',$get_name_image));

            $new_image              = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();

            $get_image->move('public/uploads/post'  ,   $new_image);

            $post->post_image       = $new_image;

           	$post->save();
           	
            Session::put('message','Thêm bài viết thành công');
            
            return redirect()->back();
        }
        else{
            
        	Session::put('message','Post ko co hình ảnh');
        	
        	$post->save();
            
        	return redirect()->back();
        }      
    }
    
  
    public function delete_post($post_id){
        $this->AuthLogin();
        $post = Post::find($post_id);
        $post_image = $post->post_image;

        if($post_image){
        	$path ='public/uploads/post/'.$post_image;
        	unlink($path);
        }
        $post->delete();
        
       
        Session::put('message','Xóa bài viết thành công');
        return redirect()->back();
    }
    
   	public function edit_post($post_id){
   		$cate_post = CatePost::orderBy('cate_post_id')->get();
   		$post = Post::find($post_id);
   		return view('admin.post.edit_post')->with(compact('post','cate_post'));
   	}
   	public function update_post(Request $request,$post_id){
   		$this->AuthLogin();
    	$data = $request->all();
    	$post = Post::find($post_id);

    	$post->post_title = $data['post_title'];
    	$post->post_slug = $data['post_slug'];
    	$post->post_desc = $data['post_desc'];
    	$post->post_content = $data['post_content'];
    	$post->post_meta_desc = $data['post_meta_desc'];
    	$post->post_meta_keywords = $data['post_meta_keywords'];
    	$post->cate_post_id = $data['cate_post_id'];
    	$post->post_status = $data['post_status'];

        $get_image = $request->file('post_image');
      
        if($get_image){
        	//xoa anh cu
        	$post_image_old = $post->post_image;
        	$path ='public/uploads/post/'.$post_image_old;
        	unlink($path);
        	//cap nhat anh moi
            $get_name_image = $get_image->getClientOriginalName(); //lay ten của hình ảnh
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/post',$new_image);
            $post->post_image = $new_image; 
        }

        $post->save();
        Session::put('message','Cập nhật bài viết thành công');
        return redirect()->back();
   	}
    
   	
   	
   
    
}
