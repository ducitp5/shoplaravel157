
   
   
<script type="text/javascript">

    $('.btn-delete-document').click(function(){

        var product_id 		=	 $(this).data('document_id');

        var _token 			=	 $('input[name="_token"]').val();

        if(confirm('Do you want to delete this file ?')){
            
            $.ajax({
                
                url			:	"{{url('/delete-document')}}",
                
                method		:	"POST",
               
                data		:	{	_token		:	_token,
    
                    				product_id	:	product_id
                				},
                
                success		:	function(data)
                {
                    alert('Xóa file thành công');
                    
                    location.reload();
                }   
            });  
        }  
    });
</script>


   

<script type="text/javascript">
    
    var tables 		=	 document.getElementsByTagName('table');
    
    for (var i = 0 ; i < tables.length ; i++){

    	resizableGrid(tables[i]);
    }


	function resizableGrid(table) {
        
	 	var row 	=	 table.getElementsByTagName('tr')[0],

     		 cols 	=	 row 	?	 row.children 	 :	 undefined;
 		 

 		if (!cols) return;
 
 		table.style.overflow 		=	 'hidden';
 
 		var tableHeight 			=	 table.offsetHeight;
 

		for (var i = 0  ; i < cols.length ; i++){

	  		var div = createDiv(tableHeight);

	  	  	cols[i].appendChild(div);

	  	  	cols[i].style.position = 'relative';

	  	  	setListeners(div);
 		}


		function setListeners(div){

			var pageX,curCol,nxtCol,curColWidth,nxtColWidth;

  			div.addEventListener('mousedown' , function (e) {

    			curCol 			= e.target.parentElement;
    
    	   		nxtCol 			= curCol.nextElementSibling;
    
    	   	   	pageX 			= e.pageX; 
     

    	   	   	var padding 	= paddingDiff(curCol);
 

				curColWidth = curCol.offsetWidth - padding;

				
			   	if (nxtCol)		    nxtColWidth 	=	 nxtCol.offsetWidth - padding;
  			});


  		  	div.addEventListener('mouseover', function (e) {

	  	   		e.target.style.borderRight = '2px solid #0000ff';
  			})

  
  			div.addEventListener('mouseout', function (e) {

		   		e.target.style.borderRight = '';
  			})

  
  			document.addEventListener('mousemove', function (e) {

		   		if (curCol) {

		   			var diffX 		=	 e.pageX - pageX;

		   		    if (nxtCol)	     nxtCol.style.width 	=	 (nxtColWidth - (diffX))+'px';

    				curCol.style.width = (curColWidth + diffX)+'px';
   				}
			});


  		  	document.addEventListener('mouseup', function (e) {
  	  		  	 
                curCol 			=	 undefined;
                nxtCol 			=	 undefined;
                pageX 			=	 undefined;
                nxtColWidth 	=	 undefined;
                curColWidth 	=	 undefined
  			});
		}
 

	 	function createDiv(height){
		 	
            var div 				= document.createElement('div');
            div.style.top 			= 0;
            div.style.right 		= 0;
            div.style.width 		= '5px';
            div.style.position 		= 'absolute';
            div.style.cursor 		= 'col-resize';
            div.style.userSelect 	= 'none';
            div.style.height 		= height + 'px';

            return div;
 		}
 

	 	function paddingDiff(col){
 
  			if (getStyleVal(col , 'box-sizing')  ==  'border-box'){

  			   	return 0;
			}
 
            var padLeft 	=	 getStyleVal(col,'padding-left');
            var padRight 	=	 getStyleVal(col,'padding-right');

            return 			(parseInt(padLeft) + parseInt(padRight));
 		}


	 	function getStyleVal(elm,css){

  			return (window.getComputedStyle(elm, null).getPropertyValue(css))
 		}
	};


