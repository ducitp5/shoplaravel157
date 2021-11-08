<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  \Illuminate\Support\Facades\Mail;
use App\CatePost;
use App\CategoryProductModel;
use App\Slider;
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;



session_start();


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){

        //seo
        $meta_desc          = "Chuyên bán những phụ kiện ,thiết bị game";
        $meta_keywords      = "thiet bi game,phu kien game,game phu kien,game giai tri";
        $meta_title         = "Phụ kiện,máy chơi game chính hãng";
        $url_canonical      = $request->url();
        //--seo


        return              view('pages.home')      ->with('meta_desc'      ,$meta_desc)
                                                    ->with('meta_keywords'  ,$meta_keywords)
                                                    ->with('meta_title'     ,$meta_title)
                                                    ->with('url_canonical'  ,$url_canonical)  ; //1


        // return view('pages.home')->with(compact('cate_product','brand_product','all_product')); //2
    }

    public function index2(Request $request){

        return              view('home');
    }

    public function autocomplete_ajax(Request $request){

        $data    =    $request->all();

        if($data['query']){

            $product        =        Product    ::where('product_status' ,   0)
                                                ->where('product_name'   , 'LIKE' ,'%'.$data['query'].'%')      ->get();

            $output         =       '<ul class="dropdown-menu" style="display:block; position:relative">' ;

            foreach($product as $key => $val){

                $output         .=      '<li class="li_search_ajax">

                                            <a href="#">'   .$val->product_name.    '</a>

                                         </li>';
            }

            $output         .=      '</ul>';


            echo        $output;
        }
    }




    public function search(Request $request){

        //seo
        $meta_desc          =    "Tìm kiếm sản phẩm";
        $meta_keywords      =    "Tìm kiếm sản phẩm";
        $meta_title         =    "Tìm kiếm sản phẩm";
        $url_canonical      =    $request->url();
        //--seo

        $keywords           =    $request->keywords_submit;

        $search_product     =    DB::table('tbl_product')   ->where( 'product_name' , 'like'  ,'%'.$keywords.'%' )      ->get();


        return          view('pages.sanpham.search')    ->with('search_product'     ,   $search_product)

                                                        ->with('meta_desc'          ,   $meta_desc)
                                                        ->with('meta_keywords'      ,   $meta_keywords)
                                                        ->with('meta_title'         ,   $meta_title)
                                                        ->with('url_canonical'      ,   $url_canonical);
    }


    public function error_page(){

        return view('errors.404');
    }


    public function send_mail(){
         //send mail

        $to_name    =    "duc tran Tutorial from HomeController";

        $to_email   =    "ducitp5@gmail.com";//send to this email


        $data       =    array( "name"      =>  "Mail từ tài khoản ",

                                "body"      =>  'Mail gửi về '); //body of mail.blade.php


        Mail    ::send('pages.send_mail'    ,

                        $data   ,

                        function($message) use ($to_name    ,   $to_email){

            $message    ->to($to_email)             ->subject('Test thử gửi mail google');       //send this mail with subject

            $message    ->from($to_email  ,  $to_name);                                          //send from this mail
        });

        return redirect('/mail')->with('message','gui mail ok rui');
        //--send mail
    }


    public function mail(){

        return      view('pages.send_mail')

                        ->with( "name"      ,  "duc it")
                        ->with( "body"      ,  'da gui song');

    }

}
