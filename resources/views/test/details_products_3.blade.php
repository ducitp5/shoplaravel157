

<?php 
    
    $category_id        =    $value->category_id;
    
    $relate_product     =    DB::table('tbl_product')

                                    ->join('tbl_category_product'   ,   'tbl_category_product.category_id'  ,'=',   'tbl_product.category_id')
                                    
                                    ->join('tbl_brand'              ,   'tbl_brand.brand_id'                ,'=',   'tbl_product.brand_id')
                                    
                                    ->where('tbl_category_product.category_id'  ,   $category_id)
                                    
                                    ->whereNotIn('tbl_product.product_slug'     ,   [$product_slug])
                                    
                                    ->orderby(DB::raw('RAND()'))
                                    
                                    ->paginate(3);

?>
        <div class="recommended_items"><!--recommended_items-->
        
        	<h2 class="title text-center">Sản phẩm liên quan</h2>
        	
        	<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        		
        		<div class="carousel-inner">
        		
        			<div class="item active">
<?php
  
    foreach($relate_product as $key => $lienquan){
?>
        				<div class="col-sm-4">
        				
        					<div class="product-image-wrapper">
        				
        						 <div class="single-products">
                        
                                    <div class="productinfo text-center product-related">
                        
                                    	<a href="{{URL::to('/chi-tiet/'.$lienquan->product_slug)}}">
                                    	
                                            <img src="{{URL::to('public/uploads/product/'.$lienquan->product_image)}}" alt="" />
                                            
                                            
                                            <h2>{{number_format($lienquan->product_price,0,',','.').' '.'VNĐ'}}</h2>
                                            
                                            <p>{{$lienquan->product_name}}</p>
                                     	</a>
                        
                                    </div>
                                  
                    			</div>
        					</div>
        				</div>
<?php 
    }
?>	
        			</div>
        				
        		</div>
        				
        	</div>
        </div><!--/recommended_items-->
        
  {{--      <ul class="pagination pagination-sm m-t-none m-b-none">
       		{!!$relate_product->links()!!}
    	</ul> 
--}}