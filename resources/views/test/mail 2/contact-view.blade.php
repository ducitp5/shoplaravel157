<?php    session_start();    


?>


<html>
<head>

<!--  	<base href="/yourapp" />   -->

    <title>Contact Us Form</title>


	<style type="text/css">
	
        @import "{{asset('resources/views/test/mail/style.css')}}";   
    	
/*       	@import url("{{asset('resources/views/test/mail/style.css')}}");   */
	</style>
    
<!-- 	<link href="{{asset('resources/views/test/mail/style.css')}}" 					rel="stylesheet">  -->
		
<!-- 		<link href="{{	asset2('style.css')  }}"		 -->						<!-- defined in index.php -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>


<body>

	

	<div class="form-container">

    	<h1 class="notification">notification </h1>
    	
    	
    	
    	
    	
        <form 	name="frmContact" 	id="myForm" 	frmContact"" 	method="post"
        
              	action="{{asset('resources/views/test/mail/send_contact_mail.blade.php')}}" 			enctype="multipart/form-data"
              	
	            onsubmit="return validateContactForm()">

			<h1 class="">Sender Name</h1>
			
			<div class="input-row">
            
                <input  type="text" class="input-field" name="sender"   />
                
            </div>
            
            <h1 class="">SEND TO</h1>
            
            <div class="input-row">
            
                <label style="padding-top: 20px;">Name</label> 
                
                <span  id="userName-info" class="info"></span>
                    
                <br /> 
                
                <input  type="text" class="input-field" name="userName"  id="userName" />
                
            </div>
            
            
            <div class="input-row">
            
                <label>Email</label> 
                
                <span id="userEmail-info"	 class="info"></span>
                    
                <br /> 
                
                <input type="text"   class="input-field" name="userEmail" id="userEmail" />
            </div>
            
            
            <div class="input-row">
            
                <label>Subject</label> 
                
                <span id="subject-info"    class="info"></span>
                    
                <br /> 
                
                <input type="text"         class="input-field" name="subject" id="subject" />
            </div>
            
            
            <div class="input-row">
            
                <label>Message</label> 
                
                <span id="userMessage-info"   class="info">		</span>
                
                <br />
                
                <textarea 	name="content" id="content"
                    		class="input-field" cols="60" rows="6">
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
?>
					<p>ko co j ca</p>

<?php     
    }
?>
            	</div>
            </div>
            
            
<script type="text/javascript">


                           
</script>              
               
               
<?php

$_SESSION["x"]="y";
?>

<script>
 var session = eval('(<?php echo json_encode($_SESSION)?>)');
 console.log(session);


//		alert(session.x);
</script>
               
        	</div>
        
        </form>
        
    </div>




    




    <script src="https://code.jquery.com/jquery-2.1.1.min.js"        type="text/javascript">	</script>
    
    
    <script type="text/javascript" src="{{asset('resources/views/test/mail/contact-view.js')}}">	</script>
    


</body>
</html>