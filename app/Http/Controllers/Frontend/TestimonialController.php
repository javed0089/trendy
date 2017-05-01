<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Company\Webpage;
use App\Models\Page\Page;
use App\Models\Testimonials\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function show()
    {
    	$testimonials = Testimonial::where('status','=','1')->paginate(9);
        $topImage = [];
        $topImage = Page::find(170)->PageSections()->first();
        $metatags = Webpage::where('page_name','=','testimonials')->first();
    	return view('frontend.testimonials')->with('testimonials',$testimonials)->with('topImage',$topImage)->with('metatags',$metatags);
    }
}
