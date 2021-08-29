
<script>
     alert("Hello world");
     console.log("Hello world!");
   </script>
   
<?php
	use App\Video;
	use Illuminate\Http\Request;
    
	$video_id                   =    $_POST["video_id"];
        
    $video                      =    Video::find($video_id);
    
    $output['video_title']      =    $video->video_title;
    $output['video_desc']       =    $video->video_desc;
    
    // $output['video_link'] = '<iframe width="100%" height="400" src="https://www.youtube.com/embed/'.$video->video_link.'?rel=0&modestbranding=1&autohide=1&showinfo=0&controls=0" frameborder="0" allowfullscreen" frameborder="0" allowfullscreen></iframe>';
    
    $output['video_link']       =   '<video  id                   ="my_yt_video"
				                             class                ="vlite-js"
				                             data-youtube-id      ="'.$video->video_link.'">
				                     </video>';
    
    
    echo json_encode($output);
    
?>