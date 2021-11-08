<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoyalCustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        //
        $data = [
            [
                'email' => 'lxc150896@gmail.com',
                'password' => bcrypt('12345'),
            ],
            [
                'email' => 'lxc@gmail.com',
                'password' => bcrypt('12345'),
            ],
            [
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345'),
            ],
        ];
        DB::table('loyal_customers')->insert($data);
    }
}
