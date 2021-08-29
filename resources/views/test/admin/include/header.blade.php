	
	<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}" >		
    <link rel='stylesheet' href="{{asset('public/backend/css/style.css')}}" 		type='text/css' />
    <link rel="stylesheet" href="{{asset('public/backend/css/font-awesome.css')}}" > 
    
   
    <script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
	<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>

    
    
    
    

		<header class="header fixed-top clearfix">
        
            <!--logo start-->
            
            <div class="brand">
            
                <a target="_blank" href="{{url('/')}}" class="logo">
                   Shop
                </a>
            
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            
            <!--logo end-->
            
            <div class="top-nav clearfix">
            
                <!--search & user info start-->
            
                <ul class="nav pull-right top-menu">
            
                    <li>
                        <input type="text" class="form-control search" placeholder=" Search">
                    </li>
                    
                    <!-- user login dropdown start-->
                    
                    <li class="dropdown">
                    
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    
                            <img alt="" src="{{asset('public/backend/images/2.png')}}">
                    
                            <span class="username">
                    
<?php
            //					$name = Auth::user()->admin_name;
            
	use Illuminate\Support\Facades\Session;
            
    $name       =      Session::get("admin_name");

	if($name){		       		echo $name;           					}
?>            
                            </span>
  
                            <b class="caret"></b>
                        </a>
  
                        <ul class="dropdown-menu extended logout">
                            <li><a href="#">							<i class=" fa fa-suitcase"></i>		Profile</a></li>
                            <li><a href="#">							<i class="fa fa-cog"></i> 			Settings</a></li>
                            <li><a href="{{URL::to('/logout-auth')}}">	<i class="fa fa-key"></i>			Đăng xuất</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                   
                </ul>
                <!--search & user info end-->
            </div>
        </header>
        
