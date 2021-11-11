<?php

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Frontend




Route::get('/'                      ,   'HomeController@index' );
Route::get('/trang-chu'             ,   'HomeController@index')->name('trang-chu');
Route::get('/404'                   ,   'HomeController@error_page');
Route::post('/tim-kiem'             ,   'HomeController@search');
Route::post('/autocomplete-ajax'    ,   'HomeController@autocomplete_ajax');



//Lien he trang

Route::get('/lien-he'                   ,   'ContactController@lien_he' );

Route::get('/information'               ,   'ContactController@information' );

Route::post('/update-info/{info_id}'    ,   'ContactController@update_info' );

Route::post('/save-info','ContactController@save_info' );




//Danh muc san pham trang chu

Route::get('/danh-muc/{slug_category_product}'          ,       'CategoryProduct@show_category_home');

Route::get('/thuong-hieu/{brand_slug}','BrandProduct@show_brand_home');

Route::get('/chi-tiet/{product_slug}'                   ,       'ProductController@details_product');

Route::post('/load-comment'                             ,       'ProductController@load_comment');

Route::post('/send-comment'                             ,       'ProductController@send_comment');

Route::get('/tag/{product_tag}'                         ,       'ProductController@tag');

Route::get('/comment'                                   ,       'ProductController@list_comment');

Route::post('/allow-comment'                            ,       'ProductController@allow_comment');

Route::post('/reply-comment'                            ,       'ProductController@reply_comment');




Route::post('/quickview'            ,   'ProductController@quickview');

Route::post('/insert-rating'        ,   'ProductController@insert_rating');

Route::post('/uploads-ckeditor','ProductController@ckeditor_image');
Route::get('/file-browser','ProductController@file_browser');


//Product


Route::get('/all-product'                       ,   'ProductController@all_product');

Route::get('/unactive-product/{product_id}'     ,   'ProductController@unactive_product');

Route::get('/active-product/{product_id}'       ,   'ProductController@active_product');

Route::post('/update-product/{product_id}'      ,   'ProductController@update_product');

Route::get('/delete-product/{product_id}'       ,   'ProductController@delete_product');


Route::post('/save-product'                     ,   'ProductController@save_product');

Route::post('/delete-document'                  ,   'ProductController@delete_document');

//     'auth.roles'   =>   \App\Http\Middleware\AccessPermission::class,

Route::group(['middleware'      =>   'auth.roles'], function () {

    Route::get('/add-product'                  ,   'ProductController@add_product');

    Route::get('/edit-product/{product_id}'    ,   'ProductController@edit_product');
});




//Bai viet





//Backend

Route::get('/session'               ,       'AdminController@session');

Route::get('/admin'                 ,       'AdminController@index');
Route::post('/admin-dashboard'      ,       'AdminController@dashboard');

Route::get('/dashboard'             ,       'AdminController@show_dashboard')   ->middleware('ducauth');

Route::post('/days-order'           ,       'AdminController@days_order');
Route::post('/days-order-demo'      ,       'AdminController@days_order_demo');

Route::post('/filter-by-date'       ,       'AdminController@filter_by_date');
Route::post('/dashboard-filter'     ,       'AdminController@dashboard_filter');

Route::get('/logout','AdminController@logout');         //dont use , we use logout-auth




//Category Product

Route::post('/product-tabs'                                     ,       'CategoryProduct@product_tabs');

Route::get('/all-category-product'                              ,       'CategoryProduct@all_category_product');

Route::get('/add-category-product'                              ,       'CategoryProduct@add_category_product');
Route::post('/save-category-product'                            ,       'CategoryProduct@save_category_product');



Route::get('/edit-category-product/{category_product_id}'       ,       'CategoryProduct@edit_category_product');
Route::post('/update-category-product/{category_product_id}'    ,       'CategoryProduct@update_category_product');


Route::get('/delete-category-product/{category_product_id}'     ,       'CategoryProduct@delete_category_product');

Route::post('/export-csv'                                       ,       'CategoryProduct@export_csv');
Route::post('/import-csv'                                       ,       'CategoryProduct@import_csv');

Route::post('/arrange-category'                                 ,       'CategoryProduct@arrange_category');

Route::get('/unactive-category-product/{category_product_id}'   ,       'CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_product_id}'     ,       'CategoryProduct@active_category_product');





//Send Mail

Route::get('/send-mail'             ,   'HomeController@send_mail');