</script>


    
    <script type="text/javascript">
   
        $( function() {
            
			$( "#datepicker" ).datepicker({

 				format			: 'yyyy-mm-dd',
			 	calendarWeeks	: true,
                todayHighlight	: true,
                autoclose		: true 
    
/*               	prevText		:	"Tháng trước",
                nextText		:	"Tháng sau",
                dateFormat		:	"yy-mm-dd",
              
                dayNamesMin		:	[ "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật" ],
                
                duration		:	"slow"  */
            });
        
            
            $( "#datepicker2" ).datepicker({

            	format			: 'yyyy-mm-dd',
			 	calendarWeeks	: true,
                todayHighlight	: true,
                autoclose		: true 
                
/*             	prevText		:	"Tháng trước",
                nextText		:	"Tháng sau",
                dateFormat		:	"yy-mm-dd",
              
                dayNamesMin		:	[ "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật" ],
                
                duration		:	"slow"  */
            }); 
            
        });


      
    </script>
    
    
    
    
    
    <script type="text/javascript">
    
        $(document).ready(function(){
            
//								jquery-ui.min.js
            $('#category_order').sortable({
                
             	placeholder		: 'ui-state-highlight',

                update  		: function(event, ui)
                {
                    var page_id_array 		=	 new Array();
                    
                    var _token 				=	 $('input[name="_token"]').val();
    
                    $('#category_order tr').each(function(){
                        
                        page_id_array.push($(this).attr("id"));
                    });
                    
                    $.ajax({
                            url			:	"{{url('/arrange-category')}}",
                            method		:	"POST",
                            
                            data		:	{	page_id_array	:	page_id_array,
                                				_token			:	_token
                            				},
                            				
                            success		:	function(data)
                            {
                                alert(data);
                            }
                    });
    
              	} 
            });    
        });
    </script>
    
    
   
   
   
   	<script type="text/javascript">

    	$('.price_format').simpleMoneyFormat();

	</script>
   
   
   	




	

        
    
    
    
   
  
    

    
    
    
   
    
    
    
    
    
    
    
    
    
    
    <script type="text/javascript">
    
        $('.comment_duyet_btn').click(function(){
            
            var comment_status 		=	 $(this).data('comment_status');
    
            var comment_id 			=	 $(this).data('comment_id');
            
            var comment_product_id 	=	 $(this).attr('id');


            if(comment_status==0){
                
                var alert 	= 'Thay đổi thành duyệt thành công';
            }
            else{

                var alert 	= 'Thay đổi thành không duyệt thành công';
            }

            $.ajax({
                
                url			:	"{{url('/allow-comment')}}",
                method		:	"POST",

                headers		:	{
                    
                    'X-CSRF-TOKEN'		:	 $('meta[name="csrf-token"]').attr('content')
                },
                
                data		:	{	comment_status		:	comment_status,
                    				comment_id			:	comment_id,
                    				comment_product_id	:	comment_product_id
                				},
                				
                success		:	function(data){
                    
                    location.reload();

                   	$('#notify_comment').html('<span class="text text-alert">'+alert+'</span>');

                }
            });
    
    
        });

        
        $('.btn-reply-comment').click(function(){
            
            var comment_id 				=	 $(this).data('comment_id');
    
            var comment 				=	 $('.reply_comment_'+comment_id).val();
       
            var comment_product_id 		=	 $(this).data('product_id');
    
            
            // alert(comment);
            // alert(comment_id);
            // alert(comment_product_id);
            
            $.ajax({
                
                url			:	"{{url('/reply-comment')}}",
                method		:	"POST",
            
                headers		:	{
                    
                    'X-CSRF-TOKEN'	: $('meta[name="csrf-token"]').attr('content')
                },
                
                data		:	{	comment				:	comment,
                    				comment_id			:	comment_id,
                    				comment_product_id	:	comment_product_id
                				},

                success		:	function(data){

                	location.reload();
                	
                  	$('.reply_comment_'+comment_id).val('');

                   	$('#notify_comment').html('<span class="text text-alert">Trả lời bình luận thành công</span>');
            
                }
            });
    
    
        });
    </script>
    
    
    
    
    
       
    <script type="text/javascript">			/* add_delivery.blade.php */


    
        $(document).ready(function(){
    
  
            $('.choose').on('change',function(){
                
                var action 		=	 $(this).attr('id');
                var ma_id 		=	 $(this).val();
                var _token 		=	 $('input[name="_token"]').val();
                
                var result 		=	 '';
                
                // alert(action);
                //  alert(matp);
                //   alert(_token);
    
                if(action=='city'){       result 	= 'province';             }

                
                else{                     result 	= 'wards';                }

				$.ajax({
					
                    url 		:	 '{{url('/select-delivery')}}',
                    method		:	 'POST',
                    
                    data		:	{	action		:	action,
                        				ma_id		:	ma_id,
                        				_token		:	_token
                    				},
                    				
                    success		:	function(data){
                        
                       $('#'+result).html(data);     
                    }
                });
            });

            
            
            $(document).on('blur' , '.fee_feeship_edit',function(){
    
                var feeship_id 		= $(this).data('feeship_id');
                var fee_value 		= $(this).text();
                
				var _token 			= $('input[name="_token"]').val();

                // alert(feeship_id);
                // alert(fee_value);
                
                $.ajax({

                    url 		: 	'{{url('/update-delivery')}}',
                    method		: 	'POST',
                    
                    data		:	{
                        				feeship_id	:	feeship_id, 
                        				fee_value	:	fee_value, 
                        				
                        				_token		:	_token},
                        				
                    success		:	function(data){

                  		fetch_delivery();
                    }
                });
    
            });
            
            
            $('.add_delivery').click(function(){
    
               var city 		=	 $('.city').val();
               var province 	=	 $('.province').val();
               var wards 		=	 $('.wards').val();
               var fee_ship 	=	 $('.fee_ship').val();
               var _token 		=	 $('input[name="_token"]').val();
               // alert(city);
               // alert(province);
               // alert(wards);
               // alert(fee_ship);
               
                $.ajax({
                    
                    url 		: '{{url('/insert-delivery')}}',
                    method		: 'POST',
                    
                    data		: {		city		:	city, 
                        				province	:	province, 
                        				wards		:	wards, 
                        				fee_ship	:	fee_ship,
                        				
                        				_token		:	_token 
                    			  },
                    			  
                    success		:	function(data){
                        
                       fetch_delivery();
                    }
                });
    
    
            });
            
             
        })
    
    
    </script>
    
    
    
    
    
    
    

