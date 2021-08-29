
	<link href="{{asset('public/frontend/css/bootstrap.min.css')}}" 		rel="stylesheet">

    <link href="{{asset('public/frontend/css/animate.css')}}" 				rel="stylesheet">
    <link href="{{asset('public/frontend/css/main.css')}}" 					rel="stylesheet">

   

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    


 <div class="col-sm-9 padding-right">
 
	<div class="features_items"><!--features_items-->
	
        <div class="category-tab">      <!--category-tab-->
    
            <div class="col-sm-12">	    <!-- category-list -->
    
                <ul class="nav nav-tabs">
<?php 
    
    use App\CategoryProductModel;


    $cate_pro_tabs      =    CategoryProductModel       ::where('category_parent'   ,   '<>'    ,   0)
    
                                                        ->orderBy('category_order'  ,   'ASC')              ->get();
    
    $i = 0;
    
    foreach($cate_pro_tabs as $key => $cat_tabs){
     
        $i++;
?>    							                                      													 <!--  $('.tabs_pro')-->

                    <li data-id="{{$cat_tabs->category_id}}" 	id="{{$i==1 ? 'tabs_id' : ''}}"  	class="{{$i==1 ? 'active ' : ''}} tabs_pro">
                    
                    	<a href="#{{$cat_tabs->slug_category_product}}" data-toggle="tab">{{$cat_tabs->category_name}}</a>
                    </li>
<?php

    }
?>              
                </ul>
            </div>								 <!--/ category-list -->
            
            
            
            <div id="tabs_product"></div>			
        
        
        
        
        </div><!--/category-tab-->
        
        <h2 class="title text-center">Sản phẩm mới nhất</h2>
                        
 <?php 
    use Illuminate\Support\Facades\DB;
    
    $all_product    =    DB::table('tbl_product')       ->where('product_status'    ,   '0')
                                                        ->orderby(DB::raw('RAND()'))        ->paginate(25);
    
    foreach($all_product as $key => $product){
 
 ?>                       
        <div class="col-sm-4">
        
            <div class="product-image-wrapper">
           
                <div class="single-products">
        
                    <div class="productinfo text-center">
                    
                        <form>
                            @csrf

                            <input type="hidden" 	value="{{$product->product_id}}" 		class="cart_product_id_{{$product->product_id}}">

                            <input type="hidden" 	value="{{$product->product_name}}" 		class="cart_product_name_{{$product->product_id}}">
                          
                            <input type="hidden" 	value="{{$product->product_quantity}}" 	class="cart_product_quantity_{{$product->product_id}}">
                            
                            <input type="hidden" 	value="{{$product->product_image}}" 	class="cart_product_image_{{$product->product_id}}">
                            
                            <input type="hidden" 	value="{{$product->product_price}}" 	class="cart_product_price_{{$product->product_id}}">
                            
                            <input type="hidden" 	value="1" 								class="cart_product_qty_{{$product->product_id}}">


                            <a href="{{URL::to('/chi-tiet/'.$product->product_slug)}}">
                            
                            	
                            	
                                <img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
                            
                                <h2><h8>id : <?= $product->product_id ?> - </h8>{{number_format($product->product_price,0,',','.').' '.'VNĐ'}}</h2>
                            
                                <p>{{$product->product_name}}</p>
                               
                            </a>
                            

                        	<style type="text/css">
                        	
                                .xemnhanh {
                            
                                    background:         #F5F5ED;
                                    border:             0 none;
                                    border-radius:      0;
                                    color:              #696763;
                                    font-family:        'Roboto', sans-serif;
                                    font-size:          15px;
                                    margin-bottom:      25px;
                                }
                            </style>
                            
                            <input 	type="button" 		value="Thêm giỏ hàng" 			class="btn btn-default add-to-cart" 
                            		data-id_product="{{$product->product_id}}" 			name="add-to-cart">


					        <!-- Trigger Modal by Data-target -->
					        <!-- getData by JQuery via .xemnhanh -->
							<input 	type="button" 		value="Xem nhanh"				class="btn btn-default xemnhanh"	
                            		data-toggle="modal" data-target="#xemnhanh"    		name="add-to-cart"
                            		data-id_product="{{$product->product_id}}" >
                        </form>                      

                	</div>
                      
				</div>
           
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                    </ul>
                </div>
                
            </div>
        </div>
<?php 
    }
