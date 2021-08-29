@extends('layout')


@section('content')

    <section id="cart_items">
    
    <!-- 	<div class="container"> -->
    	<div>
    		<div class="breadcrumbs">
    
    			<ol class="breadcrumb">
    
    				<li><a href="{{URL::to('/')}}">Trang chủ</a></li>
    
    				<li class="active">Giỏ hàng của bạn</li>
    			</ol>
    		</div>
<?php 
    use Illuminate\Support\Facades\Session;
    
    
    if(session()->has('message')){
?>    
    		<div class="alert alert-success">{!! 	session()	->get('message') 	!!}</div>
<?php
        Session::put('message' , null);
    }
    elseif(session()->has('error')){
?>
    		<div class="alert alert-danger">{!! 	session()	->get('error') 		!!}</div>
<?php 
    }
?>
    		<div class="table-responsive cart_info">
    		
<style>
    table, th, td {
    
        border: 3px solid black;
    }
</style>    
    			<form action="{{url('/update-cart')}}" method="POST">
    			
    				@csrf
    			
    				<table class="table table-condensed">
    			
    					<thead>
    			
    						<tr class="cart_menu">
    			
    							<td class="image">			Hình ảnh		</td>
    							<td class="description">	Tên sản phẩm	</td>
    							<td class="description">	Số lượng tồn	</td>
    							<td class="price">			Giá sản phẩm	</td>
    							<td class="quantity">		Số lượng		</td>
    							<td class="total">			Thành tiền		</td>
    							<td>						Edit			</td>
    						</tr>
    					</thead>
    					
    					<tbody>
 
 <script>
		
    console.log(JSON.stringify(<?php echo json_encode(Session::get('cart')) ;?> , undefined, 4));  			// console              //      console
   
