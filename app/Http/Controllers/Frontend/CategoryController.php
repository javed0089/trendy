<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page\Page;
use App\Models\Product\Category;
use App\Models\Product\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
    	$categories=Category::all();
        $topImage = Page::find(110)->PageSections()->first();

    	return view('frontend.categories')->with('categories',$categories)->with('topImage',$topImage);
    }

    public function productlist($slug)
    {
    	$categories=Category::where('parent_id','=','0')->get();
    	//$categories=Category::all();
        $category=Category::where('slug','=',$slug)->get();
        //dd($category);
    	$products=Product::where('category_id','=',$category->first()->id)->get();
    	//dd($products);

        $topImage = Page::find(120)->PageSections()->first();

    	return view('frontend.productlist')->with('categories',$categories)->with('products',$products)->with('topImage',$topImage);
    }

    public function product($slug)
    {
 
        $product=Product::where('slug','=',$slug)->first();
        $topImage = Page::find(130)->PageSections()->first();

        if($product)
            return view('frontend.product')->with('product',$product)->with('topImage',$topImage);
        else
            abort(403, 'Unauthorized action.');
    }
}
