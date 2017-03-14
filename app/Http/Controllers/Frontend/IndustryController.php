<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Block\Block;
use App\Models\Page\Page;
use Illuminate\Http\Request;

class IndustryController extends Controller
{
	public function show()
    {
	    $topImage = [];
	    $topImage = Page::find(30)->PageSections()->first();

	    $section1 = [];
	    $section1 = Page::find(31)->PageSections()->first();

	    $yellowbox=Block::where('block_type','=','Industry-YellowBox')->first();

	    $section2 = [];
	    $section2 = Page::find(32)->PageSections()->first();

	    $stats=Block::where('block_type','=','Industry-stats')->get();

	    $accordians = [];
	    $accordians=Page::find(33)->PageSections()->get();
	    
	    $quickfact=Block::where('block_type','=','Industry-QuickFact')->first();

	    return view('frontend.industry')->with('topImage',$topImage)->with('section1',$section1)->with('yellowbox',$yellowbox)->with('section2',$section2)->with('stats',$stats)->with('accordians',$accordians)->with('quickfact',$quickfact);
	}
      	
}
