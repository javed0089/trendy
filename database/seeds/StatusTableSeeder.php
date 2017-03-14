<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('statuses')->delete();

    	DB::table('statuses')->insert([

    		['id' => '1', 'status' => 'Pending'],
    		['id' => '2', 'status' => 'In-process'],
    		['id' => '3', 'status' => 'Completed'],
    		['id' => '4', 'status' => 'Rejected'],
    	]);
    }
}
