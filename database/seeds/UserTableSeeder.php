<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('users')->delete();
        DB::table('users')->insert([

    		['id' => '1', 'email' => 'javed@javed.com','password'=>Hash::make( 'display' )]
    	]);

        DB::table('role_users')->delete();
    	 DB::table('role_users')->insert([

    		['user_id' => '1', 'role_id' => '1']
    	]);

    	 DB::table('activations')->delete();
    	  DB::table('activations')->insert([

    		['id' => '1','user_id' => '1', 'code' => 'RfSjOaUKx4dtUggD6NUiSJmEue6Op7CI','completed'=>'1']
    	]);

    }
}
