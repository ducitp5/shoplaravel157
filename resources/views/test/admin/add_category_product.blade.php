	
 	<link rel="stylesheet"  href="{{asset('public/backend/css/bootstrap.min.css')}}" >
    <link rel='stylesheet'  href="{{asset('public/backend/css/style.css')}}" 						type='text/css' /> 
  	 
  
  

	<div class="row">
    	
    	<div class="col-lg-12">
    	
            <section class="panel">
        
                <header class="panel-heading">
                
                   	Thêm danh mục sản phẩm
                </header>
                
<?php
    use App\CategoryProductModel;
    
    use Illuminate\Support\Facades\Session;

    $message    =    Session::get('message');

    if($message){
    
        echo '<span class="text-alert">'.$message.'</span>';
        
        Session::put('message'  ,   null);
    }
?>
                <div class="panel-body">

                    <div class="position-center">
                    
                        <form role="form" action="{{URL::to('/save-category-product')}}" method="post">
                        
                            {{ csrf_field() }}
                        
                            <div class="form-group">
                            
                                <label for="exampleInputEmail1">Tên danh mục</label>
                        
                                <input  type="text"  					class="form-control"  	onkeyup="ChangeToSlug();" 
                                		name="category_product_name"  	id="slug" 				placeholder="danh mục" >
                            </div>
                        
                        
                            <div class="form-group">
                        
                                <label for="exampleInputEmail1">Slug</label>
                                
                                <input 	type="text" 		name="slug_category_product" 		class="form-control" 
                                		id="convert_slug" 	placeholder="Tên danh mục">
                            </div>
                        
                        
                            <div class="form-group">
                        
                                <label for="exampleInputPassword1">Mô tả danh mục</label>
                        
                                <textarea 	style="resize: none" 			rows="8" 					class="form-control" 
                                
                                			name="category_product_desc"	id="exampleInputPassword1" 	placeholder="Mô tả danh mục"></textarea>
                            </div>
                        
                        
                            <div class="form-group">
                            
                                <label for="exampleInputPassword1">Từ khóa danh mục</label>
                            
                                <textarea style="resize: none" rows="8" class="form-control" name="category_product_keywords" id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea>
                            </div>
                            
                            
                            <div class="form-group">
                            
                                <label for="exampleInputPassword1">Thuộc danh mục</label>
               
                              	<select name="category_parent" class="form-control input-sm m-bot15">
        
                                	<option value="0">---Danh mục cha---</option>
<?php 

    $category       =        CategoryProductModel   ::where('category_parent'   ,   0)
    
                                                    ->orderBy('category_id'     ,   'DESC')     ->get();
    
    foreach($category as $key => $val){
?>
   
	
                                   	<option value="{{$val->category_id}}">{{$val->category_name}}</option>                                       	
<?php 
    }
?>                                   
                                </select>
                            </div>
                            
                            
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hiển thị</label>
                            
                              	<select name="category_product_status" class="form-control input-sm m-bot15">
                              	
                               		<option value="0">Hiển thị</option>
                               		
                                    <option value="1">Ẩn</option>                                        
                                </select>
                            </div>
                            
                           
                            <button type="submit" name="add_category_product" class="btn btn-info">Thêm danh mục</button>
                        </form>
                    </div>
                </div>
            </section>

	    </div>
    </div>
    
    
    
    
    
    
    <script type="text/javascript">
     
        function ChangeToSlug()
        {
            var slug;
         
            slug 	=	 document.getElementById("slug").value;
            slug 	=	 slug.toLowerCase();

           //Đổi ký tự có dấu thành không dấu
           
            slug 	=	 slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug 	=	 slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug 	=	 slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug 	=	 slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug 	=	 slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug 	=	 slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug 	=	 slug.replace(/đ/gi, 'd');
            
            //Xóa các ký tự đặt biệt
            
            slug 	=	 slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');

            //Đổi khoảng trắng thành ký tự gạch ngang
            
            slug 	=	 slug.replace(/ /gi, "-");

            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            
            slug 	=	 slug.replace(/\-\-\-\-\-/gi, '-');
            slug 	=	 slug.replace(/\-\-\-\-/gi, '-');
            slug 	=	 slug.replace(/\-\-\-/gi, '-');
            slug 	=	 slug.replace(/\-\-/gi, '-');

            //Xóa các ký tự gạch ngang ở đầu và cuối
            
            slug 	=	 '@' + slug + '@';
            slug 	=	 slug.replace(/\@\-|\-\@|\@/gi, '');

            //In slug ra textbox có id “slug”
            
            document.getElementById('convert_slug').value = slug;
        }
             
    </script>


	

 