?>
    </div><!--features_items-->
    
    
    <ul class="pagination pagination-sm m-t-none m-b-none">    
    
    	{!!$all_product->links()!!}
    </ul>
    
        <!--/recommended_items-->
        
        
        
    <!-- Modal xem nhanh-->				<!-- Trigger Modal by button via Data-target ="#xemnhanh" -->
					                                        <!-- getData by JQuery via .xemnhanh -->
    
    
    <div class="modal fade" id="xemnhanh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
        <div class="modal-dialog modal-lg"  role="document">
        
        	<div class="modal-content">
          
          		<div class="modal-header">
          		
            		<h5 class="modal-title product_quickview_title" id=""> 	      <!-- modal-title  --> 
            		      
                		<span id="product_quickview_title"></span>              <!-- getData by JS at layout.blade.php -->  
            		</h5>
            	
            		<button type="button" class="close" data-dismiss="modal" aria-label="Close">              
              			<span aria-hidden="true">Fermer</span>
            		</button>
          		</div>
          
				<div class="modal-body">
				
            		<style type="text/css">
                
                        span#product_quickview_content img {
                            width: 100%;
                        }
    
                        @media screen and (min-width: 768px) {
                    
                            .modal-dialog {
                                width: 700px; /* New width for default modal */
                            }
                    
                            .modal-sm {
                                width: 350px; /* New width for small modal */
                            }
                        }
                
                        @media screen and (min-width: 992px) {
                            .modal-lg {
                                width: 1200px; /* New width for large modal */
                            }
                        }
                    </style>
            
                	<div class="row">
                        <div class="col-md-5">
                            <span id="product_quickview_image"></span>
                            <span id="product_quickview_gallery"></span>
                        </div>
                        
                        <form>
                            @csrf
                            <div id="product_quickview_value"> is hidden this</div>
                        
                        	<div class="col-md-7">
                        	
                            	<h2><span id="product_quickview_title">---ko tac dung, vi da get product_quickview_title-----</span></h2>
                    
                            	<p>Mã ID: <span id="product_quickview_id"></span></p>
                            
                            	<p style="font-size: 20px; color: brown;font-weight: bold;">Giá sản phẩm : <span id="product_quickview_price"></span></p>
            
                            	<label>Số lượng:</label>
        
                            	<input name="qty" type="number" min="1" class="cart_product_qty_"  value="1" />
                         
                        		<!-- </span> -->
                        		
                        		<h4 style="font-size: 20px; color: brown;font-weight: bold;">Mô tả sản phẩm</h4>
                        		<hr>
    
                                <p><span id="product_quickview_desc"></span></p>
                                <p><span id="product_quickview_content"></span></p>
                                
                                <div id="product_quickview_button"></div>
                                
                                <div id="beforesend_quickview"></div>
                            </div>
                        </form>
            
                    </div>           
				</div>
          	
          		<div class="modal-footer">
            		
            		<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            		
            		<button type="button" class="btn btn-default redirect-cart">Đi tới giỏ hàng</button>
          		</div>
        	</div>
      	</div>
	</div>
	
	
	 
