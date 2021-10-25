@extends('admin_layout')


@section('admin_content')

    <div class="table-agile-info">
        <div class="panel panel-default">

	        <div class="panel-heading">
          		Liệt kê bài viết
    	    </div>

				
        	<div class="table-responsive">
<?php

    
    use App\Post2;
    use Illuminate\Support\Facades\Session;
    use App\Lpl2;
    use app\DucClass\mySql\myModel;
    use shopbanhanglaravel\app\DucClass\mySql\myDB;

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
                        	
                            
<!--                             <th>Slug</th>
                            <th>Mô tả bài viết</th>                            
 -->                            
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

    $all_post       =    Post2   ::Sql_cate_post();
    
    
    
    // count total number of rows

    $total_rows     =    mysqli_num_rows($all_post);
    
    consolelog("83 co ${total_rows} ket qua");
    
    
    $row            =    0;
    
    // number of rows per page default
    
    $rowperpage     =    5;
    
    if(isset($_POST['num_rows'])){
    
        $rowperpage     =    $_POST['num_rows'];
    }
    
    
    // Previous Button
        
    if(isset($_POST['but_prev'])){
    
        $row    =    $_POST['row'];         // value="{{  $row }}"      first row in current page
        
        $row    -=   $rowperpage;
        
        
        if( $row < 0 ){            $row     =    0;       }
    }
    
    // Next Button
    if(isset($_POST['but_next'])){
        
        $row            =    $_POST['row'];        
                
        $val            =    $row + $rowperpage;
        
        $total_rows     =    $_POST['allcount'];        // = mysqli_num_rows($all_post);
        
        if( $val < $total_rows ){
            
            $row        =    $val;
        }
    }
    
    // selecting rows
    
    $result     =    Post2   ::Sql_cate_post3( $row , $rowperpage );
    
    $sno = $row + 1;






    
    if ( mysqli_num_rows($result) > 0 ) {

        while ($post = mysqli_fetch_array($result)){
?>	
	                   
                    	<form action="{{url('test/post-assign-lang')}}" method="POST">
                    	
                    		@csrf	
                    		<tr>
                    			
                			</tr>
                			
                			<tr>
                          		
                          		<td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                               
                                <td> <input type="hidden" name="post_id" value="{{  $post['post_id']  }}">	{{ $post['post_id'] }}	</td>
{{--                         		
                                <td><input type="text"    name="post_idd" 	value="{{ $post->getprikey() }}"></td>
--}}                           		

{{--                                
                                <td>{{ 	$post->post_slug }}</td>
                                
                                <td>{!! $post->post_desc !!}</td>
--}}                                
        
<?php 
        $all_lang       =    Lpl2   ::where('post_id'   ,   $post['post_id'])     ->pluck('lang_id')  ->toArray();  

        consolelog_json2('lp2 114' , $all_lang);
       
        consolelog(myModel::getSql(Lpl2   ::where('post_id'   ,   $post['post_id'])));
        
        consolelogpretty(Lpl2   ::where('post_id'   ,   $post['post_id']) ->get()   );
        consolelog('2233');
        
 //       consoletype( Lpl2   ::where('post_id'   ,   $post->post_id)  );
        consolelog('11111');
        
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
                
                    <div class="col-sm-5 text-center">
                        
                        <form method="post" action="" id="form">
            
                        @csrf
                            <div id="div_pagination">
              
                                <input type="hidden" name="row" 	 value="{{  $row }}">
                                <input type="hidden" name="allcount" value="{{  $total_rows }}">
              
                                <input type="submit" class="button" name="but_prev" <?php if($row < 1) echo 'disabled';?>  value="Previous">
                                <input type="submit" class="button" name="but_next" <?php if($row > $total_rows - $rowperpage) echo 'disabled';?> value="Next">
                
                                <!-- Number of rows -->
                
                                <div class="divnum_rows">
                	    
                	                <span class="paginationtextfield">Number of rows:</span>&nbsp;
                    	
                    	            <select id="num_rows" name="num_rows">
<?php

    $numrows_arr    =    array("5" , "10" , "15" , "25");
    
    foreach( $numrows_arr    as   $nrow ){
    
        if(isset($_POST['num_rows']) && $_POST['num_rows'] == $nrow){
        
            echo '<option value="'.$nrow.'" selected>'   .$nrow.     '</option>';
        }
        else{
            
            echo '<option value="'.$nrow.'">'                       .$nrow.     '</option>';
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