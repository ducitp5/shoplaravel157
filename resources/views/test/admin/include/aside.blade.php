
    <link rel="stylesheet"  href="{{asset('public/backend/css/bootstrap.min.css')}}" >
    <link rel='stylesheet'  href="{{asset('public/backend/css/style.css')}}" 						type='text/css' />
    <link rel="stylesheet"  href="{{asset('public/backend/css/font-awesome.css')}}" > 

   
   	        
  	<script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
	  
    <script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{asset('public/backend/js/scripts.js')}}"></script>
  
  
  
  	
		<aside>
            <div id="sidebar" class="nav-collapse">
        
                <!-- sidebar menu start-->
        
     <!--            <div class="leftside-navigation"> -->
     
     
        		<div class="leftside-navigation"  style="overflow-y: scroll;">
        			
                    <ul class="sidebar-menu" id="nav-accordion">
                    
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
        
                            <a href="#">
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
                                <li><a href="{{URL::to('/insert-coupon')}}">Quản lý mã giảm giá</a></li>
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
                                <li><a href="{{URL::to('video')}}">Thêm video</a></li>                             
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
        
        
        
        
        
        
        
        
        
        

    
    
    
 	<!-- //calendar -->