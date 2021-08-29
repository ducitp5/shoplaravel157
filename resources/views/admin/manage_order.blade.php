@extends('admin_layout') 


@section('admin_content')


    <div class="table-agile-info">
    
    	<div class="panel panel-default">
    
    		<div class="panel-heading">Liệt kê đơn hàng</div>
    
    		<div class="row w3-res-tb"></div>
    
    		<div class="table-responsive">
<?php
    use Illuminate\Support\Facades\Session;

    $message = Session::get('message');
    
    if ($message) {
    
        echo '<span class="text-alert">' . $message . '</span>';
        
        Session::put('message'  ,  null);
    }
?>
          		<table class="table myTable table-striped b-t b-light">
    			
    				<thead>
    					<tr>    
    						<th>Thứ tự</th>
    						<th>Order ID</th>
    						<th>Mã đơn hàng</th>
    						<th>Ngày tháng đặt hàng</th>
    						<th>Tình trạng đơn hàng</th>
    
    						<th style="width: 30px;"></th>
    					</tr>
    				</thead>
    				
    				
    				<tbody>
<?php 
    $i = 0;
    $style  =   '';
    
    
    foreach($order as $key => $ord){
        
        $i++;
        
        if      ($ord	    ->order_status  == 1 )      $style      =        "background-color:#DDEDE0; border:4px";
        
        elseif  ($ord	    ->order_status  == 2 )      $style      =        "background-color:#DDDDD0; border:4px";
        
        else                                            $style      =        "background-color:#ffffff; border:4px";
?>
						<tr style="{{$style}}">

    						<td><i>{{$i}}				</i></td>
    						<td>{{ $ord		->order_id }}	</td>
    						<td>{{ $ord		->order_code }}	</td>
    						
    						<td>{{ $ord		->created_at }}	</td>
<?php 
        if      ($ord->order_status  == 1  ){
?>    						
    						<td> 		Đơn hàng mới 		</td>
<?php 
        }
        elseif  ($ord->order_status  == 2 ){
?>
    						<td >		Đã xử lý 			</td>
<?php 
        }
        else{
?>
    						<td >		Annuler			</td>
<?php 
        }
?>  
    						<td>
    							<a href="{{URL::to('/view-order/'.$ord->order_code)}}" 	class="active styling-edit"   ui-toggle-class=""> 
    							
    								<i class="fa fa-eye text-success text-active"></i></a> 
    								
								<a 	onclick="return confirm('Bạn có chắc là muốn xóa đơn hàng này ko?')" 	class="active styling-edit" ui-toggle-class=""
    								href="{{URL::to('/delete-order/'.$ord->order_code)}}" > 
    								
    								<i class="fa fa-times text-danger text"></i>			</a>
							</td>
    					</tr>
<?php 
    }
?>
    				</tbody>
    			</table>
    		</div>
    		    		
    		
    		<footer class="panel-footer">
    			<div class="row">
    
    				<div class="col-sm-5 text-center">
    					<small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
    				</div>
    				
    				<div class="col-sm-7 text-right text-center-xs">
    					<ul class="pagination pagination-sm m-t-none m-b-none">
    						{!!$order->links()!!}
    					</ul>
    				</div>
 
    			</div>
    		</footer>
    
    	</div>
    </div>
    
    
@endsection