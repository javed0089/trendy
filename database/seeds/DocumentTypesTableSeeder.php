<?php

use Illuminate\Database\Seeder;

class DocumentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('document_types')->delete();

    	DB::table('document_types')->insert([

    		['id'=>'1','document_type_en'=>'Performa Invoice','document_type_ar'=>'Performa Invoice','doc_type_id'=>'1'],
    		['id'=>'2','document_type_en'=>'Confirmed Performa Invoice','document_type_ar'=>'Confirmed Performa Invoice','doc_type_id'=>'2'],
    		['id'=>'3','document_type_en'=>'Payment Proof','document_type_ar'=>'Payment Proof','doc_type_id'=>'2'],
    		
    		
    		]);
    }
}
