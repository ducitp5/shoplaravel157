<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Admin;
use App\Login;
use App\Roles;


class DucAuthController extends Controller
{
    
    public function register_auth(){
        
        return view('admin.custom_auth.register');
    }
    
    
    public function login_auth(){
        
        return      view('admin.duc_auth.login_auth');
    }
    
    
    public function login(Request $request){
        
        $this->validate(    $request    ,   [
            
            'admin_email'        => 'required|email|max:255',
            
            'admin_password'     => 'required|max:255'
        ]);
        
//                      tbl_admin

        $Admin      =   Admin   ::where('admin_email'       ,   $request->admin_email)
                                ->where('admin_password'    ,   $request->admin_password)    
                                ->with('roles')
                                ->first();        
        
        if($Admin){            
            
            Session::put('admin_name'       ,   $Admin->admin_name);
            Session::put('admin_id'         ,   $Admin->admin_id);
            Session::put('admin_email'      ,   $Admin->admin_email);           
            
            Session::put('DucAuth'          ,   $Admin);
            Session::put('DucAuthRole'      ,   $Admin->withRole());
            Session::put('Role'             ,   $Admin->roles2());
            
            $dbb    =   DB::table('tbl_admin')  ->where('admin_id'  ,  $Admin->admin_id)
            
                                                ->first();
            
            Session::put('dbbAuth'          ,   $dbb);
//            Auth::id() =    $Admin->admin_id;
            
            Session::put('message'          ,   'DUC Auth logined success');
            
            
//             $_SESSION['testAuth']       =   'sincaho';
//             $_SESSION['test']           =   $Admin;
          
 //           dd (session_id());
 //           dd($_SESSION);
            
            return      redirect('/dashboard');
        }
        else{
            
            return      redirect('/duc-login-auth')
            
            ->with('message'    ,   'Lỗi đăng nhập authentication');
        }
    }
    
    
    
    public function logout_auth(){        
        
        Session::flush();
        
//         Session::forget('admin_name');

        return      redirect('/duc-login-auth')     ->with('message'    ,   'Đăng xuất authentication thành công');
    }
    
    
    public function register(Request $request){
        
        $this->validation($request);
        
        $data                     =    $request->all();
        
        $admin                    =    new Admin();
        
        $admin->admin_name        =    $data['admin_name'];
        $admin->admin_phone       =    $data['admin_phone'];
        $admin->admin_email       =    $data['admin_email'];
        $admin->admin_password    =    $data['admin_password'];
        
        $admin->save();
        
        return        redirect('/register-auth')
        
        ->with('message'    ,   'Đăng ký thành công');
    }
    
    
    
    public function validation($request){
        
        return     $this   ->validate($request     ,   [
            
            'admin_name'      => 'required|max:255',
            'admin_phone'     => 'required|max:255',
            'admin_email'     => 'required|email|max:255',
            'admin_password'  => 'required|max:255',
        ]);
    }
    
    
    
    
}
