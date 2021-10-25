

		<aside>
            <div id="sidebar" class="nav-collapse" >
        
                <!-- sidebar menu start-->
        
                <div class="leftside-navigation"  style="overflow-y: scroll;">
        			
                    <ul class="sidebar-menu" id="nav-accordion">
                    
                    	<li><a href="{{URL::to('test/send-mail-view')}}">
                        		<i class="fa fa-dashboard"></i>
                        		send mail
                    		</a>
                		</li>
                		
                		
                		<li class="sub-menu">
        
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>mySQL</span>
                            </a>
        
                            <ul class="sub">
                            
                            
                              	<li class="sub-menu">
                              	
                              		<a href="javascript:;">
                                        <i class="fa fa-book"></i>
                                        <span>Posts_Lang_2</span>
                                    </a>
                                                        				
                    				<ul class="sub">
                    				
                    					<li class="sub-menu">
                    						<a href="{{URL::to('test/lang2_lpl2')}}">
                                        		<i class="fa fa-dashboard"></i>
                                        		lang2_lpl2
                                    		</a>
                                		</li>
                                		
                                		<li><a href="{{URL::to('test/lpl2_lang2')}}">
                                        		<i class="fa fa-dashboard"></i>
                                        		lpl2_lang2
                                    		</a>
                                		</li>
                                		
                                		<li class="sub-menu">
                    						<a href="{{URL::to('test/lpl2_post2')}}">
                                        		<i class="fa fa-dashboard"></i>
                                        		lpl2_post2
                                    		</a>
                                		</li>
                                		
                                		<li><a href="{{URL::to('test/post2_lpl2')}}">
                                        		<i class="fa fa-dashboard"></i>
                                        		post2_lpl2
                                    		</a>
                                		</li>
                                		
                                		<li><a href="{{URL::to('test/post2')}}">
                                        		<i class="fa fa-dashboard"></i>
                                        		post2
                                    		</a>
                                		</li>
                    				</ul>
                    				
                				</li>
                				
                            </ul>
                        </li>
                        
                        
                		<li class="sub-menu">
        
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>List Post</span>
                            </a>
        
                            <ul class="sub">
                              	<li><a href="{{URL::to('test/list-post')}}">
                        			<i class="fa fa-dashboard"></i>
                        			list post 1
                    				</a>
                				</li>
                				
                				<li><a href="{{URL::to('test/list-post-2')}}">
                                		<i class="fa fa-dashboard"></i>
                                		list post 2
                            		</a>
                        		</li>
                        		
                        		<li><a href="{{URL::to('test/list-post-3')}}">
                                		<i class="fa fa-dashboard"></i>
                                		list post 3
                            		</a>
                        		</li>
                        		
                        		<li><a href="{{URL::to('test/list-post-4')}}">
                                		<i class="fa fa-dashboard"></i>
                                		list post 4
                            		</a>
                        		</li>
                        		
                        		<li><a href="{{URL::to('test/list-post-5')}}">
                                		<i class="fa fa-dashboard"></i>
                                		list post 5
                            		</a>
                        		</li>
                        		
                        		<li><a href="{{URL::to('test/list-post-6')}}">
                                		<i class="fa fa-dashboard"></i>
                                		list post 6
                            		</a>
                        		</li>
                        		
                        		<li><a href="{{URL::to('test/list-post-7')}}">
                                		<i class="fa fa-dashboard"></i>
                                		list post 7
                            		</a>
                        		</li>
                        		
                            </ul>
                        </li>
                        
                       
                    
                    	
                    
                        <li>
                            <a class="active" href="{{URL::to('/dashboard')}}">
                                <i class="fa fa-dashboard"></i>
                                <span>Tổng quan</span>
                            </a>
                        </li>
        
                        <li>
                            <a href="{{URL::to('/information')}}">
                                <i class="fa fa-dashboard"></i>
                                <span>Thông tin website</span>
                            </a>
                        </li>
                         
                        <li class="sub-menu">
        
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Slider</span>
                            </a>
        
                            <ul class="sub">
                                <li><a href="{{URL::to('/manage-slider')}}">Liệt kê slider</a></li>
                                <li><a href="{{URL::to('/add-slider')}}">Thêm slider</a></li>
                            </ul>
                        </li>
                           
                       
                        <li class="sub-menu">
                        	
                        	<a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Đơn hàng</span>
                            </a>
                            
                            <ul class="sub">

        						<li><a href="{{URL::to('/manage-order')}}">Quản lý đơn hàng</a></li>                              
                            </ul>
                        </li>
                        
                        <li class="sub-menu">
                        
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Mã giảm giá</span>
                            </a>
                        
                            <ul class="sub">
                                <li><a href="{{URL::to('/insert-coupon')}}">Them mã giảm giá</a></li>
                                <li><a href="{{URL::to('/list-coupon')}}">Liệt kê mã giảm giá</a></li>
                            </ul>
                        </li>
                        
                        <li class="sub-menu">
                        
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Vận chuyển</span>
                            </a>
                            
                            <ul class="sub">
                                <li><a href="{{URL::to('/delivery')}}">Quản lý vận chuyển</a></li>                     
                            </ul>
                        </li>
                        
                        <li class="sub-menu">
                        
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Danh mục sản phẩm</span>
                            </a>
                        
                            <ul class="sub">
        						<li><a href="{{URL::to('/add-category-product')}}">Thêm danh mục sản phẩm</a></li>
        						<li><a href="{{URL::to('/all-category-product')}}">Liệt kê danh mục sản phẩm</a></li>
                            </ul>
                        </li>
                        
                        <li class="sub-menu">
                        
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Bình luận</span>
                            </a>
                        
                            <ul class="sub">
                                <li><a href="{{URL::to('/comment')}}">Liệt kê bình luận</a></li>
                            </ul>
                        </li>
                        
                        <li class="sub-menu">
                        
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Danh mục bài viết</span>
                            </a>
                        
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-category-post')}}">Thêm danh mục bài viết</a></li>
                                <li><a href="{{URL::to('/all-category-post')}}">Liệt kê danh mục bài viết</a></li>                              
                            </ul>
                        </li>
                        
                        <li class="sub-menu">
                        
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Thương hiệu sản phẩm</span>
                            </a>
                        
                            <ul class="sub">
        						<li><a href="{{URL::to('/add-brand-product')}}">Thêm hiệu sản phẩm</a></li>
        						<li><a href="{{URL::to('/all-brand-product')}}">Liệt kê thương hiệu sản phẩm</a></li>                              
                            </ul>
                        </li>
                      
                        <li class="sub-menu">
                        
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Sản phẩm</span>
                            </a>
                        
                            <ul class="sub">
        						<li><a href="{{URL::to('/add-product')}}">Thêm sản phẩm</a></li>
        						<li><a href="{{URL::to('/all-product')}}">Liệt kê sản phẩm</a></li>                              
                            </ul>
                        </li>
                        
                        <li class="sub-menu">
                        
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Bài viết</span>
                            </a>
                        
                            <ul class="sub">
                                 <li><a href="{{URL::to('/add-post')}}">Thêm bài viết</a></li>
                                <li><a href="{{URL::to('/all-post')}}">Liệt kê bài viết</a></li>
                              
                            </ul>
                        </li>
                        
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Video</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('add-video')}}">Thêm video</a></li>   
                                
                                <li><a href="{{URL::to('list-video')}}">list video</a></li>                             
                            </ul>
						</li>
                        
@impersonate
                        <li>
                           
                            <span><a href="{{URL::to('/impersonate-destroy')}}">Stop chuyển quyền</a></span>
                          
                        </li>
@endimpersonate
        



@hasrole(['admin','author'])

                        <li class="sub-menu">

                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Users</span>
                            </a>

                            <ul class="sub">
                            	<li><a href="{{URL::to('/add-users')}}">Thêm user</a></li>
                                <li><a href="{{URL::to('/users')}}">Liệt kê user</a></li>
                              
                            </ul>
						</li>
       
@endhasrole
                   
					</ul>
	            </div>
    			            <!-- sidebar menu end-->
            </div>
        </aside>