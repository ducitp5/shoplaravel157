	<link href="{{asset('public/frontend/css/bootstrap.min.css')}}" 		rel="stylesheet">
 	<link href="{{asset('public/frontend/css/main.css')}}" 					rel="stylesheet">
 	
 	
   	<link href="{{asset('public/frontend/css/lightslider.css')}}" 			rel="stylesheet">		<!-- lightSlider  -->
    

	<script src="{{asset('public/frontend/js/jquery.js')}}"></script>
	
<!-- 	<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>	 -->
	
	<script src="{{asset('public/frontend/js/lightslider.js')}}"></script>							<!-- lightSlider  -->


	



<?php 

    
    use Illuminate\Support\Facades\DB;

    
    $product_slug           =    "may-choi-game-ps4-pro-1tb-tang-them-tay-cam-va-3-game";
    
    $product_details                  =    DB::table('tbl_product')
                                        
                                        ->join('tbl_category_product'   ,   'tbl_category_product.category_id'  ,   '='   ,   'tbl_product.category_id')
                                        
                                        ->join('tbl_brand'              ,   'tbl_brand.brand_id'                ,   '='   ,   'tbl_product.brand_id')
                                        
                                        ->where('tbl_product.product_slug'  ,   $product_slug)
                                        
                                        ->first();
  
                                        
    $category_id            =    $product_details->category_id;
    $product_id             =    $product_details->product_id;
    $product_cate           =    $product_details->category_name;
    $cate_slug              =    $product_details->slug_category_product;
    
    //seo
    
    $meta_desc              =    $product_details->product_desc;
    $meta_keywords          =    $product_details->product_slug;
    $meta_title             =    $product_details->product_name;
    
?>

<div class="container">

	<div class="col-sm-9 padding-right" >
	
		<div class="product-details"><!--product-details-->
		
		
<style type="text/css">

	.lSSlideOuter .lSPager.lSGallery img {
	
	    display    : block;
	    height     : 140px;
	    max-width  : 100%;
	}
	
	li.active {
    
        border: 2px solid #FE980F;
    }
    
</style>

            <nav aria-label="breadcrumb">
            
              	<ol class="breadcrumb"  style="background: none;">
              	
                	<li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
                	
                	<li class="breadcrumb-item"><a href="{{url('/danh-muc/'.$cate_slug)}}">{{$product_cate}}</a></li>
                	
                	<li class="breadcrumb-item active" aria-current="page">{{$meta_title}}</li>
              	
              	</ol>
            </nav>
<?php 
    
    use App\Gallery;

    $gallery            =    Gallery::where('product_id'    ,   $product_id)    ->get();
  
?>          
            
            <div class="col-sm-5">
            
            	<ul id="imageGallery">           	
<?php 
    foreach($gallery as $key => $gal){
?>         
        	  		<li data-thumb="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}" data-src="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}">
        
						<img width="100%" alt="{{$gal->gallery_name}}" 		src="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}" />
        
            	  	</li>
<?php 
    }
?>           	             	 
            	</ul>
            
            </div>
 
 
 
 

  	
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


               
    		
			<div class="col-sm-7">

				<div class="product-information"><!--/product-information-->
		
					{{-- <img src="images/product-details/new.jpg" class="newarrival" alt="" /> --}}
					
					<h2>{{$value->product_name}}</h2>
					
					<p>Mã ID: {{$value->product_id}}</p>
					
<!-- 					<img src="{{asset('public/images/product-details/rating.png')}}" alt="" /> -->
					
					
					<form action="{{URL::to('/save-cart')}}" method="POST">
						@csrf
						<input type="hidden" value="{{$value->product_id}}" 		class="cart_product_id_{{		$value->product_id}}">

                        <input type="hidden" value="{{$value->product_name}}" 		class="cart_product_name_{{		$value->product_id}}">

                        <input type="hidden" value="{{$value->product_image}}" 		class="cart_product_image_{{	$value->product_id}}">

                        <input type="hidden" value="{{$value->product_quantity}}" 	class="cart_product_quantity_{{	$value->product_id}}">

                        <input type="hidden" value="{{$value->product_price}}" 		class="cart_product_price_{{	$value->product_id}}">
                              
    					<span>
    						<span>{{number_format($value->product_price,0,',','.').'VNĐ'}}</span>
    					
    						<label>Số lượng:</label>
    						
    						<input name="qty" type="number" min="1" class="cart_product_qty_{{$value->product_id}}"  value="1" />
    						
    						<input name="productid_hidden" type="hidden"  value="{{$value->product_id}}" />
    					</span>
    					
    					<input type="button" value="Thêm giỏ hàng" class="btn btn-primary btn-sm add-to-cart" data-id_product="{{$value->product_id}}" name="add-to-cart">
					
					</form>


					<p><b>Tình trạng:</b> 			Còn hàng</p>
					<p><b>Điều kiện:</b> 			Mơi 100%</p>
					
					<p><b>Số lượng kho còn:</b> 	{{$value->product_quantity}}</p>
					<p><b>Thương hiệu:</b> 			{{$value->brand_name}}</p>
					<p><b>Danh mục:</b> 			{{$value->category_name}}</p>
					
					
<style type="text/css">

	a.tags_style {
	  
	    margin     : 3px 2px;
	    border     : 1px solid;
	  
	    height     : auto;
	    background : #428bca;
	    color      : #abc;
	    padding    : 0px;
	  
	}
	a.tags_style:hover {
	    background: black;
	}
</style>
					<fieldset>
					
						<legend>Tags</legend>
						
						<p><i class="fa fa-tag"></i>
<?php 
        $tags   =    $product_details ->product_tags;
  
        $tags   =    explode(","    ,   $tags);
        
        
        foreach($tags as $tag){
?>								
							<a href="{{url('/tag/'.str_slug($tag))}}" class="tags_style">{{$tag}}</a>
<?php 
        }
?>		
						</p>
						
					</fieldset>
					
					<a href="#"><img src="{{asset('public/images/product-details/share.png')}}" class="share img-responsive"  alt="share" /></a>
					
				</div><!--/product-information-->
			</div>

		</div><!--/product-details-->
		
	</div>
</div>







		