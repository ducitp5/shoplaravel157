








<script type="text/javascript">

    $(document).ready(function(){

        $('#sort').on('change',function(){

            var url 	=	 $(this).val(); 

            alert(url);
            
            if (url) { 

                window.location = url;
            }
            return false;
        });

    }); 
</script>





<script type="text/javascript">

 	function view2(){        

         if(localStorage.getItem('data_viewed')	!=	null){

             var data = JSON.parse(localStorage.getItem('data_viewed'));

             data.reverse();

             document.getElementById('row_viewed').style.overflow 	= 'scroll';
             document.getElementById('row_viewed').style.height 	= '500px';

             $('#row_viewed').html('');
             
             for(i = 0  ; i < data.length  ;  i++){

                var name 	= data[i].name;
                var price 	= data[i].price;
                var image 	= data[i].image;
                var url 	= data[i].url;

                $('#row_viewed').append(

                    '<div class="row" style="margin:10px 0">'
                    	+'<div class="col-md-4">'
                    	
                    		+'<img width="100%" src="'+image+'">'

                		+'</div>'

                		+'<div class="col-md-8 info_wishlist">'

                			+'<p>'+name+'</p>'
                			+'<p style="color:#FE980F">'+price+'</p>'
                			+'<a href="'+url+'">Đặt hàng</a>'

            			+'</div>'
        			+'</div>'
    			);
            }
        }
     	else{
//			alert('not yet');

			$('#row_viewed').html(

                '<div class="row" style="margin:10px 0">'
                	+'dont have viewed product'
    		   +'</div>'
			);
     	}     
    }

//    view2();  

    $('#clear-viewed').on('click' ,  function(){
        
    	 // 		alert("Bạn đã đánh giá 5");

    	localStorage.removeItem("data_viewed"); 

    	$('#clear-viewed').refresh();
 //   	view();
    });

    
   	
    
</script>




 
 
<script type="text/javascript">

 	function view(){        

         if(localStorage.getItem('data')	!=	null){

             var data = JSON.parse(localStorage.getItem('data'));

             data.reverse();

             document.getElementById('row_wishlist').style.overflow 	= 'scroll';
             document.getElementById('row_wishlist').style.height 		= '500px';

             $('#row_wishlist').html('');
             
             for(i = 0  ; i < data.length  ;  i++){

                var name 	= data[i].name;
                var price 	= data[i].price;
                var image 	= data[i].image;
                var url 	= data[i].url;

                $('#row_wishlist').append(

                    '<div class="row" style="margin:10px 0">'
                    	+'<div class="col-md-4">'
                    	
                    		+'<img width="100%" src="'+image+'">'

                		+'</div>'

                		+'<div class="col-md-8 info_wishlist">'

                			+'<p>'+name+'</p>'
                			+'<p style="color:#FE980F">'+price+'</p>'
                			+'<a href="'+url+'">Đặt hàng</a>'

            			+'</div>'
        			+'</div>'
    			);
            }
        }
     	else{
//			alert('not yet');

			$('#row_wishlist').html(

                '<div class="row" style="margin:10px 0">'
                	+'dont have liked product'
    		   +'</div>'
			);
     	}     
    }

    view();  

    $('#clear-liked').on('click' ,  function(){
        
    	 // 		alert("Bạn đã đánh giá 5");

    	localStorage.removeItem("data"); 

    	$('#clear-liked').refresh();
 //   	view();
    });
    

   	function add_wistlist(clicked_id){

        alert(+clicked_id);
          
        var id 			= clicked_id;
        var name 		= document.getElementById('wishlist_productname'	+id).value;
        var price 		= document.getElementById('wishlist_productprice'	+id).value;
        var image 		= document.getElementById('wishlist_productimage'	+id).src;
        var url 		= document.getElementById('wishlist_producturl'		+id).href;

        var newItem 	= {
                
            'url'	: url,
            'id' 	: id,
            'name'	: name,
            'price' : price,
            'image' : image
        }

//		alert('2');
        console.log('newItem 		: '	 +newItem);
        console.log('newItem-JSON 	: '	 +JSON.stringify(newItem , null , 4));
        
        if(localStorage.getItem('data')  ==  null){
            
           	localStorage.setItem('data', '[]');

//           	alert('the 1st time like an item');
        }
        else{

//        	  alert('like multiple items');
        } 
      

        
        var old_data 	=	 JSON.parse(localStorage.getItem('data'));

        console.log('getItem(data) : ' 		+localStorage.getItem('data'));
        console.log('old_data : '			+JSON.stringify(old_data , null , 4));


        
        var matches 	=	 $.grep(old_data  , function(obj){		// return array
            
            return 		obj.id == id;
        })
        
        console.log('matches : '		+JSON.stringify(matches , null , 4));
        
        if(matches.length){											// array.length
            
            alert('Sản phẩm bạn đã yêu thích,nên không thể thêm');

//            console.log('matches.length : '+matches.length);		//max 1


        }             
        else{
            
        	alert('new item added to the like list');
        	
            old_data.push(newItem);

        	$('#row_wishlist').append(

           		'<div class="row" style="margin:10px 0">'
           			+'<div class="col-md-4">'

           				+'<img width="100%" src="'+newItem.image+'">'
       				+'</div>'

   					+'<div class="col-md-8 info_wishlist">'

   						+'<p>'+newItem.name+'</p>'

   						+'<p style="color:#FE980F">'+newItem.price+'</p>'

   						+'<a href="'+newItem.url+'">Đặt hàng</a>'
					+'</div>'
				+'</div>'
			);   
        }
       
        localStorage.setItem('data', JSON.stringify(old_data));      
	}
    
