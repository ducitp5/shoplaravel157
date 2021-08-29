@extends('admin_layout')


@section('admin_content')

    <div class="table-agile-info">
        <div class="panel panel-default">

	        <div class="panel-heading">
          		Liệt kê bài viết
    	    </div>
    

        	<div class="table-responsive">
<?php

    use App\PostLang;
    use Illuminate\Support\Facades\Session;
    use app\DucClass\mySql\myModel;

    $message = Session::get('message');
    
    if($message){
    
        echo '<span class="text-alert">'.$message.'</span>';
        
        Session::put('message' , null);
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
                            <th>Danh mục bài viết</th>
                            <th>Hiển thị</th>
                        
                        	<th style="width:30px;"></th>
                  		</tr>
                    </thead>
                    
                    
                    <tbody>	
<?php 

    $all_post       =    PostLang   ::with('cate_post')
    
                                    ->orderBy('cate_post_id')   ->paginate(5)  ;

    
    foreach($all_post as $key => $post){
?>	
						<form action="{{url('test/post-assign-lang')}}" method="POST">
                          	@csrf
                          	<tr>
                          		
                          		<td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                                
                                <td><input type="number"  name="post_id" 	value="{{ $post->post_id }}"></td>
                          		
                                
{{--                                
                                <td>{{ 	$post->post_slug }}</td>
                                
                                <td>{!! $post->post_desc !!}</td> 
--}}                                
                                <td><input type="checkbox" name="english_lang" {{ $post->hasLang('English') 	?	 'checked'   :   '' }} > </td>                               
                                <td><input type="checkbox" name="french_lang"  {{ $post->hasLang('French') 		?	 'checked'   :   '' }} > </td> 
    							<td><input type="checkbox" name="viet_lang"    {{ $post->hasLang('Viet') 		?	 'checked'   :   '' }} > </td> 
       
       				
       							<td>{{ 	$post->post_title }}</td>
                                
                                <td><img src="{{asset('public/uploads/post/'.$post->post_image)}}" height="100" width="100"></td>
                                
                                <td>
                                	<p><input type="submit" value="Phân quyền" class="btn btn-sm btn-default"></p>
                         				
                     				<p><a  onclick="alert('delete this user')" style="margin:5px 0;" class="btn btn-sm btn-danger" href="{{url('/delete-post/'.$post->post_id)}}">Xóa user</a></p>
                      			
                        		</td>
                                
                                <td>{{ 	$post->cate_post	->cate_post_name }}</td>
                                
                                <td>
<?php 
        if($post->post_status == 0){
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
                              		<a 	href="{{URL::to('/edit-post/'.$post->post_id)}}" 	class="active styling-edit" ui-toggle-class="">
                              		
                                		<i class="fa fa-pencil-square-o text-success text-active"></i></a>
                              
                              		<a 	onclick="return confirm('Bạn có chắc là muốn xóa bài viết này ko?')" 
                              			
                              			href="{{URL::to('/delete-post/'.$post->post_id)}}" 	class="active styling-edit" ui-toggle-class="">
                                    	
                                    	<i class="fa fa-times text-danger text"></i></a>
                                </td>
                          	</tr>
                      	</form>
<?php 
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
                        	{!!$all_post->links()!!}
                      	</ul>
                    </div>
              	</div>
            </footer> 
      	</div>
    </div>


@endsection