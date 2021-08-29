@extends('admin_layout')


@section('admin_content')


	   <div class="table-agile-info">
        <div class="panel panel-default">

	        <div class="panel-heading">
          		List video
    	    </div>
    

        	<div class="table-responsive">
<?php

    use Illuminate\Support\Facades\Session;

    $message = Session::get('message');
    
    if($message){
    
        echo '<span class="text-alert">'.$message.'</span>';
        
        Session::put('message'    ,   null);
    }
?>
          		<table class="table table-striped b-t b-light" id="myTable">
          		
                    <thead>
                      	<tr>
                        	<th style="width:20px;">

                            	<input type="checkbox"><i></i>

                        	</th>
                        	<th>STT</th>
                        	<th>ID</th>
                            <th>Video Name</th>
                            <th>Image</th>
                            <th>Slug</th>
                            <th>Video desc</th>
                            <th>Linkt</th>
                            <th>sub Link</th>
                            <th>Movie</th>
                            <th>Hiển thị</th>
                        
                        	<th style="width:30px;"></th>
                  		</tr>
                    </thead>
                    
                    
                    <tbody>	
<?php 

    $i = ($all_video->currentpage()-1)* $all_video->perpage() + 1;

    
    foreach($all_video as $key => $post){
?>	
                      	<tr>
                      	
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            
                            <td>{{ 	$i++ }}</td>
                            
                            <td>{{ 	$post->video_id }}</td>
                            
                            <td>{{ 	$post->video_title }}</td>
                            
                            <td><img src="{{asset('public/uploads/videos/'.$post->video_image)}}" height="100" width="100"></td>
                            
                            <td>{{ 	$post->video_slug }}</td>
                            
                            <td>{!! $post->video_desc !!}</td>
                            
                           
                            
                            <td>{{ 	$post->video_link }}</td>
                            <td>{{ 	$post->sub_link }}</td>
                            
                            <td><iframe     width="200"     height="200"    src="https://www.youtube.com/embed/<?= $post->sub_link; ?>" 

                                            allow="accelerometer;   autoplay;   encrypted-media;       gyroscope;          picture-in-picture"   
                                            
                                            frameborder="0"    allowfullscreen  >
                                </iframe>
                            </td>
                            
                            
                            <td>
<?php 
        if($post->status == 0){
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
                          		<a 	href="{{URL::to('/edit-video/'.$post->video_id)}}" >
                          		
                            		<i class="fa fa-pencil-square-o text-success text-active"></i></a>
                          
                          		<a 	                          		
                          			onclick="return confirm('Bạn có chắc là muốn xóa bài viết này ko?')" 
                          			
                          			href="{{URL::to('/delete-video/'.$post->video_id)}}" 	class="active styling-edit" ui-toggle-class="">
                                	
                                	<i class="fa fa-times text-danger text"></i></a>
                            </td>
                      	</tr>
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
                        	{!!$all_video->links()!!}
                      	</ul>
                    </div>
              	</div>
            </footer> 
      	</div>
    </div>
	
    
    
@endsection