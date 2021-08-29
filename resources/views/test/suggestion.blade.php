

<link href="{{asset('public/frontend/css/bootstrap.min.css')}}" 		rel="stylesheet">

    
<div class="col-sm-5">
    
    <form action="{{URL::to('/tim-kiem')}}" autocomplete="off" method="POST">
        {{csrf_field()}}		
        <div class="search_box">
            
            <!-- $('#keywords').keyup(function() -->
        	
        	<input type="text" style="width: 100%" name="keywords_submit" id="keywords" placeholder="Tìm kiếm sản phẩm"/>
           	
           	<div id="search_ajax"></div>

           	<input type="submit" style="margin-top:0;color:#666" name="search_items" class="btn btn-primary btn-sm" value="Tìm kiếm">

    	</div>
    </form>
</div>    


<script src="{{asset('public/frontend/js/jquery.js')}}"></script>

<script type="text/javascript">

    $('#keywords').keyup(function(){
        
    	var query 	=	 $(this).val();

    	
    	
      	if(query != '')
        {
			var _token = $('input[name="_token"]').val();

	/* 		alert('_token is : ' +_token); */
			
 			$.ajax({
 	 			
 				url			:"{{url('/autocomplete-ajax')}}"				,

  				method		:"POST"								,
  				
  				data		:{	query		:	query		, 
  	  							_token		:	_token
  							 }									,

  				success		:function(data){

	   				$('#search_ajax').fadeIn(50);  
					$('#search_ajax').html(data);
				}
 			});
		}
		else{

    		$('#search_ajax').fadeOut();  
		}
    });

    $(document).on('click'	,  '.li_search_ajax'	,	 function(){ 		//li_search_ajax  inside the HomeController@autocomplete_ajax
        
        $('#keywords').val($(this).text()); 
         
        $('#search_ajax').fadeOut();  
    }); 



</script>



