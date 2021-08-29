@extends('layout')


@section('content')


          

	<div class="features_items">       <!--features_items-->
	
        <div 	class="fb-share-button" 		data-href="http://localhost/tutorial_youtube/shopbanhanglaravel" 	
        		data-layout="button_count" 		data-size="small">
        		
    		<a 	target="_blank" 	href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse" 
    			class="fb-xfbml-parse-ignore">
    			
    				Chia sẻ
			</a>
		</div>
        
        
    	<div 	class="fb-like" 	data-href="{{$url_canonical}}" 		data-width="" 		data-layout="button_count" 
    			data-action="like" 	data-size="small" 					data-share="false">
		</div>

		<h2 class="title text-center">	{{$meta_title}}	</h2>
		
		
	 	<div class="row">

            <div class="col-md-4">
                    
                <label for="amount">Sắp xếp theo</label>
        
                <form>
                    @csrf
        
                    <select name="sort" id="sort" class="form-control">
                    
                        <option value="{{Request::url()}}?sort_by=none">--Lọc theo--</option>
                        <option value="{{Request::url()}}?sort_by=tang_dan">--Giá tăng dần--</option>
                        <option value="{{Request::url()}}?sort_by=giam_dan">--Giá giảm dần--</option>
                        <option value="{{Request::url()}}?sort_by=kytu_az">Lọc theo tên A đến Z</option>
                        <option value="{{Request::url()}}?sort_by=kytu_za">Lọc theo tên Z đến A</option>
                        
                    </select>
        
                </form>
               
            </div>

            <div class="col-md-4">
                
                <label for="amount">Lọc giá theo</label>
            
                <form>
                    <div id="slider-range"></div>
                    
                    <style type="text/css">
                        .style-range p {
                            float: left;
                            width: 25%;
                        }
                    </style>
                           
                    
            		<div class="style-range">
                
                		<p><input type="text" id="amount_start" readonly style="border:0; color:#f6931f; font-weight:bold;"></p>
           
        			 	<p><input type="text" id="amount_end" readonly style="border:0; margin-left:50px; color:green; font-weight:bold;"></p>
                                      
                    </div>
                    
                    <input type="text" name="start_price"   id="start_price" placeholder="min price">
                    <input type="text" name="end_price" 	id="end_price"   placeholder="max price">	 

                    <br>
                    <div class="clearfix"></div>
                    
                    
                    <input type="submit" name="filter_price" value="Lọc giá" class="btn btn-sm btn-default">
                    
                    
                </form>
                   
            </div>
            
            <div class="col-md-4">
                
                <p>count     : 		{{$category_by_id->count()}}</p>
        		<p>min price : 		{{number_format( $min_price		  ,0,',','.')}}</p>
   				<p>max price : 		{{number_format( $max_price 	  ,0,',','.')}}</p>
			 	<p>min rang  :	 	{{number_format( $min_price_range ,0,',','.')}}</p>
			 	<p>max rang  : 		{{number_format( $max_price_range ,0,',','.')}}</p>
       
            </div>
            
        </div>

<?php     
    
    foreach($category_by_id as $key => $product){

?>                
    <!--     <a href="{{URL::to('/chi-tiet/'.$product->product_slug)}}"> -->
        
    	<div class="col-sm-4">
         	
         	<div class="product-image-wrapper">
       
                <div class="single-products">
                        
                    <div class="productinfo text-center">
                    	
                    	<h2>id : {{number_format($product->product_id,0,',','.')}}</h2>
                    	
                    	<form>
                                @csrf
                                
                            <input type="hidden" value="{{$product->product_id}}" 		class="cart_product_id_{{		$product->product_id}}">
                            <input type="hidden" value="{{$product->product_name}}" 	class="cart_product_name_{{		$product->product_id}}">
                            <input type="hidden" value="{{$product->product_image}}" 	class="cart_product_image_{{	$product->product_id}}">
                            <input type="hidden" value="{{$product->product_quantity}}" class="cart_product_quantity_{{	$product->product_id}}">
                            <input type="hidden" value="{{$product->product_price}}" 	class="cart_product_price_{{	$product->product_id}}">
                            
                            <input type="hidden" value="1" 								class="cart_product_qty_get_{{	$product->product_id}}">
        
                            <a href="{{URL::to('/chi-tiet/'.$product->product_slug)}}">
                            
                                <img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
                            
                                <h2>{{number_format($product->product_price,0,',','.').' '.'VNĐ'}}</h2>
                            
                                <p>{{$product->product_name}}</p>            
                             
                         	</a>
                             
                        	<input type="button" value="Thêm giỏ hàng" class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart">
                      
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
    <!--     </a> -->
<?php 
    }
?>
    </div><!--features_items-->
    
   	<ul class="pagination pagination-sm m-t-none m-b-none">
       	
       	{!!		$category_by_id->links()	!!}
    </ul>

        <!--/recommended_items-->
        
        
        
        
<script type="text/javascript">

	$(document).ready(function(){

		const current_url	 	=  window.location.href;
		const router 			=  "{{URL::to('danh-muc/')}}";

		console.log(current_url.includes(router));
		
		if(current_url.includes(router)){

    		console.log('window.location.protocol = ' +window.location.protocol);
    		console.log('window.location.host = '     +window.location.host); 
    		console.log('window.location.href = ' 	  +window.location.href);
    		console.log('window.location.pathname = ' +window.location.pathname);
    		console.log('window.location.search = '   +window.location.search);
    	
    		console.log('location.pathname = ' 		  +location.pathname);
    		console.log('URL::to(danh muc) = ' 		  +"{{URL::to('danh-muc/')}}");
    
    
     
      		$( "#slider-range" ).slider({
    			
    			
               	orientation		: "horizontal",
              	
              	range			: true,
    
              	min				: {{	$min_price_range	}},
              	max				: {{	$max_price_range	}},
    
              	steps			: 50000,
              	values			: [ {{ $min_price }}   ,  {{ $max_price }} ] ,
             
              	slide			: function( event, ui ) {
    
                    $( "#amount_start" ).val(ui.values[ 0 ]).simpleMoneyFormat();
                	$( "#amount_end" )	.val(ui.values[ 1 ]).simpleMoneyFormat();
    
    
                    $( "#start_price" )	.val(ui.values[ 0 ]);
                    $( "#end_price" )	.val(ui.values[ 1 ]);
              	}
            }); 
    		
            $( "#amount_start" ).val($( "#slider-range" ).slider("values",0)).simpleMoneyFormat();
            $( "#amount_end" )	.val($( "#slider-range" ).slider("values",1)).simpleMoneyFormat();


		}
		else{

			console.log('sai rui');
		}
    }); 
</script>
        
@endsection