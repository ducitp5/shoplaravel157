@extends('admin_layout')


@section('admin_content')

    <div class="table-agile-info">
        <div class="panel panel-default">

	        <div class="panel-heading">
          		Liệt kê bài viết
    	    </div>

				
        	<div class="table-responsive">
<?php

    
    use App\PostLang2;
    use Illuminate\Support\Facades\Session;
    use App\Lpl2;
    

    $message = Session::get('message');
    
    if($message){
    
        echo '<span class="text-alert">'.$message.'</span>';
        
        Session::put('message'  ,   null);
    }
                                  
?>
				
				
				
          		<table class="table table-striped b-t b-light" id="myTable">
          		
                    <thead>
                      	<tr>
                        	<th style="width:20px;">

                            	<input type="checkbox"><i></i>

                        	</th>
                        	
                        	<th style="width:20px;">id</th>
                            
                            <th>EN</th>
                            <th>FR</th>                            
                            <th>VN</th>
                            
                            <th>Tên bài viết</th>
                            <th>Hình ảnh</th>
                            
                            <th>Languague Manupulation</th>
                            
                            <th>ID danh muc</th>
                            <th>Danh mục bài viết</th>
                            <th>Hiển thị</th>
                        
                        	<th style="width:30px;"></th>
                  		</tr>
                    </thead>
                    
                    
					<tbody>	
                     	
                     	
<?php 

    $all_post       =    PostLang2   ::Sql_cate_post();    

    $total_rows     =    mysqli_num_rows($all_post);
    
    consolelog("83 co ${total_rows} ket qua");
    
    
    $row            =    0;
        
    $rowperpage     =    2;
    
    if(isset($_GET['rowperpage'])){
    
        $rowperpage     =    $_GET['rowperpage'];
    }
    
    
    if (isset($_GET['page_no']) && $_GET['page_no']!="") {
        
        $current_page    =    $_GET['page_no'];
    }
    else {
        
        $current_page    =    1;
    }
    
    
    // selecting rows
    
    $row        =    ($current_page-1) * $rowperpage;
    
    $result     =    PostLang2   ::Sql_cate_post3( $row , $rowperpage );
    
    $sno        =    $row + 1;

        
    if ( mysqli_num_rows($result) > 0 ) {

        while ($post = mysqli_fetch_array($result)){
?>	
	                   
						<form action="{{url('test/post-assign-lang')}}" method="post">
                    	
                    		@csrf	                    	
                			<tr></tr>
                			<tr>
                          		
                          		<td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                               
                                <td> <input type="hidden" name="post_id" value="{{  $post['post_id']  }}">	{{ $post['post_id'] }}	</td>
  
<?php 
            $all_lang       =    Lpl2   ::where('post_id'   ,   $post['post_id'])     ->pluck('lang_id')  ->toArray();  
        
            consolelog_json2('post id - '.$post['post_id'], $all_lang);
?>
                                <td><input type="checkbox" name="english_lang" {{ in_array(1, $all_lang) 	?	 'checked'   :   '' }} > </td>                               
                                <td><input type="checkbox" name="french_lang"  {{ in_array(2, $all_lang)	?	 'checked'   :   '' }} > </td> 
    							<td><input type="checkbox" name="viet_lang"    {{ in_array(3, $all_lang)	?	 'checked'   :   '' }} > </td> 
     
       				
       							<td>{{ 	$post['post_title'] }}</td>
                                
                                <td><img src="{{asset('public/uploads/post/'.$post['post_image'])}}" height="100" width="100"></td>
                                
                               	<td>
                                	<p><input type="submit" value="assign language" class="btn btn-sm btn-default"></p>
                         				
                     				<p><a  onclick="alert('delete this user')" style="margin:5px 0;" class="btn btn-sm btn-danger" >Xóa user</a></p>
                      			
                    			</td>
                                
                                <td>{{ 	$post['cate_post_id'] }}</td>
                                
                                <td>{{ 	$post['cate_post_name']	 }}</td>
                                
                                <td>
<?php 
        if($post['post_status'] == 0){
?>		             			
								Hiển thị
<?php 
        }
        else{
?>
                                Ẩn
<?php 
        }
?>                             
                                </td>
                        
                                <td>
                              		<a 	href="{{URL::to('/edit-post/'.$post['post_id'])  }}" 	class="active styling-edit" ui-toggle-class="">
                              		
                                		<i class="fa fa-pencil-square-o text-success text-active"></i></a>
                              
                              		<a 	onclick="return confirm('Bạn có chắc là muốn xóa bài viết này ko?')" 
                              			
                              			href="{{URL::to('/delete-post/'.$post['post_id'] )  }}" 	class="active styling-edit" ui-toggle-class="">
                                    	
                                    	<i class="fa fa-times text-danger text"></i></a>
                                </td>
                          	</tr>
                    	</form>
<?php 
    
        }
    }
?>
         
         
         						
                    </tbody>
              	</table>
            </div>
            
            
        
           	<footer class="panel-footer">
              	
              	<div class="row">
                
                    <div class="col-sm-10 text-center">
                        
                        <ul class="pagination">
                        
