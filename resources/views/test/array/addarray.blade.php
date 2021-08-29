
<!-- .php -->

<link href="http://127.0.0.1:8080/PHP%20Tutorial/laravel/Workspace/Laravel%20157/shopbanhanglaravel/public/frontend/css/bootstrap.min.css" rel="stylesheet">


<link href="{{asset('public/frontend/css/bootstrap.min.css')}}" 		rel="stylesheet">		<!-- .blade.php -->



<div class="container">

<?php  

    $cartt      =   [ 'a' , 5];
    
    echo  '<pre>';
    
    print_r($cartt);  
    
    echo  '</pre>';
?>
	<hr>

	$cartt :   <br>

<?php     
        
    $cartt      =   [6 , 9];
    
    
    echo  '<pre>';
    
    print_r($cartt);
    
    echo  '</pre>';
    
    
    $cartt[]      =   [ 2, 1 , 4];
    
    echo  '<pre>';
    print_r($cartt);
    
    echo  '</pre>';
    
    $cartt[]      =   [5 , 9];
    
    
    echo  '<pre>';
    print_r($cartt);
    
    echo  '</pre>';
?>

	<pre> <?php  print_r($cartt);   ?>   </pre>
	
	<hr>
	
	<?= $cartt[3][0];?>
	

<?php     
        
    $cartt[]      =   10;
    
    
    echo  '<pre>';
    
    print_r($cartt);
    
    echo  '</pre>';
    
    
  
?>

</div> 