@extends('admin_layout')


@section('admin_content')

    <div class="table-agile-info">
        <div class="panel panel-default">

	        <div class="panel-heading">
          		Liệt kê bài viết
    	    </div>

				
        	<div class="table-responsive">
<?php

    
    use App\PostLang2;
    use Illuminate\Support\Facades\Session;
    use App\Lpl2;
use app\DucClass\mySql\myModel;
use shopbanhanglaravel\app\DucClass\mySql\myDB;

    $message = Session::get('message');
    
    if($message){
    
        echo '<span class="text-alert">'.$message.'</span>';
        
        Session::put('message'  ,   null);
    }
                                  
?>
				
				
				
          		<table class="table table-striped b-t b-light" id="myTable">
          		
                    <thead>
                      	<tr>
                        	<th style="width:20px;">

                            	<input type="checkbox"><i></i>

                        	</th>
                        	
                        	<th style="width:20px;">id</th>
                        	
                            
<!--                             <th>Slug</th>
                            <th>Mô tả bài viết</th>                            
 -->                            
                            <th>EN</th>
                            <th>FR</th>                            
                            <th>VN</th>
                            
                            <th>Tên bài viết</th>
                            <th>Hình ảnh</th>
                            
                            <th>Languague Manupulation</th>
                            
                            <th>ID danh muc</th>
                            <th>Danh mục bài viết</th>
                            <th>Hiển thị</th>
                        
                        	<th style="width:30px;"></th>
                  		</tr>
                    </thead>
                    
                    
                    <tbody>	
                     	
<?php 

   /*  $all_post       =    PostLang2   ::with('cate_post')
                    
                                     ->paginate(5)  ; */
 
    $all_post       =    PostLang2   ::Sql_cate_post();

    
    $results_per_page       =    5;
    
      
    $total_row       =    mysqli_num_rows($all_post);
    
    
    $number_of_page         =    ceil ($total_row / $results_per_page);
    
    
    
    if (!isset ($_GET['page']) ) {        $page     = 1;                } 
    
    else {                                $page     = $_GET['page'];    }
    
    
    $page_first_result      =     ($page - 1)   *    $results_per_page;
    
    
    $result                 =     PostLang2   ::Sql_cate_post2  ($page_first_result , $results_per_page);
    
    
    if ( mysqli_num_rows($result) > 0 ) {

        while ($post = mysqli_fetch_array($result)){
?>	
	                   
                    	<form action="{{url('test/post-assign-lang')}}" method="POST">
                    	
                    		@csrf	
                    		<tr>
                    			
                			</tr>
                			
                			<tr>
                          		
                          		<td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                               
                                <td> <input type="hidden" name="post_id" value="{{  $post['post_id']  }}">	{{ $post['post_id'] }}	</td>
{{--                         		
                                <td><input type="text"    name="post_idd" 	value="{{ $post->getprikey() }}"></td>
--}}                           		

{{--                                
                                <td>{{ 	$post->post_slug }}</td>
                                
                                <td>{!! $post->post_desc !!}</td>
--}}                                
        
<?php 
        $all_lang       =    Lpl2   ::where('post_id'   ,   $post['post_id'])     ->pluck('lang_id')  ->toArray();  

        consolelog_json2('lp2 114' , $all_lang);
       
        consolelog(myModel::getSql(Lpl2   ::where('post_id'   ,   $post['post_id'])));
        
        consolelogpretty(Lpl2   ::where('post_id'   ,   $post['post_id']) ->get()   );
        consolelog('2233');
        
 //       consoletype( Lpl2   ::where('post_id'   ,   $post->post_id)  );
        consolelog('11111');
        
?>
                                <td><input type="checkbox" name="english_lang" {{ in_array(1, $all_lang) 	?	 'checked'   :   '' }} > </td>                               
                                <td><input type="checkbox" name="french_lang"  {{ in_array(2, $all_lang)	?	 'checked'   :   '' }} > </td> 
    							<td><input type="checkbox" name="viet_lang"    {{ in_array(3, $all_lang)	?	 'checked'   :   '' }} > </td> 
     
       				
       							<td>{{ 	$post['post_title'] }}</td>
                                
                                <td><img src="{{asset('public/uploads/post/'.$post['post_image'])}}" height="100" width="100"></td>
                                
                               	<td>
                                	<p><input type="submit" value="assign language" class="btn btn-sm btn-default"></p>
                         				
                     				<p><a  onclick="alert('delete this user')" style="margin:5px 0;" class="btn btn-sm btn-danger" >Xóa user</a></p>
                      			
                    			</td>
                                
                                <td>{{ 	$post['cate_post_id'] }}</td>
                                <td>{{ 	$post['cate_post_name']	 }}</td>
                                
                                <td>
<?php 
        if($post['post_status'] == 0){
?>		             			
								Hiển thị
<?php 
        }
        else{
?>
                                Ẩn
<?php 
        }
?>                             
                                </td>
                        
                                <td>
                              		<a 	href="{{URL::to('/edit-post/'.$post['post_id'])  }}" 	class="active styling-edit" ui-toggle-class="">
                              		
                                		<i class="fa fa-pencil-square-o text-success text-active"></i></a>
                              
                              		<a 	onclick="return confirm('Bạn có chắc là muốn xóa bài viết này ko?')" 
                              			
                              			href="{{URL::to('/delete-post/'.$post['post_id'] )  }}" 	class="active styling-edit" ui-toggle-class="">
                                    	
                                    	<i class="fa fa-times text-danger text"></i></a>
                                </td>
                          	</tr>
                    	</form>
<?php 
    
        }
    }
?>
         
         
         						
                    </tbody>
              	</table>
            </div>
            
           	<footer class="panel-footer">
              	
              	<div class="row">
                
                    <div class="col-sm-5 text-center">
                      	<small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div>
                    
                    <div class="col-sm-7 text-right text-center-xs">                
                      	<ul class="pagination pagination-sm m-t-none m-b-none">
<?php                      	
                      	for($page = 1; $page<= $number_of_page; $page++) {  
?>
                      	   	<a href = "{{URL::to('test/list-post-4?page='.$page)}}"> {{ $page }} </a> 
<?php 
                        }
?>
                 {{--        	{!!$all_post->links()!!}  --}}
                      	</ul>
                    </div>
              	</div>
            </footer> 
      	</div>
    </div>


@endsection