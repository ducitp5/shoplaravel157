<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            'email2'    => $request->email,
            'password'  => $request->password,
        ];

        if (Auth::guard('loyal_customer')->attempt($arr)) {

            return      redirect('/dashboard');
        }
        else {

            return redirect()->back();
        }
    }

}

