<?php

use Illuminate\Database\Seeder;

class BlogCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blog_categories')->delete();

    		DB::table('blog_categories')->insert([

                //header
    			['id'=>'1','name_en'=>'The Company','name_ar'=>'The Company'],
    			['id'=>'2','name_en'=>'Careers','name_ar'=>'Careers'],
    			['id'=>'3','name_en'=>'Transportation','name_ar'=>'Transportation'],
    			['id'=>'4','name_en'=>'Environment','name_ar'=>'Environment'],
    			['id'=>'5','name_en'=>'Refineries','name_ar'=>'Refineries'],
    			['id'=>'6','name_en'=>'Technology','name_ar'=>'The Technology'],
    			['id'=>'7','name_en'=>'Marketing & Sales','name_ar'=>'Marketing & Sales'],
    		]);

    }
}
