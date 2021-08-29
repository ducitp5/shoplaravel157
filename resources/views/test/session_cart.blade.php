

<link href="{{asset('public/frontend/css/bootstrap.min.css')}}" 		rel="stylesheet">


<script		src="{{asset('public/frontend/js/jquery.js')}}"></script>
    

<?php 
        
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\URL;

    
    if( isset($_POST['search_items']) ) {
        
    
        $data           =        Request()->all();
        
        $session_id     =        substr(md5(microtime()),rand(0,26),5);
        
        $DucCart        =        Session::get('duccart');
    
        echo("<script>console.log(JSON.stringify(" .json_encode($DucCart). " , undefined , 4));</script> " );

        $DucCart[]      =   array(
            
            'session_id'            =>      $session_id,
            
            'product_id'            =>      $data['keyword'],
            
        );
        Session::put('duccart'      ,   $DucCart);
        
        $item[]         =       Session::get('item');
        
        $item[]         =       $data['keyword'];
        $item[]         =       $session_id;
        
        Session::put('item'         ,   $item);
        
        Session::put('message'      ,   'the first buy success');
    }
    
    if( isset($_POST['deleteall']) ) {
        
        header("Location: " . URL::to('/test/refresh-cart'), true, 302);

        exit();
    }
    
?>
    
 


<?php 
       
    
    if(session()->has('message')){
?>    
		<div class="alert alert-success" id="alert">keke ----  {{ 	session()	->get('message') 	}}</div>
<?php
        Session::put('message' , null);
    }
?>

<div class="container">

    <div class="col-sm-4">
        
        <form action="{{URL::to('/test/session-cart')}}" autocomplete="off" method="POST">
        
            {{csrf_field()}}		
        
            <div class="">
            	
            	<input type="text" style="width: 100%" name="keyword"  placeholder="Tìm kiếm sản phẩm"/>
               	    
               	<input type="submit" style="margin-top:0;color:#666" name="search_items" class="btn btn-primary btn-sm" value="Tìm kiếm">
               	
    			<input type="submit" name="deleteall" value="delete all" />		
        	</div>
        </form>
    </div>    
    
        
    <div class="col-sm-4">
                   	
       	<div>
       		<pre>   		
<?php 
    echo       'duccart est : <br>' ;
                
                print_r(Session::get('duccart')); 
    
    echo       '<br>' ;
?>                      	
       		</pre>   	
       	</div>
    </div>    
    
    
    <div class="col-sm-4">
                   	
       	<div>
       		<pre>
   		
<?php 
    $ite    =    Session::get('item');
    
    echo       'item est : <br>' ;
    
                print_r($ite);
    
    echo       '<br>' ;
?>                      	
       		</pre>   	
       	</div>
    </div>  

</div>

<hr>

<div class="container">


	<hr>
	<p>All SESSION</p>
	
	<pre> <?php  print_r(session::all());   ?>   </pre>
	
	<hr>	
	

</div>



<script>

    console.log('ducconsole :- ' +JSON.stringify(<?= json_encode(Session::get('duccart')) ;?> , undefined, 4)); 
</script>


