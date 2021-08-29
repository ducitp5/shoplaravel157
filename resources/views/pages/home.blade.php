@extends('layout')




@section('content')

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

                            <input type="hidden" 	value="{{$product->product_name}}" 		class="cart_product_name_{{$product->product_id}}"
                            
                            	   id="wishlist_productname{{$product->product_id}}" >
                          
                            <input type="hidden" 	value="{{$product->product_quantity}}" 	class="cart_product_quantity_{{$product->product_id}}">
                            
                            <input type="hidden" 	value="{{$product->product_image}}" 	class="cart_product_image_{{$product->product_id}}">
                            
                            <input type="hidden" 	value="{{$product->product_price}}" 	class="cart_product_price_{{$product->product_id}}"
                            
                            	   id="wishlist_productprice{{$product->product_id}}">
                            
                            <input type="hidden" 	value="1" 								class="cart_product_qty_get_{{$product->product_id}}">


                            <a id="wishlist_producturl{{$product->product_id}}"  href="{{URL::to('/chi-tiet/'.$product->product_slug)}}">                    	
                            	
                                <img id="wishlist_productimage{{$product->product_id}}"		src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
                            
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
                            
                            <input 	type="button" 			value="Thêm giỏ hàng"		class="btn btn-default add-to-cart" 
                            		data-id_product="{{$product->product_id}}" 			name="add-to-cart">


					        <!-- Trigger Modal by Data-target -->
					        <!-- getData by JQuery via .xemnhanh -->
					        
							<input 	type="button" 			value="Xem nhanh"			class="btn btn-default xemnhanh"	
                            		data-toggle="modal" 	data-target="#xemnhanh" 	name="add-to-cart"
                            		data-id_product="{{$product->product_id}}" >
                            		
                        </form>                      

                	</div>
                      
				</div>
        

                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <style type="text/css">

                            ul.nav.nav-pills.nav-justified li {
                                text-align: center;
                                font-size: 13px;
                            }
                            .button_wishlist{
                                border: none;
                                background: #ffff;
                                color: #B3AFA8;
                            }
                            ul.nav.nav-pills.nav-justified i {
                                color: #B3AFA8;
                            }
                            .button_wishlist span:hover {
                                color: #FE980F;
                            }
                        
                            .button_wishlist:focus {
                                border: none;
                                outline: none;
                            }
                          
                        </style>

                        <li>
                         	<i class="fa fa-plus-square"></i>

                         	<button 	class="button_wishlist" id="{{$product->product_id}}" 
                         				onclick="add_wistlist(this.id);">
                         	
                         		<span>Yêu thíchh</span>
                     		</button>

                        </li>

                        <li ><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                        
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
                            <div id="product_quickview_value"> is hidden this , to sent hidden values</div>
                        
                        	<div class="col-md-7">
                        	
                            	<h2><span id="product_quickview_title">---ko tac dung, vi da get product_quickview_title-----</span></h2>
                    
                            	<p>Mã ID: <span id="product_quickview_id"></span></p>
                            
                            	<p style="font-size: 20px; color: brown;font-weight: bold;">Giá sản phẩm : <span id="product_quickview_price"></span></p>
            
                            	<label>Số lượng:</label>
        
                            	<input name="cart_product_qty_get" type="number" min="1" class="cart_product_qty_get"  value="1" />
                         
                        		<!-- </span> -->
                        		
                        		<h4 style="font-size: 20px; color: brown;font-weight: bold;">Mô tả sản phẩm</h4>
                        		<hr>
    
                                <p><span id="product_quickview_desc"></span></p>
                                <p><span id="product_quickview_content"></span></p>
                                
                                <div id="product_quickview_button"></div>
                                
                                <div id="beforesend_quickview">ko co j</div>
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
	
	
	
	
	<script type="text/javascript">
    
        $(document).ready(function(){

// for load in the beginning

            var cate_id 	=	 $('.tabs_pro').data('id');
            
            var _token 		=	 $('input[name="_token"]').val();

            $.ajax({
                
                url			:	'{{ url('/product-tabs' )  }}'		,
                
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
	 


@endsection