	<link href="{{asset('public/frontend/css/bootstrap.min.css')}}" 		rel="stylesheet">
 	<link href="{{asset('public/frontend/css/font-awesome.min.css')}}" 		rel="stylesheet">		<!-- '+' at end -->
 	<link href="{{asset('public/frontend/css/main.css')}}" 					rel="stylesheet">

    
	<script src="{{asset('public/frontend/js/jquery.js')}}"></script>
	<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>				
				
				
				
				
				
				
				
				<div class="col-sm-3">
					<div class="left-sidebar">
            
                        <h2>Danh mục sản phẩm</h2>
            
                        <div class="panel-group category-products" 		id="accordian">        		<!-- BS Collapse -->
<?php 
    
    $category       =        DB::table('tbl_category_product')      ->where('category_status'   ,   '0')                    // get active category

                                                                    ->orderby('category_parent' ,   'desc')
                                                                    /* ->orderby('category_order'  ,   'ASC')      */ ->get();
    
    foreach($category as $key => $cate){
?>                         
                            <div class="panel panel-default">
<?php 
        if($cate->category_parent == 0){                                                                                    // get parent category
?>                                 
                                <div class="panel-heading">
                                
                                    <h4 class="panel-title">

                                        <a data-toggle="collapse" 	data-parent="#accordian" 	href="#{{$cate->slug_category_product}}">
                                        
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
        
                                            <?= $cate->category_name	?>
                                        </a>

                                    </h4>
                            	</div>


                                <div id="{{$cate->slug_category_product}}" class="panel-collapse collapse">
                                
                                    <div class="panel-body">
                                
                                        <ul>
<?php 
            foreach($category as $key => $cate_sub){
            
                if($cate_sub->category_parent  ==  $cate->category_id){
?>                                            
                                    		<li><a href="{{URL::to('/danh-muc/'.$cate_sub->slug_category_product)}}">{{$cate_sub->category_name}}</a></li>
<?php 
                }
            }
?>
                                        </ul>
                                    </div>
                                </div>
<?php 
        }
?>        
		             		</div>                          
<?php 
    }
?>          

                        </div><!--/category-products-->
                    
                    
                    
                    
                    
                    
                        <div class="brands_products"><!--brands_products-->
                        
                            <h2>Thương hiệu sản phẩm</h2>
                        
                            <div class="brands-name">
                            
                                <ul class="nav nav-pills nav-stacked">
<?php 
    $brand     =    DB::table('tbl_brand')      ->where('brand_status'  ,   '0')
                                                ->orderby('brand_id'    ,   'desc')     ->get();
    
    foreach($brand as $key => $brand){
?>    
                                    <li><a href="{{URL::to('/thuong-hieu/'.$brand->brand_slug)}}"> <span class="pull-right"></span>{{$brand->brand_name}}</a></li>
<?php 
    }
?>
                                </ul>
                            </div>
                        </div><!--/brands_products-->
                        
                    </div>
                    
                </div>