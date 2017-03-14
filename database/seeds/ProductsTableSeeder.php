<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();

    	DB::table('products')->insert([

    		['id'=>'10','category_id'=>'17','brand_id'=>'1','slug'=>'marlex-hgx-030sp','name_en'=>'Marlex HGX-030SP','name_ar'=>'Marlex® HGX-030SP','desc_en'=>'','desc_ar'=>'','specs_en'=>'','specs_ar'=>''],
    		['id'=>'11','category_id'=>'17','brand_id'=>'1','slug'=>'marlex-hhm-tr-144p','name_en'=>'Marlex HHM TR-144','name_ar'=>'Marlex HHM TR-144','desc_en'=>'','desc_ar'=>'','specs_en'=>'','specs_ar'=>''],
    		['id'=>'12','category_id'=>'17','brand_id'=>'1','slug'=>'marlex-hhm-tr-131','name_en'=>'Marlex HHM TR-131','name_ar'=>'Marlex HHM TR-131','desc_en'=>'','desc_ar'=>'','specs_en'=>'','specs_ar'=>''],
    		['id'=>'13','category_id'=>'17','brand_id'=>'1','slug'=>'marlex-hhm-5502bn','name_en'=>'Marlex HHM 5502BN','name_ar'=>'Marlex HHM 5502BN','desc_en'=>'','desc_ar'=>'','specs_en'=>'','specs_ar'=>''],
    		['id'=>'14','category_id'=>'17','brand_id'=>'1','slug'=>'marlex-hxm-50100-polyethylene','name_en'=>'Marlex HXM 50100 Polyethylene','name_ar'=>'Marlex HXM 50100 Polyethylene','desc_en'=>'','desc_ar'=>'','specs_en'=>'','specs_ar'=>''],


    		['id'=>'15','category_id'=>'11','brand_id'=>'1','slug'=>'sabic-ldpe-hp0322n','name_en'=>'SABIC LDPE HP0322N','name_ar'=>'SABIC LDPE HP0322N','desc_en'=>'','desc_ar'=>'','specs_en'=>'','specs_ar'=>''],

    		['id'=>'16','category_id'=>'11','brand_id'=>'1','slug'=>'tasnee-ld-0725n','name_en'=>'TASNEE LD 0725N','name_ar'=>'TASNEE LD 0725N','desc_en'=>'','desc_ar'=>'','specs_en'=>'','specs_ar'=>''],

    		['id'=>'17','category_id'=>'11','brand_id'=>'1','slug'=>'tasnee-ld-1925as','name_en'=>'TASNEE LD 1925AS','name_ar'=>'TASNEE LD 1925AS','desc_en'=>'','desc_ar'=>'','specs_en'=>'','specs_ar'=>''],

    		['id'=>'18','category_id'=>'11','brand_id'=>'1','slug'=>'tasnee-ld-4025as','name_en'=>'TASNEE LD 4025AS','name_ar'=>'TASNEE LD 4025AS','desc_en'=>'','desc_ar'=>'','specs_en'=>'','specs_ar'=>''],

    	]);
    }
}
