<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Company\Webpage;
use App\Models\Page\Page;
use App\Models\Product\Brand;
use App\Models\Product\Category;
use App\Models\Product\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
    	$categories=Category::all();
        $topImage = Page::find(110)->PageSections()->first();
        $metatags = Webpage::where('page_name','=','categories')->first();

        return view('frontend.categories')->with('categories',$categories)->with('topImage',$topImage)->with('metatags',$metatags);
    }

    public function productlist($slug)
    {
    	$categories=Category::where('parent_id','=','0')->get();
        $category=Category::where('slug','=',$slug)->first();

        $subCategories = Category::where('parent_id','=',$category->id)->get();
        $products=Product::where([['category_id','=',$category->id],['discontinued','=','0']])->get();

        $brands = Brand::all();

        $topImage = Page::find(120)->PageSections()->first();

        return view('frontend.productlist')->with('categories',$categories)->with('products',$products)->with('topImage',$topImage)->with('subCategories',$subCategories)->with('brands',$brands)->with('category',$category);
    }

    public function productsByBrand($slug)
    {
        $categories=Category::where('parent_id','=','0')->get();
        $brand=Brand::where('slug','=',$slug)->first();
        $subCategories=[];
        $products=Product::where([['brand_id','=',$brand->id],['discontinued','=','0']])->get();

        $brands = Brand::all();

        $topImage = Page::find(120)->PageSections()->first();

        return view('frontend.productlist')->with('categories',$categories)->with('products',$products)->with('topImage',$topImage)->with('subCategories',$subCategories)->with('brands',$brands)->with('brand',$brand);
    }

    public function product($slug)
    {

        $product=Product::where('slug','=',$slug)->first();
        $topImage = Page::find(130)->PageSections()->first();

        $relatedProds = Product::where([['category_id','=',$product->category->id],['id','!=',$product->id]])->inRandomOrder()->take(3)->get();
        if(!count($relatedProds) >0 )
        {
            $relatedProds = Product::where([['id','!=',$product->id]])->inRandomOrder()->take(3)->get();
        }

        if($product)
            return view('frontend.product')->with('product',$product)->with('topImage',$topImage)->with('relatedProds',$relatedProds);
        else
            abort(403, 'Unauthorized action.');
    }
}
