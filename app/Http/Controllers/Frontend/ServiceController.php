<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page\Page;
use App\Models\Service\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function show($slug)
    {
 
        $service=Service::where([['slug','=',$slug],['status','=','1']])->first();
        $topImage = Page::find(140)->PageSections()->first();

        if($service)
            return view('frontend.service')->with('service',$service)->with('topImage',$topImage);
        else
            abort(403, 'Unauthorized action.');
    }
}
