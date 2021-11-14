

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
            
	use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Session;
            
    $name       =      Session::get("admin_name");
    
    $mail       =      Session::get("admin_email");
    
    $admin      =      DB::table('tbl_admin')->where('admin_email' , $mail)->first();
    
	if($mail){		       		echo $mail;           					}
?>            
                            </span>
  
                            <b class="caret"></b>
                        </a>
  
     	              	<ul class="dropdown-menu extended logout"> 
     	              	
                            <li><a href="#">							<i class=" fa fa-suitcase"></i>		Profile</a></li>
                            <li><a href="#">							<i class="fa fa-cog"></i> 			Settings</a></li>
                            <li><a href="{{URL::to('/duc-logout-auth')}}">	<i class="fa fa-key"></i>		Đăng xuất</a></li>
                            
<?php 
  
    if(Session::get("admin_email")) { 
?>
							<li>Admin id :	{{	$admin->admin_id	}}	</li>
							
                            <li>{{	$mail 		}}						</li>
                            <li>Auth :		{{	Auth::id()			}}	</li>   
                            <li>DucAuth_id :	{{	Session::get('DucAuth_id')	}}	</li>    
                           <!--  <li>DucAuth :	{{	Session::get('DucAuth')	}}	</li> -->                        
<?php 
    }
?>                            
       						<li><?php if(isset($_COOKIE["admin_name"])) { echo "cookie : " .$_COOKIE["admin_name"]; } ?></li>              
          
                        
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                   
                </ul>
                <!--search & user info end-->
            </div>
        </header>