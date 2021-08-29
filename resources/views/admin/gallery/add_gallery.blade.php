@extends('admin_layout')


@section('admin_content')

	<div class="row">
    	<div class="col-lg-12">
            <section class="panel">
            
                <header class="panel-heading">
                   Thêm thư viện ảnh
                </header>
                
<?php
    use Illuminate\Support\Facades\Session;

    $message = Session::get('message');
    
    if($message){
    
        echo '<span class="text-alert">'.$message.'</span>';
        
        Session::put('message'   ,   null);
    }
?>
                <form action="{{url('/insert-gallery/'.$pro_id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-3" align="right">           </div>
                        
                        <div class="col-md-6">
                            <input type="file" class="form-control" id="file" name="file[]" accept="image/*" multiple>
                            
                            <span id="error_gallery"></span>
                        </div>
                        
                        <div class="col-md-3" >
                            <input type="submit" name="upload" name="taianh" value="Tải ảnh" class="btn btn-success ">
                        </div>
                        
                    </div>
                </form>
                
    
                <div class="panel-body">
                
                    <input type="hidden" value="{{$pro_id}}" name="pro_id" class="pro_id">
                    
                    <form>
                        
                        @csrf
                        
                        <div id="gallery_load">  keke                </div>
                        
                	</form>

                </div>
            </section>
		</div>
    </div>
    
    
    
    <script type="text/javascript">

        $(document).ready(function(){
    
        	try{
            	
        		 load_gallery();
        	}
    		catch(err){
    			
    			console.log('909 - : ' +err.message);
    		}

            
            function load_gallery(){
    
    //            console.log('load gallery');
                
                var pro_id 		= 	$('.pro_id').val();
                
                var _token 		= 	$('input[name="_token"]').val();
                
                // alert(pro_id);
                
                $.ajax({
    
                    url			:	"{{url('/select-gallery')}}",
                    
                    method		:	"POST",
                    
                    data		:	{	pro_id	:	pro_id,
                        				_token	:	_token
                    				},
    
                    success		:	function(data2){
                        
                        $('#gallery_load').html(data2);
                    }
                });
            }
        })

    
	</script>
    
@endsection