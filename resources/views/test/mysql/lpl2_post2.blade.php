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

//    dd(Post2    ::get());       // return Illuminate\Database\Eloquent\Collection(App\Post2)
    
//    dd(Post2    ::with('cate_post')   );           // retrun Illuminate\Database\Eloquent\Builder
//    dd(Post2    ::with('cate_post')->get());       // return Illuminate\Database\Eloquent\Collection(App\Post2)
    
    echo        '<hr>';
    
//    echo_prepvardump( Post2   ::Sql_cate_post());
    
//    echo_prepvardump( Post2   ::Sql_cate_post()->fetch_all(MYSQLI_ASSOC));        // return array
    
    $result     =    Post2   ::Sql_cate_post();
     
    
    if ( mysqli_num_rows($result) > 0 ) {

        $ini  =   0;
        
        while ( ($post = mysqli_fetch_array($result)) && ($ini < 1) ){
            
            $ini++;
?>		                   
                    	<form action="{{url('test/post-assign-lang')}}" method="POST">
                    	
                    		@csrf	
                			
                			<tr>
                          		
                          		<td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                               
                                <td> <input type="hidden" name="post_id" value="{{  $post['post_id']  }}">	{{ $post['post_id'] }}	</td>      
<?php 

            $all_lang       =    Lpl2   ::where('post_id'   ,   $post['post_id'])     ->pluck('lang_id')  ->toArray();
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

            //           dd(Lpl2   ::where('post_id'   ,   $post['post_id'])     ->pluck('lang_id')    );
            //           dd(Lpl2   ::where('post_id'   ,   $post['post_id'])     ->pluck('lang_id')  ->toArray());
            
           
            
            consolelog_json2('lp2 114' , $all_lang);
            
            consolelog(myModel::getSql( Lpl2   ::where('post_id'   ,   $post['post_id'])));
            
            consolelogpretty(           Lpl2   ::where('post_id'   ,   $post['post_id']) ->get()   );
            
            consolelog('11111');
            
            //            consolelogpretty(   Lpl2   ::where('post_id'   ,   $post['post_id']) ->with('postIn') ->get()   );
            
            dd( Lpl2   ::where('post_id'   ,   $post['post_id']) ->with('post') ->get());
            
        }
    }
?>
         
         
         						
                    </tbody>
              	</table>
            </div>
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