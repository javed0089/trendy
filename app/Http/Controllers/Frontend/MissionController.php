<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Block\Block;
use App\Models\Company\Webpage;
use App\Models\Page\Page;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    public function show()
    {
	    $topImage = [];
	    $topImage = Page::find(40)->PageSections()->first();

	    $section1 = [];
	    $section1 = Page::find(41)->PageSections()->first();

	    $yellowbox=Block::where('block_type','=','Mission-YellowBox')->first();

	    $vision = [];
	    $vision = Page::find(42)->PageSections()->get();

	    $mission = [];
	    $mission=Page::find(43)->PageSections()->get();
	    
	    $quickfact=Block::where('block_type','=','Mission-QuickFact')->first();
	    $metatags = Webpage::where('page_name','=','mission')->first();

	    return view('frontend.mission')->with('topImage',$topImage)->with('section1',$section1)->with('yellowbox',$yellowbox)->with('vision',$vision)->with('mission',$mission)->with('quickfact',$quickfact)->with('metatags',$metatags);
	}
}
