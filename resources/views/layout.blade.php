<?php

    use App\CatePost;


    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Session;




?>


<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" 		content="width=device-width, initial-scale=1.0">

    <!---------Seo--------->

    <meta name="description" 	content="{{$meta_desc}}">
    <meta name="keywords" 		content="{{$meta_keywords}}"/>

    <meta name="robots" 		content="INDEX,FOLLOW"/>

    <link  rel="canonical" 		href="{{$url_canonical}}" />

    <meta name="author" 		content="">

    <link  rel="icon" type="image/x-icon" href="" />


    <!--//-------Seo--------->


    <title>{{$meta_title}}</title>

	@include('include.css')





</head><!--/head-->

<body>


    @include('include.header')


<?php
/*
 echo  (app_path() ."<br>");
/*
echo  (__FILE__   ."<br>"  );

echo  (__DIR__   ."<br>"  );
 */

 //   include app_path().'\includeViews\slider.php';
?>

	{{--		@include('include.slider')								 --}}

	{{-- 		@component('demo.include.slider')    @endcomponent   	 --}}






    <section>
        <div class="container">

            <div class="row">

       <!--          <div class="col-sm-3"> -->

                @include('include.leftside')

     <!--            </div> -->

                <div class="col-sm-9 padding-right">

               		@yield('content')

                </div>
            </div>
        </div>
    </section>


    @include('include.footer')




  	@include('include.script')



</body>
</html>
