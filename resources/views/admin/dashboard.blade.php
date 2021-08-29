@extends('admin_layout')


@section('admin_content')

<?php
    use Illuminate\Support\Facades\Session;

    $message = Session::get('message');

    if($message){
    
        echo '<span class="text-alert">'.$message.'</span>';
        
        Session::put('message'  ,   null);
    }
?>
	<h3><center>Chào mừng bạn đến với đồ án hướng dẫn website của anh Hiếu nhé</center></h3>


	
	<div class="container-fluid">
	
    	<style type="text/css">
    		p.title_thongke {
    		    text-align: center;
    		    font-size: 20px;
    		    font-weight: bold;
    		}
    	</style>
    	
		<div class="row">
		
    		<p class="title_thongke">Thống kê đơn hàng doanh số</p>
    
    		<form autocomplete="off">
    	
    			@csrf
    
    			<div class="col-md-2">
    	
    				<p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>
    
    				<input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả"></p>
    
    			</div>
    
    
    			<div class="col-md-2">
    	
    				<p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>
    			
    			</div>
    			
    
    			<div class="col-md-2">
    				<p>
    					Lọc theo: 
    					
    					<select class="dashboard-filter form-control" >
    					
    						<option>--Chọn--</option>
    					
    						<option value="thang9">		2 month ago		</option>
    						<option value="7ngay">		7 ngày qua		</option>
    						<option value="thangtruoc">	tháng trước		</option>
    						<option value="thangnay">	tháng này		</option>
    						<option value="365ngayqua">	365 ngày qua	</option>
    					</select>
    				</p>
    			</div>
    
    		</form>
    
    
    		<div class="col-md-12">
    		
    			<div id="chart" style="height: 250px;">by Default get the days : 2020 / 11 / 01 - 10</div>
    		</div>
    
    	</div>
    
    
    
        <div class="row">
        
        	<style type="text/css">
        
        		table.table.table-bordered.table-dark {
        
        		    background: #32383e;
        		}
        
        		table.table.table-bordered.table-dark tr th {
        
        		    color: #fff;
        		}
        		
        	</style>
        
        
            <p class="title_thongke">Thống kê truy cập</p>
            
            
            <table class="table table-bordered table-dark">
            
                <thead>
                    <tr>
                    	<th scope="col">Your IP</th>
                        <th scope="col">Đang online</th>
                        <th scope="col">Tổng tháng trước</th>
                        <th scope="col">Tổng tháng này</th>
                        <th scope="col">Tổng một năm</th>
						<th scope="col">Tổng truy cập</th>
                    </tr>
                </thead>
                
                
                <tbody>
                    <tr>
                    	<td>{{	$user_ip_address			}}</td>
                      	<td>{{	$visitor_count				}}</td>
                      	<td>{{	$visitor_last_month_count	}}</td>
                      	<td>{{	$visitor_this_month_count	}}</td>
                      	<td>{{	$visitor_year_count			}}</td>
                      	<td>{{	$visitors_total				}}</td>
                    </tr>
                    
                </tbody>
            </table>
        
        </div>
        
        
        
    
        <div class="row">
        
        
        	<div class="col-md-4 col-xs-12">
        	
        		<p class="title_thongke">Thống kê tổng sản phẩm bài viết đơn hàng</p>
        	
        		<div id="donut"></div>	
        	</div>
        
        
        
        	<!--------------------------->
        
        	<div class="col-md-4 col-xs-12">
        	
        		<h3>Bài viết xem nhiều</h3>
        
        		<ol class="list_views">
<?php 

    foreach($post_views   as   $key => $post){
?>

        			<li>
        				<a target="_blank" href="{{url('/bai-viet/'.$post->post_slug)}}">
        				
        					{{$post	->post_title}} 		| 
        					
        					<span style="color:black">	{{	$post	->post_views	}}</span>
    					</a>
        			</li>
<?php 
    }
?>
        		</ol>
        		
        	</div>
        
        
        	<div class="col-md-4 col-xs-12">
        	
        		<style type="text/css">
        			ol.list_views {
        			    margin: 10px 0;
        			    color: #fff;
        			}
        			ol.list_views a {
        			    color: orange;
        			    font-weight: 400;
        			}
        		</style>
        		
        		
        		<h3>Sản phẩm xem nhiều</h3>
        
        
        		<ol class="list_views">
