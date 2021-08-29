	<link href="{{asset('public/frontend/css/bootstrap.min.css')}}" 		rel="stylesheet">
 	<link href="{{asset('public/frontend/css/main.css')}}" 					rel="stylesheet">
 	
 	    
	<script src="{{asset('public/frontend/js/jquery.js')}}"></script>
	
 	<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>	 
	
	




<?php 

    use Illuminate\Support\Facades\DB;


    $product_slug           =    "may-choi-game-ps4-pro-1tb-tang-them-tay-cam-va-3-game";

    $product_details                  =    DB::table('tbl_product')
                                            
                                            ->join('tbl_category_product'   ,   'tbl_category_product.category_id'  ,   '='   ,   'tbl_product.category_id')
                                            
                                            ->join('tbl_brand'              ,   'tbl_brand.brand_id'                ,   '='   ,   'tbl_product.brand_id')
                                            
                                            ->where('tbl_product.product_slug'  ,   $product_slug)
                                            
                                            ->first();

?>


<div class="container">

	<div class="col-sm-9 padding-right" >
	
		<div class="category-tab shop-details-tab"><!--category-tab-->
		
		
			<div class="col-sm-12">
		
				<ul class="nav nav-tabs">
				
					<li>				<a href="#details" 			data-toggle="tab">Mô tả</a></li>
					
					<li>				<a href="#companyprofile" 	data-toggle="tab">Chi tiết sản phẩm</a></li>
				
					<li class="active">	<a href="#reviews" 			data-toggle="tab">Đánh giá</a></li>
				</ul>
			</div>
			
			
			<div class="tab-content">
			
				<div class="tab-pane " id="details" >
			
					<p>{!!  $value->product_desc  !!}</p>
					
				</div>
			
				
				<div class="tab-pane fade" id="companyprofile" >
			
					<p>{!!  $value->product_content  !!}</p>						
			
				</div>
				
				
				<div class="tab-pane fade active in" id="reviews" >
				
					<div class="col-sm-12">
				
						<ul>
							<li><a href=""><i class="fa fa-user">		</i>Admin</a></li>
							<li><a href=""><i class="fa fa-clock-o">	</i>12:41 PM</a></li>
							<li><a href=""><i class="fa fa-calendar-o">	</i>16.09.2020</a></li>
						</ul>
				
<style type="text/css">

	.style_comment {
	    
	    border         : 1px solid #ddd;
	    border-radius  : 10px;
	    background     : #F0F0E9;
	}
</style>

						<form>
						
						 	@csrf
							
							<input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$value->product_id}}">

						 	
						
						</form>

						<div id="comment_show"></div>
						
							
						
						<p><b>Viết đánh giá của bạn</b></p>

						 <!------Rating here---------->
						 
 <?php 
 
     use App\Rating;
    
     $product_id         =    $product_details->product_id;
     
     $rating             =    Rating::where('product_id'    ,   $product_id)    ->avg('rating');
     
     $rating             =    round($rating);
 
 ?>
						 
                        <ul class="list-inline rating"  title="Average Rating">
<?php 
    
    for ($count = 1 ; $count <= 5 ; $count++){
        
        if($count <= $rating){            $color = 'color:#ffcc00;';    }
        
        
        else                 {            $color = 'color:#F80636;';    }
?>

                            <li title="star_rating" 	id="{{$value->product_id}}-{{$count}}" 	data-index="{{$count}}"   data-product_id="{{$value->product_id}}" 
                            
                            	data-rating="{{$rating}}"   class="rating"   style="cursor:pointer; {{ $color }} font-size:30px; " >
                            	
                            	&#9733;
                        	</li>
<?php 
    }
?>
						</ul>
						


                       
						<form action="#">
						
							<span>
								<input style="width:100% ; margin-left: 0" 		type="text" 	class="comment_name" 	placeholder="Tên bình luận"/>									
							</span>							
							
							<textarea 	name="comment" 		class="comment_content" 	placeholder="Nội dung bình luận"></textarea>							
							
							<div id = "notify_comment"></div>							
							<div id = "notify_comment2"></div>
							
							<button type="button" class="btn btn-default pull-right send-comment">
								Gửi bình luận
							</button>

						</form>
						
      
<script type="text/javascript">

    $(document).ready(function(){

    	load_comment();
        
        function load_comment(){
            
            var product_id 		=	 $('.comment_product_id').val();
            var _token 			=	 $('input[name="_token"]').val();
            
            $.ajax({
                
              	url			:	"{{url('/load-comment')}}",
              	method		:	"POST",
              	
              	data		:	{	product_id		:	product_id, 
                  					_token			:	_token
              					},
    
              	success		:	function(data){
              
                    $('#comment_show').html(data);
              	}
            });
        } 

        
        $('.send-comment').click(function(){
            
            var product_id 			= $('.comment_product_id').val();
            var comment_name 		= $('.comment_name').val();
            var comment_content 	= $('.comment_content').val();
            
            var _token 				= $('input[name="_token"]').val();

            $.ajax({
                
                url			:	"{{url('/send-comment')}}",
                method		:	"POST",
                
                data		:	{	product_id			:	product_id,
                    				comment_name		:	comment_name,
                    				comment_content		:	comment_content, 
                    				
                    				_token				:	_token
                				},

				success		:	function(data){
                
                    $('#notify_comment').html('<span class="text text-success">Thêm bình luận thành công, bình luận đang chờ duyệt</span>');

                    $('#notify_comment').fadeOut(9000);
                    
                    $('.comment_name').val('');
                    $('.comment_content').val('');

                    load_comment();						//only called in the same  $(document).ready(function()

                    $('#notify_comment2').html('<span class="text text-success">bình luận đang chờ duyệt 2</span>');
                    $('#notify_comment2').fadeOut(19000);
              	}
            });
        });
    });
    
</script>						
						
						
					</div>
				</div>
				
			</div>
		</div><!--/category-tab-->
<?php 
//    }

?>		

		@include('test.details_products_3')
		
		
    </div>
 </div>
    
      