<script type="text/javascript">
 
    $('.order_details').change(function(){
        

		var order_status 	=	 $(this).val();
		
        var order_id 		=	 $(this).children(":selected").attr("id");
        
        var _token 			=	 $('input[name="_token"]').val();

        //lay ra so luong
        
        quantity 			=	 [];
        
        $("input[name='product_sales_quantity']").each(function(){

            quantity			.push($(this).val());
        });
        
        //lay ra product id
        
        order_product_id 	=	 [];
        
        $("input[name='order_product_id']").each(function(){

            order_product_id	.push($(this).val());
        });
        

        // examine that order_qty < Order_storage
        
        j 					=	 0;
        
        for(i = 0   ;  i < order_product_id.length   ;   i++){
            
            //so luong khach dat
            
            var order_qty 			=	 $('.order_qty_' 		 + order_product_id[i])		.val();

            //so luong ton kho
            
            var order_qty_storage 	=	 $('.order_qty_storage_' + order_product_id[i])		.val();

            
            if(parseInt(order_qty)  >  parseInt(order_qty_storage)){

                j = j + 1;

                if(j == 1){
                    
                    alert('Số lượng bán trong kho không đủ');
                }
                
                $('.color_qty_'+order_product_id[i]).css('background'  ,  '#000');
            }
        }

        
        if(j == 0){
          
            $.ajax({
                    url 		: 	'{{url('/update-order-qty')}}',
                    method		: 	'POST',
                    
                    data		:	{	_token				:	_token, 
                        
                        				order_status		:	order_status ,
                        				order_id			:	order_id ,
                        				
                        				order_product_id	:	order_product_id,		//	[]
                        				
                        				quantity			:	quantity				//	[]
                        				
                    				},
                    				
                    success		:	function(data){
                        
                        alert('Thay đổi tình trạng đơn hàng thành công');

                        location.reload();
                    }
            });            
        }
        

    });
