@extends('layout')

@section('content')


<?php

//    Session::put('cart'     ,   null);

 //   foreach($product_details as $key => $value){

    use Illuminate\Support\Facades\Session;

    $value      =       $product_details;

?>

		<div class="product-details"><!--product-details-->

<style type="text/css">

	.lSSlideOuter .lSPager.lSGallery img {

	    display    : block;
	    height     : 140px;
	    max-width  : 100%;
	}

	li.active {

        border: 2px solid #FE980F;
    }
</style>

            <nav aria-label="breadcrumb">

              	<ol class="breadcrumb"  style="background: none;">

                	<li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>

                	<li class="breadcrumb-item"><a href="{{url('/danh-muc/'.$cate_slug)}}">{{$product_cate}}</a></li>

                	<li class="breadcrumb-item active" aria-current="page">{{$meta_title}}</li>

              	</ol>
            </nav>



            <div class="col-sm-5">

            	<ul id="imageGallery">
<?php
        foreach($gallery as $key => $gal){
?>

        	  		<li data-thumb="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}" data-src="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}">

						<img width="100%" alt="{{$gal->gallery_name}}" 		src="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}" />

            	  	</li>
<?php
        }
?>
            	</ul>

            </div>



			<div class="col-sm-7">

				<div class="product-information"><!--/product-information-->

					{{-- <img src="images/product-details/new.jpg" class="newarrival" alt="" /> --}}

					<h2>{{$value->product_name}}</h2>

					<p>Mã ID: {{$value->product_id}}</p>

<!-- 					<img src="{{asset('public/images/product-details/rating.png')}}" alt="" /> -->


					<form {{-- action="{{URL::to('/save-cart')}}" --}} method="POST">		<!-- use url('/add-cart-ajax') by click .add-to-cart -->

						@csrf
						<input type="hidden" value="{{$value->product_id}}" 		class="cart_product_id_{{		$value->product_id}}">

                        <input type="hidden" value="{{$value->product_name}}" 		class="cart_product_name_{{		$value->product_id}}">

						<input type="hidden" value="{{$value->product_price}}" 		class="cart_product_price_{{	$value->product_id}}">

                        <input type="hidden" value="{{$value->product_image}}" 		class="cart_product_image_{{	$value->product_id}}">

                        <input type="hidden" value="{{$value->product_quantity}}" 	class="cart_product_quantity_{{	$value->product_id}}">



    					<span>

    						<span>{{number_format($value->product_price,0,',','.').'VNĐ'}}</span>

    						<label>Số lượng:</label>

    						<input name="cart_product_qty_get" type="number" min="1" class="cart_product_qty_get_{{$value->product_id}}"  value="1" />

    						<input name="productid_hidden" type="hidden"  value="{{$value->product_id}}" />

    					</span>

    					<input type="button" value="Thêm giỏ hàng" class="btn btn-primary btn-sm add-to-cart" data-id_product="{{$value->product_id}}" name="add-to-cart">

					</form>


					<p><b>Tình trạng:</b> 			Còn hàng</p>
					<p><b>Điều kiện:</b> 			Mơi 100%</p>

					<p><b>Số lượng kho còn:</b> 	{{$value->product_quantity}}</p>
					<p><b>Thương hiệu:</b> 			{{$value->brand_name}}</p>
					<p><b>Danh mục:</b> 			{{$value->category_name}}</p>


<style type="text/css">

	a.tags_style {

	    margin     : 3px 2px;
	    border     : 1px solid;

	    height     : auto;
	    background : #428bca;
	    color      : #FFF;
	    padding    : 0px;

	}
	a.tags_style:hover {
	    background: black;
	}
</style>
					<fieldset>

						<legend>Tags</legend>

						<p><i class="fa fa-tag"></i>
<?php
        $tags   =    $value ->product_tags;                                              // string       //  xxx , abc , xyz...

        $tags   =    explode(","    ,   $tags);                                          //   []         //  [xxx , abc , xyz ,... ]

/*         echo("<script>console.log('PHP: " .json_encode($tags) . "');</script>");


        foreach ($tags as $key => $val ){

            echo("<script>console.log('PHP: " .$key. " ===> " .$val. "');</script>");

        } */


        foreach($tags as $tag){                                                                                     //   $tag  = ab xy cz
?>
							<a href="{{url('/tag/'.str_slug($tag))}}" class="tags_style">{{	  $tag	}}</a>			<!-- tag/ab-xy-cz -->
<?php
        }
