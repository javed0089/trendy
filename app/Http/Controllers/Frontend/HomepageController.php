<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Block\Block;
use App\Models\Blog\Post;
use App\Models\Company\Company;
use App\Models\Company\Webpage;
use App\Models\Page\Page;
use App\Models\Product\Brand;
use App\Models\Product\Category;
use App\Models\Product\Product;
use App\Models\Rating\Rating;
use App\Models\Subscriber\Subscriber;
use App\Models\Testimonials\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Input;
use Sentinel;

class HomepageController extends Controller
{

    public function index()
    {

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
        $posts=Post::where('featured','=','1')->take(3)->get();
        $brands=Brand::all();

        $ratings = new Rating();

        $company = Company::first();
        $metatags = Webpage::where('page_name','=','homepage')->first();

        return view('frontend.index')->with('CompBlock',$homepageCompBlock)->with('ServBlock',$homepageServBlock)->with('PubBlocks',$homepagePubBlock)->with('CeoBlock',$homepageCeoBlock)->with('SlidersBlock',$homepageSliders)->with('categories',$categories)->with('homepageCategoryText',$homepageCategoryText)->with('testimonials',$testimonials)->with('products',$products)->with('posts',$posts)->with('brands',$brands)->with('stats',$stats)->with('ratings',$ratings)->with('company',$company)->with('metatags',$metatags);



    }


    public function rateService(Request $request)
    {

        if(Sentinel::check()){
            $rating = Rating::where([['user_id','=',Sentinel::check()->id],['rating_type','=','1']])->first();

            if(count($rating)>0){
                $rating->rating = $request->rating;
                $rating->save();
                return redirect()->back()->with(['success' => "Thank you for your feedback!"]);
            }
            else{
                $rating = new Rating;
                $rating->rating = $request->rating;
                $rating->rating_type = '1';
                $rating->order_id = 0;
                $rating->user_id = Sentinel::check()->id;
                $rating->save();
                return redirect()->back()->with(['success' => "Thank you for your feedback!"]);
            }
        }
        else{
            return redirect()->route('frontend.login')->with('error',"You must login first!");
            
        }

    }


    public function subscribe(Request $request)
    {
        $this->validate($request, [
            'email' =>'required|email|unique:subscribers,email',
            ],$messages = [
            'email.unique' => 'E-mail address already registered!',
            ]);

        $subscriber = new Subscriber;
        $subscriber->email =$request->email;
        $subscriber->ip_address =\Request::ip();
        $subscriber->save();
        if($subscriber)
        {
            $response = array(
              'status' => 'success',
              'msg' => 'Thank you for subscribing!',
              );
        }
        else
        {
            $response = array(
              'status' => 'error',
              'msg' => 'There was an error!',
              );
        }

        return response()->json($response);

    }

}

