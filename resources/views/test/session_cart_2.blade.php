


<link href="{{asset('public/frontend/css/bootstrap.min.css')}}" 		rel="stylesheet">


<script		src="{{asset('public/frontend/js/jquery.js')}}"></script>
    


<!--     
<div class="container">

	<p>Start typing a name in the input field below:</p>
	
	
	First name:		<input type="text" id="input1">


	<p>		Suggestions --: <span id="span1"></span>	</p>

	<br>


	<hr>	

</div>

<script>

    $(document).ready(function(){

        $("#input1").keyup(function(){

            var txt = $("#input1").val();

           	$("#span1").html(txt);
        	
      	});
    });
</script>
 	--> 
 	
 	
 	
 	
<div class="container">

	
	<br>

	<form id="form_1" action="" method="post">
	 {{csrf_field()}}
 
 		<input type="submit" name="delete1"   value="delete 1" />		<br>
    
        <input type="submit" name="deleteall" value="delete all" />		
	</form>
	<hr>
	<div class="alert alert-success" id="alert2"> alert2</div>
	<hr>	




<?php
    use Illuminate\Http\Request;
    
    use Illuminate\Support\Facades\Redirect;
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\URL;
    
    
//    if($_SERVER["REQUEST_METHOD"] == "POST"){
     
        if( isset($_POST['delete1']) ) {
        
            Session::put('duccart'      ,   null);
            
            Session::put('message'      ,   'delete Duccart success');
            
                    
        }
        else if( isset($_POST['deleteall']) ) {
        
            echo("<script>console.log('helloe duc');</script> " );
            
            Session::flush();             
        
            if(Session::has('duccart'))         Session::put('message2'      ,   'cannot delete all Session');
            
            else                                Session::put('message2'      ,   'delete all Session success');
           
            echo("<script> $('#alert2').html('".session()	->get('message2')."' );</script> " );

            echo("<script>console.log(JSON.stringify(" .json_encode(Session::get('duccart')). " , undefined , 4));</script> " );
//			echo("<script>window.location = {{ url('test/session-cart') }};</script>");
?>

			<script>console.log('dduc :- ' +JSON.stringify(<?= json_encode(Session::get('duccart')) ;?> , undefined, 4)); </script>
			
<!--   			<script>window.location = "{{ url('/test/session-cart') }}";</script>
	--> 		
<?php 
                
//            exit();
//            header("Location: " . URL::to('/test/session-cartt'), true, 302);
            
//            exit();
            
?>   
	 	<h4>	
			<a href="{{URL::to('test/session-cart-2')}}">
		
				<p>refresh here</p>
		
			</a>	
		</h4>  
<?php 

//            echo("<script> alert('".session()	->get('message')."' );</script> " );
          
//            redirect(Request()->url());
 //           return redirect("{{URL::to('/test/session-cart'])}}");
  //           return redirect()->to('/test/session-cart'); 
  
//            return redirect()->back();{{URL::to('/chi-tiet/'.$cart['product_slug'])}}

//            return redirect('/');
        }        
//    }

?>

</div>
<hr>
    
    
<div class="container">

    <form id="form_1" action="" method="post">
    
    {{csrf_field()}}	
        <input type="submit" name="submit_1" value="Submit 1" />		<br>
    
        <input type="submit" name="submit_2" value="Submit 2" />
    </form>
    
    
    <form id="form_2" action="" method="post">
    {{csrf_field()}}	
        <input type="submit" name="submit_3" value="Submit 3" />
    </form>
</div>

<?php

//    if($_SERVER["REQUEST_METHOD"] == "POST"){
     
        if( isset($_POST['submit_1']) ) {
        
            echo 'text 1';
        
        }
        else if( isset($_POST['submit_2']) ) {
        
            echo 'text 22';
        
        }
        else if( isset($_POST['submit_3']) ) {
            
            echo 'text 333';
            
        }
 //   }

?>






<?php 

    
//    if (Request()->isMethod('post')) {

 //   if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        if( isset($_POST['search_items']) ) {
            
        
            $data           =        Request()->all();
            
            $session_id     =        substr(md5(microtime()),rand(0,26),5);
            
            $DucCart        =        Session::get('duccart');
        
