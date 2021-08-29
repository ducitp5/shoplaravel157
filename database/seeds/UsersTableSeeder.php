<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Admin;
use App\Roles;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        
        DB::table('admin_roles')->truncate();
        
                
        $admin          =    Admin::create([
            
        	'admin_name'       => 'hieuadmin',
        	'admin_email'      => 'hieuadmin@yahoo.com',
        	'admin_phone'      => '123456789',
        	'admin_password'   => md5('123456')
        ]);

        
        $author         =    Admin::create([
            
        	'admin_name'       => 'hieuauthor',
        	'admin_email'      => 'hieuauthor@yahoo.com',
        	'admin_phone'      => '123456789',
        	'admin_password'   => md5('123456')
        ]);
        

        $user           =    Admin::create([
            
        	'admin_name'       => 'hieuuser',
        	'admin_email'      => 'hieuuser@yahoo.com',
        	'admin_phone'      => '123456789',
        	'admin_password'   => md5('123456')
        ]);
        

        $adminRoles     =    Roles::where('name','admin')   ->first();     //   [   1   ,   admin    ]
        $authorRoles    =    Roles::where('name','author')  ->first();     //   [   2   ,   author   ]
        $userRoles      =    Roles::where('name','user')    ->first();     //   [   3   ,   user     ]
        
        
        $admin  ->lang()    ->attach($adminRoles);
        
        $author ->lang()    ->attach($authorRoles);
        
        $user   ->lang()    ->attach($userRoles);

        
        factory(App\Admin::class , 20)  ->create();

    }
}
