<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;
use App\Order;
use App\Post;
use App\Product;
use App\Social;
use App\Statistic;
use App\Video;
use App\Visitors;

use App\Login;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

use App\Rules\Captcha; 
use Carbon\Carbon;
use app\DucClass\mySql\myModel;



class AdminController extends Controller
{
    
    
    public function dashboard_filter(Request $request){
        
        // $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        // $tomorrow = Carbon::now('Asia/Ho_Chi_Minh')->addDay()->format('d-m-Y H:i:s');
        // $lastWeek = Carbon::now('Asia/Ho_Chi_Minh')->subWeek()->format('d-m-Y H:i:s');
        // $sub15days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(15)->format('d-m-Y H:i:s');
        // $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->format('d-m-Y H:i:s');
        
        
        $now            =    Carbon::now('Asia/Ho_Chi_Minh')    ->toDateString();        
        
        
        $data           =    $request->all();
        
        
        if($data['dashboard_value']  ==  '7ngay'){
            
            $sub7days       =    Carbon::now('Asia/Ho_Chi_Minh')    ->subdays(7)    ->toDateString();
            
            $get            =    Statistic  ::whereBetween('order_date'     ,    [$sub7days  ,  $now])
            
                                            ->orderBy('order_date'   ,   'ASC')
            
                                            ->get();
            
        }
        elseif($data['dashboard_value']  ==  'thangtruoc'){
            
            $dau_thangtruoc     =    Carbon::now('Asia/Ho_Chi_Minh')    ->subMonth()    ->startOfMonth()    ->toDateString();
            
            $cuoi_thangtruoc    =    Carbon::now('Asia/Ho_Chi_Minh')    ->subMonth()    ->endOfMonth()      ->toDateString();
            
            
            $get                =    Statistic  ::whereBetween('order_date'     ,   [$dau_thangtruoc    ,   $cuoi_thangtruoc])
            
                                                ->orderBy('order_date'  ,   'ASC')
            
                                                ->get();
            
        }
        elseif($data['dashboard_value']  ==  'thangnay'){
            
            $dauthangnay        =    Carbon::now('Asia/Ho_Chi_Minh')                    ->startOfMonth()    ->toDateString();
                        
            $get                =    Statistic  ::whereBetween('order_date'     ,   [$dauthangnay   ,   $now])
            
                                                ->orderBy('order_date'  ,   'ASC')
            
                                                ->get();
            
        }
        elseif ($data['dashboard_value']  ==  'thang9') {
            
            $dauthang9          =    Carbon::now('Asia/Ho_Chi_Minh')    ->subMonth(2)   ->startOfMonth()    ->toDateString();
            
            $cuoithang9         =    Carbon::now('Asia/Ho_Chi_Minh')    ->subMonth(2)   ->endOfMonth()      ->toDateString();
            
            
            $get                =    Statistic  ::whereBetween('order_date'     ,   [$dauthang9     ,   $cuoithang9])
            
                                                ->orderBy('order_date'  ,   'ASC')
            
                                                ->get();
            
        }
        else{
            
            $sub365days         =    Carbon::now('Asia/Ho_Chi_Minh')    ->subdays(365)                      ->toDateString();
            
            $get                =    Statistic  ::whereBetween('order_date'     ,   [$sub365days    ,   $now])
            
                                                ->orderBy('order_date'  ,   'ASC')
            
                                                ->get();
        }
        
        
        foreach($get as $key => $val){
            
            $chart_data[]   =    array(
                
                'period'    => $val->order_date,
                
                'order'     => $val->total_order,
                'sales'     => $val->sales,
                'profit'    => $val->profit,
                'quantity'  => $val->quantity
            );
        }
        
        echo        $data      =    json_encode($chart_data);
        
    }
    
    
    
    
    