Route::get('/mail'                  ,   'HomeController@mail');


//Login facebook
Route::get('/login-facebook','AdminController@login_facebook');
Route::get('/admin/callback','AdminController@callback_facebook');

//Login google
Route::get('/login-google','AdminController@login_google');
Route::get('/google/callback','AdminController@callback_google');





//Brand Product



Route::get('/all-brand-product'                         ,   'BrandProduct@all_brand_product');


Route::get('/add-brand-product','BrandProduct@add_brand_product');
Route::get('/edit-brand-product/{brand_product_id}','BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}','BrandProduct@delete_brand_product');


Route::get('/unactive-brand-product/{brand_product_id}','BrandProduct@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}','BrandProduct@active_brand_product');

Route::post('/save-brand-product'                       ,   'BrandProduct@save_brand_product');

Route::post('/update-brand-product/{brand_product_id}','BrandProduct@update_brand_product');



//Category Post



Route::get('/all-category-post'                         ,   'CategoryPost@all_category_post');
//Route::get('/danh-muc-bai-viet/{cate_post_slug}'        ,   'CategoryPost@danh_muc_bai_viet');

Route::get('/edit-category-post/{category_post_id}'     ,   'CategoryPost@edit_category_post');

Route::post('/update-category-post/{cate_id}'           ,   'CategoryPost@update_category_post');

Route::get('/add-category-post'                         ,   'CategoryPost@add_category_post');

Route::post('/save-category-post'                       ,   'CategoryPost@save_category_post');

Route::get('/delete-category-post/{cate_id}'            ,   'CategoryPost@delete_category_post');




//POst


Route::get('/danh-muc-bai-viet/{post_slug}'     ,       'PostController@danh_muc_bai_viet');
Route::get('/bai-viet/{post_slug}'              ,       'PostController@bai_viet');

Route::get('/all-post'                          ,       'PostController@all_post');

Route::get('/add-post'                          ,       'PostController@add_post');



Route::get('/delete-post/{post_id}','PostController@delete_post');
Route::get('/edit-post/{post_id}','PostController@edit_post');
Route::post('/save-post','PostController@save_post');
Route::post('/update-post/{post_id}','PostController@update_post');








// User



Route::get('users'                          ,   'UserController@index')                 ->middleware('auth.roles');

Route::get('delete-user-roles/{admin_id}'   ,   'UserController@delete_user_roles')     ->middleware('auth.roles');

Route::post('assign-roles'                  ,   'UserController@assign_roles')          ->middleware('auth.roles');

Route::get('impersonate/{admin_id}'         ,   'UserController@impersonate');

Route::get('add-users'                      ,   'UserController@add_users')             ->middleware('auth.roles');

Route::post('store-users'                   ,   'UserController@store_users');


Route::get('impersonate-destroy','UserController@impersonate_destroy');




//Coupon


Route::get('/list-coupon'               ,   'CouponController@list_coupon');

Route::get('/insert-coupon'             ,   'CouponController@insert_coupon');



Route::post('/check-coupon'             ,   'CartModelController@check_coupon');

Route::get('/unset-coupon'              ,   'CouponController@unset_coupon');

Route::get('/delete-coupon/{coupon_id}','CouponController@delete_coupon');

Route::post('/insert-coupon-code','CouponController@insert_coupon_code');




//Cart


Route::get('/gio-hang'                  ,       'CartModelController@gio_hang');

Route::post('/add-cart-ajax'            ,       'CartModelController@add_cart_ajax');

Route::get('/del-product/{session_id}'  ,       'CartModelController@delete_product');

Route::post('/update-cart'              ,       'CartModelController@update_cart');


//Route::post('/save-cart'            ,       'CartModelController@save_cart');

//Route::get('/show-cart'                 ,       'CartModelController@show_cart');


Route::get('/del-all-product'           ,       'CartModelController@delete_all_product');


Route::get('/delete-to-cart/{rowId}','CartController@delete_to_cart');




Route::post('/update-cart-quantity','CartController@update_cart_quantity');




//Checkout


Route::get('/dang-nhap'                 ,   'CheckoutController@login');
Route::post('/add-customer'             ,   'CheckoutController@add_customer');
Route::get('/checkout'                  ,   'CheckoutController@checkout');

Route::post('/login-customer'           ,   'CheckoutController@login_customer');

Route::get('/logout-checkout'           ,   'CheckoutController@logout_checkout');

