@extends('admin_layout')


@section('admin_content')
    
    <div class="table-agile-info">
    
  		<div class="panel panel-default">
  		
            <div class="panel-heading">
              	Edit videos
            </div>
            
            <div class="row w3-res-tb">
     
      			<div class="col-sm-12">
<?php 
    use Illuminate\Support\Facades\Session;
    
    $message = Session::get('message');
    
    if($message){
        
        echo '<span class="text-alert">'.$message.'</span>';
        
        Session::put('message',null);
    }
?>
        			<div class="position-center">
        			
                        <form action="{{URL::to('/update-video')}}" method="post">
                            {{ csrf_field() }}
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên video</label>
                                
                                <input type="text" name="video_title" class="form-control video_title" onkeyup="ChangeToSlug();"
                                       value="{{ $video->video_title }}" id="slug" placeholder="Tên danh mục">
                          
                            	<input type="hidden" 	name="video_id" 	value="{{$video->video_id}}">
                            </div>
                            
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug video</label>
                                
                                <input 	type="text" name="video_slug" class="form-control video_slug" 
                                		value="{{$video->video_slug}}" 	id="convert_slug" placeholder="Slug">
                            </div>
                            
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1">Link video</label>
                                
                                <input type="text" name="video_link" class="form-control video_link" 
                                
                                		value="{{$video->video_link}}"	id="convert_slug" placeholder="Slug">
                            </div>
                            
                            
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả videoo</label>
                                
                                <textarea style="resize: none" rows="8" class="form-control video_desc" 
                                			
                                			name="video_desc" 	id="exampleInputPassword1" placeholder="Mô tả danh mục">
                        			{{$video->video_desc}}
                        			
                    			</textarea>
                            </div>
                            
                            <div class="form-group">
                            
                                <label for="exampleInputPassword1">Hình ảnh video</label>
                            
                             	<input 	type="file" class="form-control" id="file_img_video"
                             	
                             			name="video_image" accept="image/*" >
                             			
                     			<img src="{{url('public/uploads/videos/'.$video->video_image)}}" height="100" width="100"> 
      
                            </div>
        
        					
        				                          	
                          	<div class="form-group">
                          	
                                <label for="exampleInputPassword1">Hiển thị</label>
                              	
                              	<select name="status" class="form-control input-sm m-bot15">
                              	
                                    <option value="0">Hiển thị</option>
                                    <option value="1">Ẩn</option>
                                        
                                </select>
                            </div>
                           
                            <button type="submit" name="edit_video" class="btn btn-info ">save video</button>
                            
                        </form>
                       
                        <div id="notify"></div>
                    </div>
      			</div>
            </div>
            
        </div>
	</div>
@endsection