//        echo("<script>console.log(JSON.stringify(" .json_encode($DucCart). " , undefined , 4));</script> " );
?>

<script type="text/javascript">

/*  */

</script>


<?php         
            echo("<script>console.log('--------------------');</script> " );
?>

<script type="text/javascript">

/*  */

</script>


<?php 
  /*           echo("<script>console.log(JSON.stringify(" .json_encode(session::all()). " , undefined , 4));</script> <br>");
            
            if($DucCart    ==  true){
                
                $is_avaiable    =    false;
                
                foreach($DucCart as $key => $val){
                
                    if($val['product_id']   ==  $data['keyword']){
                    
                        $is_avaiable    =   true;
                    }
                    
                }
                
                echo("<script>console.log('-----------1111111---------');</script> " );
                echo("<script>console.log('is_avaiable' , $is_avaiable);</script>");
                echo("<script>console.log('-----------2222222---------');</script> " );
                
                
                if($is_avaiable == 0){      // consol.log json
                
                    $DucCart[]     =    array(
                
                        'session_id'        => $session_id,
                
                        'product_id'        => $data['keyword'],
                   
                    );
                    Session::put('duccart'      ,   $DucCart);
                
                    Session::put('message'      ,   'product added success');
                } 
                
                else{
                    Session::put('message'      ,   'product already added before');
                } 
            }
            
            else{
                 */
                $DucCart[]      =   array(
                    
                    'session_id'            =>      $session_id,
                    
                    'product_id'            =>      $data['keyword'],
                    
                );
                Session::put('duccart'      ,   $DucCart);
                
                
                $item[]           =   $data['keyword'];
                $item[]           =   $session_id;
                
                Session::put('item'         ,   $item);
                
                Session::put('message'      ,   'the first buy success');
            }
            
//            Session::save();       
//        }
 //   }
?>
    
    
 


<?php 
       
    
    if(session()->has('message')){
?>    
		<div class="alert alert-success" id="alert">keke ----  {!! 	session()	->get('message') 	!!}</div>
<?php
        Session::put('message' , null);
    }
?>

<div class="container">

    <div class="col-sm-4">
        
        <form action="{{URL::to('/test/session-cart')}}" autocomplete="off" method="POST">
        
            {{csrf_field()}}		
        
            <div class="">
                
                <!-- $('#keywords').keyup(function() -->
            	
            	<input type="text" style="width: 100%" name="keyword"  placeholder="Tìm kiếm sản phẩm"/>
               	
     <!--           	<div id="search_ajax"></div> -->
    
               	<input type="submit" style="margin-top:0;color:#666" name="search_items" class="btn btn-primary btn-sm" value="Tìm kiếm">
    
        	</div>
        </form>
    </div>    
    
    
        
    <div class="col-sm-4">
                   	
       	<div id="search_ajax">
       		<pre>
   		
<?php 
    echo       'duccart est : <br>' ;
               print_r(Session::get('duccart')); 
    
    echo       '<br>' ;
//        echo       var_dump(Session::get('cart'));    

?>                      	
       		</pre>   	
       	</div>
    </div>    
    
    
    <div class="col-sm-4">
                   	
       	<div id="search_ajax">
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

	<p>All SESSION</p>
	
	<pre> <?php  print_r(session::all());   ?>   </pre>
	
	<hr>	

</div>






<!-- <div class="container">


	<button id="delete">delete</button>
	<button id="deleteall">deleteall</button>		

	<hr>	

</div> -->

<script>

    $(document).ready(function(){

          
        $("#delete").keyup(function(){
 /* 
            Session::put('duccart'      ,   null);

            Session::put('message'      ,   'delete Duccart success'); */
            	
      	});


        $("#deleteall").click(function(){
            	                
              

   //             Session::put('message'      ,   'delete all Session success');
	                
 //               $("#alert").html(session()	->get('message') );
            	
      	});      	
    });

    console.log('ducconsole :- ' +JSON.stringify(<?= json_encode(Session::get('duccart')) ;?> , undefined, 4)); 
</script>


