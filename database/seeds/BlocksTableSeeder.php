<?php

use Illuminate\Database\Seeder;

class BlocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        	DB::table('blocks')->delete();

    		DB::table('blocks')->insert([

                //header
    			['block_type'=>'header','title_en'=>'CALL US','title_ar'=>'اتصل بنا','title_enabled'=>'0',
    				'value_en'=>'423423423423','value_ar'=>'23432566','image'=>'','has_image'=>'0'],
                ['block_type'=>'header','title_en'=>'EMAIL US','title_ar'=>'EMAIL US','title_enabled'=>'0',
                    'value_en'=>'info@gap_polymers.com','value_ar'=>'info@gap_polymers.com','image'=>'','has_image'=>'0'],
                ['block_type'=>'header','title_en'=>'MARKET','title_ar'=>'MARKET','title_enabled'=>'0',
                    'value_en'=>'256.78  + 4.26','value_ar'=>'256.78  + 4.26','image'=>'','has_image'=>'0'],


                //social 
                ['block_type'=>'social','title_en'=>'facebook','title_ar'=>'facebook','title_enabled'=>'1',
                    'value_en'=>'https://www.facebook.com/','value_ar'=>'https://www.facebook.com/','image'=>'','has_image'=>'0'],
                ['block_type'=>'social','title_en'=>'twitter','title_ar'=>'twitter','title_enabled'=>'1',
                    'value_en'=>'https://www.twitter.com/','value_ar'=>'https://www.twitter.com/','image'=>'','has_image'=>'0'],
                ['block_type'=>'social','title_en'=>'linkedin','title_ar'=>'linkedin','title_enabled'=>'1',
                    'value_en'=>'https://www.linkedin.com/','value_ar'=>'https://www.linkedin.com/','image'=>'','has_image'=>'0'],
                ['block_type'=>'social','title_en'=>'google-plus','title_ar'=>'google-plus','title_enabled'=>'1',
                    'value_en'=>'https://www.google.com/','value_ar'=>'https://www.google.com/','image'=>'','has_image'=>'0'],
                ['block_type'=>'social','title_en'=>'instagram','title_ar'=>'instagram','title_enabled'=>'1',
                    'value_en'=>'https://www.instagram.com/','value_ar'=>'https://www.instagram.com/','image'=>'','has_image'=>'0'],

                //Homepage Stats
                ['block_type'=>'homepage-stats','title_en'=>'Offices Worldwide','title_ar'=>'Offices Worldwide','title_enabled'=>'0','value_en'=>'26','value_ar'=>'26','image'=>'','has_image'=>'1'],
                ['block_type'=>'homepage-stats','title_en'=>'Satisfied Employees','title_ar'=>'Satisfied Employees','title_enabled'=>'0','value_en'=>'10000','value_ar'=>'10000','image'=>'','has_image'=>'1'],
                ['block_type'=>'homepage-stats','title_en'=>'Refineries & Operations','title_ar'=>'Refineries & Operations','title_enabled'=>'0','value_en'=>'35','value_ar'=>'35','image'=>'','has_image'=>'1'],
                ['block_type'=>'homepage-stats','title_en'=>'Awards & Recognitions
                    ','title_ar'=>'Awards & Recognitions
                    ','title_enabled'=>'0','value_en'=>'126','value_ar'=>'126','image'=>'','has_image'=>'1'],

                //Homepage Categories text
                ['block_type'=>'homepage-categories','title_en'=>'empty','title_ar'=>'empty','title_enabled'=>'1','value_en'=>'Objectively whiteboard transparent models for prospective information. Authoritatively myocardinate.','value_ar'=>'Objectively whiteboard transparent models for prospective 
                    information. Authoritatively myocardinate.','image'=>'','has_image'=>'0'],


                //Footer
                ['block_type'=>'footer','title_en'=>'HEAD OFFICE','title_ar'=>'HEAD OFFICE','title_enabled'=>'0','value_en'=>'PO Box 16122, Collins Street West, 
                    Victoria 8007 Australia','value_ar'=>'PO Box 16122, Collins Street West, 
                    Victoria 8007 Australia','image'=>'','has_image'=>'0'],
                ['block_type'=>'footer','title_en'=>'CALL US','title_ar'=>'CALL US','title_enabled'=>'0','value_en'=>'SUPPORT: 1800 425 4646 OFFICE: +1 (253) 2587 220','value_ar'=>'SUPPORT: 1800 425 4646 OFFICE: +1 (253) 2587 220','image'=>'','has_image'=>'0'],
                ['block_type'=>'footer','title_en'=>'EMAIL US','title_ar'=>'EMAIL US','title_enabled'=>'0','value_en'=>'hello@offshoreindustry.com <br> sales@offshoreindustry.com','value_ar'=>'hello@offshoreindustry.com <br> sales@offshoreindustry.com','image'=>'','has_image'=>'0'],
                ['block_type'=>'footer','title_en'=>'empty','title_ar'=>'empty','title_enabled'=>'1','value_en'=>'Our mission in business is to become the pioneer in our field by giving our customers the exceptional services that even the biggest multinational firm would have a hard time providing. Our business principle is to have long term relation with mutual benefits under the umbrella of U WIN I WIN . !','value_ar'=>'Our mission in business is to become the pioneer in our field by giving our customers the exceptional services that even the biggest multinational firm would have a hard time providing. Our business principle is to have long term relation with mutual benefits under the umbrella of U WIN I WIN . !','image'=>'','has_image'=>'0'],

                //About us
                 ['block_type'=>'About-QuickFact','title_en'=>'Quick Fact','title_ar'=>'Quick Fact','title_enabled'=>'0','value_en'=>'Distinctively fashion in the effect of standard products communities via seamless applications. Authoritatively recaptiualize.','value_ar'=>'Distinctively fashion in the effect of standard products communities via seamless applications. Authoritatively recaptiualize.','image'=>'','has_image'=>'0'],
                //About YellowBox
                ['block_type'=>'About-YellowBox','title_en'=>'empty','title_ar'=>'empty','title_enabled'=>'1','value_en'=>'Wealth can only be accumulated by the earnings of industry and the savings of frugality.','value_ar'=>'Wealth can only be accumulated by the earnings of industry and the savings of frugality.','image'=>'','has_image'=>'0'],
                //About Stats
                ['block_type'=>'About-Stats','title_en'=>'Offices Worldwide','title_ar'=>'Offices Worldwide','title_enabled'=>'0','value_en'=>'26','value_ar'=>'26','image'=>'','has_image'=>'1'],
                ['block_type'=>'About-Stats','title_en'=>'Satisfied Employees','title_ar'=>'Satisfied Employees','title_enabled'=>'0','value_en'=>'10000','value_ar'=>'10000','image'=>'','has_image'=>'1'],
                ['block_type'=>'About-Stats','title_en'=>'Refineries & Operations','title_ar'=>'Refineries & Operations','title_enabled'=>'0','value_en'=>'35','value_ar'=>'35','image'=>'','has_image'=>'1'],
                ['block_type'=>'About-Stats','title_en'=>'Awards & Recognitions
                    ','title_ar'=>'Awards & Recognitions
                    ','title_enabled'=>'0','value_en'=>'126','value_ar'=>'126','image'=>'','has_image'=>'1'],

                //Industry
                ['block_type'=>'Industry-QuickFact','title_en'=>'Quick Fact','title_ar'=>'Quick Fact','title_enabled'=>'0','value_en'=>'Distinctively fashion in the effect of standard products communities via seamless applications. Authoritatively recaptiualize.','value_ar'=>'Distinctively fashion in the effect of standard products communities via seamless applications. Authoritatively recaptiualize.','image'=>'','has_image'=>'0'],

                ['block_type'=>'Industry-YellowBox','title_en'=>'empty','title_ar'=>'empty','title_enabled'=>'1','value_en'=>'Wealth can only be accumulated by the earnings of industry and the savings of frugality.','value_ar'=>'Wealth can only be accumulated by the earnings of industry and the savings of frugality.','image'=>'','has_image'=>'0'],

                //Industry Stats
                ['block_type'=>'Industry-Stats','title_en'=>'Offices Worldwide','title_ar'=>'Offices Worldwide','title_enabled'=>'0','value_en'=>'26','value_ar'=>'26','image'=>'','has_image'=>'1'],
                ['block_type'=>'Industry-Stats','title_en'=>'Satisfied Employees','title_ar'=>'Satisfied Employees','title_enabled'=>'0','value_en'=>'10000','value_ar'=>'10000','image'=>'','has_image'=>'1'],
                ['block_type'=>'Industry-Stats','title_en'=>'Refineries & Operations','title_ar'=>'Refineries & Operations','title_enabled'=>'0','value_en'=>'35','value_ar'=>'35','image'=>'','has_image'=>'1'],
                ['block_type'=>'Industry-Stats','title_en'=>'Awards & Recognitions
                    ','title_ar'=>'Awards & Recognitions
                    ','title_enabled'=>'0','value_en'=>'126','value_ar'=>'126','image'=>'','has_image'=>'1'],

                //Mission
                ['block_type'=>'Mission-QuickFact','title_en'=>'Quick Fact','title_ar'=>'Quick Fact','title_enabled'=>'0','value_en'=>'Distinctively fashion in the effect of standard products communities via seamless applications. Authoritatively recaptiualize.','value_ar'=>'Distinctively fashion in the effect of standard products communities via seamless applications. Authoritatively recaptiualize.','image'=>'','has_image'=>'0'],

                //Approach
                ['block_type'=>'Approach-QuickFact','title_en'=>'Quick Fact','title_ar'=>'Quick Fact','title_enabled'=>'0','value_en'=>'Distinctively fashion in the effect of standard products communities via seamless applications. Authoritatively recaptiualize.','value_ar'=>'Distinctively fashion in the effect of standard products communities via seamless applications. Authoritatively recaptiualize.','image'=>'','has_image'=>'0'],
                ['block_type'=>'Approach-YellowBox','title_en'=>'empty','title_ar'=>'empty','title_enabled'=>'1','value_en'=>'Wealth can only be accumulated by the earnings of industry and the savings of frugality.','value_ar'=>'Wealth can only be accumulated by the earnings of industry and the savings of frugality.','image'=>'','has_image'=>'0'],

                 //Our Team
                ['block_type'=>'Team-QuickFact','title_en'=>'Quick Fact','title_ar'=>'Quick Fact','title_enabled'=>'0','value_en'=>'Distinctively fashion in the effect of standard products communities via seamless applications. Authoritatively recaptiualize.','value_ar'=>'Distinctively fashion in the effect of standard products communities via seamless applications. Authoritatively recaptiualize.','image'=>'','has_image'=>'0'],
                ['block_type'=>'Team-Leaders','title_en'=>'OUR LEADERS','title_ar'=>'OUR LEADERS','title_enabled'=>'0','value_en'=>'Objectively whiteboard transparent models for prospective information. Authoritatively myocardinate.','value_ar'=>'Objectively whiteboard transparent models for prospective information. Authoritatively myocardinate.','image'=>'','has_image'=>'0'],

                 //Career
                ['block_type'=>'Career-Work','title_en'=>'COME. WORK WITH US','title_ar'=>'COME. WORK WITH US','title_enabled'=>'0','value_en'=>'Objectively whiteboard transparent models for prospective information. Authoritatively myocardinate.','value_ar'=>'Objectively whiteboard transparent models for prospective information. Authoritatively myocardinate.','image'=>'','has_image'=>'0'],

                 //Blog
                ['block_type'=>'Blog-QuickFact','title_en'=>'Quick Fact','title_ar'=>'Quick Fact','title_enabled'=>'0','value_en'=>'Distinctively fashion in the effect of standard products communities via seamless applications. Authoritatively recaptiualize.','value_ar'=>'Distinctively fashion in the effect of standard products communities via seamless applications. Authoritatively recaptiualize.','image'=>'','has_image'=>'0'],

    		]);
    }
}
