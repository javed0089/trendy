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

    		['id' => '1', 'email' => 'superadmin@gap-polymers.com','password'=>Hash::make( 'display' ),
            'first_name' => 'Super','last_name' => 'Admin','backend_user'=>'1'],
            ['id' => '2', 'email' => 'admin@gap-polymers.com','password'=>Hash::make( 'display' ),
            'first_name' => 'Admin','last_name' => 'Admin','backend_user'=>'1'],
            ['id' => '3', 'email' => 'supervisor@gap-polymers.com','password'=>Hash::make( 'display' ),
            'first_name' => 'Supervisor','last_name' => 'Supervisor','backend_user'=>'1'],
            ['id' => '4', 'email' => 'sales-executive@gap-polymers.com','password'=>Hash::make( 'display' ),'first_name' => 'Sales','last_name' => 'Executive','backend_user'=>'1'],
            ['id' => '5', 'email' => 'customer@gap-polymers.com','password'=>Hash::make( 'display' ),'first_name' => 'Customer','last_name' => 'Customer','backend_user'=>'0'],
    	]);

        DB::table('role_users')->delete();
    	 DB::table('role_users')->insert([

    		['user_id' => '1', 'role_id' => '1'],
            ['user_id' => '2', 'role_id' => '2'],
            ['user_id' => '3', 'role_id' => '3'],
            ['user_id' => '4', 'role_id' => '4'],
            ['user_id' => '5', 'role_id' => '5'],
    	]);

    	 DB::table('activations')->delete();
    	  DB::table('activations')->insert([

    		['id' => '1','user_id' => '1', 'code' => 'RfSjOaUKx4dtUggD6NUiSJmEue6Op7CI','completed'=>'1'],
            ['id' => '2','user_id' => '2', 'code' => 'RfSjOaUKx4dtUggD6NUiSJmEue6Op7CI','completed'=>'1'],
            ['id' => '3','user_id' => '3', 'code' => 'RfSjOaUKx4dtUggD6NUiSJmEue6Op7CI','completed'=>'1'],
            ['id' => '4','user_id' => '4', 'code' => 'RfSjOaUKx4dtUggD6NUiSJmEue6Op7CI','completed'=>'1'],
            ['id' => '5','user_id' => '5', 'code' => 'RfSjOaUKx4dtUggD6NUiSJmEue6Op7CI','completed'=>'1'],
    	]);

    }
}