Route::post('/confirm-order'            ,   'CheckoutController@confirm_order');

Route::post('/select-delivery-home'     ,   'CheckoutController@select_delivery_home');

Route::post('/calculate-fee'            ,   'CheckoutController@calculate_fee');

Route::get('/del-fee'                   ,   'CheckoutController@del_fee');

Route::get('/payment'   ,   'CheckoutController@payment');


Route::post('/order-place','CheckoutController@order_place');




Route::post('/save-checkout-customer','CheckoutController@save_checkout_customer');




//Order


Route::get('/manage-order'                  ,   'OrderController@manage_order');

Route::get('/view-order/{order_code}'       ,   'OrderController@view_order');

Route::post('/update-qty'                   ,   'OrderController@update_qty');

Route::post('/update-order-qty'             ,   'OrderController@update_order_qty');

Route::get('/print-order/{checkout_code}'   ,   'OrderController@print_order');


Route::get('/delete-order/{order_code}'     ,   'OrderController@delete_order');





//Delivery


Route::get('/delivery'                      ,   'DeliveryController@delivery');

Route::post('/select-feeship'               ,   'DeliveryController@select_feeship');

Route::post('/select-delivery'              ,   'DeliveryController@select_delivery');



Route::post('/insert-delivery'              ,   'DeliveryController@insert_delivery');

Route::post('/update-delivery'              ,   'DeliveryController@update_delivery');



//Banner
Route::get('/manage-slider'                 ,   'SliderController@manage_slider');

Route::get('/add-slider','SliderController@add_slider');
Route::get('/delete-slide/{slide_id}','SliderController@delete_slide');
Route::post('/insert-slider','SliderController@insert_slider');
Route::get('/unactive-slide/{slide_id}','SliderController@unactive_slide');
Route::get('/active-slide/{slide_id}','SliderController@active_slide');





//Authentication roles

Route::get('/logout-auth'           ,   'AuthController@logout_auth');

Route::get('/login-auth'            ,   'AuthController@login_auth');
Route::post('/login'                ,   'AuthController@login');


Route::get('/register-auth'         ,   'AuthController@register_auth');



Route::post('/register'             ,   'AuthController@register');


//Duc Authetication

Route::get('/duc-login-auth'        ,   'DucAuthController@login_auth');
Route::post('/duc-login'            ,   'DucAuthController@login');


//Gallery


Route::get('add-gallery/{product_id}'   ,   'GalleryController@add_gallery');
Route::post('insert-gallery/{pro_id}'   ,   'GalleryController@insert_gallery');

Route::post('select-gallery'            ,   'GalleryController@select_gallery');

Route::post('update-gallery-name'       ,   'GalleryController@update_gallery_name');
Route::post('delete-gallery'            ,   'GalleryController@delete_gallery');
Route::post('update-gallery'            ,   'GalleryController@update_gallery');



//Video

Route::get('video-shop'             ,       'VideoController@video_shop');
Route::post('watch-video'           ,       'VideoController@watch_video');

Route::get('add-video'              ,       'VideoController@add_video');
Route::get('list-video'             ,       'VideoController@list_video');

Route::get('edit-video/'            ,       'VideoController@edit_videoo');
Route::get('edit-video/{id}'        ,       'VideoController@edit_video');


Route::post('update-video'          ,       'VideoController@update_video');
Route::post('update-direct-video'   ,       'VideoController@update_direct_video');


Route::get('select-video'           ,       'VideoController@select_video');
Route::get('select-video2'          ,       'VideoController@select_video2');

Route::post('insert-video'          ,       'VideoController@insert_video');

Route::get('delete-video/{id}'      ,       'VideoController@delete_video_get');

Route::post('delete-video'          ,       'VideoController@delete_video');
Route::post('update-video-image','VideoController@update_video_image');





// Include


Route::get('include/leftside'        ,   'IncludeController@leftside' );
Route::get('include/header'          ,   'IncludeController@header' );
Route::get('include/slider'          ,   'IncludeController@slider' );

Route::get('admin/include/header'    ,   'IncludeController@adminheader' );
Route::get('admin/include/aside'     ,   'IncludeController@adminaside' );




// Demo

Route::get('/demo'                  ,   'DemoController@index' );

Route::get('/demo/home'             ,   'DemoController@home' );

Route::get('slider'                 ,   'DemoController@slider' );




//Document