</script>



 
 	<script type="text/javascript">
 	
     	$(document).ready(function() {
         	
 //           setInterval(timestamp, 1000);
        });
        
        function timestamp() {
            
            $.ajax({

                url: '{{url("/test/timestamp")}}',

                success: function(data) {

                    $('#timestamp').html(data);
                },
            });
        }

	</script>
	
	
	
 	 <!--add to  cart quickview-->
 	 
     <script type="text/javascript">
       
            $(document).on('click' , '.add-to-cart-quickview',function(){

                var id 						= $(this).data('id_product');
                
                var cart_product_id 		= $('.cart_product_id_' 		+ id).val();
                var cart_product_name 		= $('.cart_product_name_' 		+ id).val();
                var cart_product_image 		= $('.cart_product_image_' 		+ id).val();
                var cart_product_quantity 	= $('.cart_product_quantity_' 	+ id).val();
                var cart_product_price 		= $('.cart_product_price_' 		+ id).val();
                var cart_product_qty_get	= $('.cart_product_qty_get' 	    ).val();
                
                var _token 					= $('input[name="_token"]').val();

                if(parseInt(cart_product_qty_get) > parseInt(cart_product_quantity)){
                    
                    alert('Làm ơn đặt nhỏ hơn ' + cart_product_quantity);
                }
                else{

                    $.ajax({
                        
                        url			: 	'{{url('/add-cart-ajax')}}',

                        method		: 	'POST',

                        data		:	{	cart_product_id			:	cart_product_id,
                            				cart_product_name		:	cart_product_name,
                            				cart_product_image		:	cart_product_image,
                            				cart_product_quantity	:	cart_product_quantity,
                            				cart_product_price		:	cart_product_price,
                            				cart_product_qty_get	:	cart_product_qty_get,
                            				
                            				_token					:	_token
                            				
                        				},


                        beforeSend	: 	function(){
                            
                            $("#beforesend_quickview").html("<p class='text text-primary'>Đang thêm sản phẩm vào giỏ hàng</p>");
                        },
                        
                        success		:	function(){

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
        	
            $('.calculate_delivery').click(function(){

            	var _token 		= $('input[name="_token"]').val();
            	
                var matp 		= $('.city').val();
                var maqh 		= $('.province').val();
                var xaid 		= $('.wards').val();
                
                if(matp == '' && maqh =='' && xaid ==''){
                    
                    alert('Làm ơn chọn tinh thanh để tính phí vận chuyển');
                }
                else{
                    
                    $.ajax({
                        
                        url 		: '{{url('/calculate-fee')}}',
                        method		: 'POST',
                        
                        data		:	{	matp	:	matp,
                            				maqh	:	maqh,
                            				xaid	:	xaid,
                            				_token	:	_token
                        				},
                        				
                        success		:	function(){
                            
                           	location.reload(); 
                        }
                    });
                } 
        	});
    	});
    </script>
    
    
    
    
 
	<script type="text/javascript">
 	 
		$(document).ready(function(){
			
            $('.choose').on('change',function(){

				var _token 		=	 $('input[name="_token"]').val();
                
                var result 		=	 '';               
                var ma_id 		=	 $(this).val();                
                var action 		=	 $(this).attr('id');

                
                if(action  ==  'city'){         result = 'province';    }  // select city  	  	==> change province


                else{			                result = 'wards';	    }  // select province 	==> change wards

              	$.ajax({
                  	
                    url 		:	 '{{url('/select-delivery-home')}}',
                    method		:	 'POST',
                    
                    data		:	{	action	:	action,
                        				ma_id	:	ma_id,
                        				_token	:	_token
                    				},
                    				
                    success		:	function(data){
                        
                       $('#'+result).html(data);     
                    }
                });
        });
        });
          
	</script>
    
    
    
    
 	
	<script type="text/javascript">

		$(document).ready(function(){

            $('.send_order').click(function(){			// cant use submit by using Post method

            	if( $('.shipping_address').val().trim() == ''){

            		alert('address cant be null');
            		$('.shipping_address').style.borderColor = "green";
            		exit();
            	}
 				           	            	
    	        swal(
	    	        {
        	        
                        title					: "Xác nhận đơn hàng",
                        text					: "Đơn hàng sẽ không được hoàn trả khi đặt,bạn có muốn đặt không?",
                        type					: "warning",
                        
                        showCancelButton		: true,
                        cancelButtonText		: "Đóng,chưa mua",
                        
                        confirmButtonClass		: "btn-danger",
                        confirmButtonText		: "Cảm ơn, Mua hàng",
    
                        
                        closeOnConfirm			: false,
                        closeOnCancel			: false
                    },
                
                    function(isConfirm){
    					
                    	if (isConfirm) {
    
                    		var _token 				= $('input[name="_token"]').val();
                            
                            var shipping_email 		= $('.shipping_email').val();
                            var shipping_name 		= $('.shipping_name').val();
                            var shipping_address 	= $('.shipping_address').val();
                            var shipping_phone 		= $('.shipping_phone').val();
    
                            var shipping_notes 		= $('.shipping_notes').val();
                            
                            var order_fee 			= $('.order_fee').val();
                            var order_coupon 		= $('.order_coupon').val();
                            
                            
                            var shipping_method 	= $('.payment_select').val();
                          
                            
                            $.ajax({
                                
                            	url			: '{{url('/confirm-order' )}}',
                                method		: 'POST',
                                
                                data		:	{	_token				:	_token,
    
                                                    shipping_email		:	shipping_email,                            	
                                                    shipping_name		:	shipping_name,
                                                    shipping_address	:	shipping_address,
                                                    shipping_phone		:	shipping_phone,
                                                    shipping_notes		:	shipping_notes,  
                                                                                                  
                                                    order_fee			:	order_fee,
                                                    order_coupon		:	order_coupon,
                                                    shipping_method		:	shipping_method
                                    			},
    
                                success		:	function(){
                                    
                                   	swal("Đơn hàng"	 , "Đơn hàng của bạn đã được gửi thành công"  , "success");
                                }
                        	});

                            window.setTimeout(
    
                                function(){    location.reload();     	} ,
    
                                2000
                            );
    					}
                        else{
                            
                            swal("Đóng"	   ,   "Đơn hàng chưa được gửi, làm ơn hoàn tất đơn hàng"	,   "error");
                      	}              
                	}
            	);               
            });
        });
				
    </script>
    
    
    
    
 	<script type="text/javascript">
 	
        $(document).ready(function(){

        	$('.add-to-cart').click(function(){

//        		alert('add cart ajax begin');
        		
                var id 							= $(this).data('id_product');                
          //      var sid			                =    session_id();
                
                var cart_product_id 			= $('.cart_product_id_' 		+ id).val();
                var cart_product_name 			= $('.cart_product_name_' 		+ id).val();
                var cart_product_price 			= $('.cart_product_price_' 		+ id).val();
                var cart_product_image 			= $('.cart_product_image_' 		+ id).val();
                var cart_product_qty_get 		= $('.cart_product_qty_get_'	+ id).val();
                var cart_product_quantity 		= $('.cart_product_quantity_' 	+ id).val();  
                
                var _token 						= $('input[name="_token"]')			 .val();
                
                console.log('truoc post');
                console.log('SL get : ' +cart_product_qty_get);
                
                if(parseInt(cart_product_qty_get) > parseInt(cart_product_quantity)){

                    alert('Làm ơn đặt nhỏ hơn ' + cart_product_quantity);
                }
                
                else{

                    $.ajax({
                        
                        url			: 	'{{url('/add-cart-ajax')}}',
                        method		: 	'POST',
                        
                        data		:	{	//	sid						:	session_id(),
                            
                            				cart_product_id			:	cart_product_id	,
                            				cart_product_name		:	cart_product_name,
                            				cart_product_price		:	cart_product_price,

                            				cart_product_qty_get	:	cart_product_qty_get,
                            				cart_product_image		:	cart_product_image,
                            				cart_product_quantity	:	cart_product_quantity,  

                            				_token:_token
                        				},
                            				
                        success		:	function(){

                            swal({
                                    title					:	 "Đã thêm sản phẩm vào giỏ hàng",
                                    text					:	 "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                    
                                    showCancelButton		:	 true,
                                    cancelButtonText		:	 "Xem tiếp",
                                    
                                    confirmButtonClass		:	 "btn-success",
                                    confirmButtonText		:	 "Đi đến giỏ hàng",
                                    
                                    closeOnConfirm			:	 true
                                },
                                
                                function() {
                                    
                                    window.location.href = "{{url('/gio-hang')}}";
                                });

                        }

                    });

                    console.log('sau ajax');
                }
                
            });
        });
    </script>
    
    
    
 
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
                  	},

                  	 error		: function(xhr){

                     	console.log('xhr - '  , xhr);
                     	console.log('this - ' , this);
                     	console.log("une erreur occured: " + xhr.status + " - " + xhr.statusText);
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
 	
         $(document).ready(function() {

            $('#imageGallery').lightSlider({
    
                gallery					:true,
                item					:1,
                loop					:true,
                thumbItem				:3,
                slideMargin				:0,
                enableDrag				: false,
                currentPagerPosition	:'left',
                
                onSliderLoad			: function(el) {
                    
                    el.lightGallery({

                        selector		: '#imageGallery .lslide'
                    });
                }
    
            });  
          });
    </script>
    
    
    
    
    
    
    
    
    
 
 	<script type="text/javascript">
    
        $('#keywords').keyup(function(){
            
            var query 	=	 $(this).val();
    
          	if(query != '')
            {
                 var 	_token 		=	 $('input[name="_token"]').val();
    
                 $.ajax({
                     
                  	url			:	"{{url('/autocomplete-ajax')}}"	,
                  	
                  	method		:	"POST"								,

                  	data		:	{
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
      
        $(document).on('click','.watch-video',function(){
            
            var 	video_id 	=	 $(this).attr('id');			/*  $video->video_id */

            var 	_token 		=	 $('input[name="_token"]').val();
			
            $.ajax({
                
                url			:	'{{url('/watch-video')}}'		,
                method		:	"POST"							,
                dataType	:	"JSON"							,
                
                data		:	{
                    				video_id	:	video_id,
                    				_token		:	_token
                			 	}								,
                			 

                success		:function(data){
                    
                    $('#video_title')	.html(data.video_title);
                   
                    $('#video_desc')	.html(data.video_desc); 

                    $('#video_link')	.html(data.video_link);

        //										vlite.css  .js            
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
                },		// fin success

                error		: function(xhr){

                	console.log('xhr --- '  , xhr);
                	console.log('this - ' , this);
                	console.log("une erreur video: " + xhr.status + " - " + xhr.statusText);
                }
            }); 		// fin ajax
        });
    </script>
    
    
    
    
    
    
    
	<script type="text/javascript">
        
        $('.xemnhanh').click(function(){
        	
            var 	product_id 		=	 $(this).data('id_product');
            var 	_token 			=	 $('input[name="_token"]').val();

            console.log('id clicked- ' , product_id );
            
            $.ajax({
                
                url			:	"{{url('/quickview')}}",
                method		:	"POST",
                dataType	:	"JSON",
                
                data		:	{	product_id	:	product_id, 
                    				_token		:	_token
                				},
                				
                success		:	function(data){		//modal  #xemnhanh
        
                    console.log('data xem nhanh - ' , data);
                    
                    $('#product_quickview_title')	.html(data.product_name);
                    $('#product_quickview_image')	.html(data.product_image);
                    $('#product_quickview_gallery')	.html(data.product_gallery);
                    
                    $('#product_quickview_value')	.html(data.product_quickview_value);             
                    $('#product_quickview_id')		.html(data.product_id);                    
                    $('#product_quickview_price')	.html(data.product_price);                    
                    
                    $('#product_quickview_desc')	.html(data.product_desc);
                    $('#product_quickview_content')	.html(data.product_content);
                    $('#product_quickview_button')	.html(data.product_button);
                },
                
                error		: function(xhr){

                	console.log('xhr - '  , xhr);
                	console.log('this - ' , this);
                	console.log("une erreur occured: " + xhr.status + " - " + xhr.statusText);
                }
            });

            console.log('sau ajax');
        });

/* 
        $('.xemnhanh').click(function(){
            var product_id = $(this).data('id_product');
            var _token = $('input[name="_token"]').val();
            $.ajax({
            url:"{{url('/quickview')}}",
            method:"POST",
            dataType:"JSON",
            data:{product_id:product_id, _token:_token},
              success:function(data){
                $('#product_quickview_title').html(data.product_name);
                $('#product_quickview_id').html(data.product_id);
                $('#product_quickview_price').html(data.product_price);
                $('#product_quickview_image').html(data.product_image);
                $('#product_quickview_gallery').html(data.product_gallery);
                $('#product_quickview_desc').html(data.product_desc);
                $('#product_quickview_content').html(data.product_content);
                $('#product_quickview_value').html(data.product_quickview_value);
                $('#product_quickview_button').html(data.product_button);
              }
            });
        }); */



        
    </script>
    
    
    
    
    
    
    
    
    
    
   
 
    
    
    
    
    
    
   
   
   
   
   