<?php 
    foreach($product_views as $key => $pro){
?>        
	

        			<li>
        				<a target="_blank" href="{{url('/chi-tiet/'.$pro->product_slug)}}">
        				
        					{{$pro	->product_name}} 	| 
        					
        					<span style="color:black">	{{	$pro	->product_views		}}</span>
    					</a>
        			</li>
<?php 
    }
?>
        		</ol>
        
        	</div>
        </div>
    
    
    </div>
	
	
	

	<script type="text/javascript">
    
    	$(document).ready(function(){
    
    		chartDemo();					//get the lasts 60 days
    						//			   .Bar
            var chart 	   = 	 new Morris.Line({
                 
                element			:  'chart',
                
                //option chart
                
                stacked			:	true,
                
                lineColors		:  ['green'		,  'red'	 	,	'yellow'	,	 'gris'		,	 'orange'],
                
                parseTime		:  false,
    			
                hideHover		:  'auto',
    
                xkey			:  'period',
    
                ykeys			:  ['order'		,	'sales'		,	'profit'	,	'quantity'],
    
                labels			:  ['đơn hàngg'	,	'doanh số'	,	'lợi nhuận'	,	'số lượng']
                        
            });
    
    
           
            function chart60daysorder(){
                
                var _token 		=	 $('input[name="_token"]').val();
    
                $.ajax({
                    
                    url			:	"{{url('/days-order')}}",		//get the lasts 60 days
                    method		:	"POST",
                    dataType	:	"JSON",
    
                    data		:	{	_token	:	_token	},
                    
                    success		:	function(data)
                    {
                        chart.setData(data);
                    }   
                });
            }


 			function chartDemo(){
                
                var _token 		=	 $('input[name="_token"]').val();
    
                $.ajax({
                    
                    url			:	"{{url('/days-order-demo')}}",		//get the lasts 60 days
                    method		:	"POST",
                    dataType	:	"JSON",
    
                    data		:	{	_token	:	_token	},
                    
                    success		:	function(data)
                    {
                        chart.setData(data);
                    }   
                });
            }
    
            
        	$('.dashboard-filter').change(function(){
            	
                var dashboard_value 	=	 $(this)					.val();
                
                var _token 				=	 $('input[name="_token"]')	.val();
                // alert(dashboard_value);
                
                $.ajax({

                	url			:	"{{url('/dashboard-filter')}}",
                	
                    method		:	"POST",
                    dataType	:	"JSON",
                    
                    data		:	{	dashboard_value		:	dashboard_value	,
                        				_token				:	_token
                    				},

                                    
                    success		:	function(data)
                    {
                        chart.setData(data);
                    }   
                });    
            });


            
            $('#btn-dashboard-filter').click(function(){

                alert('click filter');
                
                var _token 		=	 $('input[name="_token"]')	.val();
        
                var from_date 	=	 $('#datepicker')			.val();
                var to_date 	=	 $('#datepicker2')			.val();
        
             	$.ajax({
                 	
                    url			:	"{{url('/filter-by-date')}}",
//  					url			:	"{{url('/days-order')}}",
                    method		:	"POST",
                    
                    dataType	:	"JSON",
                    
                    data		:	{	from_date	:	from_date,
                                        to_date		:	to_date,
                                        _token		:	_token
                                    },
                    
                    success		:	function(data)
                    {
                        chart.setData(data);
                    }   
                });        
            }); 
        
        });
        
    </script>
    
    

    <script type="text/javascript">

    	$(document).ready(function(){
    
            var donut 	=	 Morris.Donut({
                
              	element		: 	'donut',
              	
              	resize		: 	true,
              	
              	colors		: 	[
                                    '#a8328e',
                                    '#61a1ce',
                                    '#ce8f61',
                                    '#f5b942',
                                    '#4842f5'            
              	],
              	
             	//labelColor:"#cccccc", // text color
              	backgroundColor: '#333333', // border color
              
              	data		: 	[								//				get varaibles from AppServiceProvider.php
                  	
                                    {	label	:	"San pham"		, 		value	:    <?= $app_product   ?>},
                                    {	label	:	"Bai viet"		,		value	:    <?= $app_post      ?>},
                                    {	label	:	"Don hang"		, 		value	:    <?= $app_order     ?>},
                                    {	label	:	"Video"			, 		value	:    <?= $app_video     ?>},
                                    {	label	:	"Khach hang"	, 		value	:    <?= $app_customer  ?>} 
                ]
            });     
    	});
    	
    </script>
	
	
	
	
@endsection



