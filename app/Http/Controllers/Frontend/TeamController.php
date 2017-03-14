<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Block\Block;
use App\Models\Page\Page;
use App\Models\Team\Member;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function show()
    {
	    $topImage = [];
	    $topImage = Page::find(60)->PageSections()->first();

	    $section1 = [];
	    $section1 = Page::find(61)->PageSections()->first();

	    $leaders=Block::where('block_type','=','Team-Leaders')->first();
	    
	    $quickfact=Block::where('block_type','=','Team-QuickFact')->first();

	    $members = Member::where('status', '=','1')->get();

	    return view('frontend.team')->with('topImage',$topImage)->with('section1',$section1)->with('leaders',$leaders)->with('quickfact',$quickfact)->with('members',$members);
	}
}
