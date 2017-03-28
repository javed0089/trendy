<?php

use Illuminate\Database\Seeder;

class rolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

    	DB::table('roles')->insert([

    		['id'=>'1','slug'=>'super-admin','name'=>'Super Admin'],
    		['id'=>'2','slug'=>'admin','name'=>'Admin'],
    		['id'=>'3','slug'=>'supervisor','name'=>'Supervisor'],
    		['id'=>'4','slug'=>'sales-executive','name'=>'Sales Executive'],
    		['id'=>'5','slug'=>'subscriber','name'=>'Subscriber'],
    		
    		
    		]);
    }
}
