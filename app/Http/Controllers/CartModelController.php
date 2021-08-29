<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;





session_start();




class CartModelController extends Controller
{
    
    //  CartController
    
    public function gio_hang(Request $request){
        
        $meta_desc          =    "Giỏ hàng của bạn";
        $meta_keywords      =    "Giỏ hàng Ajax";
        $meta_title         =    "Giỏ hàng Ajax";
        
        $url_canonical      =    $request->url();
        
        return      view('pages.cart.cart_ajax')
        
                            ->with('meta_desc'          ,   $meta_desc)
                            ->with('meta_keywords'      ,   $meta_keywords)
                            ->with('meta_title'         ,   $meta_title)
                            ->with('url_canonical'      ,   $url_canonical)
                    ;
    }
       
    
    public function add_cart_ajax(Request $request){
        
        // Session::forget('cart');
        
        $data           =        $request   ->all();
        
        
        $product        =        Product    ::where('product_id'   ,   $data['cart_product_id'])
        
                                            ->first();
        
        
        $session_id     =        substr(md5(microtime()),rand(0,26),5);
        
        $cart           =        Session::get('cart');
                
 //       echo("<script>console.log('jjson(cart): " .json_encode($cart) . "');</script>");
        
        if($cart    ==  true){
            
            $is_avaiable    =    false;
            
            foreach($cart as $key => $val){
                
                if($val['product_id']   ==  $data['cart_product_id']){
                    
                    $is_avaiable    =    true;
                }
            }
            
            if($is_avaiable == false){      // consol.log json
                
                $cart[]     =    array(
                    
                    'session_id'        => $session_id,
                    
                    'product_id'        => $data['cart_product_id'],
                    'product_name'      => $data['cart_product_name'],
                    'product_price'     => $data['cart_product_price'],
                    'product_image'     => $data['cart_product_image'],
                    
                    'product_slug'      => $product->product_slug,
                        
                    'product_qty'       => $data['cart_product_qty_get'],
                    'product_quantity'  => $data['cart_product_quantity'],
                );
                
                Session::put('cart'     ,   $cart); 
                
                Session::put('message'  ,   'product added success');
            }
        }
        
        else{
            
            $cart[]     =    array(
                
                'session_id'            => $session_id,
                
                'product_id'            => $data['cart_product_id'],
                'product_name'          => $data['cart_product_name'],
                'product_price'         => $data['cart_product_price'],                              
                'product_image'         => $data['cart_product_image'],
                
                'product_slug'          => $product->product_slug,
                
                'product_qty'           => $data['cart_product_qty_get'],  
                'product_quantity'      => $data['cart_product_quantity'],
            );
            
            Session::put('cart'     ,   $cart);
            
            Session::put('message'  ,   'the first buy success');
        }
        
 //       Session::save();
        
    }
    
    
    public function delete_product($session_id){
        
        $cart       =    Session::get('cart');
        
        
        if($cart    ==  true){
            
            foreach($cart as $key => $val){
            
                if($val['session_id']  ==  $session_id){
                
                    unset($cart[$key]);
                }
            }
            Session::put('cart'  ,  $cart);
        
            return redirect()->back()->with('message'   ,   'Xóa sản phẩm thành công');            
        }
        else{
            
            return redirect()->back()->with('message'   ,   'Xóa sản phẩm thất bại');
        }
        
    }
    
    
    public function update_cart(Request $request){
        
        $data       =    $request->all();
        
        $cart       =    Session::get('cart');
        
        
        if($cart == true){
            
            $message    =    '';
 
//                        cart_qty[]      $cart['session_id']

            foreach($data['cart_qty']   as   $key       =>       $qty){         // qty in cart from table
               
                $i      =    0;
                
//                      array         int                   array              
                
                foreach($cart   as   $session       =>      $val){                             // cart from session
                    
//                      session_id from session           qty input
            
                    if( $val['session_id'] == $key){
                        
                        if( $qty <= $cart[$session]['product_quantity']){
                            
                            $cart[$session]['product_qty']      =    $qty;
                            
                            $message    .='<p style="color:blue">'.$i.') Cập nhật số lượng :'.$cart[$session]['product_name'].' thành công</p>';
                        }
                        else {
                            
                            $message    .='<p style="color:red">'.$i.') Cập nhật số lượng :'.$cart[$session]['product_name'].' thất bại</p>';
                        }                      
                    }                   
                    
                    $i++;                    
                }                
            }
            
            Session::put('cart'   ,   $cart);
            
            return      redirect()->back()->with('message'  ,   $message);
        }
        else{
            
            return      redirect()->back()->with('message'  ,   'Cập nhật số lượng thất bại');
        }
    }
    
    
    