    public function filter_by_date(Request $request){
        
        $data           =    $request->all();
        
        $from_date      =    $data['from_date'];
        $to_date        =    $data['to_date'];
        
        $get            =    Statistic      ::whereBetween('order_date'    ,    [$from_date  ,  $to_date])
        
                                            ->orderBy('order_date'      ,   'ASC')
        
                                            ->get();
        
/*               
        echo("<script>      console.log('PHP: get "      .$get. "');                    </script>");
 */        
                                            
         
        foreach($get as $key => $val){
            
            $chart_data[]   =    array(
                
                'period'        =>  $val->order_date,
                
                'order'         =>  $val->total_order,
                'sales'         =>  $val->sales         / 1000000,
                'profit'        =>  $val->profit        / 1000000,
                'quantity'      =>  $val->quantity
            );
        } 
        
        echo    $data   =    json_encode($chart_data);
        
    }
    
    
    
     
    
    
    public function days_order(){
        
        $sub60days      =    Carbon     ::now('Asia/Ho_Chi_Minh')   ->subdays(60)   ->toDateString();
        
        $now            =    Carbon     ::now('Asia/Ho_Chi_Minh')                   ->toDateString();
        
        
        $get            =    Statistic  ::whereBetween('order_date'  ,  [$sub60days , $now] )
        
                                        ->orderBy('order_date'  ,  'ASC')
                                        
                                        ->get();
        
        
        
        //        echo("<script>      console.log('PHP: sub60day " .$sub60days. "');              </script>");
        
        //        echo("<script>      console.log('PHP: now "      .$now. "');                    </script>");
        
        //        echo("<script>      console.log('PHP: get "      .$get. "');                    </script>");
        
        foreach($get as $key => $val){
            
            $chart_data[]   =    array(
                
                'period'        =>  $val->order_date,
                
                'order'         =>  $val->total_order,
                'sales'         =>  $val->sales         / 1000000,
                'profit'        =>  $val->profit        / 1000000,
                'quantity'      =>  $val->quantity
            );
        }
        
        echo    $data   =    json_encode($chart_data);
    }
    
    
    
    public function days_order_demo(){
        
        $get            =    Statistic      ::whereBetween('order_date'    ,    ['2020-11-01'  ,  '2020-11-10'])
                                            
                                            ->orderBy('order_date'      ,   'ASC')
                                            
                                            ->get();
                                            
        /*
         echo("<script>      console.log('PHP: get "      .$get. "');                    </script>");
         */
        
        
        foreach($get as $key => $val){
            
            $chart_data[]   =    array(
                
                'period'        =>  $val->order_date,
                
                'order'         =>  $val->total_order,
                'sales'         =>  $val->sales         / 1000000,
                'profit'        =>  $val->profit        / 1000000,
                'quantity'      =>  $val->quantity
            );
        }
        
        echo    $data   =    json_encode($chart_data);
    }

    
    
    
    public function index(){
        
        return view('admin_login');
    }
    
    
    public function dashboard(Request $request){
        
        //$data = $request->all();
        
               
        $data       =    $request->validate([
        
            //validation laravel

            'admin_email'               => 'required',
            'admin_password'            => 'required',
            'g-recaptcha-response'      => new Captcha(),    //dòng kiểm tra Captcha
        ]);
        
        $admin_email        =   $data['admin_email'];
        $admin_password     =   ($data['admin_password']);
        
        $login              =   Login     ::where('admin_email'       ,   $admin_email)
                                          ->where('admin_password'    ,   $admin_password)    ->first();
        
        if($login){
        
/*             $login_count    =    $login->count();
            
            if($login_count>0){ */
                
                Session::put('admin_name'       ,   $login->admin_name);
                Session::put('admin_id'         ,   $login->admin_id);
                Session::put('admin_email'      ,   $login->admin_email);
                
                return      Redirect::to('/dashboard');
  //          }
        }
        else{
        
            Session::put('message'  ,   'Mật khẩu hoặc tài khoản bị sai.Làm ơn nhập lại');
            
            return Redirect::to('/admin');
        }       
    }
    
    
    public function logout(){
     
        $this->AuthLogin();
        
        Session::forget('admin_name');
        Session::forget('admin_id');
        
        Session::put('admin_email'  ,   null);
        
        return Redirect::to('/admin');
    }
    
    
    public function AuthLogin(){
        
 //       $admin_id = Auth::id();
 
        $admin_id   =   Session::get("admin_id");
        
        if($admin_id){
            
            return Redirect::to('dashboard');
        
        }
        else{
           
            return Redirect::to('admin')->send();
        }
    }
    
    
    
