<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Block\Block;
use App\Models\Company\Webpage;
use App\Models\Page\Page;
use Illuminate\Http\Request;

class ApproachController extends Controller
{
    public function show()
    {
	    $topImage = [];
	    $topImage = Page::find(50)->PageSections()->first();

	    $section1 = [];
	    $section1 = Page::find(51)->PageSections()->first();

	    $section2 = [];
	    $section2 = Page::find(52)->PageSections()->first();

	    $yellowbox=Block::where('block_type','=','Approach-YellowBox')->first();

	    $quality = [];
	    $quality = Page::find(53)->PageSections()->get();

	    $advantages = [];
	    $advantages=Page::find(54)->PageSections()->get();
	    
	    $quickfact=Block::where('block_type','=','Approach-QuickFact')->first();

	    $metatags = Webpage::where('page_name','=','approach')->first();

	    return view('frontend.approach')->with('topImage',$topImage)->with('section1',$section1)->with('section2',$section2)->with('yellowbox',$yellowbox)->with('quality',$quality)->with('advantages',$advantages)->with('quickfact',$quickfact)->with('metatags',$metatags);
	}
}
