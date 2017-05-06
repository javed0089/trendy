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
        ['id' => '3', 'status_type' => '1', 'status_ar' => 'Submitted', 'status_en' => 'Quoted'],
        ['id' => '5', 'status_type' => '1', 'status_ar' => 'Completed', 'status_en' => 'Completed'],
        ['id' => '8', 'status_type' => '1', 'status_ar' => 'Shipment Started', 'status_en' => 'Shipment Started'],
        ['id' => '9', 'status_type' => '1', 'status_ar' => 'Performa Invoice Added', 'status_en' => 'Performa Invoice Added'],
        ['id' => '10', 'status_type' => '1', 'status_ar' => 'Performa Invoice Confirmed', 'status_en' => 'Performa Invoice Confirmed'],
        ['id' => '11', 'status_type' => '1', 'status_ar' => 'Payment Proof Added', 'status_en' => 'Payment Proof Added'],
        ['id' => '12', 'status_type' => '1', 'status_ar' => 'Payment Proof Confirmed', 'status_en' => 'Payment Proof Confirmed'],
        ['id' => '13', 'status_type' => '1', 'status_ar' => 'Shipment Started', 'status_en' => 'Shipment Started'],
        ['id' => '14', 'status_type' => '1', 'status_ar' => 'Before Loading', 'status_en' => 'Before Loading'],
        ['id' => '15', 'status_type' => '1', 'status_ar' => 'Loading', 'status_en' => 'Loading'],
        ['id' => '16', 'status_type' => '1', 'status_ar' => 'Clearance', 'status_en' => 'Clearance'],
        ['id' => '17', 'status_type' => '1', 'status_ar' => 'BL Draft', 'status_en' => 'Bl Draft'],
        ['id' => '18', 'status_type' => '1', 'status_ar' => 'Shipment', 'status_en' => 'Shipment'],


        
        //type 1 for sales rep changes
        ['id' => '4', 'status_type' => '2', 'status_ar' => 'In-process', 'status_en' => 'In-process'],
        ['id' => '6', 'status_type' => '2', 'status_ar' => 'Rejected', 'status_en' => 'Rejected'],
        ['id' => '7', 'status_type' => '2', 'status_ar' => 'Not Available', 'status_en' => 'Not Available'],

       
    		
    	]);
    }
}