    public function check_coupon(Request $request){
        
        $data       =    $request->all();
        
        $coupon     =    Coupon::where('coupon_code'    ,   $data['coupon'])        ->first();
        
        if($coupon){
            
            $count_coupon       =    $coupon->count();
            
            if($count_coupon > 0){
            
                $coupon_session     =    Session::get('coupon');
                
                if($coupon_session  ==  true){
                    
                    $is_avaiable    =    0;
                    
                    if($is_avaiable  ==  0){
                        
                        $cou[]      =    array(
                            
                            'coupon_code'       => $coupon->coupon_code,
                            'coupon_condition'  => $coupon->coupon_condition,
                            'coupon_number'     => $coupon->coupon_number,
                            
                        );
                        Session::put('coupon' , $cou);
                    }
                }
                else{
                    
                    $cou[]      =    array(
                        
                        'coupon_code'           => $coupon->coupon_code,
                        'coupon_condition'      => $coupon->coupon_condition,
                        'coupon_number'         => $coupon->coupon_number,
                        
                    );
                    Session::put('coupon'   ,   $cou);
                }
                
                Session::save();
                
                return      redirect()  ->back()    ->with('message','Thêm mã giảm giá thành công');
            }
            
        }
        else{
        
            return          redirect()      ->back()
            
                                            ->with('error'    ,   'Mã giảm giá không đúng');
        }
    }
    
    
    
    public function delete_all_product(){
        
        $cart       =    Session::get('cart');
        
        if($cart==true){
            // Session::destroy();
            
            Session::forget('cart');
            Session::forget('coupon');
            
            return      redirect()      ->back()        ->with('message'    ,   'Xóa hết giỏ thành công');
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
/*     public function save_cart(Request $request){
        
        
        $productId                  =    $request->productid_hidden;
        
        $product_info               =    DB::table('tbl_product')
        
                                                ->where('product_id'    ,   $productId)     ->first();
        
        $data['sid']                =    session_id();
        $data['product_id']         =    $product_info->product_id;
        $data['product_name']       =    $product_info->product_name;
        $data['product_price']      =    $product_info->product_price;        
        $data['product_qty_get']    =    $request->qty;
        $data['product_image']      =    $product_info->product_image;
        
        
        DB::table('tbl_cart')       ->insert($data);        
        
        echo("<script>      console.log('PHP: CartModelController " .$data['product_id']. "');              </script>");
        
        return          Redirect::to('/show-cart');        
    } */
    
    
/*     public function show_cart(Request $request){
        //seo
        $meta_desc = "Giỏ hàng của bạn";
        $meta_keywords = "Giỏ hàng";
        $meta_title = "Giỏ hàng";
        $url_canonical = $request->url();
        //--seo
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        return view('pages.cart.show_cart')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }
     */
    
    
    
    
    
/*     
    
    
    
    
    
    
    
    

    
    
    
    
    
    
    
    
    
    
    public function delete_to_cart($rowId){
        Cart::update($rowId,0);
        return Redirect::to('/show-cart');
    }
    public function update_cart_quantity(Request $request){
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId,$qty);
        return Redirect::to('/show-cart');
    }
     */
}
