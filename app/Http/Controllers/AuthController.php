<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Admin;
use App\Login;
use App\Roles;

class AuthController extends Controller
{

    public function register_auth(){

    	return view('admin.custom_auth.register');
    }


    public function login_auth(){

        return      view('admin.custom_auth.login_auth');
    }


    public function login2(Request $request){

        $this->validate(    $request    ,   [

            'admin_email'        => 'required|email|max:255',

            'admin_password'     => 'required|max:255'
        ]);

        $credential     =    [

            'admin_email'       =>  $request->admin_email,

            'password'          =>  $request->admin_password
        ];

        if(Auth::attempt($credential)){

            $login              =  Auth::user();

            Session::put('admin_name'       ,   $login->admin_name);
            Session::put('admin_id'         ,   $login->admin_id);
            Session::put('admin_email'      ,   $login->admin_email);

            Session::put('message'          ,   'Auth logined success');

            return      redirect('/dashboard');
        }
        else{

            return      redirect('/login-auth')

                            ->with('message'    ,   'Lỗi đăng nhập authentication');
        }
    }



    public function logout_auth(){

        Auth::logout();

        Session::flush();


        //        Session::forget('admin_email');

        return      redirect('/login-auth')     ->with('message'    ,   'Đăng xuất authentication thành công');
    }


    public function register2(Request $request){

		$this->validation($request);

		$data                     =    $request->all();

		$admin                    =    new Admin();

		$admin->admin_name        =    $data['admin_name'];
		$admin->admin_phone       =    $data['admin_phone'];
		$admin->admin_email       =    $data['admin_email'];
		$admin->admin_password    =    $data['admin_password'];

		$admin->save();

		return        redirect('/login-auth')

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
