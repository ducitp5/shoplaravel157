

 	@include('include.css')   
	
	
	
	<header id="header"><!--header-->
    
        <div class="header_top"><!--header_top-->
    
            <div class="container">
    
                <div class="row">
    
    
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> 0932023992</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> webextrasite.com</a></li>
                            </ul>
                        </div>
                    </div>
    
    
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>

    
                </div>
            </div>
        </div><!--/header_top-->
            
            
              
        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                
                    <div class="col-sm-4">
      
                        <div class="logo pull-left">
                            <a href="{{URL::to('/trang-chu')}}"><img src="{{('public/frontend/images/home/logo.png')}}" alt="ko co" /></a>
                        </div>
      
                        <div class="btn-group pull-right">
      
                            <div class="btn-group">
                                
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    USA
                                    <span class="caret"></span>
                                </button>
                                
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canada</a></li>
                                    <li><a href="#">UK</a></li>
                                </ul>
                            </div>
                            
                            <div class="btn-group">
                                
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    DOLLAR
                                    <span class="caret"></span>
                                </button>
                                
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canadian Dollar</a></li>
                                    <li><a href="#">Pound</a></li>
                                </ul>
                            </div>
      
                        </div>
                    </div>
                    
                    
      
                    <div class="col-sm-8">
                    
                        <div class="shop-menu pull-right">
                    
                            <ul class="nav navbar-nav">
                               
                                <li><a href="#"><i class="fa fa-star"></i> Yêu thích</a></li>
<?php
    

    use App\CatePost;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Session;

    $customer    =    Session::get('customer_id');
    $shipping_id    =    Session::get('shipping_id');
    
    if($customer != NULL     &&    $shipping_id == NULL){ 
 ?>
                              	<li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                
<?php
    }
    elseif($customer != NULL     &&   $shipping_id != NULL){
 ?>
 								<li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
<?php 
    }
    else{
?>
 								<li><a href="{{URL::to('/dang-nhap')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
<?php
    }
?>
                             	<li><a href="{{URL::to('/gio-hang')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
<?php

    $customer    =    Session::get('customer_id');

    if($customer!=NULL){ 
?>
								<li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
                                
<?php
    }
    else{
?>
								<li><a href="{{URL::to('/dang-nhap')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
<?php 
    }
?>
                               
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->
  
    
        <div class="header-bottom"><!--header-bottom-->
        
            <div class="container">
        
                <div class="row">
        
                    <div class="col-sm-7">
  
                        <div class="navbar-header">									                                                <!-- for what -->
        
                            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
  
                        <div class="mainmenu pull-left">
                        
                            <ul class="nav navbar-nav collapse navbar-collapse">
                        
                                <li><a href="{{URL::to('/trang-chu')}}" class="active">Trang chủ</a></li>
                        
                                <li class="dropdown"><a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>
                        
                                    <ul role="menu" class="sub-menu">
<?php 

    $category       =        DB::table('tbl_category_product')      ->where('category_status'   ,   '0')
    
                                                                    ->orderby('category_parent' ,   'desc')
                                                                    ->orderby('category_order'  ,   'ASC')      ->get();

    foreach($category as $key => $danhmuc){
?>
                                        <li><a href="{{URL::to('/danh-muc/'.$danhmuc->slug_category_product)}}">{{$danhmuc->category_name}}</a></li>
<?php 
    }
?>
                                    </ul>
                                </li> 
  
                                <li class="dropdown"><a href="#">Tin tức<i class="fa fa-angle-down"></i></a>
  
                                    <ul role="menu" class="sub-menu">
<?php 

    $category_post      =    CatePost::orderBy('cate_post_id','DESC')->get();
    
    foreach($category_post as $key => $danhmucbaiviet){
?>
                                        <li><a href="{{URL::to('/danh-muc-bai-viet/'.$danhmucbaiviet->cate_post_slug)}}">{{$danhmucbaiviet->cate_post_name}}</a></li>
<?php 
    }
?>                                
                                      
                                    </ul>
                                </li> 
    
                                <li><a href="{{URL::to('/gio-hang')}}">Giỏ hàng</a></li>
                                
                                <li><a href="{{URL::to('/video-shop')}}">Videos Shop</a></li>
                                
                                <li><a href="{{URL::to('/lien-he')}}">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
    
    
                    <div class="col-sm-5">
    
                        <form action="{{URL::to('/tim-kiem')}}" autocomplete="off" method="POST">
                        
                            {{csrf_field()}}
    	                
    	                    <div class="search_box">
                                
                                <!-- $('#keywords').keyup(function() -->
                            	
                            	<input type="text" style="width: 100%" name="keywords_submit" id="keywords" placeholder="Tìm kiếm sản phẩm"/>
                               	
                               	<div id="search_ajax">search_ajax</div>
    
                               	<input type="submit" style="margin-top:0;color:#666" name="search_items" class="btn btn-primary btn-sm" value="Tìm kiếm">

                        	</div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div><!--/header-bottom-->
    
    </header><!--/header-->
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

<script src="{{asset('public/frontend/js/jquery.js')}}"></script>

<script type="text/javascript">

    $('#keywords').keyup(function(){
        
    	var query 	=	 $(this).val();

    	
    	
      	if(query != '')
        {
			var _token = $('input[name="_token"]').val();

	/* 		alert('_token is : ' +_token); */
			
 			$.ajax({
 	 			
 				url			:"{{url('/autocomplete-ajax')}}"				,

  				method		:"POST"								,
  				
  				data		:{	query		:	query		, 
  	  							_token		:	_token
  							 }									,

  				success		:function(data){

	   				$('#search_ajax').fadeIn(50);  
					$('#search_ajax').html(data);
				}
 			});
		}
		else{

    		$('#search_ajax').fadeOut();  
		}
    });

    $(document).on('click'	,  '.li_search_ajax'	,	 function(){ 		//li_search_ajax  inside the HomeController@autocomplete_ajax
        
        $('#keywords').val($(this).text()); 
         
        $('#search_ajax').fadeOut();  
    }); 



</script>
    