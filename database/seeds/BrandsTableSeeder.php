<?php

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('brands')->delete();

    		DB::table('brands')->insert([

                ['id'=>'1','slug'=>'sabic','name_en'=>'Sabic','name_ar'=>'Sabic'],
                ['id'=>'2','slug'=>'borouge','name_en'=>'Borouge','name_ar'=>'Borouge'],
                ['id'=>'3','slug'=>'marlex','name_en'=>'Marlex','name_ar'=>'Marlex'],
                ['id'=>'4','slug'=>'lyondellbasell','name_en'=>'Lyondellbasell','name_ar'=>'Lyondellbasell'],
                ['id'=>'5','slug'=>'petro-rabigh','name_en'=>'Petro Rabigh','name_ar'=>'Petro Rabigh'],
                ['id'=>'6','slug'=>'tasnee','name_en'=>'Tasnee','name_ar'=>'Tasnee'],
            
    			
    		]);
    }
}