    public function show_dashboard(Request $request){
               
//        $this->AuthLogin();
        
        //total last month
        
        $early_last_month           =    Carbon::now('Asia/Ho_Chi_Minh')    ->subMonth()        ->startOfMonth()    ->toDateString();
        
        $end_of_last_month          =    Carbon::now('Asia/Ho_Chi_Minh')    ->subMonth()        ->endOfMonth()      ->toDateString();
        
        $sql1                       =    Visitors   ::whereBetween('date_visitor'  ,  [$early_last_month  ,  $end_of_last_month]);
        $visitor_of_lastmonth       =    $sql1->get();        
        consolelog(myModel::getSql($sql1));
        
        $visitor_last_month_count   =    $visitor_of_lastmonth      ->count();
        
        //total this month
        
        $early_this_month           =    Carbon::now('Asia/Ho_Chi_Minh')    ->startOfMonth()    ->toDateString();
        
        $now                        =    Carbon::now('Asia/Ho_Chi_Minh')    ->toDateString();
        
        $visitor_of_thismonth       =    Visitors   ::whereBetween('date_visitor'  ,  [$early_this_month  ,  $now])
        
                                                    ->get();
        
        $visitor_this_month_count   =    $visitor_of_thismonth      ->count();
        
        
        
        $oneyears                   =    Carbon::now('Asia/Ho_Chi_Minh')    ->subdays(365)      ->toDateString();
        
        $visitor_of_year            =    Visitors   ::whereBetween('date_visitor'  ,  [$oneyears    ,   $now])
        
                                                    ->get();
        
        $visitor_year_count         =    $visitor_of_year           ->count();
        
        
        $visitors                   =    Visitors::all();
        consoletable($visitors);
        consolevar($visitors);
        
        $visitors_total             =    $visitors                  ->count();
        
        
        consolelog('stat my '.$early_last_month);
        echo("<script>      console.log('->subMonth()     ->startOfMonth() "     .$early_last_month. "');              </script>");
        echo("<script>      console.log('->subMonth()     ->endOfMonth() "       .$end_of_last_month. "');             </script>");
        echo("<script>      console.log('->startOfMonth()     "                  .$early_this_month. "');              </script>");
        echo("<script>      console.log('->subdays(365) "                        .$oneyears. "');                      </script>");
        echo("<script>      console.log('->toDateString() "                      .$now. "');                           </script>");
        
        
        
        //current online
        
        $user_ip_address            =    $request   ->ip();      
        
        $visitors_current           =    Visitors   ::where('ip_address'    ,   $user_ip_address)   ->get();        
        
        $visitor_count              =    $visitors_current          ->count();
        
        consolevar($visitors_current);
        
        if($visitor_count < 1){
            
            $visitor                =    new Visitors();
            
            $visitor->ip_address    =    $user_ip_address;
            
            $visitor->date_visitor  =    Carbon::now('Asia/Ho_Chi_Minh')    ->toDateString();
            
            $visitor->save();
        }        
        
        
        $product_views  =    Product    ::orderBy('product_views'   ,  'DESC')  ->take(20)  ->get();
        
        $post_views     =    Post       ::orderBy('post_views'      ,  'DESC')  ->take(20)  ->get();
        
        
        return          view('admin.dashboard')     
        
                            ->with(     compact(    'user_ip_address',
                                                    'visitors_total',
                                                    'visitor_count',
                                                    'visitor_last_month_count',
                                                    'visitor_this_month_count',
                                                    'visitor_year_count',
/*                                                     'product',
                                                    'post',
                                                    'order',
                                                    'video',
                                                    'customer', */
                                                    'product_views',
                                                    'post_views'
                                ));           
    }
    
    
    
    
    
    
    
    
    public function login_google(){
        return Socialite::driver('google')->redirect();
    }
    
    
    public function callback_google(){
            $users = Socialite::driver('google')->stateless()->user(); 
            // // return $users->id;
            // return $users->name;
            // return $users->email;
            $authUser = $this->findOrCreateUser($users,'google');
            $account_name = Login::where('admin_id',$authUser->user)->first();
            Session::put('admin_name',$account_name->admin_name);
            Session::put('admin_id',$account_name->admin_id);
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');  
    }
    
    
    public function findOrCreateUser($users, $provider){
            $authUser = Social::where('provider_user_id', $users->id)->first();
            if($authUser){

                return $authUser;
            }
          
            $hieu = new Social([
                'provider_user_id' => $users->id,
                'provider' => strtoupper($provider)
            ]);

            $orang = Login::where('admin_email',$users->email)->first();

                if(!$orang){
                    $orang = Login::create([
                        'admin_name' => $users->name,
                        'admin_email' => $users->email,
                        'admin_password' => '',
                        'admin_phone' => '',
                        'admin_status' => 1
                        
                    ]);
                }

            $hieu->login()->associate($orang);
                
            $hieu->save();

            $account_name = Login::where('admin_id',$hieu->user)->first();
            Session::put('admin_name',$account_name->admin_name);
            Session::put('admin_id',$account_name->admin_id); 
          
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');


    }


    public function login_facebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook(){
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
        if($account){
            //login in vao trang quan tri  
            $account_name = Login::where('admin_id',$account->user)->first();
            Session::put('admin_name',$account_name->admin_name);
            Session::put('admin_id',$account_name->admin_id);
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        }else{

            $hieu = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = Login::where('admin_email',$provider->getEmail())->first();

            if(!$orang){
                $orang = Login::create([
                    'admin_name' => $provider->getName(),
                    'admin_email' => $provider->getEmail(),
                    'admin_password' => '',
                    'admin_phone' => ''
                    
                ]);
            }
            $hieu->login()->associate($orang);
            $hieu->save();

            $account_name = Login::where('admin_id',$account->user)->first();
            Session::put('admin_name',$account_name->admin_name);
            Session::put('admin_id',$account_name->admin_id);
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        } 
    }

   
   
    
}
