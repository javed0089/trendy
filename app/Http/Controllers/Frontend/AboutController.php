<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Block\Block;
use App\Models\Page\Page;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function show()
    {
 
        $topImage = [];
    	$topImage = Page::find(20)->PageSections()->first();

    	$section1 = [];
    	$section1 = Page::find(21)->PageSections()->first();

    	$yellowbox=Block::where('block_type','=','About-YellowBox')->first();

    	$section2 = [];
    	$section2 = Page::find(22)->PageSections()->first();

    	$stats=Block::where('block_type','=','about-stats')->get();

    	$accordians = [];
    	$accordians=Page::find(23)->PageSections()->get();

    	$quickfact=Block::where('block_type','=','About-QuickFact')->first();

    	return view('frontend.about')->with('topImage',$topImage)->with('section1',$section1)->with('yellowbox',$yellowbox)->with('section2',$section2)->with('stats',$stats)->with('accordians',$accordians)->with('quickfact',$quickfact);
      	

    }
}
