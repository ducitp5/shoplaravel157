

<link href="{{asset('public/frontend/css/bootstrap.min.css')}}" 		rel="stylesheet">


<script		src="{{asset('public/frontend/js/jquery.js')}}"></script>
    


<?php 
    use App\Lpl2;
    use App\PostLang2;
    
    use Illuminate\Support\Facades\Session;
    
/*     $all_post       =    PostLang2   ::with('cate_post')

                                     ->orderBy('cate_post_id')   ->first()  ; */
    
                                     
    
    

    
    
    $array_lang     =    Lpl2   ::where('post_id'   ,  19)->pluck('lang_id')->toArray();       //      return array[object]
/*     foreach($all_lang as $object)
    {
        $arrays[] = $object->toArray();
    }
    // Dump array with object-arrays
    dd($arrays);  */
?>  


<hr>

<div class="container">

	<p>$all_post       =    PostLang2  ::find(19) ;</p>
	
	<pre> 
	
<?php  

    $all_post       =    PostLang2  ::find(19) ;
    
    echo_pre($all_post);
    print_r($all_post );
?>   
  	</pre>
  	
  	
  	
	<p>All SESSION</p>
	
	<pre> 
	
<?php  // print_r($all_post);  

    $all_lang       =    Lpl2   ::get('lang_id');       //      return array[object]
    
    $all_lang       =    Lpl2   ::where('post_id'   ,  19)->pluck('lang_id');       //      return object

    print_r($all_lang);
?>   
  	</pre>
  	
  	
  	<p>Array</p>
	
	<pre> 
	
<?php  // print_r($all_post);  

        print_r($array_lang);
?>   
  	</pre>
	

	<hr>	

</div>



<script>

    console.log('ducconsole :- ' +JSON.stringify(<?= json_encode(Session::get('duccart')) ;?> , undefined, 4)); 
</script>











