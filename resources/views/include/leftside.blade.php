			
				
				
				
				
				
				
				<div class="col-sm-3">
				
					<div class="left-sidebar">
            
                        <h2>Danh mục sản phẩm</h2>
            
            
            			
            
            
            
            
            
            
                        <div class="panel-group category-products" 		id="accordian">        		<!-- BS Collapse -->
<?php 
    
    use Illuminate\Support\Facades\DB;

    $category       =        DB::table('tbl_category_product')      ->where('category_status'   ,   '0')                    // get active category

                                                                    ->orderby('category_parent' ,   'desc')
                                                                    /* ->orderby('category_order'  ,   'ASC')      */ ->get();
    $i              =        0;
    
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
        
                                            <?= ++$i ."-" .$cate->category_id   ." - "    .$cate->category_name	?>
                                        </a>

                                    </h4>
                            	</div>

                                <div id="{{$cate->slug_category_product}}" class="panel-collapse collapse">
                                
                                    <div class="panel-body">
                                
                                        <ul>
<?php 
            $children   =   false;
            
            foreach($category as $key => $cate_sub){
            
                if($cate_sub->category_parent  ==  $cate->category_id){
                    
                    $children   =   true;                    
                }       
            }
            
            if($children){
                
                foreach($category as $key => $cate_sub){
                    
                    if($cate_sub->category_parent  ==  $cate->category_id){
?>
                                    		<li><a href="{{URL::to('/danh-muc/'.$cate_sub->slug_category_product)}}">
                                    		
                                    				{{ $i ." - " .$cate_sub->category_id  ."-"  .$cate_sub->category_name}}
                                				</a>
                            				</li>
<?php 
                        
                        
                        
                    }
                
                }
            }
            else{
?>
 											<li><a href="{{URL::to('/danh-muc/'.$cate->slug_category_product)}}">
                                    		
                                    				{{ $i ." - " .$cate->category_id  ."-"  .$cate->category_name}}
                                				</a>
                            				</li>
<?php       
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
                       
                       	
                       	<div class="brands_products"><!--brands_products-->
                       	
                            <h2>Sản phẩm đã xem</h2>
                        
                            <div class="brands-name ">

                                <div id="row_viewed" class="row">    

                                </div>

                            </div>
                        </div><!--/brands_products-->



                        <div class="brands_products"><!--brands_products-->
                        
                            <h2>Sản phẩm yêu thích</h2>
                        	<button id="clear-liked">Clear liked product</button>
                        	
                            <div class="brands-name ">

                                <div id="row_wishlist" class="row">    

                                </div>

                            </div>
                        </div><!--/brands_products-->
                         
                         
                    </div>
                    
                </div>