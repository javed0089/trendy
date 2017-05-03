<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogCategory;
use App\Models\Blog\Post;
use App\Models\Blog\Tag;
use App\Models\Company\Webpage;
use App\Models\Page\Page;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
    	$posts=Post::paginate(6);
    	$blogCategories=BlogCategory::all();
    	$tags=Tag::all();

        $topImage = [];
        $topImage = Page::find(90)->PageSections()->first();

        $metatags = Webpage::where('page_name','=','blog')->first();

        return view('frontend.blog')->with('posts',$posts)->with('blogCategories',$blogCategories)->with('tags',$tags)->with('topImage',$topImage)->with('metatags',$metatags);
    }

    public function categoryPosts($slug)
    {
        $posts=Post::where('slug','=',$slug)->paginate(6);

        $blogCategories=BlogCategory::all();
        $tags=Tag::all();

        return view('frontend.blog')->with('posts',$posts)->with('blogCategories',$blogCategories)->with('tags',$tags);
    }

    public function tagPosts($slug)
    {
        $tag=Tag::where('slug','=',$slug)->first();
        $posts=$tag->posts()->paginate(6);
        $blogCategories=BlogCategory::all();
        $tags=Tag::all();
        return view('frontend.blog')->with('posts',$posts)->with('blogCategories',$blogCategories)->with('tags',$tags);
    }


    public function post($slug)
    {
    	$post=Post::where('slug','=',$slug);
        $topImage = [];
        $topImage = Page::find(160)->PageSections()->first();

        $blogCategories=BlogCategory::all();
        return view('frontend.post')->with('post',$post->first())->with('blogCategories',$blogCategories)->with('topImage',$topImage);
    }


}
