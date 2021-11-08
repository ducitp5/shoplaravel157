<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\LoyalCustomer;//user model can kiem tra

use Illuminate\Support\Facades\Auth;




class AuthLoyalController extends Controller
{
    
    public function getLogin()
    {
        return              view('demo.Auth_loyal.login');
    }
    
    public function postLogin(Request $request)
    {
        $arr = [
            'email'     => $request->email,
            'password'  => $request->password,
        ];
        
        if ($request->remember  ==  trans('remember.Remember Me')) {
            
            $remember = true;
        } 
        else {
            
            $remember = false;
        }
        
//        dd('this here');
        
        //kiểm tra trường remember có được chọn hay không
        
        if (Auth::guard('loyal_customer')->attempt($arr)) {
            
            dd('đăng nhập thành công');
            //..code tùy chọn
            //đăng nhập thành công thì hiển thị thông báo đăng nhập thành công
        } else {
            
            dd('tài khoản và mật khẩu chưa chính xác');
            //...code tùy chọn
            //đăng nhập thất bại hiển thị đăng nhập thất bại
        }
    }
    
}