<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News\News;
use App\Models\Page\Page;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
    	$news = News::where('status','=','1')->get();
        $topImage = [];
        $topImage = Page::find(100)->PageSections()->first();
    	return view('frontend.news')->with('newsCol',$news)->with('topImage',$topImage);
    }

    public function show($id)
    {
    	$news = News::find($id);
        $topImage = [];
        $topImage = Page::find(100)->PageSections()->first();
    	return view('frontend.newsdetail')->with('news',$news)->with('topImage',$topImage);
    }
}
