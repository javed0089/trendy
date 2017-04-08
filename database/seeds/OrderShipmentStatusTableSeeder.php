<?php

use Illuminate\Database\Seeder;

class OrderShipmentStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('order_shipment_statuses')->delete();

    	DB::table('order_shipment_statuses')->insert([

    		['id'=>'1','shipping_status_en'=>'Before Loading','shipping_status_ar'=>'Before Loading'],
    		['id'=>'2','shipping_status_en'=>'Loading','shipping_status_ar'=>'Loading'],
    		['id'=>'3','shipping_status_en'=>'Clearance','shipping_status_ar'=>'Clearance'],
    		['id'=>'4','shipping_status_en'=>'BL Draft','shipping_status_ar'=>'BL Draft'],
    		['id'=>'5','shipping_status_en'=>'Shipment','shipping_status_ar'=>'Shipment'],
    	]);
    }
}
