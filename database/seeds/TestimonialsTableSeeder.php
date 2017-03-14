<?php

use Illuminate\Database\Seeder;

class TestimonialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('testimonials')->delete();

    	DB::table('testimonials')->insert([

    		['id'=>'1','quote_en'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget leo ac nisi porta consectetur. Duis sit amet ligula turpis. Suspendisse eget hendrerit justo. Suspendisse elementum eleifend arcu in consequat. Nullam imperdiet, mauris a consequat pharetra, quam quam malesuada nisi, non scelerisque.','quote_ar'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget leo ac nisi porta consectetur. Duis sit amet ligula turpis. Suspendisse eget hendrerit justo. Suspendisse elementum eleifend arcu in consequat. Nullam imperdiet, mauris a consequat pharetra, quam quam malesuada nisi, non scelerisque.','client_name_en'=>'Calvin Sims','client_name_ar'=>'Calvin Sims','location_en'=>'Marketing Head, ABC Chemicals','location_ar'=>'Marketing Head, ABC Chemicals','featured'=>'1','status'=>'1'],
    		
    		['id'=>'2','quote_en'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget leo ac nisi porta consectetur. Duis sit amet ligula turpis. Suspendisse eget hendrerit justo. Suspendisse elementum eleifend arcu in consequat. Nullam imperdiet, mauris a consequat pharetra, quam quam malesuada nisi, non scelerisque.','quote_ar'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget leo ac nisi porta consectetur. Duis sit amet ligula turpis. Suspendisse eget hendrerit justo. Suspendisse elementum eleifend arcu in consequat. Nullam imperdiet, mauris a consequat pharetra, quam quam malesuada nisi, non scelerisque.','client_name_en'=>'Bertha Gonzales','client_name_ar'=>'Bertha Gonzales','location_en'=>'Divisional Manager, Corpo Inc.','location_ar'=>'Divisional Manager, Corpo Inc.','featured'=>'1','status'=>'1'],

			['id'=>'3','quote_en'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget leo ac nisi porta consectetur. Duis sit amet ligula turpis. Suspendisse eget hendrerit justo. Suspendisse elementum eleifend arcu in consequat. Nullam imperdiet, mauris a consequat pharetra, quam quam malesuada nisi, non scelerisque.','quote_ar'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget leo ac nisi porta consectetur. Duis sit amet ligula turpis. Suspendisse eget hendrerit justo. Suspendisse elementum eleifend arcu in consequat. Nullam imperdiet, mauris a consequat pharetra, quam quam malesuada nisi, non scelerisque.','client_name_en'=>'Brianna Hernandez','client_name_ar'=>'Brianna Hernandez','location_en'=>'Founder & CEO, Marine Engineering','location_ar'=>'Founder & CEO, Marine Engineering','featured'=>'1','status'=>'1'],

			['id'=>'4','quote_en'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget leo ac nisi porta consectetur. Duis sit amet ligula turpis. Suspendisse eget hendrerit justo. Suspendisse elementum eleifend arcu in consequat. Nullam imperdiet, mauris a consequat pharetra, quam quam malesuada nisi, non scelerisque.','quote_ar'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget leo ac nisi porta consectetur. Duis sit amet ligula turpis. Suspendisse eget hendrerit justo. Suspendisse elementum eleifend arcu in consequat. Nullam imperdiet, mauris a consequat pharetra, quam quam malesuada nisi, non scelerisque.','client_name_en'=>'Brianna Hernandez','client_name_ar'=>'Brianna Hernandez','location_en'=>'Founder & CEO, Marine Engineering','location_ar'=>'Founder & CEO, Marine Engineering','featured'=>'0','status'=>'1'],

			['id'=>'5','quote_en'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget leo ac nisi porta consectetur. Duis sit amet ligula turpis. Suspendisse eget hendrerit justo. Suspendisse elementum eleifend arcu in consequat. Nullam imperdiet, mauris a consequat pharetra, quam quam malesuada nisi, non scelerisque.','quote_ar'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget leo ac nisi porta consectetur. Duis sit amet ligula turpis. Suspendisse eget hendrerit justo. Suspendisse elementum eleifend arcu in consequat. Nullam imperdiet, mauris a consequat pharetra, quam quam malesuada nisi, non scelerisque.','client_name_en'=>'Brianna Hernandez','client_name_ar'=>'Brianna Hernandez','location_en'=>'Founder & CEO, Marine Engineering','location_ar'=>'Founder & CEO, Marine Engineering','featured'=>'0','status'=>'0'],

    		]);
    }
}
