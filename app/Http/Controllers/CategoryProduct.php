<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Slider;
use App\Exports\ExcelExports;
use App\Imports\ExcelImports;
//use Excel;
// use CategoryProductModel;
use App\CategoryProductModel;
use App\CatePost;
use App\Product;

//use Auth;
use App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

session_start();

class CategoryProduct extends Controller
{
 
    
    public function product_tabs(Request $request){
        
        $data               =    $request->all();
        
        $output             =    '';
        
        $product            =    Product    ::where('category_id'   ,   $data['cate_id'])
        
                                            ->orderBy('product_id'  ,   'DESC')                 ->get();
        
        $product_count      =    $product   ->count();
        
        if($product_count > 0){
            
            $output         =    '<div class="tab-content">';
            
            foreach($product as $key => $pro){
                
                $output     .=      '<div class="tab-pane fade active in" id="t-shirt" >
          
                                        <div class="col-sm-3">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">

                                                        <h8>id : ' .$pro->product_id .'</h8>

                                                        <a href="'.url('/chi-tiet/'.$pro->product_slug).'" class="btn btn-default add-to-cart">

                                                            <img src="'.url('public/uploads/product/'.$pro->product_image).'" alt="'.$pro->product_name.'" />
    
                                                            <h2>'.number_format($pro->product_price,0,',','.').'</h2>
    
                                                            <p>'.$pro->product_name.'</p>

                                                            <i class="fa fa-shopping-cart"></i>Chi tiết
                                                        </a>

                                                    </div>                                                            
                                                </div>
                                            </div>
                                        </div> 
                                    </div>';
            }
        }
        
        else{
            
                $output     .=      '
                                    <div class="tab-pane fade active in" id="t-shirt" >
                                        <div class="col-sm-12">
                                            Chưa có sản phẩm thuộc danh mục '.$data['cate_id'].'
                                        </div>
                                    </div>';
        }
        $output     .=          '</div>';
        
        echo        $output;       
    }
    
    
    
        
    public function show_category_home(Request $request     ,   $slug_category_product){
        
        
        $category           =    DB::table('tbl_category_product')
        
                                    ->where('tbl_category_product.slug_category_product'    ,   $slug_category_product)
        
                                    ->first();              //return 1 objet
        
                                //limit(1)->get();            return 1 array
                
        
        $meta_desc          =    $category->category_desc;
        $meta_keywords      =    $category->meta_keywords;
        $meta_title         =    $category->category_name;
              
        $url_canonical      =    $request->url();
        
       
        $category_by_id     =    DB::table('tbl_product')      
        
                                    ->join('tbl_category_product'       ,
                                        
                                           'tbl_product.category_id'    ,   '='     ,   'tbl_category_product.category_id')
        
                                    ->where('tbl_category_product.slug_category_product'    ,   $slug_category_product)
        
                                    ->paginate(6);
                
        
        
        
        
         
                  
        echo("<script>console.log('request()->query(): " .json_encode(request()->query()) . "');</script>");
        
        
        $category_id        =    $category->category_id;     
                
        $min_price          =    Product::where('category_id'  ,   $category_id)->min('product_price');
        $max_price          =    Product::where('category_id'  ,   $category_id)->max('product_price');
        
        
        $min_price_range    =    0;
        $max_price_range    =    1.2*$max_price;
        
        
        
        if(isset($_GET['sort_by'])){
            
            $sort_by    =    $_GET['sort_by'];
            
            
            if($sort_by  ==  'giam_dan'){
                
                $category_by_id     =    Product    ::with('category')
                
                                                    ->where('category_id'       ,   $category_id)
                                                    ->orderBy('product_price'   ,   'DESC')
                                                    
                                                    ->paginate(6)
                                                    
                                                 /*    ->appends(  request()->query()   ) */;
            }
            elseif($sort_by  ==  'tang_dan'){
                
                $category_by_id     =    Product    ::with('category')
                
                                                    ->where('category_id'       ,   $category_id)
                                                    ->orderBy('product_price'   ,   'ASC')
                                                    
                                                    ->paginate(6)
                                               /*      ->appends(  request()->query()  ) */;
                                                    
            }
            elseif($sort_by  ==  'kytu_za'){
                
                $category_by_id     =    Product    ::with('category')
                
                                                    ->where('category_id'       ,   $category_id)
                                                    ->orderBy('product_name'    ,   'DESC')
                                                    
                                                    ->paginate(6)
                                            /*         ->appends(  request()->query()  ) */;              
            }
            elseif($sort_by  ==  'kytu_az'){
                
                $category_by_id     =    Product    ::with('category')
                
                                                    ->where('category_id'       ,   $category_id)
                                                    ->orderBy('product_name'    ,   'ASC')
                                                    
                                                    ->paginate(6)
                                              /*       ->appends(  request()->query()  ) */;
            }
            
        }
        elseif(isset($_GET['start_price'])  &&  $_GET['end_price']){
            
            $min_price          =   $_GET['start_price'];
            $max_price          =   $_GET['end_price'];
            
            $category_by_id     =   Product     ::with('category')
                                                ->whereBetween( 'product_price'   ,   [$min_price , $max_price])
                                                ->orderBy(      'product_price'   ,   'ASC')
                                                ->paginate(6);
            
        }
        
        
        
                                    
                                    
        return          view('pages.category.show_category')    ->with('meta_desc'          ,$meta_desc)
                                                                ->with('meta_keywords'      ,$meta_keywords)
                                                                ->with('meta_title'         ,$meta_title)
                                                                
                                                                ->with('url_canonical'      ,$url_canonical)
                                                                
                                                                ->with('category_by_id'     ,$category_by_id)                                                       
                                                                
                                                                ->with('min_price'          ,$min_price)
                                                                ->with('max_price'          ,$max_price)
                                                                ->with('max_price_range'    ,$max_price_range)
                                                                ->with('min_price_range'    ,$min_price_range)
                                                                ;
    }
    
    
    
