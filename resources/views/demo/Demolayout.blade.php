<?php 

    use App\CatePost;
    
    
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Session;

    
    
    
?>


<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!---------Seo--------->
    <meta name="description" content="{{$meta_desc}}">
    <meta name="keywords" content="{{$meta_keywords}}"/>
    <meta name="robots" content="INDEX,FOLLOW"/>

    <link  rel="canonical" href="{{$url_canonical}}" />

    <meta name="author" content="">

    <link  rel="icon" type="image/x-icon" href="" />
    
    {{--   <meta property="og:image" content="{{$image_og}}" />  
      <meta property="og:site_name" content="http://localhost/tutorial_youtube/shopbanhanglaravel" />
      <meta property="og:description" content="{{$meta_desc}}" />
      <meta property="og:title" content="{{$meta_title}}" />
      <meta property="og:url" content="{{$url_canonical}}" />
      <meta property="og:type" content="website" /> --}}

    <!--//-------Seo--------->

    <title>{{$meta_title}}</title>

    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" 		rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" 		rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" 			rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" 			rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" 				rel="stylesheet">
    <link href="{{asset('public/frontend/css/main.css')}}" 					rel="stylesheet">
    <link href="{{asset('public/frontend/css/responsive.css')}}" 			rel="stylesheet">
    <link href="{{asset('public/frontend/css/sweetalert.css')}}" 			rel="stylesheet">
    <link href="{{asset('public/frontend/css/lightgallery.min.css')}}" 		rel="stylesheet">
    <link href="{{asset('public/frontend/css/lightslider.css')}}" 			rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettify.css')}}" 				rel="stylesheet">
    <link href="{{asset('public/frontend/css/vlite.css')}}" 				rel="stylesheet">
   

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    
    <link rel="shortcut icon" 									href="{{('public/frontend/images/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" 	href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" 	href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" 		href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" 					href="images/ico/apple-touch-icon-57-precomposed.png">


</head><!--/head-->

<body>

<?php 
    
    /* echo  (app_path() ."<br>");
    
    echo  (__FILE__   ."<br>"  );
    
    echo  (__DIR__   ."<br>"  );
     */
    //include app_path().'\includeViews\slider.php';
?>
    
    
    
    
    
    
    
    
    
    
    @component('demo.include.Demoheader')    @endcomponent



			
{{--			@component('slider')    @endcomponent   		--}}


     
 	<section>
        <div class="container">
            <div class="row">
            
                @component('demo.include.DemoLeftNavitab')    	@endcomponent
                
<!--                 <div class="col-sm-9 padding-right"> -->

                
                @yield('content')
                
<!--                 </div> -->
            </div>
        </div>
    </section>
    
    
    
    @component('demo.include.DemoFooter')    	@endcomponent










    
    
    
    
    

  
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
                				
                success		:	function(data){		//modal  #xemnhanh
                    
                    $('#product_quickview_title')	.html(data.product_name);
                    $('#product_quickview_image')	.html(data.product_image);
                    $('#product_quickview_gallery')	.html(data.product_gallery);
                    
                    $('#product_quickview_value')	.html(data.product_quickview_value);             
                    $('#product_quickview_id')		.html(data.product_id);                    
                    $('#product_quickview_price')	.html(data.product_price);                    
                    
                    $('#product_quickview_desc')	.html(data.product_desc);
                    $('#product_quickview_content')	.html(data.product_content);
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
  
  
</body>
</html>