</script>
    
    
    
    
    <script type="text/javascript">
    
        $('.update_quantity_order').click(function(){

        	var _token 				=	 $('input[name="_token"]').val();
        	
            var order_product_id 	=	 $(this).data('product_id');
            var order_qty 			=	 $('.order_qty_' +order_product_id).val();
            var order_code 			=	 $('.order_code').val();
                     
            // alert(order_product_id);
            // alert(order_qty);
            // alert(order_code);
            
            $.ajax({
                
                url 		: '{{url('/update-qty')}}',
    
                method		: 'POST',
    
                data		:	{	_token				:	_token, 
                    
                    				order_product_id	:	order_product_id ,
                    				order_qty			:	order_qty ,
                    				order_code			:	order_code
                				},
                				
                
                success		:	function(data){
    
                	alert('Cập nhật số lượng thành công');
                 
                   	location.reload(); 
                }
            });    
        });
            
    </script>
    
    
    
    
    <script  type="text/javascript">
           // Replace the <textarea id="editor1"> with a CKEditor
           // instance, using default configuration.
           




    </script>
    
    
    
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
    
     
    
    


    
    
    

    
    
    
<script type="text/javascript">

    $(document).ready(function(){

        
        $(document).on('click'  ,  '.btn-add-video'  ,  function(){
            
            var video_title  	=  $('.video_title') .val();
            var video_slug 	 	=  $('.video_slug')  .val();
           
            var video_link 		=  $('.video_link')  .val();
            var video_desc    	=  $('.video_desc')  .val();

            
            var form_data 		=  new FormData();

            form_data.append("file"			, 	document.getElementById("file_img_video").files[0]);

            form_data.append("video_title"	, 	video_title);
            form_data.append("video_slug"	,	video_slug);
           
            form_data.append("video_link"	,	video_link);
            form_data.append("video_desc"	,	video_desc);

            
            $.ajax({
                
                url			:	"{{url('/insert-video')}}",
                
                method		:	"POST",
                
                headers		:	{

                	'X-CSRF-TOKEN'		:	 $('meta[name="csrf-token"]').attr('content')
                },

                data		:	form_data,

                contentType	:	false,
                cache		:	false,
                processData	:	false,

                success		:	function(data){
                    
                    load_video();
                    
                    $('#notify').html('<span class="text text-success">'
            	                   			+'Đã thêm video thành công'
		                             +'</span>');
                }
            });
        });

        
        $(document).on('click'	,	'.btn-delete-video'	   ,	function(){


            var video_id 	 =	 $(this).data('video_id');

//            alert('id xoa - ' +video_id);
            
            if(confirm('Bạn muốn xóa video này không ? id -' +video_id)){
                
                $.ajax({
                    
                    url			:	"{{url('/delete-video')}}",
                    method		:	"POST",
                    
                    headers		:	{
                        
                        'X-CSRF-TOKEN'	:   $('meta[name="csrf-token"]').attr('content')
                    },
                    
                    data		:	{	video_id	:	video_id},
                    
                    success		:	function(data){

                        load_video();
                        
                        $('#notify').html('<span class="text text-success">Xóa video thành công</span>');
                    }
                });
            }


        });

        
        $(document).on('blur'	,	'.video_edit'	,	function(){
            
            var video_type 		=	 $(this).data('video_type');
            
            var video_id 		=	 $(this).data('video_id');
            //alert(video_type);
            
            if(video_type  ==  'video_title'){
                
                var video_edit 		=	 $('#'+video_type+'_'+video_id).text();
//                var video_check 	=	 video_type;
            }
            else if(video_type  ==  'video_desc'){
                
                var video_edit 		=	 $('#'+video_type+'_'+video_id).text();
//                var video_check 	=	 video_type;
            }
            else if(video_type  ==  'video_link'){
                
                var video_edit 		=	 $('#'+video_type+'_'+video_id).text();
//                var video_check 	=	 video_type;
            }
            else{
                var video_edit 		=	 $('#'+video_type+'_'+video_id).text();
//                var video_check 	=	 video_type;
            }

            var video_colum_name 	=	 video_type;

            
            $.ajax({
                
                url			:	"{{url('/update-direct-video')}}",
                method		:	"POST",
                
                headers		:	{
                    
                    'X-CSRF-TOKEN'	: $('meta[name="csrf-token"]').attr('content')
                },
                
                data		:	{	video_id		:	video_id,
				                    video_check		:	video_colum_name,
                    				video_edit		:	video_edit,
                    				
                				},
                				
                success		:	function(data){
                    
                    load_video();

                    $('#notify').html('<span class="text text-success">Cập nhật ' +video_colum_name+' video thành công</span>');
                }
            });

        });
        

        $(document).on('change'  ,  '.file_img_video'  ,  function(){

            var video_id 	=	 $(this).data('video_id');
            
            var image 		=	 document.getElementById("file-video-"+video_id).files[0];

            var form_data 	=	 new FormData();

            form_data.append(  "file"		,   document  .getElementById( "file-video-"+video_id)  .files[0]  );
            form_data.append(  "video_id"	,   video_id);
          
            $.ajax({
                
                url			:	"{{url('/update-video-image')}}",
                
                method		:	"POST",

                headers		:	{
                    
                    'X-CSRF-TOKEN'	 :   $('meta[name="csrf-token"]').attr('content')
                },
                
                data			:	form_data,

                contentType		:	false,
                cache			:	false,
                processData		:	false,

                success			:	function(data){
                    
                    load_video();

                    $('#notify').html('<span class="text text-success">Cập nhật hình ảnh video thành công</span>');
                }
            });            
        });
    });

