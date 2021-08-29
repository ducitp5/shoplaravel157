

 	<link rel="stylesheet"  href="{{asset('public/backend/css/bootstrap.min.css')}}" >
    <link rel='stylesheet'  href="{{asset('public/backend/css/style.css')}}" 						type='text/css' /> 
  	 
    <link rel="stylesheet" href="{{asset('public/backend/css/font-awesome.css')}}" >
  	 
	<script src="{{asset('public/backend/js/jquery.min.js')}}"></script> 
	

    
	
	

<!-- <section id="main-content">
	<section class="wrapper"> -->
    
    
        
    <div class="col-sm-9 m-b-xs">
    
        <div class="table-agile-info">
        	<div class="panel panel-default">
        	
        		<div class="panel-heading">Liệt kê danh mục sản phẩm</div>
        	
        		<div class="row w3-res-tb">
        			<div class="col-sm-5 m-b-xs">
        	
        				<select class="input-sm form-control w-sm inline v-middle">
        					<option value="0">Bulk action</option>
        					<option value="1">Delete selected</option>
        					<option value="2">Bulk edit</option>
        					<option value="3">Export</option>
        				</select>
        	
        				<button class="btn btn-sm btn-default">Apply</button>
        			</div>
        	
        			<div class="col-sm-4"></div>
        	
        			<div class="col-sm-3">
        	
        				<div class="input-group">
        	
        					<input type="text" class="input-sm form-control"	placeholder="Search"> 
        					
        					<span class="input-group-btn">
        						
    							<button class="btn btn-sm btn-default" type="button">Go!</button>
        					</span>
        				</div>
        			</div>
        		</div>
        		
        		
        		<div class="table-responsive">
<?php
    
    use App\CategoryProductModel;
    use Illuminate\Support\Facades\Session;

    $message = Session::get('message');
    
    if ($message) {
    
        echo '<span class="text-alert">' . $message . '</span>';
        
        Session::put('message', null);
    }
?>
              		<table class="table table-striped b-t b-light">
        			
        				<thead>
        					<tr>
        						<th style="width: 20px;">
        						
        							<label class="i-checks m-b-none"> 		<input 	type="checkbox"><i></i>		</label>    						
        						</th>
        						
        						<th>STT</th>
        						<th>Tên danh mục</th>
        						<th>Thuộc danh mục</th>
        						<th>Slug</th>
        						<th>Thứ tự danh mục</th>
        						<th>Hiển thị</th>
        
        						<th style="width: 30px;">Edit</th>
        					</tr>
        				</thead>
    				
<style type="text/css">

    #category_order .ui-state-highlight {

    	padding            : 24px;
    	background-color   : #ffffcc;
    	border             : 1px dotted #ccc;
    	cursor             : move;
    	margin-top         : 12px;
    }
    
</style>
    
						<tbody id="category_order">
