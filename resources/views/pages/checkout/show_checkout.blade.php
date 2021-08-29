@extends('layout')



@section('content')

	<section id="cart_items">
	
		<div>
	
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  	
				  	<li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  	
				  	<li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div>
			
<!-- 			<pre>			 -->
<?php      
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\URL;
    
    if(session()->has('customer')){
        
        $customer   =   session()->get('customer');
        
//        print_r($customer);
    }
    else{
        
        Session::put('message' , 'please signing to continue your purchase');
        
        header("Location: " . URL::to('/dang-nhap'), true, 302);
        
        exit();
    }
    
?>	
    		
	<!-- 		</pre> -->
<?php    
    
   

    if(session()->has('message')){
?>    
			<div class="alert alert-success" style="color: red;">{{ 	session()	->get('message') 	}}</div>
<?php
        Session::put('message' , null);
    }
?>	
			<div class="register-req">
				<p>Làm ơn đăng ký hoặc đăng nhập để thanh toán giỏ hàng và xem lại lịch sử mua hàng</p>
			</div><!--/register-req-->


			<div class="shopper-informations">
			
				<div class="row">
				
					<div class="col-md-12 clearfix">
					
						<div class="bill-to">
						
							<p>Điền thông tin gửi hàng (SHIPPING)</p>
							

							<div class="col-md-6 form-style">
								
							

							
							
<!-- post by AJAX , get parametre by .send_order-->

								<form method="POST">

									@csrf
									<input type="text" name="shipping_email" 	class="form-control shipping_email" 	value="{{ $customer->customer_email}}"	placeholder="Điền email">
									<input type="text" name="shipping_name" 	class="form-control shipping_name" 		value="{{ $customer->customer_name}}"	placeholder="Họ và tên người gửi">
									<input type="text" name="shipping_address" 	class="form-control shipping_address" 	required="required"						placeholder="Địa chỉ gửi hàng">
									SDT : <input type="text" name="shipping_phone" 	class="form-control shipping_phone" 		value="{{ $customer->customer_phone}}"	placeholder="Số điện thoại">
									
									<textarea 		   name="shipping_notes" 	class="form-control shipping_notes" 	required 								placeholder="Ghi chú đơn hàng của bạn" rows="5"></textarea>
<?php 

    if(Session::get('fee')){
?>
										<input type="hidden" name="order_fee" class="order_fee" value="{{Session::get('fee')}}">
<?php 
    }
    else{
?>
										<input type="hidden" name="order_fee" class="order_fee" value="10000">
<?php 
    }
    if(Session::get('coupon')){
        
        foreach(Session::get('coupon') as $key => $cou){
?>
											<input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
<?php 
        }
    }
    else{
?>
											<input type="hidden" name="order_coupon" class="order_coupon" value="no">
<?php 
    }
?>	
									<div class="">
										 <div class="form-group">
		                                    <label for="exampleInputPassword1">Chọn hình thức thanh toán</label>
		                                      
		                                      <select name="payment_select"  class="form-control input-sm m-bot15 payment_select">
		                                      
		                                            <option value="0">Qua chuyển khoản</option>
		                                      
		                                            <option value="1">Tiền mặt</option>   
		                                    </select>
		                                </div>
									</div>
<!-- post by AJAX via .send_order   
    /confirm-order          
cant use submit because it call the Post method -->

									<input type="button" value="Xác nhận đơn hàng" name="send_order" class="btn btn-primary btn-sm send_order">
									
								</form>
							
							</div>	
							
							
							
							
							<div class="col-md-6">	
							
								
								
<!-- post by AJAX via .calculate_delivery        -->	
															
								<form>
                                    @csrf 
                             
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Chọn thành phố</label>
                                        
                                          	<select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                        
                                                <option value="">--Chọn tỉnh thành phố--</option>
        @foreach($city as $key => $ci)
                                                <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
        @endforeach                                                
                                        	</select>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Chọn quận huyện</label>
                                          	
                                          	<select name="province" id="province" class="form-control input-sm m-bot15 province choose">
                                          	
                                                <option value="">--Chọn quận huyện--</option>
                                               
                                        	</select>
                                    </div>
                                    
                                                                      
                                  	<div class="form-group">
                                		
                                		<label for="exampleInputPassword1">Chọn xã phường</label>
                                        
                                        <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                    
                                            <option value="">--Chọn xã phường--</option>   
                                        </select>
                                    </div>
                                   
<!-- post by AJAX via .calculate_delivery        -->
                                   
                                  	<input type="button" value="Tính phí vận chuyển" name="calculate_order" class="btn btn-primary btn-sm calculate_delivery">

								</form>
                        	</div>

							
						</div>
						
					</div>
					
					
					
					
					<div class="col-sm-12 clearfix">
						<div class="bill-to">

							
								
								
								

							</div>							
						</div>
					</div>
					
					
					
					<div class="col-sm-12 clearfix">
<?php 
    if(session()->has('message')){
?>		
                        <div class="alert alert-success">
    
                            {!! session()->get('message') !!}
                        </div>
<?php 
    }
    elseif(session()->has('error')){
?>    
    
	                    <div class="alert alert-danger">
	                    
	                        {!! session()->get('error') !!}
	                    </div>
<?php 
    }