Route::get('upload_file','DocumentController@upload_file');
Route::get('upload_image','DocumentController@upload_image');
Route::get('upload_video','DocumentController@upload_video');
Route::get('download_document/{path}/{name}','DocumentController@download_document');
Route::get('create_document','DocumentController@create_document');

Route::get('delete_document/{path}','DocumentController@delete_document');

//Folder
Route::get('create_folder','DocumentController@create_folder');
Route::get('rename_folder','DocumentController@rename_folder');
Route::get('delete_folder','DocumentController@delete_folder');

Route::get('list_document','DocumentController@list_document');
Route::get('read_data','DocumentController@read_data');









// Test


Route::post('test/post-assign-lang'         ,   'TestController@post_assign_lang' );

Route::get('test/list-post'                 ,   'TestController@list_post' );
Route::get('test/list-post-2'               ,   'TestController@list_post_2' );
Route::get('test/list-post-3'               ,   'TestController@list_post_3' );

Route::get('test/list-post-4'               ,   'TestController@list_post_4' );

Route::get('test/list-post-5'               ,   'TestController@list_post_5' );
Route::post('test/list-post-5'               ,   'TestController@list_post_5' );

Route::get('test/list-post-6'               ,   'TestController@list_post_6' );
Route::post('test/list-post-6'               ,   'TestController@list_post_6' );

Route::get('test/list-post-7'               ,   'TestController@list_post_7' );

Route::get('test/suggestion'                ,   'TestController@suggestion' );

Route::get('test/video-shop'                ,   'TestController@video' );
Route::post('test/watch-video'              ,   'TestController@watch_video' );

Route::get('test/session-cart'              ,   'TestController@session_cart' );
Route::post('test/session-cart'             ,   'TestController@session_cart' );

Route::get('test/session-cart-2'              ,   'TestController@session_cart_2' );
Route::post('test/session-cart-2'             ,   'TestController@session_cart_2' );

Route::get('test/refresh-cart  '              ,   'TestController@refresh_cart' );


Route::get('test/details-products'          ,   'TestController@detail_products' );
Route::get('test/details-products_1'        ,   'TestController@detail_products_1' );
Route::get('test/details-products_2'        ,   'TestController@detail_products_2' );


Route::get('test/include/header'            ,   'TestController@header' );
Route::get('test/include/leftside'          ,   'TestController@leftside' );
Route::get('test/include/slider'            ,   'TestController@slider' );


Route::get('test/admin/information'         ,   'TestController@information' );

Route::get('test/admin/include/header'          ,   'TestController@adminheader' );
Route::get('test/admin/include/aside'           ,   'TestController@adminaside' );

Route::get('test/admin/addcategoryproduct'      ,   'TestController@add_category_product' );
Route::get('test/admin/all-category-product'    ,   'TestController@all_category_product' );

Route::get('test/admin/add-post'                ,   'TestController@add_post' );



Route::get('test/array/cart'              ,   'TestController@array_cart' );

Route::get('test/timestamp'               ,   'TestController@timestamp' );

Route::get('test/send-mail-view'          ,   'TestController@send_mail_view' );

Route::post('test/send-mail'              ,   'TestController@send_mail' );


Route::get('test/export-excel-view'       ,   'TestController@export_excel_view' );

Route::post('test/export-excel'           ,   'TestController@export_excel' );


Route::get('test/export-excel-view2'       ,   'TestController@export_excel_view2' );

Route::post('test/export-excel2'           ,   'TestController@export_excel2' );


Route::get('test/post2_lpl2'                ,   'TestController@post2_lpl2' );

Route::get('test/lpl2_post2'                ,   'TestController@lpl2_post2' );

Route::get('test/lpl2_lang2'                ,   'TestController@lpl2_lang2' );

Route::get('test/lang2_lpl2'                ,   'TestController@lang2_lpl2' );

Route::get('test/post2'                     ,   'TestController@post2' );

Route::get('test/Auth_loyal/login'          ,   'AuthLoyalController@getLogin' );
Route::post('test/Auth_loyal/postLogin'     ,   'AuthLoyalController@postLogin' );


use Illuminate\Support\Facades\DB;

Route::get('/testsqllog', function () {
    $user = DB::transaction(function () {
        $user = factory(User::class)->create();
        $user->name = 'change name';
        $user->save();
        $user->delete();

        return factory(User::class)->create();
    });

        User::find($user->id);

        return view('welcome');
});



Auth::routes();

Route::get('/home', 'HomeController@index2')->name('home');