<?php 

    use Illuminate\Support\Facades\DB;
    
    $category_product           =        CategoryProductModel   ::where('category_parent'   ,   0)
    
                                                                ->orderBy('category_id'     ,   'DESC')     ->get();
    
    $all_category_product       =        DB::table('tbl_category_product')
    
                                                ->orderBy('category_parent' ,   'DESC')/*
                                                
                                                ->orderBy('category_order'  ,   'ASC')      */      ->paginate(5);
    
    
    $i = ($all_category_product->currentpage()-1)* $all_category_product->perpage() + 1;
    
    
    foreach($all_category_product as $key => $cate_pro){        //orderBy('category_parent' ,   'DESC')
?>   					
    					
    						<tr id="{{$cate_pro->category_id}}">
    						
        						<td><label class="i-checks m-b-none">  <input type="checkbox"	name="post[]"><i></i></label></td>
        						
        						<td> {{ $i++ }} </td>
        						
        						<td>{{ $cate_pro	->category_name }}</td>
        						
        						<td>
<?php 
        if($cate_pro->category_parent   ==  0) {
?>			
									<span style="color: red;">Danh mục cha</span> 
<?php 
        }
        else{
		
            foreach($category_product as $key 		=>	$cate_sub_pro){                  // ::where('category_parent'   ,   0)
    
                if($cate_sub_pro->category_id   ==   $cate_pro->category_parent) {
?>
									<span style="color: green;">
								
									{{$cate_sub_pro		->category_name}}</span>
<?php 								
                }
            }
        }
?>
    							</td>
    						
        						<td>{{ $cate_pro	->slug_category_product }}</td>
        						
        						<td>{{ $cate_pro	->category_order }}</td>
        						
        						<td>
        							<span class="text-ellipsis">
<?php
        if ($cate_pro->category_status == 0) {
?>
        			                    <a	href="{{URL::to('/unactive-category-product/'.$cate_pro->category_id)}}">
        			                    
        			                    	<span	class="fa-thumb-styling fa fa-thumbs-up">		</span>
        		                    	</a>
<?php
        } 
        else {
?>  
        		                     	<a	 href="{{URL::to('/active-category-product/'.$cate_pro->category_id)}}">
        			                     
        			                     	<span	class="fa-thumb-styling fa fa-thumbs-down">		</span>
        		                     	</a>
<?php
        }
?>
				                	</span>
    			                </td>
        
        						<td>
        							<a	href="{{URL::to('/edit-category-product/'.$cate_pro->category_id)}}"
        								class="active styling-edit" ui-toggle-class=""> 
        								
        								<i	class="fa fa-pencil-square-o text-success text-active"></i>
    								</a>
        							
        							<a	onclick="return confirm('Bạn có chắc là muốn xóa danh mục này ko?')"
        								href="{{URL::to('/delete-category-product/'.$cate_pro->category_id)}}"
        								class="active styling-edit" ui-toggle-class=""> 
        								
        								<i 	class="fa fa-times text-danger text"></i>
        							</a>
    							</td>
        					</tr>
<?php 
    }
?>
    					</tbody>
        			</table>   	  
        
        		</div>
        		
        		
        		
        		
        		
        		
        		 <!-----import data---->
          
          
          		<h3 id="annonce" >  annonce 1 </h3>
          		<h3 id="annonce2" > annonce 2</h3>
          		
                <form action="{{url('import-csv')}}" method="POST" id="fileform" enctype="multipart/form-data">
                  	@csrf
                  
                	<input type="file" 		name="file" 			id="file"	accept=".xlsx">
                	
                	<br>
                
                	<input 	type="submit" 			name="import_csv"		id="enter"	{{-- disabled='disabled' --}}	
                			onclick="myFunction()" 	value="Import file Excel"  class="btn btn-warning">
                </form>
   
   
     <script>  

          	
 //       var annonce 	=	 document.getElementById('annonce'); 		// only one element by ID, that the firt id matched
 
   		var annonce		=	 $('#annonce')[0];     						// unique value 0, 
   		var annonce2	=	 $('#annonce2')[0];
        { 
            if ($('#file')[0].files.length === 0) { 

                annonce.innerHTML 		=	 "No files selected 1"; 
                annonce2.innerHTML 		=	 $('#file')[0].files.length; 
                console.log("no files selected");
//                $('#enter')[0].disabled = 	 true;
            } 

            else { 
                annonce.innerHTML 		= 	"Some file is selected"; 
                annonce2.innerHTML 		=	 $('#file')[0].files.length; 
                console.log("some files selected");
                $('#enter')[0].disabled = 	false;
            } 
        } 

  /*       function myFunction() {
        	if ($('#file')[0].files.length === 0) { 
        		alert("No file selected2.");
        	}
    	} */


		$('#fileform').submit(function(){
            valid = true;

            if($("#file").val() == ''){

            	alert("No file selected2.");
   	            // your error validation action
    	        valid =  false;
           	}

           	return valid
       	});
    </script> 
    
    
        <!-----export data---->
    
    
           
           		<form action="{{url('export-csv')}}" 		method="POST">
              		@csrf
           	
           			<input type="submit" value="Export file Excel" name="export_csv" class="btn btn-success">
          		</form>
          		
          		
          		
          		
          		
          		
          		
          		
        		
        		
       
                    		
        		
        		
        		
        		
        		<footer class="panel-footer">
        		
        			<div class="row">
        
        				<div class="col-sm-5 text-center">
        					<small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50	items</small>
        				</div>
        				
        				<div class="col-sm-7 text-right text-center-xs">
        					<ul class="pagination pagination-sm m-t-none m-b-none">
        					
        						{!!$all_category_product	->links()!!}
        					</ul>
        				</div>
        				
        			</div>
        		</footer>
        		
        		
        	</div>
        </div>
    </div>
    
    
    
<!--     </section>
</section>
 -->



































