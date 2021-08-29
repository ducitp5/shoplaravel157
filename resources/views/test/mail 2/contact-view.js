

function validateContactForm() {

    var valid 		=	 true;

    
    $(".info").html("");

    
    $(".input-field").css('border', '#e0dfdf 1px solid');

    
    var userName 		= 	$("#userName")	.val();
            
    
    if (userName == "") {
    	
        $("#userName-info").html("Required.");
        
        $("#userName").css('border', '#e66262 1px solid');
        
        valid = false;
    }
    
    
    var userEmail 		= 	$("#userEmail")	.val();
    
    if (userEmail == "") {
    	
        $("#userEmail-info").html("Required.");
        
        $("#userEmail").css('border', '#e66262 1px solid');
        
        valid = false;
    }
    
    if (!userEmail.match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/))
    {
        $("#userEmail-info").html("Invalid Email Address.");
        
        $("#userEmail").css('border', '#e66262 1px solid');
        
        valid = false;
    }

    
    var subject 		= 	$("#subject")	.val();
    
    if (subject == "") {
    	
        $("#subject-info")	.html("Required.");
        
        $("#subject")		.css('border'  ,  '#e66262 1px solid');
        
        valid = false;
    }
    
    
    var content 		= $("#content")		.val();
    
    if (content == "") {
        
    	$("#userMessage-info")	.html("Required.");
    	
        $("#content")			.css('border'	,  '#e66262 1px solid');
        
        valid = false;
    }
    
    return valid;
}

