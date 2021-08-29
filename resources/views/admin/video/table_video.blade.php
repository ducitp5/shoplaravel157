

<?php 
    
    use App\Video;
    
    $video             =    Video      ::orderBy('video_id'    ,   'DESC')     ->get();
    
    $video_count       =    $video     ->count();


?>


 	

       
        
    <table class="table myTable table-striped b-t b-light">
    
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

<?php 

    if($video_count > 0){
        
        $i   =   0;
        
        foreach($video as $key => $vid){
            
            $i++;
?>
    		
            <tr>
                
                <form>
    			{{ csrf_field() }}
    			
                    <td>{{ $i}}</td>
        
                    <td>
        
                        {{ $vid->video_id }}
                    </td>
                    
        <!--                select CELL by .video_edit                      -->
        <!--                data-video_id           =   line                -->
        <!--                data-video_type         =   column              -->
        <!--                data-video_type       ==>   content             -->
        
                    <td contenteditable     data-video_id = "{{$vid->video_id}}"      data-video_type = "video_title" 
        
                                            class = "video_edit"                      id="video_title_{{$vid->video_id}}">
                            
                        {{  $vid->video_title  }}
                    </td>
                    
        
                    <td contenteditable     data-video_id="{{ $vid->video_id }}"      data-video_type="video_slug" 
        
                                            class="video_edit"                        id="video_slug_{{$vid->video_id}}">
                                                
                        {{ $vid->video_slug}}
                    </td>
                    
        
                    <td>
                        <img    src="{{url('public/uploads/videos/'.$vid->video_image)}}" 
        
                                class="img-thumbnail" width="80" height="80">
                    
                        <input  type="file"     class="file_img_video"      data-video_id="{{$vid->video_id}}" 
        
                                id="file-video-{{$vid->video_id}}"          name="file"         accept="image/*" />
                    
                    </td>
                    
        
                    <td contenteditable     data-video_id="{{ $vid->video_id }}"      data-video_type="video_link" 
        
                                            class="video_edit"                        id="video_link_{{$vid->video_id}}">
        
                        {{$vid->video_link}}
                    </td>
        
        
                    <td contenteditable     data-video_id="{{$vid->video_id}}"      data-video_type="sub_link" 
        
                                            class="video_edit"                      id="video_link_{{$vid->video_id}}">
        
                        {{$vid->sub_link}}
                    </td>
        
        
                    <td contenteditable     data-video_id="{{$vid->video_id}}"      data-video_type="video_desc" 
        
                                            class="video_edit"                      id="video_desc_{{$vid->video_id}}">
                                                
                        {{$vid->video_desc}}
                    </td>
                    
        
                    <td><iframe     width="200"     height="200"    src="https://www.youtube.com/embed/{{$vid->sub_link}}" 
        
                                    frameborder="0"     allow="accelerometer;   autoplay;   encrypted-media; 
        
                                    gyroscope;          picture-in-picture"     allowfullscreen>
                        </iframe>
                    </td>
        
        
                    <td>
                        <button     type="button"       data-video_id="{{$vid->video_id}}"  
        
                                    class="btn btn-xs   btn-danger      btn-delete-video">
        
                            Xóa video
        
                        </button>
                    </td>
                    
                </form>
                
            </tr>        	 

<?php 

        }
    }
    else{

?>
            <tr>
                <td colspan="4">Chưa có video nào hết</td>
           
            </tr>
<?php 
    }
?>
    	
    	
    	
        </tbody>
    </table>
   



  	<script type="text/javascript">
    
        $(document).ready( function () {

        	try {

				$('.myTable').DataTable();

 //     		  	adddlert("Welcome guest!");

      		}
    		catch(err) {

      		  	console.log('erreur 20 - ' +err.message);
    		}
        });
    </script>
    

       