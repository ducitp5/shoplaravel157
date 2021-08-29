	
 	<link rel="stylesheet"  href="{{asset('public/backend/css/bootstrap.min.css')}}" >
    <link rel='stylesheet'  href="{{asset('public/backend/css/style.css')}}" 						type='text/css' /> 
  	 
  	    
  	    
  	    
 	<div class="container">

    	<div class="col-lg-12">
            <section class="panel">
        
                <header class="panel-heading">
                   Thêm bài viết
                </header>
<?php
    use App\CatePost;
    use Illuminate\Support\Facades\Session;

    $cate_post      =    CatePost   ::orderBy('cate_post_id'  ,  'DESC')    ->get(); 
    
    $message        =    Session::get('message');

    if($message){
    
        echo '<span class="text-alert">'.$message.'</span>';
        
        Session::put('message',null);
    }
?>
                <div class="panel-body">

                    <div class="position-center">
                    
                        <form role="form" action="{{URL::to('/save-post')}}" method="post" enctype='multipart/form-data'>
                        
                            {{ csrf_field() }}
                            
                            <div class="form-group">
                            
                                <label for="exampleInputEmail1">Tên bài viết</label>
                                
                                <input 	type="text" 	name="post_title" 	class="form-control" 	id="slug" 
                                
                                		data-validation				="length" 						{{--  jquery.form-validator   --}}
                                		data-validation-length		="min10" 
                                		data-validation-error-msg	="Làm ơn điền ít nhất 10 ký tự" 
                                		
                                		onkeyup="ChangeToSlug();" 	placeholder="Tên danh mục">
                            </div>
                            
                            
                            <div class="form-group">
                            
                                <label for="exampleInputEmail1">Slug</label>
                                
                                <input 	type="text" 		name="post_slug" 	class="form-control" 
                                
                                		id="convert_slug" 	placeholder="Slug">
                            </div>
                            
                            <br>
                            
                            <div class="form-group">
                                
                                <label for="exampleInputPassword1">Tóm tắt bài viết</label>
                                                                <!-- get ckeditor by .ckeditor  -->
                                                                
                                <textarea 	style="resize: none" 	rows="8" class="form-control ckeditor" name="post_desc"
                                
                                			id="" 			placeholder="Mô tả danh mục 1">
                    			</textarea>
                            </div>
                                                        
                            <br>
                            
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nội dung bài viết</label>
                                
                                <textarea 	style="resize: none" rows="8" class="form-control ckeditor" name="post_content" 
                                
                                			id="" placeholder="Mô tả danh mục 2">
                    			</textarea>
                            </div>
                            
                            <br>
                            
                            <div class="form-group">
                                
                                <label for="exampleInputPassword1">Meta từ khóa</label>
                                
                                <textarea 	style="resize: none" rows="5" class="form-control" name="post_meta_keywords" 
                                
                                			id="exampleInputPassword1" placeholder="Mô tả danh mục 3">
                    			</textarea>
                            </div>
                            
                            <br>
                            
                            <div class="form-group">
                            
                                <label for="exampleInputPassword1">Meta nội dung</label>
                            
                                <textarea 	style="resize: none" 		rows="5" class="form-control ckeditor" name="post_meta_desc"
                                
                                			id="exampleInputPassword1" 	placeholder="Mô tả danh mục">
                    			</textarea>
                            </div>
                            
                            
                            <div class="form-group">
                            
                                <label for="exampleInputEmail1">Hình ảnh bài viết</label>
                            
                                <input type="file" name="post_image" class="form-control" id="exampleInputEmail1">
                            </div>
                            
                            
                            <div class="form-group">
                                <label for="exampleInputPassword1">Danh mục bài viết</label>
                                
                                <select name="cate_post_id" class="form-control input-sm m-bot15">
                                
    @foreach($cate_post as $key => $cate)
    
							        <option value="{{$cate->cate_post_id}}">{{$cate->cate_post_name}}</option>
    @endforeach
                                        
                                </select>
                            </div>
                            
                            
                            <div class="form-group">
                            	
                            	<label for="exampleInputPassword1">Hiển thị</label>
                                
                                <select name="post_status" class="form-control input-sm m-bot15">
                                
                                    <option value="0">Hiển thị</option>
                                    <option value="1">Ẩn</option>
                                        
                                </select>
                            </div>
                           
                            <button type="submit" name="add_category_product" class="btn btn-info">Thêm bài viết</button>
                        
                        </form>
                        
                    </div>
                </div>
            </section>

    	</div>
	
	</div>
	
	
	

<script type="text/javascript">


//	alert('hello');
	
    function ChangeToSlug()
    {
//        alert('hello');
        
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



    
    
     

	
	
	
	
<script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script> 
	    
<script  type="text/javascript">

        CKEDITOR.replace('ckeditor2',{
    
            filebrowserImageUploadUrl : "{{ url('uploads-ckeditor?_token='.csrf_token()) }}",
            filebrowserBrowseUrl : "{{ url('file-browser?_token='.csrf_token()) }}",
            filebrowserUploadMethod: 'form'
    
        });
            
        CKEDITOR.replace('.ckeditor');

</script>

	

<script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.form-validator.min.js')}}"></script>		<!--  require jquery -->


<script type="text/javascript">

    $.validate({    });
</script>
    
	
	
	
	
