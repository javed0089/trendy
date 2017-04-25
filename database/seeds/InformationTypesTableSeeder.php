<?php

use Illuminate\Database\Seeder;

class InformationTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('information_types')->delete();

    	DB::table('information_types')->insert([
    		['id' => '1','slug'=>'privacy-policy','information_type_en' => 'Privacy Policy','information_type_ar' => 'سياسة الخصوصية'],
    		['id' => '2','slug'=>'terms-of-use','information_type_en' => 'Terms of use','information_type_ar' => 'تعليمات الاستخدام'],
            ['id' => '3','slug'=>'disclaimer','information_type_en' => 'Disclaimer','information_type_ar' => 'تنصل'],
    		]);
    }
}
