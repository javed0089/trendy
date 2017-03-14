<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PageContent;

class HomePageController extends Controller
{
    //
    public function companySection()
    {
    	$homepageCompBlock=PageContent::where([['page_name_slug','=','homepage'],['section_name_slug','=','section-company']])->first();
    	return view('backend.hpcompanysection')->with('CompBlock',$homepageCompBlock);
    }
}
