
	<link href="{{asset('public/frontend/css/bootstrap.min.css')}}" 		rel="stylesheet">
 	<link href="{{asset('public/frontend/css/main.css')}}" 					rel="stylesheet">
 	
	<link href="{{asset('public/frontend/css/vlite.css')}}" 				rel="stylesheet">			<!-- vlitejs video -->
   
    
	<script src="{{asset('public/frontend/js/jquery.js')}}"></script>
	<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>	
	
	<script src="{{asset('public/frontend/js/vlite.js')}}"></script>
	
	
	
	
	<div class="col-sm-9 padding-right">
	
     	<div class="features_items">
        
        	<!--features_items-->
        
        	<h2 class="title text-center">Videos công ty</h2>
        
    <?php
        
        use Illuminate\Support\Facades\DB;
    
        $all_video          =    DB::table('tbl_videos')        ->paginate(6);
    
        foreach($all_video as $key => $video){
    ?>
        	<div class="col-sm-4">
        		<div class="product-image-wrapper">
        			
        			<style type="text/css">
                        .single-products.single-products-video {
                        	height: 450px;
                        }
                    </style>
        			
        			<form>
        				@csrf
        				<div class="single-products single-products-video">
        					<div class="productinfo text-center">
        						<form>
        							@csrf 
        							
        							<a href=""> 
        								<img src = "{{asset('public/uploads/videos/'.$video->video_image)}}"	alt="{{$video->video_title}}" />
        								
        								<h2>{{	$video	->video_title}}	</h2>
        								
        								<p> {{	$video	->video_desc}}	</p>   
        							</a>
        							
        							<!-- Button trigger modal -->
        							
        							<button type="button" 			class="btn btn-primary watch-video"
        									data-toggle="modal" 	data-target="#modal_video"
        									id="{{$video->video_id}}">
        									
    									Xem video
    								</button>
    							</form>
        
        					</div>
        
        				</div>
    				</form>   
        		</div>
        	</div>
    <?php 
        }
    ?>
        </div>
      
        <!--features_items-->
      
        <ul class="pagination pagination-sm m-t-none m-b-none">
        	{!!$all_video->links()!!}
        </ul>
        
    </div>
        
        
    <!-- Modal xem video -->
    
    
    
    <div 	class="modal fade" 	id="modal_video" 		tabindex="-1" 	role="dialog"
    		aria-labelledby="exampleModalCenterTitle" 	aria-hidden="true">
    		
    	<div class="modal-dialog modal-dialog-centered" role="document">
    		
    		<div class="modal-content">
    		
    			<div class="modal-header">
    		
    				<h5 class="modal-title" id="video_title"></h5>
    		
    				<button type="button" class="close" data-dismiss="modal"	aria-label="Close">
    				
    					<span aria-hidden="true">close</span>
    				
    				</button>
    			</div>
    
    			<div class="modal-body">
    
    				<div id="video_desc"></div>
    
    				<div id="video_link"></div>
    			</div>
    
    
    			<div class="modal-footer">
    
    				<button type="button" 	id="close_video" 	class="btn btn-secondary"	data-dismiss="modal">
    					
    					Đóng video
					</button>
    
    			</div>
    		</div>
    	</div>
    </div>
    
    
    
    <script type="text/javascript">
      
        $(document).on('click' , '.watch-video' , function(){
            
            var 	video_id 	=	 $(this).attr('id');			/*  $video->video_id */

            var 	_token 		=	 $('input[name="_token"]').val();
			
            $.ajax({
                
                url			:	'{{url('test/watch-video')}}'		,
              
         /*      	url			:	"{{asset('public/ajax/watch_video.php')}}" */
                method		:	"POST"							,
                dataType	:	"JSON"							,
                
                data		:{
                    			video_id	:	video_id,
                    			_token		:	_token
                			 }								,
                			 

                success		:function(data){
                    
                    $('#video_title')	.html(data.video_title);
                   
                    $('#video_desc')	.html(data.video_desc); 

                    $('#video_link')	.html(data.video_link);
                    
                    var 	playerYT 	=	 new vlitejs({
                        
                        		selector	:	 '#my_yt_video',

                            	options: {
                                	
                                      autoplay		:	 false,                                                  
                                      controls		:	 true,				// enable controls                                                  
                                      playPause		:	 true,				// enables play/pause buttons                                      
                                      progressBar	:	 true,				// shows progress bar                                      
                                      time			: 	 true,				// shows time                                     
                                      volume		:	 true,				// shows volume control                                     
                                      fullscreen	:	 true,				// shows fullscreen button   
                                      
                                      poster		:	 null,				// path to poster image                                     
                                      bigPlay		:	 true,				// shows play button                                      
                                      autoHide		:	 false,				// hide the control bar if the user is inactive            
                                      
                                      nativeControlsForTouch	: false			// keeps native controls for touch devices
                                },

		                        onReady: (player) = {
    			                  // callback function here
                		        }
                    });                   
                }		// fin success
            }); 		// fin ajax
        });
    </script>