</div>



	<script src="{{asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>


    <script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/lightgallery-all.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/lightslider.js')}}"></script>
    <script src="{{asset('public/frontend/js/prettify.js')}}"></script>
    <script src="{{asset('public/frontend/js/vlite.js')}}"></script>
   
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <div id="fb-root"></div>




    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v6.0&appId=2339123679735877&autoLogAppEvents=1"></script>
 
 
 	<script type="text/javascript">
    
        $('#keywords').keyup(function(){
            
            var query 	=	 $(this).val();
    
          	if(query != '')
            {
                 var 	_token 		=	 $('input[name="_token"]').val();
    
                 $.ajax({
                     
                  	url			:"{{url('/autocomplete-ajax')}}"	,
                  	method		:"POST"								,

                  	data		:{
                      				query		:	query	, 
                      				_token		:_token
                  				 }									,

                    success		:	function(data){

                        $('#search_ajax').fadeIn();  

                        $('#search_ajax').html(data);
                  	}
                 });
    
                }
            	else{
    
                    $('#search_ajax').fadeOut();  
                }
        });
    
        $(document).on('click'	,  '.li_search_ajax'	,	 function(){ 
             
            $('#keywords').val($(this).text());  
            $('#search_ajax').fadeOut();  
        }); 
        
    </script>
    
    
 
    <script type="text/javascript">
    
        $(document).ready(function(){

// for load in the beginning

            var cate_id 	=	 $('.tabs_pro').data('id');
            
            var _token 		=	 $('input[name="_token"]').val();

            $.ajax({
                
                url			:	'{{ url('/product-tabs') }}'		,
                
                method		:	"POST"								,
                
                data		:	{
                    				cate_id		:	cate_id,
                    				_token		:	_token
                				}									,
                				
                success		:	function(data){
                    
                    $('#tabs_product').html(data);						//	home.blade.php
                   
                }
            }); 

// for each of time click at the tabs_pro

            $('.tabs_pro').click(function(){
                
                var cate_id 	=	 $(this).data('id');

                //alert(cate_id);
                
                var _token 		=	 $('input[name="_token"]').val();

                $.ajax({
                    
                    url			:	'{{ url('/product-tabs') }}'		,
                    
                    method		:	"POST"							,
                      
                    data		:	{	cate_id		:	cate_id	,
                        				_token		:	_token
                    				}								,
                    				
                    success		:	function(data){
                        
                        $('#tabs_product').html(data); 					//	home.blade.php
                    }    
                }); 
            });     
        });
    </script>
    
    
    
    <script type="text/javascript">
        function remove_background(product_id)
         {
          for(var count = 1; count <= 5; count++)
          {
           $('#'+product_id+'-'+count).css('color', '#ccc');
          }
        }
        //hover chuột đánh giá sao
       $(document).on('mouseenter', '.rating', function(){
          var index = $(this).data("index");
          var product_id = $(this).data('product_id');
        // alert(index);
        // alert(product_id);
          remove_background(product_id);
          for(var count = 1; count<=index; count++)
          {
           $('#'+product_id+'-'+count).css('color', '#ffcc00');
          }
        });
       //nhả chuột ko đánh giá
       $(document).on('mouseleave', '.rating', function(){
          var index = $(this).data("index");
          var product_id = $(this).data('product_id');
          var rating = $(this).data("rating");
          remove_background(product_id);
          //alert(rating);
          for(var count = 1; count<=rating; count++)
          {
           $('#'+product_id+'-'+count).css('color', '#ffcc00');
          }
         });
    
        //click đánh giá sao
        $(document).on('click', '.rating', function(){
              var index = $(this).data("index");
              var product_id = $(this).data('product_id');
                var _token = $('input[name="_token"]').val();
              $.ajax({
               url:"{{url('insert-rating')}}",
               method:"POST",
               data:{index:index, product_id:product_id,_token:_token},
               success:function(data)
               {
                if(data == 'done')
                {
                 alert("Bạn đã đánh giá "+index +" trên 5");
                }
                else
                {
                 alert("Lỗi đánh giá");
                }
               }
        });
              
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            
            load_comment();
    
            function load_comment(){
                var product_id = $('.comment_product_id').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                  url:"{{url('/load-comment')}}",
                  method:"POST",
                  data:{product_id:product_id, _token:_token},
                  success:function(data){
                  
                    $('#comment_show').html(data);
                  }
                });
            }
            $('.send-comment').click(function(){
                var product_id = $('.comment_product_id').val();
                var comment_name = $('.comment_name').val();
                var comment_content = $('.comment_content').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                  url:"{{url('/send-comment')}}",
                  method:"POST",
                  data:{product_id:product_id,comment_name:comment_name,comment_content:comment_content, _token:_token},
                  success:function(data){
                    
                    $('#notify_comment').html('<span class="text text-success">Thêm bình luận thành công, bình luận đang chờ duyệt</span>');
                    load_comment();
                    $('#notify_comment').fadeOut(9000);
                    $('.comment_name').val('');
                    $('.comment_content').val('');
                  }
                });
            });
        });
    </script>
    
    
	<script type="text/javascript">
        
        $('.xemnhanh').click(function(){
            
            var 	product_id 		=	 $(this).data('id_product');
            var 	_token 			=	 $('input[name="_token"]').val();
            
            $.ajax({
                
                url			:	"{{url('/quickview')}}",
                method		:	"POST",
                dataType	:	"JSON",
                
                data		:	{	product_id	:	product_id, 
                    				_token		:	_token
                				},
                				
                success:function(data){		//modal  #xemnhanh
                    
                    $('#product_quickview_title')	.html(data.product_name);
                    $('#product_quickview_id')		.html(data.product_id);
                    $('#product_quickview_price')	.html(data.product_price);
                    $('#product_quickview_image')	.html(data.product_image);
                    $('#product_quickview_gallery')	.html(data.product_gallery);
                    $('#product_quickview_desc')	.html(data.product_desc);
                    $('#product_quickview_content')	.html(data.product_content);
                    $('#product_quickview_value')	.html(data.product_quickview_value);
                    $('#product_quickview_button')	.html(data.product_button);
                }
            });
        });
       
    </script>
    
    
    
    
    
    
    <script type="text/javascript">
         $(document).ready(function() {
            $('#imageGallery').lightSlider({
    
                gallery:true,
                item:1,
                loop:true,
                thumbItem:3,
                slideMargin:0,
                enableDrag: false,
                currentPagerPosition:'left',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslide'
                    });
                }
    
            });  
          });
    </script>
    <script type="text/javascript">
      
        $(document).on('click','.watch-video',function(){
            var video_id = $(this).attr('id');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:'{{url('/watch-video')}}',
                method:"POST",
                dataType:"JSON",
                data:{video_id:video_id,_token:_token},
                success:function(data){
                    $('#video_title').html(data.video_title);
                    $('#video_link').html(data.video_link);
                    $('#video_desc').html(data.video_desc); 
                    var playerYT = new vlitejs({
                        selector: '#my_yt_video',
                        options: {
                          // auto play
                          autoplay: false,

                          // enable controls
                          controls: true,

                          // enables play/pause buttons
                          playPause: true,

                          // shows progress bar
                          progressBar: true,

                          // shows time
                          time: true,

                          // shows volume control
                          volume: true,

                          // shows fullscreen button
                          fullscreen: true,

                          // path to poster image
                          poster: null,

                          // shows play button
                          bigPlay: true,

                          // hide the control bar if the user is inactive
                          autoHide: false,

                          // keeps native controls for touch devices
                          nativeControlsForTouch: false
                        },
                        onReady: (player) => {
                          // callback function here
                        }
                    });
                   
                }

            }); 
        });
    </script>
   
    <script type="text/javascript">

          $(document).ready(function(){
            $('.send_order').click(function(){
                swal({
                  title: "Xác nhận đơn hàng",
                  text: "Đơn hàng sẽ không được hoàn trả khi đặt,bạn có muốn đặt không?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Cảm ơn, Mua hàng",

                    cancelButtonText: "Đóng,chưa mua",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                     if (isConfirm) {
                        var shipping_email = $('.shipping_email').val();
                        var shipping_name = $('.shipping_name').val();
                        var shipping_address = $('.shipping_address').val();
                        var shipping_phone = $('.shipping_phone').val();
                        var shipping_notes = $('.shipping_notes').val();
                        var shipping_method = $('.payment_select').val();
                        var order_fee = $('.order_fee').val();
                        var order_coupon = $('.order_coupon').val();
                        var _token = $('input[name="_token"]').val();

                        $.ajax({
                            url: '{{url('/confirm-order')}}',
                            method: 'POST',
                            data:{shipping_email:shipping_email,shipping_name:shipping_name,shipping_address:shipping_address,shipping_phone:shipping_phone,shipping_notes:shipping_notes,_token:_token,order_fee:order_fee,order_coupon:order_coupon,shipping_method:shipping_method},
                            success:function(){
                               swal("Đơn hàng", "Đơn hàng của bạn đã được gửi thành công", "success");
                            }
                        });

                        window.setTimeout(function(){ 
                            location.reload();
                        } ,3000);

                      } else {
                        swal("Đóng", "Đơn hàng chưa được gửi, làm ơn hoàn tất đơn hàng", "error");

                      }
              
                });

               
            });
        });
    

    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.add-to-cart').click(function(){

                var id = $(this).data('id_product');
                // alert(id);
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();

                if(parseInt(cart_product_qty)>parseInt(cart_product_quantity)){
                    alert('Làm ơn đặt nhỏ hơn ' + cart_product_quantity);
                }else{

                    $.ajax({
                        url: '{{url('/add-cart-ajax')}}',
                        method: 'POST',
                        data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token,cart_product_quantity:cart_product_quantity},
                        success:function(){

                            swal({
                                    title: "Đã thêm sản phẩm vào giỏ hàng",
                                    text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                    showCancelButton: true,
                                    cancelButtonText: "Xem tiếp",
                                    confirmButtonClass: "btn-success",
                                    confirmButtonText: "Đi đến giỏ hàng",
                                    closeOnConfirm: false
                                },
                                function() {
                                    window.location.href = "{{url('/gio-hang')}}";
                                });

                        }

                    });
                }

                
            });
        });
    </script>
    <!--add to  cart quickview-->
     <script type="text/javascript">
       
            $(document).on('click','.add-to-cart-quickview',function(){

                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();

                if(parseInt(cart_product_qty)>parseInt(cart_product_quantity)){
                    alert('Làm ơn đặt nhỏ hơn ' + cart_product_quantity);
                }else{

                    $.ajax({
                        url: '{{url('/add-cart-ajax')}}',
                        method: 'POST',
                        data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token,cart_product_quantity:cart_product_quantity},
                        beforeSend: function(){
                            $("#beforesend_quickview").html("<p class='text text-primary'>Đang thêm sản phẩm vào giỏ hàng</p>");
                        },
                        success:function(){
                            $("#beforesend_quickview").html("<p class='text text-success'>Sản phẩm đã thêm vào giỏ hàng</p>");
                          

                        }

                    });
                }

                
            });
            $(document).on('click','.redirect-cart',function(){
                window.location.href = "{{url('/gio-hang')}}";
            });
        
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
           
            if(action=='city'){
                result = 'province';
            }else{
                result = 'wards';
            }
            $.ajax({
                url : '{{url('/select-delivery-home')}}',
                method: 'POST',
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                   $('#'+result).html(data);     
                }
            });
        });
        });
          
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.calculate_delivery').click(function(){
                var matp = $('.city').val();
                var maqh = $('.province').val();
                var xaid = $('.wards').val();
                var _token = $('input[name="_token"]').val();
                if(matp == '' && maqh =='' && xaid ==''){
                    alert('Làm ơn chọn để tính phí vận chuyển');
                }else{
                    $.ajax({
                    url : '{{url('/calculate-fee')}}',
                    method: 'POST',
                    data:{matp:matp,maqh:maqh,xaid:xaid,_token:_token},
                    success:function(){
                       location.reload(); 
                    }
                    });
                } 
        });
    });
    </script>