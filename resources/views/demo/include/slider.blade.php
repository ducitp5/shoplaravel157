<?php 
    
    use App\Slider;

    $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
?>

    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" 	rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" 	rel="stylesheet">    
    <link href="{{asset('public/frontend/css/main.css')}}" 				rel="stylesheet">

	
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>			<!-- require jqquery.js -->




   


	<section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                            <li data-target="#slider-carousel" data-slide-to="3"></li>
                        </ol>
                        <style type="text/css">
                            img.img.img-responsive.img-slider {
                                height: 350px;
                            }
                        </style>
                        <div class="carousel-inner">
<?php 
    $i = 0;

    foreach($slider as $key => $slide){
    
        $i++;
    
?>
                            <div class="item {{$i==1 ? 'active' : '' }}">
                                
                                <div class="col-sm-12">
                                    <img alt="{{$slide->slider_desc}}" src="{{asset('public/uploads/slider/'.$slide->slider_image)}}" height="200" width="100%" class="img img-responsive img-slider">
                                   
                                </div>
                            </div>
<?php 
    }
?> 
                        </div>
                        
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </section><!--/slider-->
    
    
    
    
     



    