?>
						</p>

					</fieldset>

					<a href=""><img src="{{asset('public/images/product-details/share.png')}}" class="share img-responsive"  alt="share" /></a>

				</div><!--/product-information-->
			</div>

		</div><!--/product-details-->



		<div class="category-tab shop-details-tab"><!--category-tab-->


			<div class="col-sm-12">

				<ul class="nav nav-tabs">

					<li>				<a href="#details" 			data-toggle="tab">Mô tả</a></li>

					<li>				<a href="#companyprofile" 	data-toggle="tab">Chi tiết sản phẩm</a></li>

					<li class="active">	<a href="#reviews" 			data-toggle="tab">Đánh giá</a></li>
				</ul>
			</div>


			<div class="tab-content">

				<div class="tab-pane " id="details" >

					<p>{!!$value->product_desc!!}</p>

				</div>


				<div class="tab-pane fade" id="companyprofile" >

					<p>{!!$value->product_content!!}</p>

				</div>

				<div class="tab-pane fade active in" id="reviews" >

					<div class="col-sm-12">

						<ul>
							<li><a href=""><i class="fa fa-user">		</i>Admin</a></li>
							<li><a href=""><i class="fa fa-clock-o">	</i><?= date("h:i:sa") ?></a></li>
							<li><a href=""><i class="fa fa-calendar-o">	</i><?= date("d/m/Y")  ?></a></li>

							<li><a href=""><i class="fa fa-clock-o">	</i> <span id="timestamp"></span> </a></li>
						</ul>

<style type="text/css">

	.style_comment {

	    border         : 1px solid #ddd;
	    border-radius  : 10px;
	    background     : #F0F0E9;
	}
</style>

						<?php

    $note = '';

    if($rating == 0)        $note   =   '<span style="color:red"> product have not yet the rating </span>';
?>
						<p><b>Viết đánh giá của bạn   : {!! $note !!}</b></p>

						 <!------Rating here---------->

                        <ul class="list-inline "  title="Average Rating">
<?php

    for ($count = 1 ; $count <= 5 ; $count++){

        if($count <= $rating){            $color = 'color : red;';    }

        else                 {            $color = 'color : green;';    }
?>

                            <li title			="star_rating" 						id	  ="{{$value->product_id}}-{{$count}}"
                            	data-index		="{{ $count }}"   					class ="rating"
                            	data-product_id	="{{ $value->product_id}}"

                            	data-rating		="{{ $rating }}"      				style ="cursor:pointer; {{ $color }} font-size:30px; " >

                            	&#9733;
                        	</li>
<?php
    }
?>
						</ul>

						<form action="#">

							<span>
								<input style="width:100% ; margin-left: 0" 		type="text" 	class="comment_name" 	placeholder="Tên bình luận"/>
							</span>

							<textarea 	name="comment" 		class="comment_content" 	placeholder="Nội dung bình luận"></textarea>

							<div id = "notify_comment"></div>

							<button type="button" class="btn btn-default pull-right send-comment">
								Gửi bình luận
							</button>

						</form>

						<form>

						 	@csrf

							<input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$value->product_id}}">

						 	<div id="comment_show"></div>

						</form>

					</div>
				</div>

			</div>
		</div><!--/category-tab-->
<?php
 //   }

?>


    <div class="recommended_items"><!--recommended_items-->

    	<h2 class="title text-center">Sản phẩm liên quan</h2>

    	<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">

    		<div class="carousel-inner">

    			<div class="item active">
<?php

    foreach($relate as $key => $lienquan){
?>
    				<div class="col-sm-4">

    					<div class="product-image-wrapper">

    						 <div class="single-products">

                                <div class="productinfo text-center product-related">

                                	<a href="{{URL::to('/chi-tiet/'.$lienquan->product_slug)}}">

                                        <img src="{{URL::to('public/uploads/product/'.$lienquan->product_image)}}" alt="" />


                                        <h2>{{number_format($lienquan->product_price,0,',','.').' '.'VNĐ'}}</h2>

                                        <p>{{$lienquan->product_name}}</p>
                                 	</a>

                                </div>

                			</div>
    					</div>
    				</div>
<?php
    }
