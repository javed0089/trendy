<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Block\Block;
use App\Models\Page\Page;
use App\Models\Product\Brand;
use App\Models\Product\Category;
use App\Models\Product\Product;
use App\Models\Testimonials\Testimonial;
use App\Models\Blog\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;


class HomepageController extends Controller
{
    
    public function index()
    {
//Session::flush();
        $homepageCompBlock=[];
    	$pageComp=Page::find(10);
    	$homepageCompBlock=$pageComp->PageSections()->first();

        $homepageServBlock=[];
    	$pageServ=Page::find(11);
    	$homepageServBlock=$pageServ->PageSections()->first();

        $homepageCeoBlock=[];
    	$pageCeo=Page::find(12);
    	$homepageCeoBlock=$pageCeo->PageSections()->first();
      
        $homepagePubBlock=[];
    	$pagePub=Page::find(13);
		$homepagePubBlock=$pagePub->PageSections()->get();

        $pageSliders=Page::find(14);
        $homepageSliders;
        if($pageSliders)
            $homepageSliders=$pageSliders->PageSections()->get();
    	
        $homepageCategoryText=Block::where('block_type','=','homepage-categories')->get();

        $categories=Category::where('parent_id','=','0')->get();
        $products=Product::where('featured','=','1')->limit(3)->get();
        $stats=Block::where('block_type','=','homepage-stats')->get();

        $testimonials=Testimonial::where('featured','=','1')->take(3)->get();
        $posts=Post::where('featured','=','1')->get();
        $brands=Brand::all();

    	return view('frontend.index')->with('CompBlock',$homepageCompBlock)->with('ServBlock',$homepageServBlock)->with('PubBlocks',$homepagePubBlock)->with('CeoBlock',$homepageCeoBlock)->with('SlidersBlock',$homepageSliders)->with('categories',$categories)->with('homepageCategoryText',$homepageCategoryText)->with('testimonials',$testimonials)->with('products',$products)->with('posts',$posts)->with('brands',$brands)->with('stats',$stats);


    
    }

    
}