?>  
						<div class="table-responsive cart_info">
							
							
							@csrf
							
							<table class="table table-condensed">
							
								<thead>
									<tr class="cart_menu">
										<td class="image">			Hình ảnh		</td>
										<td class="description">	Tên sản phẩm	</td>
										<td class="price">			Giá sản phẩm	</td>
										<td class="quantity">		Số lượng		</td>
										<td class="total">			Thành tiền		</td>
										<td class="quantity"> 		Xoa order		</td>
									</tr>
								</thead>
								
								
								<tbody>
								
									<form action="{{url('/update-cart')}}" method="POST">
<?php 

    if(Session::get('cart')  ==  true){
	
		$total = 0;
	
		foreach(Session::get('cart') as $key => $cart){
			
			$subtotal 		= 		$cart['product_price']   *   $cart['product_qty'];
	
			$total			+=		$subtotal;		
?>
    									<tr>
    										<td class="cart_product">
    											<img src="{{asset('public/uploads/product/'.$cart['product_image'])}}" width="90" alt="{{$cart['product_name']}}" />
    										</td>
    										
    										<td class="">
    											<h4><a href="{{URL::to('/chi-tiet/'.$cart['product_slug'])}}">
    								
            										<p>{{	$cart['product_name']	}}</p>
            								
            									</a></h4>
    										</td>
    										
    										<td class="cart_price">
    										
    											<p>{{  number_format( $cart['product_price'] , 0 , ',' , '.'  )  }}  đ</p>
    										</td>
    										
    										
    										<td class="cart_quantity">
    											<div class="cart_quantity_button">
    											
    												<input class="cart_quantity" type="number" min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}"  >
    											
    											</div>
    										</td>
    										
    										<td class="cart_total">
    											<p class="cart_total_price">
    											
    												{{  number_format( $subtotal , 0 , ',' , '.' )  }}đ
    												
    											</p>
    										</td>
    										
    										<td class="cart_delete">
    											<a class="cart_quantity_delete" href="{{url('/del-product/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
    										</td>
    									</tr>    									
<?php 
		}
?>
    									<tr>
    									
    										<td><input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="check_out btn btn-default btn-sm"></td>
    										
    										<td><a onclick="return confirm('Bạn có chắc là muốn xóa đơn hàng này ko?')" class="btn btn-default check_out" href="{{url('/del-all-product')}}">Xóa tất cả</a></td>
    										
    										<td>
<?php 
        if(Session::get('coupon')){
?>
    				                          	<a class="btn btn-default check_out" href="{{url('/unset-coupon')}}">Xóa mã khuyến mãi</a>
<?php 
        }
        else{
?>
				                          		ko có khuyến mãi
<?php 
        }
?>
    										</td>
    
    										
    										<td colspan="2">
    										
    											<ul>
    										
        											<li>Tổng tiền :<span>{{number_format($total,0,',','.')}}đ</span></li>
<?php 
        if(Session::get('coupon')){
?>		
        										       											
<?php 
            foreach(Session::get('coupon') as $key => $cou){
                            
                if($cou['coupon_condition'] == 1){
?>    		

													<li> Mã giảm : {{ $cou['coupon_number'] }} % </li>
    											
													
<?php 
                    $total_coupon 	        =       ($total    *   $cou['coupon_number'])      /   100;
 
                    $total_after_coupon     =       $total   -   $total_coupon;

                }
                elseif($cou['coupon_condition']  ==  2){
?>

													<li> Mã giảm : {{ number_format( $cou['coupon_number'] , 0 , ',' , '.')}} k </li>

													
<?php 
    				$total_coupon           =       $cou['coupon_number'];
 
                    $total_after_coupon     =       $total      -   $total_coupon;

                }
            }
        }

        if(Session::get('fee')){
?>
            										<li>	
            											<a class="cart_quantity_delete" href="{{url('/del-fee')}}"><i class="fa fa-times"></i></a>
            
            											Phí vận chuyển <span>{{number_format(Session::get('fee'),0,',','.')}}đ</span>
        											</li>    										
<?php 
        }

        $total_after_fee    =    $total     +    Session::get('fee');         
?>    										

													<li>Tổng còn:
<?php 
		if(Session::get('fee') && !Session::get('coupon')){
		    
			$total_after = $total_after_fee;
			
			echo number_format($total_after,0,',','.').'đ';
		}
		elseif(!Session::get('fee') && Session::get('coupon')){
			
		    $total_after = $total_after_coupon;
			
		    echo number_format($total_after,0,',','.').'đ';
		}
		elseif(Session::get('fee') && Session::get('coupon')){
			
		    $total_after = $total_after_coupon;
		    
			$total_after = $total_after + Session::get('fee');
			
			echo number_format($total_after,0,',','.').'đ';
		}
		elseif(!Session::get('fee') && !Session::get('coupon')){
			
		    $total_after = $total;
			
		    echo number_format($total_after,0,',','.').'đ';
		}
?> 
        											</li>
        										</ul>
        									</td>
    									</tr>
<?php 
    }
    else{
?> 
    									<tr>
    										<td colspan="5"><center><?= 'Làm ơn thêm sản phẩm vào giỏ hàng'; ?></center></td>
    									</tr>
<?php 
    }
?>
									</form>
								</tbody>
<?php 
    if(Session::get('cart')){
?>    								
								<tr>
									<td>

										<form method="POST" action="{{url('/check-coupon')}}">
										@csrf
											<input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá"><br>
			                          		<input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Tính mã giảm giá">
			                          	
		                          		</form>
		                          	</td>
								</tr>
<?php 
    }
?>    
							</table>

						</div>
					</div>
														
				</div>
			</div>
		
		</div>
	</section> <!--/#cart_items-->

@endsection