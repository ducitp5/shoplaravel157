@extends('admin_layout')


@section('admin_content')

    <div class="table-agile-info">
  
  		<div class="panel panel-default">
    
    		<div class="panel-heading">
      			Liệt kê bình luận
    		</div>
    		
            <div id="notify_comment"></div>
            
            <div class="table-responsive">
<?php
    use Illuminate\Support\Facades\Session;

    $message = Session::get('message');
    
    if($message){

        echo '<span class="text-alert">'.$message.'</span>';
        
        Session::put('message',null);
    }
?>
                <table class="table myTable table-striped b-t b-light" id="">
                    <thead>
              			<tr>                       
                            <th>Duyệt</th>
                            <th>Tên người gửi</th>
                            <th>Bình luận</th>
                            <th>Ngày gửi</th>
                            <th>Sản phẩm</th>
                            <th>Quản lý</th>
                            <th style="width:30px;"></th>
                      	</tr>
                    </thead>
                    
                    <tbody>
<?php 
    foreach($comment as $key => $comm){         // comment parent
?>                    
		      			<tr>        
            				<td>
<?php 
        if($comm->comment_status == 1){         // inactive
?>		
                								<!-- Ajax via .comment_duyet_btn -->
                								
                				<input 	type="button" 	data-comment_status="0" 	data-comment_id="{{$comm->comment_id}}" 
                				
                						id="{{$comm->comment_product_id}}" 	class="btn btn-primary btn-xs comment_duyet_btn" 	value="Duyệt" >
<?php 
        }
        else{                                   //active
?> 
                				<input 	type="button" 	data-comment_status="1" 	data-comment_id="{{$comm->comment_id}}" 
                				
                						id="{{$comm->comment_product_id}}" 	class="btn btn-danger btn-xs comment_duyet_btn" 	value="Bỏ Duyệt" >
<?php 
        }
?>           
                            </td>
                            
                            <td>{{ $comm->comment_name }}</td>
                
							<td>{{ $comm->comment }}
<style type="text/css">

    ul.list_rep li {
    
        list-style-type     : decimal;
        color               : blue;
        margin              : 5px 40px;
    }
</style>
                                <ul class="list_rep">
                                
                                	Trả lời : 
<?php 
        foreach($comment_rep as $key => $comm_reply){           // comment_rep

            if($comm_reply->comment_parent_comment  ==  $comm->comment_id){
?>
          	                  		<li> {{	$comm_reply  ->comment	}}</li>
<?php 
            }
        }
?>                                
                                </ul>
<?php 
        if($comm->comment_status  ==  0){       //active comment
?>
                                <br/>
                                
                                <textarea class="form-control reply_comment_{{$comm->comment_id}}" rows="5"></textarea>              <br/>
                                
                                <button 	class="btn btn-default btn-xs btn-reply-comment" 
                                
                                			data-product_id="{{$comm->comment_product_id}}"  	data-comment_id="{{$comm->comment_id}}">
              			
									Trả lời bình luận
								
								</button>
<?php 
        }
?>
							</td>
            
                            <td>{{ $comm->comment_date }}</td>
                            
                            <td><a href="{{url('/chi-tiet/'.$comm->product->product_slug)}}" 	target="_blank">
                            
                            	{{ $comm->product->product_name }}</a>
                        	</td>
                            
                            
                            <td>
                              	<a href="" class="active styling-edit" ui-toggle-class="">
                                	<i class="fa fa-pencil-square-o text-success text-active"></i>
                            	</a>
                              
                              	<a 	onclick="return confirm('Bạn có chắc là muốn xóa bình luận này ko?')" 
                              		href="" class="active styling-edit" ui-toggle-class="">
                                	
                                	<i class="fa fa-times text-danger text"></i>
                              	</a>
                        	</td>
                      	</tr>
<?php 
    }
?>
    				</tbody>
      			</table>
    		</div>  
  		</div>
	</div>
	
@endsection