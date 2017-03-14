<?php

use Illuminate\Database\Seeder;

class PageSectionsTableSeeder extends Seeder
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
    			['id' => 10,'page_id'=>'21','title_en' => 'THE COMPANY','title_ar' => 'THE COMPANY','heading1_en' => 'Uniquely transform premier infrastructures before functional metrics. Completely mesh sustainable leadership for economically sound sources.','heading1_ar' => 'Uniquely transform premier infrastructures before functional metrics. Completely mesh sustainable leadership for economically sound sources.','content_en' => '<p>Distinctively fashion standardized communities vis-a-vis seamless applications. Authoritatively recaptiualize efficient supply chains without vertical initiatives. Progressively visualize strategic relationships with error-free processes. Credibly strategize fully tested outsourcing with functional e-markets. Dynamically evisculate user friendly architectures before cross-media experiences. Interactively disintermediate empowered data whereas distinctive human capital. Compellingly utilize.</p>','content_ar' => '<p>Distinctively fashion standardized communities vis-a-vis seamless applications. Authoritatively recaptiualize efficient supply chains without vertical initiatives. Progressively visualize strategic relationships with error-free processes. Credibly strategize fully tested outsourcing with functional e-markets. Dynamically evisculate user friendly architectures before cross-media experiences. Interactively disintermediate empowered data whereas distinctive human capital. Compellingly utilize.</p>','image_en' => '','image_ar' => '',],
    		]);
    }
}
