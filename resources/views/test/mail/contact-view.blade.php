<?php    

//session_start();    

?>

@extends('admin_layout')


@section('admin_content')


    
 	<link href="{{asset('resources/views/test/mail/style.css')}}" 	rel="stylesheet">  
		
<!-- 		<link href="{{	asset2('style.css')  }}"		 -->						<!-- defined in index.php -->

 <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 -->


	<div class="form-container">

    	<h1 class="notification">notificationn </h1>
    	
    	   	
    	
        <form 	name="frmContact" 	id="myForm" 	frmContact"" 	method="post"
        
              	action="{{URL('test/send-mail')}}" 			enctype="multipart/form-data"
              	
	            onsubmit="return validateContactForm()">
	            
		{{ csrf_field() }}
		
			<h1 class="">Sender Name</h1>
			
			<div class="input-row">
            
                <input  type="text" class="input-field" name="sender" value="duc tran"  />
                
            </div>
            
            <h1 class="">SEND TO</h1>
            
            <div class="input-row">
            
                <label style="padding-top: 20px;">Name</label> 
                
                <span  id="userName-info" class="info"></span>
                    
                <br /> 
                
                <input  value="duc" type="text" class="input-field" name="userName"  id="userName" />
                
            </div>
            
            
            <div class="input-row">
            
                <label>Email</label> 
                
                <span id="userEmail-info"	 class="info"></span>
                    
                <br /> 
                
                <input  value="ducttp2@gmail.com"  type="text"   class="input-field" name="userEmail" id="userEmail" />
            </div>
            
            
            <div class="input-row">
            
                <label>Subject</label> 
                
                <span id="subject-info"    class="info"></span>
                    
                <br /> 
                
                <input  value="test keke"  type="text"         class="input-field" name="subject" id="subject" />
            </div>
            
            
            <div class="input-row">
            
                <label>Message</label> 
                
                <span id="userMessage-info"   class="info">		</span>
                
                <br />
                
                <textarea 	name="content" id="content"
                    		class="input-field" cols="60" rows="6">
                    		
                    toi la duc
        		</textarea>
            </div>
            
            
            <div>
                <input type="submit" name="send" class="btn-submit" 
                		  value="Send" />

                <div id="statusMessage"> 
                
<?php

    if (! empty($_SESSION[ 'message']) ) {
?>
	                <p><?php echo $_SESSION[ 'message']; ?></p>

<?php

    
        $_SESSION[ 'message'] = null;
    }
    else {
        
        echo getcwd ();
        
?>
					<p>ko co j ca</p>
					

<?php     
    }
?>
            	</div>
            </div>        
                                     
        </form>
        
    </div>


<?php

    $_SESSION["x"]="y";
?>



<script>

	var session = eval('(<?php echo json_encode($_SESSION)?>)');
 
 	console.log('p153 - ');
 	console.log(session);


//		alert(session.x);

	
</script>

    




    
    <script type="text/javascript" src="{{asset('resources/views/test/mail/contact-view.js')}}">	</script>
    

@endsection
