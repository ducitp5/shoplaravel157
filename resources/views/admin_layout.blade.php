<!DOCTYPE html>

<html>

<head>

   @include('admin.include.head')

</head>


<body>

    <section id="container">

        <!--header start-->
        
        @include('admin.include.header')
        
        
        <!--header end-->
        <!--sidebar start-->
        
        @include('admin.include.aside')
        
        <!--sidebar end-->
        <!--main content start-->
        
        
        <section id="main-content">
        
        	<section class="wrapper">
        	
                @yield('admin_content')
            
            </section>
        
        
        
            <!-- footer -->
        
			<div class="footer">
    			<div class="wthree-copyright">
        
        			  <p>Các bạn xem hướng dẫn tạo project  : <a target="_blank" href="https://www.youtube.com/watch?v=CjA79XhHVQI&list=PLWTu87GngvNxpWN6FVuEcS-YvFNq6RnqG">tại đây nhé</a></p>
    	
    			</div>
		  	</div>
            <!-- / footer -->
        </section>
        
        <!--main content end-->
    
    </section>
    
    
    
  	@include('admin.include.script')		
    
    
    
</body>
    
    
</html>
