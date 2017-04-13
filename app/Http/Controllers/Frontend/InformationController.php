<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Information\Information;
use App\Models\Information\InformationType;
use App\Models\Page\Page;
use Illuminate\Http\Request;

class InformationController extends Controller
{
	public function show($slug)
	{
		$topImage = [];
    	$topImage = Page::find(80)->PageSections()->first();
		$infoTypeId = InformationType::where('slug','=',$slug)->first();
		if($infoTypeId){
			$information = Information::where([['information_type_id','=',$infoTypeId->id],['status','=','1']])->first();
		}

		if($information)
            return view('frontend.information')->with('information',$information)->with('topImage',$topImage);
        else
            abort(403, 'Unauthorized action.');
	}
}
