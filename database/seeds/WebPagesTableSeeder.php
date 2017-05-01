<?php

use Illuminate\Database\Seeder;

class WebPagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('webpages')->delete();
        DB::table('webpages')->insert([

    		['page_name' => 'homepage'],
    		['page_name' => 'categories'],
    		['page_name' => 'company'],
    		['page_name' => 'industry'],
    		['page_name' => 'mission'],
    		['page_name' => 'approach'],
    		['page_name' => 'locations'],
    		['page_name' => 'ourteam'],
    		['page_name' => 'career'],
    		['page_name' => 'news'],
    		['page_name' => 'blog'],
    		['page_name' => 'contact'],
    		['page_name' => 'register'],
    		['page_name' => 'login'],
            ['page_name' => 'testimonials'],
    	]);
    }
}
