<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->delete();

    	DB::table('departments')->insert([

    		['id'=>'1','name_en'=>'Marketing & Sales','name_ar'=>'Marketing & Sales'],
    		['id'=>'2','name_en'=>'Information Technology','name_ar'=>'Information Technology'],
    		['id'=>'3','name_en'=>'Production Engineering','name_ar'=>'Production Engineering'],
    		['id'=>'4','name_en'=>'Finance & HR','name_ar'=>'Finance & HR'],
    		['id'=>'5','name_en'=>'Contracting & Procurement','name_ar'=>'Contracting & Procurement'],
    		['id'=>'6','name_en'=>'Discipline Engineering','name_ar'=>'Discipline Engineering'],
    		
    		
    		]);
    }
}