?>
    			</div>

    		</div>

    	</div>
    </div><!--/recommended_items-->




	<script type="text/javascript">

        function remove_background(product_id)
        {
          	for(var count = 1 ; count <= 5 ; count++)
          	{
           		$('#'+product_id+'-'+count).css('color' , '#ccc');		// gris leger
          	}
        }

        //hover chuột đánh giá sao

       	$(document).on('mouseenter', '.rating', function(){

            var index 			= $(this).data("index");
          	var product_id 		= $(this).data('product_id');

        	// alert(index);
        	// alert(product_id);

          	remove_background(product_id);

          	for(var count = 1; count <= index; count++)
          	{
           		$('#'+product_id+'-'+count).css('color' , '#ffcc00');		//yellow
          	}
        });


       	//nhả chuột ko đánh giá

       	$(document).on('mouseleave', '.rating', function(){

            var index 		= $(this).data("index");			//star numbered i
            var product_id 	= $(this).data('product_id');
            var rating 		= $(this).data("rating");

            remove_background(product_id);

            //alert(rating);

            for(var count = 1 ; count <= rating ; count++)
            {
            	$('#'+product_id+'-'+count).css('color', '#ffcc00');		//yellow
            }
        });


        //click đánh giá sao

        $(document).on('click' , '.rating' , function(){

            var index 			= $(this).data("index");
            var product_id 		= $(this).data('product_id');

            var _token 			= $('input[name="_token"]').val();

            console.log('this - ' , $(this));

            console.log('id rating - ' , $(this).data('product_id'));

            $.ajax({

                url			:	"{{url("insert-rating")}}",
                method		:	"POST",

                data		:	{	index		:	index, 			// count
                    				product_id	:	product_id,
                    				_token		:	_token
                				},

                success		:	function(data)
                {
	                if(data == 'done')
                	{

		                alert("Bạn đã đánh giá "+index +" trên 5");
        	        }
            	    else
                	{
		                alert("Lỗi đánh giá");
        	        }

        	        console.log('data rating ---- ' , data);
                }
    		});
        });


    </script>



<script>

    console.log(JSON.stringify(<?php echo json_encode(Session::get('cart')) ;?> , undefined, 4));  			// console              //      console

    function add_viewedlist(clicked_id){

    	 //       alert(+clicked_id);

        var id 			= clicked_id;

        var name 		= document.getElementsByClassName('cart_product_name_'	+id).value;
        var price 		= document.getElementsByClassName('cart_product_price_'	+id).value;
        var image 		= document.getElementsByClassName('cart_product_image_'	+id).value;
        var url 		= window.location.href;

        var newItem 	= {

            'url'	: url,
            'id' 	: id,
            'name'	: name,
            'price' : price,
            'image' : image
        }

//    			alert('2');
        console.log('newItem 		: '	 +newItem);
        console.log('newItem-JSON 	: '	 +JSON.stringify(newItem , null , 4));

        if(localStorage.getItem('data_viewed')  ==  null){

           	localStorage.setItem('data_viewed', '[]');

//    	           	alert('the 1st time like an item');
        }
        else{

//    	        	  alert('like multiple items');
        }



        var old_data 	=	 JSON.parse(localStorage.getItem('data_viewed'));

        console.log('getItem(data) : ' 		+localStorage.getItem('data_viewed'));
        console.log('old_data : '			+JSON.stringify(old_data , null , 4));



        var matches 	=	 $.grep(old_data  , function(obj){		// return array

            return 		obj.id == id;
        })

        console.log('matches : '		+JSON.stringify(matches , null , 4));

        if(matches.length){											// array.length

            alert('Sản phẩm bạn viewed,nên không thể thêm');

//    	            console.log('matches.length : '+matches.length);		//max 1


        }
        else{

        	alert('new item added to the viewed list');

            old_data.push(newItem);

        	$('#row_viewed').append(

           		'<div class="row" style="margin:10px 0">'
           			+'<div class="col-md-4">'

           				+'<img width="100%" src="'+newItem.image+'">'
       				+'</div>'

   					+'<div class="col-md-8 info_wishlist">'

   						+'<p>'+newItem.name+'</p>'

   						+'<p style="color:#FE980F">'+newItem.price+'</p>'

   						+'<a href="'+newItem.url+'">Đặt hàng</a>'
					+'</div>'
				+'</div>'
			);
        }

        localStorage.setItem('data_viewed', JSON.stringify(old_data));
	}

	try{
//		add_viewedlist(<?php //$value->product_id ?>);
	}
	catch(err){

		console.log("erreu 100 - " +err);
	}


</script>


    {{--   <ul class="pagination pagination-sm m-t-none m-b-none">
       {!!$relate->links()!!}
      </ul> --}}

@endsection
