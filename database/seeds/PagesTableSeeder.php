<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
    		DB::table('pages')->delete();

    		DB::table('pages')->insert([
          ////////////////////*Home Page*/////////////////
          ['id' => 10,'status'=>'1','page_sec_name' => 'home-comp','page_title' => 'Home Page','section_title' =>'Company','is_multi' => '0','has_title' => '1','has_heading1' => '1','has_content' =>'1','has_image' => '1',],

    		  ['id' => 11,'status'=>'1','page_sec_name' => 'home-rating','page_title' => 'Home Page','section_title' => 'Service Rating','is_multi' => '0','has_title' => '1','has_heading1' => '1','has_content' => '1','has_image' => '0',],
			    ['id' => 12,'status'=>'1','page_sec_name' => 'home-ceo','page_title' => 'Home Page','section_title' => 'Ceo Message','is_multi' => '0','has_title' => '1','has_heading1' => '1',
    			'has_content' => '1','has_image' => '1',],
                
			    ['id' => 13,'status'=>'1','page_sec_name' => 'home-publications','page_title' => 'Home Page','section_title' => 'Publications','is_multi' => '1','has_title' => '1','has_heading1' => '0','has_content' => '1','has_image' => '0',],
             
          ['id' => 14,'status'=>'1','page_sec_name' => 'home-slider','page_title' => 'Home Page','section_title' => 'Main Slider','is_multi' => '1','has_title' => '1','has_heading1' => '0','has_content' => '1','has_image' => '1',],

          ////////////////////*About Us Page*/////////////////

          ['id' => 20,'status'=>'1','page_sec_name' => 'about-top-image','page_title' => 'About Us','section_title' => 'Top Image','is_multi' => '0','has_title' => '1','has_heading1' => '0','has_content' => '1','has_image' => '1',],
          ['id' => 21,'status'=>'1','page_sec_name' => 'about-company','page_title' => 'About Us','section_title' => 'Company','is_multi' => '0','has_title' => '1','has_heading1' => '1','has_content' => '1','has_image' => '0',],
          ['id' => 22,'status'=>'1','page_sec_name' => 'about-culture','page_title' => 'About Us','section_title' => 'Our Culture','is_multi' => '0','has_title' => '1','has_heading1' => '1','has_content' => '1','has_image' => '1',],
          ['id' => 23,'status'=>'1','page_sec_name' => 'about-accordian','page_title' => 'About Us','section_title' => 'Accordian','is_multi' => '1','has_title' => '1','has_heading1' => '0','has_content' => '1','has_image' => '0',],


          ////////////////////*Industry Page*/////////////////
          ['id' => 30,'status'=>'1','page_sec_name' => 'industry-top-image','page_title' => 'Industry','section_title' => 'Top Image','is_multi' => '0','has_title' => '1','has_heading1' => '0','has_content' => '1','has_image' => '1',],
          ['id' => 31,'status'=>'1','page_sec_name' => 'industry-innovation','page_title' => 'Industry','section_title' => 'Innovation','is_multi' => '0','has_title' => '1','has_heading1' => '1','has_content' => '1','has_image' => '0',],
          ['id' => 32,'status'=>'1','page_sec_name' => 'industry-culture','page_title' => 'Industry','section_title' => 'Our Culture','is_multi' => '0','has_title' => '1','has_heading1' => '1','has_content' => '1','has_image' => '1',],
          ['id' => 33,'status'=>'1','page_sec_name' => 'industry-accordian','page_title' => 'Industry','section_title' => 'Accordian','is_multi' => '1','has_title' => '1','has_heading1' => '0','has_content' => '1','has_image' => '0',],


                 ////////////////////*Mission Vision Page*/////////////////
          ['id' => 40,'status'=>'1','page_sec_name' => 'mission-top-image','page_title' => 'Mission','section_title' => 'Top Image','is_multi' => '0','has_title' => '1','has_heading1' => '0','has_content' => '1','has_image' => '1',],
          ['id' => 41,'status'=>'1','page_sec_name' => 'mission-vision','page_title' => 'Mission','section_title' => 'Mission and Vision','is_multi' => '0','has_title' => '1','has_heading1' => '1','has_content' => '1','has_image' => '0',],
          ['id' => 42,'status'=>'1','page_sec_name' => 'vision-points','page_title' => 'Mission','section_title' => 'Vision Points','is_multi' => '1','has_title' => '1','has_heading1' => '0','has_content' => '0','has_image' => '0',],
          ['id' => 43,'status'=>'1','page_sec_name' => 'mission-points','page_title' => 'Mission','section_title' => 'Mission Points','is_multi' => '1','has_title' => '1','has_heading1' => '0','has_content' => '0','has_image' => '0',],


          ////////////////////*Approach Page*/////////////////
          ['id' => 50,'status'=>'1','page_sec_name' => 'approach-top-image','page_title' => 'Approach','section_title' => 'Top Image','is_multi' => '0','has_title' => '1','has_heading1' => '0','has_content' => '1','has_image' => '1',],
          ['id' => 51,'status'=>'1','page_sec_name' => 'approach-approach','page_title' => 'Approach','section_title' => 'Our Approach','is_multi' => '0','has_title' => '1','has_heading1' => '0','has_content' => '1','has_image' => '1',],
          ['id' => 52,'status'=>'1','page_sec_name' => 'approach-emp-benefits','page_title' => 'Approach','section_title' => 'Employee Benefits','is_multi' => '0','has_title' => '1','has_heading1' => '0','has_content' => '1','has_image' => '1',],
          ['id' => 53,'status'=>'1','page_sec_name' => 'approach-quality-points','page_title' => 'Approach','section_title' => 'Quality Policy','is_multi' => '1','has_title' => '1','has_heading1' => '0','has_content' => '0','has_image' => '0',],
          ['id' => 54,'status'=>'1','page_sec_name' => 'approach-advantages-points','page_title' => 'Approach','section_title' => 'Advantages','is_multi' => '1','has_title' => '1','has_heading1' => '0','has_content' => '0','has_image' => '0',],

          ////////////////////*Our Team Page*/////////////////
          ['id' => 60,'status'=>'1','page_sec_name' => 'team-top-image','page_title' => 'Our Team','section_title' => 'Top Image','is_multi' => '0','has_title' => '1','has_heading1' => '0','has_content' => '1','has_image' => '1',],
          ['id' => 61,'status'=>'1','page_sec_name' => 'team-team','page_title' => 'Our Team','section_title' => 'Our Team','is_multi' => '0','has_title' => '1','has_heading1' => '1','has_content' => '1','has_image' => '0',],

          ////////////////////*Careers Page*/////////////////
          ['id' => 70,'status'=>'1','page_sec_name' => 'career-top-image','page_title' => 'Careers','section_title' => 'Top Image','is_multi' => '0','has_title' => '1','has_heading1' => '0','has_content' => '1','has_image' => '1',],  
          ['id' => 71,'status'=>'1','page_sec_name' => 'career-culture','page_title' => 'Careers','section_title' => 'Our Culture','is_multi' => '0','has_title' => '1','has_heading1' => '1','has_content' => '1','has_image' => '1',],

           ////////////////////*Contact Page*/////////////////
          ['id' => 80,'status'=>'1','page_sec_name' => 'contact-top-image','page_title' => 'Contact','section_title' => 'Top Image','is_multi' => '0','has_title' => '1','has_heading1' => '0','has_content' => '1','has_image' => '1',],  
                
          ////////////////////*Blog Page*/////////////////
          ['id' => 90,'status'=>'1','page_sec_name' => 'blog-top-image','page_title' => 'Blog','section_title' => 'Top Image','is_multi' => '0','has_title' => '1','has_heading1' => '0','has_content' => '1','has_image' => '1',],  

          ////////////////////*News*/////////////////
          ['id' => 100,'status'=>'1','page_sec_name' => 'news-top-image','page_title' => 'News','section_title' => 'Top Image','is_multi' => '0','has_title' => '1','has_heading1' => '0','has_content' => '1','has_image' => '1',], 

          ////////////////////*Categories*/////////////////
          ['id' => 110,'status'=>'1','page_sec_name' => 'categories-top-image','page_title' => 'Categories','section_title' => 'Top Image','is_multi' => '0','has_title' => '1','has_heading1' => '0','has_content' => '1','has_image' => '1',], 

          ////////////////////*Product List*/////////////////
          ['id' => 120,'status'=>'1','page_sec_name' => 'productlist-top-image','page_title' => 'Product List','section_title' => 'Top Image','is_multi' => '0','has_title' => '1','has_heading1' => '0','has_content' => '1','has_image' => '1',], 

          ////////////////////*Product*/////////////////
          ['id' => 130,'status'=>'1','page_sec_name' => 'product-top-image','page_title' => 'Product','section_title' => 'Top Image','is_multi' => '0','has_title' => '0','has_heading1' => '0','has_content' => '1','has_image' => '1',],

          ////////////////////*Service*/////////////////
          ['id' => 140,'status'=>'1','page_sec_name' => 'service-top-image','page_title' => 'Service','section_title' => 'Top Image','is_multi' => '0','has_title' => '0','has_heading1' => '0','has_content' => '1','has_image' => '1',],

          ////////////////////*Register*/////////////////
          ['id' => 150,'status'=>'1','page_sec_name' => 'register-top-image','page_title' => 'Register','section_title' => 'Top Image','is_multi' => '0','has_title' => '1','has_heading1' => '0','has_content' => '1','has_image' => '1',],
          ['id' => 151,'status'=>'1','page_sec_name' => 'register-benefits','page_title' => 'Register','section_title' => 'Benefits','is_multi' => '1','has_title' => '1','has_heading1' => '0','has_content' => '0','has_image' => '0',],


          ////////////////////*Post*/////////////////
          ['id' => 160,'status'=>'1','page_sec_name' => 'post-top-image','page_title' => 'Post','section_title' => 'Top Image','is_multi' => '0','has_title' => '0','has_heading1' => '0','has_content' => '0','has_image' => '1',],
                

          ]
			);
    	
    }
}
