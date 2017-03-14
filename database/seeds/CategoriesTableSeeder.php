<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();

    	DB::table('categories')->insert([

             
    		['id'=>'10','parent_id'=>'0','slug'=>'ploythylene-pe','name_en'=>'POLYETHYLENE (PE)','name_ar'=>'POLYETHYLENE (PE)','desc_en'=>'FY3011E is a polypropylene homopolymer intended for yarn extrusion characterized by ease of processing and low heat shrinkage. Yarn made from this resin exhibit excellent mechanical property.','desc_ar'=>'FY3011E is a polypropylene homopolymer intended for yarn extrusion characterized by ease of processing and low heat shrinkage. Yarn made from this resin exhibit excellent mechanical property.'],
    		['id'=>'11','parent_id'=>'0','slug'=>'ployvinyl-chloride-pvc','name_en'=>'POLYVINYL CHLORIDE (PVC)','name_ar'=>'POLYVINYL CHLORIDE (PVC)','desc_en'=>'FY3011E is a polypropylene homopolymer intended for yarn extrusion characterized by ease of processing and low heat shrinkage. Yarn made from this resin exhibit excellent mechanical property.','desc_ar'=>'FY3011E is a polypropylene homopolymer intended for yarn extrusion characterized by ease of processing and low heat shrinkage. Yarn made from this resin exhibit excellent mechanical property.'],
    		['id'=>'12','parent_id'=>'0','slug'=>'polystyrene-ps','name_en'=>'POLYSTYRENE (PS)','name_ar'=>'POLYSTYRENE (PS)','desc_en'=>'FY3011E is a polypropylene homopolymer intended for yarn extrusion characterized by ease of processing and low heat shrinkage. Yarn made from this resin exhibit excellent mechanical property.','desc_ar'=>'FY3011E is a polypropylene homopolymer intended for yarn extrusion characterized by ease of processing and low heat shrinkage. Yarn made from this resin exhibit excellent mechanical property.'],
    		['id'=>'13','parent_id'=>'0','slug'=>'polyethylene-terphthalate-pet','name_en'=>'POLYETHYLENE TEREPHTHALATE (PET)','name_ar'=>'POLYETHYLENE TEREPHTHALATE (PET)','desc_en'=>'FY3011E is a polypropylene homopolymer intended for yarn extrusion characterized by ease of processing and low heat shrinkage. Yarn made from this resin exhibit excellent mechanical property.','desc_ar'=>'FY3011E is a polypropylene homopolymer intended for yarn extrusion characterized by ease of processing and low heat shrinkage. Yarn made from this resin exhibit excellent mechanical property.'],
    		['id'=>'14','parent_id'=>'0','slug'=>'engineering-plastics','name_en'=>'ENGINEERING PLASTICS','name_ar'=>'ENGINEERING PLASTICS','desc_en'=>'FY3011E is a polypropylene homopolymer intended for yarn extrusion characterized by ease of processing and low heat shrinkage. Yarn made from this resin exhibit excellent mechanical property.','desc_ar'=>'FY3011E is a polypropylene homopolymer intended for yarn extrusion characterized by ease of processing and low heat shrinkage. Yarn made from this resin exhibit excellent mechanical property.'],
    		['id'=>'15','parent_id'=>'0','slug'=>'polyolefin-elastomers-poe','name_en'=>'POLYOLEFIN ELASTOMERS (POE)','name_ar'=>'POLYOLEFIN ELASTOMERS (POE)','desc_en'=>'FY3011E is a polypropylene homopolymer intended for yarn extrusion characterized by ease of processing and low heat shrinkage. Yarn made from this resin exhibit excellent mechanical property.','desc_ar'=>'FY3011E is a polypropylene homopolymer intended for yarn extrusion characterized by ease of processing and low heat shrinkage. Yarn made from this resin exhibit excellent mechanical property.'],
    		['id'=>'16','parent_id'=>'0','slug'=>'masterbatch-additives','name_en'=>'MASTERBATCH & ADDITIVES','name_ar'=>'MASTERBATCH & ADDITIVES','desc_en'=>'FY3011E is a polypropylene homopolymer intended for yarn extrusion characterized by ease of processing and low heat shrinkage. Yarn made from this resin exhibit excellent mechanical property.','desc_ar'=>'FY3011E is a polypropylene homopolymer intended for yarn extrusion characterized by ease of processing and low heat shrinkage. Yarn made from this resin exhibit excellent mechanical property.'],

    		['id'=>'17','parent_id'=>'10','slug'=>'hdpe','name_en'=>'HDPE','name_ar'=>'HDPE','desc_en'=>'FY3011E is a polypropylene homopolymer intended for yarn extrusion characterized by ease of processing and low heat shrinkage. Yarn made from this resin exhibit excellent mechanical property.','desc_ar'=>'FY3011E is a polypropylene homopolymer intended for yarn extrusion characterized by ease of processing and low heat shrinkage. Yarn made from this resin exhibit excellent mechanical property.'],
    		['id'=>'18','parent_id'=>'10','slug'=>'lldpe','name_en'=>'LLDPE','name_ar'=>'LLDPE','desc_en'=>'FY3011E is a polypropylene homopolymer intended for yarn extrusion characterized by ease of processing and low heat shrinkage. Yarn made from this resin exhibit excellent mechanical property.','desc_ar'=>'FY3011E is a polypropylene homopolymer intended for yarn extrusion characterized by ease of processing and low heat shrinkage. Yarn made from this resin exhibit excellent mechanical property.'],
    		['id'=>'19','parent_id'=>'10','slug'=>'ldpe','name_en'=>'LDPE','name_ar'=>'LDPE','desc_en'=>'FY3011E is a polypropylene homopolymer intended for yarn extrusion characterized by ease of processing and low heat shrinkage. Yarn made from this resin exhibit excellent mechanical property.','desc_ar'=>'FY3011E is a polypropylene homopolymer intended for yarn extrusion characterized by ease of processing and low heat shrinkage. Yarn made from this resin exhibit excellent mechanical property.'],
    		
    	]);
    }
}