<?php 
       
    $previous_page      =    $current_page - 1;
    
    $next_page          =    $current_page + 1;
    
    if($current_page   >   1){

?>
							<li><a  href='?page_no=1					&&rowperpage=<?=$rowperpage?>'>First Page	</a></li>
																					
							<li>
								<a  href='?page_no=<?=$previous_page?>	&&rowperpage=<?=$rowperpage?>'> Previous  	</a></li>
<?php 
	}

	
    $total_no_of_pages  =   ceil($total_rows / $rowperpage);
    
    $second_last        =   $total_no_of_pages - 1;
    
    
/*     consolelog2('current page' , $current_page);
    consolelog2('total page'   , $total_no_of_pages); */
    
    
    if ($total_no_of_pages <= 10){
                
        for ($counter = 1 ; $counter <= $total_no_of_pages; $counter++){
        
            if ($counter == $current_page) {
             
                echo        "<li class='active'><a>$counter</a></li>";
            }
            else{
                
                echo        "<li><a href='?page_no=$counter&&rowperpage=$rowperpage'>$counter</a></li>";
            }
        }
    }       
    
    elseif ($total_no_of_pages > 10){       
      
        if($current_page <= 4) {
            
            for ($counter = 1; $counter < 8; $counter++){
                
                if ($counter == $current_page) {
                
                    echo "<li class='active'><a>$counter</a></li>";
                }
                else{
                    
                    echo "<li><a href='?page_no=$counter&&rowperpage=$rowperpage'>$counter</a></li>";
                }
            }
            
            echo "<li><a>...</a></li>";
            echo "<li><a href='?page_no=$second_last        &&rowperpage=$rowperpage'>  $second_last</a></li>";
            echo "<li><a href='?page_no=$total_no_of_pages  &&rowperpage=$rowperpage'>  $total_no_of_pages</a></li>";
        
        
        }
        
        else{
?>            
                			<li><a href='?page_no=1&&rowperpage=<?=$rowperpage?>'>1</a></li>
                            <li><a href='?page_no=2&&rowperpage=<?=$rowperpage?>'>2</a></li>
                            <li><a>...</a></li>
<?php 

            if($current_page > 4 && $current_page < $total_no_of_pages - 4) {
            
                $adjacents = 2;
                
                for (
                    $counter    =       $current_page   -   $adjacents;
                    $counter    <=      $current_page   +   $adjacents;
                    
                    $counter++
                    )
                {
                    
                    if ($counter == $current_page) {
                        
                        echo "<li class='active'><a>$counter</a></li>";
                        
                    }
                    else{
                        
                        echo "<li><a href='?page_no=$counter&&rowperpage=$rowperpage'>$counter</a></li>";
                        
                    }
                }
?>
                            <li><a>...</a></li>
                            
                            <li><a href='?page_no=<?=$second_last?>			&&rowperpage=<?=$rowperpage?>'> <?= $second_last       ?></a></li>
                            <li><a href='?page_no=<?=$total_no_of_pages?>	&&rowperpage=<?=$rowperpage?>'> <?= $total_no_of_pages ?></a></li>

<?php                 
            }
            else{
                
                for (
                    $counter    =      $total_no_of_pages - 4;
                    $counter    <=      $total_no_of_pages;
                    
                    $counter++
                    )
                {
                    if ($counter == $current_page) {
                        
                        echo "<li class='active'><a>$counter</a></li>";
                        
                    }
                    else{
                        
                        echo "<li><a href='?page_no=$counter&&rowperpage=$rowperpage'>$counter</a></li>";
                        
                    }
                    
                }
            
            }
?>            
            	

<?php             
            
?>            
            
<?php 
        }
        
        
        
    }  
    
    
    if($current_page < $total_no_of_pages){
?>
							<li><a href='?page_no=<?=$next_page?>			&&rowperpage=<?=$rowperpage?>' >	Next	</a></li> 
							
        					<li><a href="?page_no=<?=$total_no_of_pages ?>	&&rowperpage=<?=$rowperpage?>"> 	Last 	</a></li>
<?php 
    }  

   
?>
						</ul>






                        <form method="GET" action="" id="form">
            
                        @csrf
                            <div id="div_pagination">
              
                                <input type="hidden" name="row" 	 value="{{  $row }}">
                                <input type="hidden" name="allcount" value="{{  $total_rows }}">
              
              					<input type="hidden" name="rowperpage" value="{{  $rowperpage }}">
              					
                               
                
                                <div class="divnum_rows">
                	    
                	                <span class="paginationtextfield">Number of rows:</span>&nbsp;
                    	
                    	            <select id="num_rows" name="rowperpage">
<?php

    $numrows_arr    =    array("1" , "2" , "3" , "4" ,"5" , "10" , "15" , "25");
    
    foreach( $numrows_arr    as   $nrow ){
    
        if($nrow   ==   $rowperpage){
        
            echo '<option value="'.$nrow.'" selected>'   .$nrow.     '</option>';
        }
        else{
            
            echo '<option value="'.$nrow.'">'            .$nrow.     '</option>';
        }
    }
    
    
?>
                                	</select>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                    
                    <div class="col-sm-7 text-right text-center-xs">                
                      	<ul class="pagination pagination-sm m-t-none m-b-none">

                      	</ul>
                    </div>
              	</div>
            </footer> 
      	</div>
    </div>



    <script type="text/javascript">
    
        $(document).ready(function(){
    
            $("#num_rows").change(function(){
        
                $("#form").submit();

            });
        });
    </script>


@endsection