</script>
    
    
    
    
    
    
    
    
    
    
    
    

    
    
    
    
   
    
<script type="text/javascript">

	try {

		$(document).ready( function () {

			try {

				console.log('1123 - keke');

		    	$('#myTable').DataTable();
			}
			catch(err) {

				console.log('1125 - ' +err.message);
			}
	    });
	    
//  		adddlert("Welcome guest!");
	}
	catch(err) {

		console.log('1133 - ' +err.message);
	}	
    
</script>
    
    
    <script type="text/javascript">
            $.validate({
                
            });
    </script>
    
    
    
	
    
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
    <!-- morris JavaScript -->	
    <script>

    
    	$(document).ready(function() {

        	try{
            	
        		//BOX BUTTON SHOW AND CLOSE
        	   jQuery('.small-graph-box').hover(function() {
        		  jQuery(this).find('.box-button').fadeIn('fast');
        	   }, function() {
        		  jQuery(this).find('.box-button').fadeOut('fast');
        	   });
        	   jQuery('.small-graph-box .box-close').click(function() {
        		  jQuery(this).closest('.small-graph-box').fadeOut(200);
        		  return false;
        	   });
        	   
        	    //CHARTS
        	    function gd(year, day, month) {
        			return new Date(year, month - 1, day).getTime();
        		}
        		
        		graphArea2 = Morris.Area({
        			element: 'hero-area',
        			padding: 10,
                behaveLikeLine: true,
                gridEnabled: false,
                gridLineColor: '#dddddd',
                axes: true,
                resize: true,
                smooth:true,
                pointSize: 0,
                lineWidth: 0,
                fillOpacity:0.85,
        			data: [
        				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
        				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
        				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
        				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
        				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
        				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
        				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
        				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
        				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
        			
        			],
        			lineColors:['#eb6f6f','#926383','#eb6f6f'],
        			xkey: 'period',
                    redraw: true,
                    ykeys: ['iphone', 'ipad', 'itouch'],
                    labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
        			pointSize: 2,
        			hideHover: 'auto',
        			resize: true
        		});
        	}
        	catch(err) {

      		  	console.log('erreur 923 - ' +err.message);
    		}
    	   
    	});
    	</script>
    <!-- calendar -->
    	<script type="text/javascript" src="{{asset('public/backend/js/monthly.js')}}"></script>
    	<script type="text/javascript">
    		$(window).load( function() {
    
    			$('#mycalendar').monthly({
    				mode: 'event',
    				
    			});
    
    			$('#mycalendar2').monthly({
    				mode: 'picker',
    				target: '#mytarget',
    				setWidth: '250px',
    				startHidden: true,
    				showTrigger: '#mytarget',
    				stylePast: true,
    				disablePast: true
    			});
    
    		switch(window.location.protocol) {
    		case 'http:':
    		case 'https:':
    		// running on a server, should be good.
    		break;
    		case 'file:':
    		alert('Just a heads-up, events will not work when run locally.');
    		}
    
    		});
    	</script>
    	<!-- //calendar -->
    	
    	
    	
    	
	<script type="text/javascript">
    
        $(document).ready(function(){

        	
            $(document).on('click'	,	'.delete-gallery'	,	function(){
                
                var gal_id 		=	 $(this).data('gal_id');
              
                var _token 		=	 $('input[name="_token"]').val();

                
                if(confirm('Bạn muốn xóa hình ảnh này không?')){
                    
                    $.ajax({
                        
                        url			:	"{{url('/delete-gallery')}}",

                        method		:	"POST",

                        data		:	{	gal_id	:	gal_id,
                            				_token	:	_token
                        				},

                        success		:	function(data){
                            
                            load_gallery();

                            $('#error_gallery').html('<span class="text-danger">Xóa hình ảnh thành công</span>');
                        }
                    });
                }
            });


            $('#file').change(function(){
                
                var error 	=	 '';
                var files 	=	 $('#file')[0].files;
    
                if(files.length  >  5){
                    
                    error	+=	'<p>Bạn chọn tối đa chỉ được 5 ảnh</p>';
                }
                else if(files.length==''){

                    error	+=	'<p>Bạn không được bỏ trống ảnh</p>';
                }
                else if(files.size > 2000000){

                        error+='<p>File ảnh không được lớn hơn 2MB</p>';
                }
    
                if(error==''){
    
                }
                else{

                    $('#file').val('');

                    $('#error_gallery').html('<span class="text-danger">'+error+'</span>');

                	return false;
                }    
            });
            

            $(document).on('change'  ,  '.file_image',function(){
                
                var gal_id 		=	 $(this).data('gal_id');
                
                var image 		=	 document	.getElementById("file-"+gal_id)
                								.files[0];
    
                var form_data 	=	 new FormData();		// https://viblo.asia/p/tim-hieu-ve-formdata-Az45bABwlxY
    
                form_data	.append("file" 		,   document.getElementById("file-"+gal_id).files[0]);

            	form_data	.append("gal_id"	,	gal_id);    
              
                    $.ajax({
                        
                        url			:	"{{url('/update-gallery')}}",
                        
                        method		:	"POST",

                        headers		:	{
                            
                            'X-CSRF-TOKEN'		: $('meta[name="csrf-token"]').attr('content')
                        },
                        
                        data		:	form_data,
    
                        contentType	:	false,
                        cache		:	false,
                        processData	:	false,
                        
                        success		:	function(data){
                            
                            load_gallery();

                            $('#error_gallery').html('<span class="text-danger">Cập nhật hình ảnh thành công</span>');
                        }
                    });
                
            });

            
            
    
            $(document).on('blur'	,	'.edit_gal_name',function(){
                
                var gal_id 		=	 $(this).data('gal_id');
                var gal_text 	=	 $(this).text();
                
                var _token 		=	 $('input[name="_token"]').val();

                $.ajax({
                    
                    url			:	"{{url('/update-gallery-name')}}",
                    
                    method		:	"POST",

                    data		:	{	gal_id		:	gal_id,
                        				gal_text	:	gal_text,
                        				_token		:	_token
                    				},

                    success		:	function(data){
                        
                        load_gallery();

                        $('#error_gallery').html('<span class="text-danger">Cập nhật tên hình ảnh thành công</span>');
                    }
                });
            });
                
        });
    </script>
    
    
    
    
 	<script type="text/javascript">
    
        $(document).ready( function () {

        	try {

				$('.myTable').DataTable();

//      		  	adddlert("Welcome guest!");

      		}
    		catch(err) {

      		  	console.log('erreur 20 - ' +err.message);
    		}
        });
    </script>
 
 
   
   	    
    <script type="text/javascript">
    
        $(document).ready( function () {

        	try {

				$('#myTable').DataTable();

//      		  	adddlert("Welcome guest!");

      		}
    		catch(err) {

      		  	console.log('erreur 592 - ' +err.message);
    		}
        });
    </script>
   	
    
    	
    	
    	