    public function AuthLogin(){
        
        //       $admin_id = Auth::id();
        
        AuthDucController::AuthLogin();
    }
    
    
    public function all_category_product(){
        
        $this->AuthLogin();
        
        
        $category_product           =        CategoryProductModel   ::where('category_parent'   ,   0)
        
                                                                    ->orderBy('category_id'     ,   'DESC')     ->get();
        
        $all_category_product       =        DB::table('tbl_category_product')  
        
                                                            ->orderBy('category_parent' ,   'DESC') 
                        
                                                            ->orderBy('category_order'  ,   'ASC')            ->paginate(10);
        
                                                            
        $manager_category_product   =        view('admin.all_category_product')
        
                                                        ->with('all_category_product'   ,   $all_category_product)
                                        
                                                        ->with('category_product'       ,   $category_product);
        
        return          view('admin_layout')    ->with('admin.all_category_product'     ,   $manager_category_product);       
    }
    
    
    public function add_category_product(){
     
        $this->AuthLogin();
        
        $category       =        CategoryProductModel   ::where('category_parent'   ,   0)
        
                                                        ->orderBy('category_id'     ,   'DESC')     ->get();
        
        return          view('admin.add_category_product')      ->with(compact('category'));
    }
    
        
    public function save_category_product(Request $request){
        
        $this->AuthLogin();
        
        $data                           =    array();
        
        $data['meta_keywords']          =    $request->category_product_keywords;
        $data['category_name']          =    $request->category_product_name;
        $data['slug_category_product']  =    $request->slug_category_product;
        $data['category_desc']          =    $request->category_product_desc;        
        $data['category_parent']        =    $request->category_parent;        
        $data['category_status']        =    $request->category_product_status;
        
        
        DB::table('tbl_category_product')   ->insert($data);
        
        Session::put('message'  ,   'Thêm danh mục sản phẩm thành công');
        
        return          Redirect::to('all-category-product');
    }
    
    
    
    
    public function export_csv(){
     
        return      Excel::download(new ExcelExports , 'category_product.xlsx');
    }
    
    
    public function import_csv(Request $request){
        
        $path       =    $request   ->file('file')  ->getRealPath();
        
        Excel       ::import(new ExcelImports   ,  $path);
     
        return      back();
    }
    
    
    public function unactive_category_product($category_product_id){
        
        $this->AuthLogin();
        
        DB::table('tbl_category_product')       ->where('category_id'           ,   $category_product_id)
        
                                                ->update(['category_status'     =>  1]);
        
        Session::put('message'      ,       'Không kích hoạt danh mục sản phẩm thành công');
        
        return      Redirect::to('all-category-product');
        
    }
    
    
    public function active_category_product($category_product_id){
        
        $this->AuthLogin();
        
        DB::table('tbl_category_product')       ->where('category_id'           ,       $category_product_id)
        
                                                ->update(['category_status'     =>      0]);
        
        Session::put('message'      ,       'Kích hoạt danh mục sản phẩm thành công');
        
        return      Redirect::to('all-category-product');
    }
    
    
    public function arrange_category(Request $request){

        $this->AuthLogin();

        $data       =    $request->all();
        
        $cate_id    =    $data["page_id_array"];

        foreach($cate_id as $key => $value){
            
            $category       =    CategoryProductModel::find($value);
            
            $category->category_order = $key;
            
            $category->save();
        }
        echo 'Updated'; 
    }
    
   
    
    
    
    
    
    
    public function edit_category_product($category_product_id){
        
        $this->AuthLogin();

        $category                       =    CategoryProductModel   ::orderBy('category_id'  ,  'DESC')     ->get();

        $edit_category_product          =    DB::table('tbl_category_product')
        
                                                ->where('category_id'   ,   $category_product_id)       ->first();

                                                
        $manager_category_product       =    view('admin.edit_category_product')
        
                                                ->with('edit_category_product'  ,   $edit_category_product)
        
                                                ->with('category'               ,   $category);

                                                
        return              view('admin_layout')    ->with('admin.edit_category_product'    ,    $manager_category_product);
    }
    
    
    public function update_category_product(Request $request,$category_product_id){
        
        $this->AuthLogin();
        
        $data                               = array();
        
        $data['category_name']              = $request->category_product_name;
        $data['category_parent']            = $request->category_parent;
        $data['meta_keywords']              = $request->category_product_keywords;
        $data['slug_category_product']      = $request->slug_category_product;
        $data['category_desc']              = $request->category_product_desc;
        
        DB::table('tbl_category_product')   ->where('category_id'   ,   $category_product_id)   ->update($data);
        
        Session::put('message'  ,   'Cập nhật danh mục sản phẩm thành công');
        
        return      Redirect::to('all-category-product');
    }
    
    
    
    public function delete_category_product($category_product_id){
        
        $this->AuthLogin();
        
        DB::table('tbl_category_product')   ->where('category_id'   ,   $category_product_id)   ->delete();
        
        Session::put('message'   ,   'Xóa danh mục sản phẩm thành công');
        
        return      Redirect::to('all-category-product');
    }

    
    
    
    
    
    
    
    
    
    
  

}