</script>
   					
	
<?php 

    if(Session::get('cart')==true){
              
 //       echo    "<pre>";
        
 //       echo        print_r(Session::get('cart'));
        
 //       echo    "</pre>";
        
                  
        $total = 0;
        
        foreach(Session::get('cart') as $key => $cart) {		
			
    		$subtotal 	=	   $cart['product_price']  *   $cart['product_qty']; 
    		
    		$total		+=	   $subtotal;
?>
    
    						<tr>
    							<td>
    							
    								<img	src="{{asset('public/uploads/product/'.$cart['product_image'])}}"
    								
    										width="90" 		alt="{{$cart['product_name']}}" />
								</td>
    							
    							
    							<td class="">    							
    								<h4>	
    									<a href="{{URL::to('/chi-tiet/'.$cart['product_slug'])}}">
    								
    										<p>{{	$cart['product_name']	}}</p>
    								
    									</a>	
									</h4>    								
    							</td>
    							
    							
    							<td class="cart_description">
    							    								
    								<p>{{	$cart['product_quantity']	}}</p>
    							</td>
    							
    							
    							<td class="cart_price">
    							
    								<p>{{ number_format( $cart['product_price'] , 0 , ',' , '.') }}đ </p>
    							</td>
    							
    							
    							<td class="cart_quantity">
    							
    								<div class="cart_quantity_button">
    
    									<input 	class="cart_quantity" 	   type="number" 	min="1"
    									
    											name="cart_qty[{{$cart['session_id']}}]"	value="{{$cart['product_qty']}}">        
    								</div>
    							</td>
    
    
    							<td class="cart_total">
    								<p class="cart_total_price">	{{  number_format(  $subtotal   , 0,',','.')  }}đ		</p>
    							</td>
    
    
    							<td {{-- class="cart_delete"  --}} >
    							
    								<a  onclick="return confirm('Bạn có chắc là muốn xóa đơn hàng này ko?')"
        							 	class="cart_quantity_delete"		href="{{url('/del-product/'.$cart['session_id'])}}">
    									<i	class="fa fa-times"></i>
									</a>
								</td>
    						</tr>
<?php 
        }
?>
    						<tr>
    							<td>
    								<input 	type="submit" 		value="Cập nhật giỏ hàng"
    										name="update_qty" 	class="check_out btn btn-default btn-sm">
								</td>
	
								
    							<td><a 	class="btn btn-default check_out"		onclick="return confirm('Bạn có chắc là muốn xóa đơn hàng này ko?')"
    									href="{{url('/del-all-product')}}">	
    									
									Xóa tất cả</a>
								</td>
	
								
    							<td>
<?php 
        if(Session::get('coupon')){
?>    	  								 
    									<a	class="btn btn-default check_out"		href="{{url('/unset-coupon')}}">
    										
    										Xóa mã khuyến mãi
										</a> 
<?php 
        }
        else{
?>									
										ko co promotion
<?php 
        }
?>
    							</td>
    
    
    							<td>
<?php 
        if(Session::get('customer_id')){
?>    								
    								
    									<a	class="btn btn-default check_out" href="{{url('/checkout')}}">
    									
    										Đặt	hàng
										</a>
<?php 
        }
        else{
?>						 									 								
										<a class="btn btn-default check_out" href="{{url('/dang-nhap')}}">
										
											Đặt hàng
										</a> 
<?php 
        }
?>
    							</td>
    
    
    							<td colspan="3">
    								<style>
                                        ul  {
                                          list-style: square inside url("sqpurple.gif");
                                        }
                                    </style>
    							
    								<ul style="line-height:200%"><li>
    								
    									<li>Tổng tiền :<span>{{		number_format(	$total	, 0 , ',' , '.')		}}đ</span></li>
    								
<?php 
        if(Session::get('coupon')){
?>									    								
									
<?php 
            foreach(Session::get('coupon') as $key => $cou){
    
                if($cou['coupon_condition'] == 1){
?>
									    		
    									Mã giảm :	{{$cou['coupon_number']}} %
    									
    									
<?php 
                    $total_coupon    =   ($total * $cou['coupon_number'])  /  100;
?>       
    									
										<li>Tổng giảm: {{  number_format( $total_coupon , 0 , ',' , '.') }}.đ</li>   
									   							
	    								<li>Tổng đã giảm : {{  number_format($total - $total_coupon  , 0 ,',' , '.')  }} đ</li>    						
    									 
<?php 
                }
                else if($cou['coupon_condition']  ==  2){
                    
                    $total_coupon = $total - $cou['coupon_number'];
?>
    										
										<li>Mã giảm :	{{  number_format( $cou['coupon_number'] , 0 , ',' , '.')  }} k</li>
						
									        								
        								
						
        								<li>Tổng đã giảm :  {{  number_format( $total_coupon , 0 , ',' , '.' )  }} đ</li>
            							
<?php 
                }
            }
?>
								    	</li>		
									</ul> 
<?php 
        }
?>									
<!--    								
    								<li>Thuế <span></span></li>
    								
    								<li>Phí vận chuyển <span>Free</span></li>
-->    
    							</td>
    						</tr>
<?php       
    }
    else{
?>
    						<tr>
    							<td colspan="5">
    								<center>    								
    									Làm ơn thêm sản phẩm vào giỏ hàng    									
									</center>
								</td>
    						</tr>
<?php 
    }
?>
    					</tbody>    
					</form>	
	
<?php

    if(Session::get('cart')){
?>
					<tr>
						<td>
							<form method="POST" action="{{url('/check-coupon')}}">
								@csrf 
								
								<input type="text" 	 name="coupon"			class="form-control" 					placeholder="Nhập mã giảm giá"><br> 
								
								<input type="submit" name="check_coupon"	class="btn btn-default check_coupon" 	value="Tính mã giảm giá">

							</form>
						</td>
					</tr>
<?php 
    }
?>
				</table>
    		
    		</div>
    	</div>
    </section>
    <!--/#cart_items-->



@endsection
