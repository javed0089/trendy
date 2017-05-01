<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Company\Webpage;
use App\Models\News\News;
use App\Models\Page\Page;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
    	$news = News::where('status','=','1')->paginate(6);
        $topImage = [];
        $topImage = Page::find(100)->PageSections()->first();
        $metatags = Webpage::where('page_name','=','news')->first();
    	return view('frontend.news')->with('newsCol',$news)->with('topImage',$topImage)->with('metatags',$metatags);
    }

    public function show($id)
    {
    	$news = News::find($id);
        $topImage = [];
        $topImage = Page::find(100)->PageSections()->first();
    	return view('frontend.newsdetail')->with('news',$news)->with('topImage',$topImage);
    }
}
