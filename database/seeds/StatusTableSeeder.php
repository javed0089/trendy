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

        //type 1 for system only
    	['id' => '1', 'status_type' => '1', 'status_ar' => 'Pending', 'status_en' => 'Pending'],
        ['id' => '2', 'status_type' => '1', 'status_ar' => 'Approval', 'status_en' => 'Approval'],
        ['id' => '3', 'status_type' => '1', 'status_ar' => 'Submitted', 'status_en' => 'Submitted'],
        ['id' => '5', 'status_type' => '1', 'status_ar' => 'Completed', 'status_en' => 'Completed'],
        
        //type 1 for sales rep changes
        ['id' => '4', 'status_type' => '2', 'status_ar' => 'In-process', 'status_en' => 'In-process'],
        ['id' => '6', 'status_type' => '2', 'status_ar' => 'Rejected', 'status_en' => 'Rejected'],
        ['id' => '7', 'status_type' => '2', 'status_ar' => 'Not Available', 'status_en' => 'Not Available'],
       
    		
    	]);
    }
}
