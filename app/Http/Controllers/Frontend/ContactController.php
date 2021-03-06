<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Company\Webpage;
use App\Models\Location\Location;
use App\Models\Page\Page;
use App\User;
use Illuminate\Http\Request;

class ContactController extends Controller
{
	public function show()
	{
		$topImage = [];
		$topImage = Page::find(80)->PageSections()->first();
		$locations = Location::where('status','=','1')->get();
		$metatags = Webpage::where('page_name','=','contact')->first();


		return view('frontend.contact')->with('locations',$locations)->with('topImage',$topImage)->with('metatags',$metatags);
	}
}
