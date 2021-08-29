<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

use App\Roles;
use App\Admin;





class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {              
                                //  App \ Roles   ===>    tbl_roles
        
        $admin      =    Admin      ::with('roles')   
        
                                    ->orderBy('admin_id'    ,   'DESC')     ->paginate(5);
        
                                    
        return      view('admin.users.all_users')       ->with(compact('admin'));;
    }
    
    
    
    public function assign_roles(Request $request){
        
        if( (Auth::id() == $request->admin_id)  ||  (Session::get('admin_id') == $request->admin_id)){
            
            return      redirect()->back()->with('message'  ,   'Bạn không được phân quyền chính mình');
        }
        
        $user       =    Admin::where('admin_email'    ,   $request->admin_email)  ->first();        


        $user   ->roles()  ->detach();               //      clear and refresh
        
        
        if($request->admin_role){
            
            $user   ->roles()   ->attach(Roles::where('name'    ,   'admin')    ->first()  );
        }
        
        if($request->author_role){
        
            $user   ->roles()   ->attach(Roles::where('name'    ,   'author')   ->first());
        }
        
        if($request->user_role){
        
            $user   ->roles()   ->attach(Roles::where('name'    ,   'user')     ->first());
        }
        
        
        return      redirect()  ->back()    ->with('message'    ,   'Cấp quyền thành công');
    }
    
    
    
    
    public function delete_user_roles($admin_id){
        
        if(Auth::id()   ==  $admin_id){
            
            return      redirect()   ->back()    ->with('message'   ,   'Bạn không được quyền xóa chính mình');
        }
        
        $admin = Admin::find($admin_id);
        
        if($admin){
            
            $admin->lang()->detach();
            
            $admin->delete();
        }
        
        return      redirect()  ->back()        ->with('message'    ,   'Xóa user thành công');        
    }
    
    
    
    
    public function impersonate($admin_id){
        
//        $user       =    Admin  ::where('admin_id'  ,   $admin_id)      ->first();
        
 //       if($user){
        
            session()->put('impersonate'    ,   $admin_id);
 //       }
        
        return redirect('/users');
    }
    
    
    public function impersonate_destroy(){
        
        session()   ->forget('impersonate');
        
        return      redirect('/users');
    }
    
    
    
    public function add_users(){
        
        return view('admin.users.add_users');
    }
    
    
    
    public function store_users(Request $request){
        
        $data                       =    $request->all();
        
        $admin                      =    new Admin();       // tbl_admin
        
        $admin->admin_name          =    $data['admin_name'];
        $admin->admin_email         =    $data['admin_email'];
        $admin->admin_phone         =    $data['admin_phone'];        
        $admin->admin_password      =   ($data['admin_password']);
        
                // tbl_roles
                
        $admin->save();
        
        $admin  ->roles()   ->attach(Roles::where('name'  ,  'user')    ->first());
        
        
        
        Session::put('message'      ,   'Thêm users thành công');
        
        
        return      Redirect::to('users');
    }
  



}
