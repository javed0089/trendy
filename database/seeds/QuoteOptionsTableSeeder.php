<?php

use Illuminate\Database\Seeder;

class QuoteOptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quote_options')->delete();

    	DB::table('quote_options')->insert([

    		['id'=>'1','option_type'=>'1','name_en'=>'ExWorks','name_ar'=>'ExWorks'],
    		['id'=>'2','option_type'=>'1','name_en'=>'FOB','name_ar'=>'FOB'],
    		['id'=>'3','option_type'=>'1','name_en'=>'CNF','name_ar'=>'CNF'],
    		['id'=>'4','option_type'=>'1','name_en'=>'CIF','name_ar'=>'CIF'],

    		['id'=>'5','option_type'=>'2','name_en'=>'LC','name_ar'=>'LC'],
    		['id'=>'6','option_type'=>'2','name_en'=>'TT','name_ar'=>'TT'],
    		['id'=>'7','option_type'=>'2','name_en'=>'CAD','name_ar'=>'CAD'],
    		
            ['id'=>'8','option_type'=>'3','name_en'=>'MTN','name_ar'=>'MTN'],

            ['id'=>'9','option_type'=>'4','name_en'=>'US$','name_ar'=>'US$'],
            ['id'=>'10','option_type'=>'4','name_en'=>'SAR','name_ar'=>'SAR'],
          
    		
    		]);
    }
}
