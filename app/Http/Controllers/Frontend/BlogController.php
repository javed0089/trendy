<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page\Page;
use App\Models\Blog\BlogCategory;
use App\Models\Blog\Post;
use App\Models\Blog\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
    	$posts=Post::all();
    	$blogCategories=BlogCategory::all();
    	$tags=Tag::all();

        $topImage = [];
        $topImage = Page::find(90)->PageSections()->first();

    	return view('frontend.blog')->with('posts',$posts)->with('blogCategories',$blogCategories)->with('tags',$tags)->with('topImage',$topImage);
    }

    public function categoryPosts($blogCategoryId)
    {
        $posts=Post::where('blog_category_id','=',$blogCategoryId)->get();
        $blogCategories=BlogCategory::all();
        $tags=Tag::all();
        return view('frontend.blog')->with('posts',$posts)->with('blogCategories',$blogCategories)->with('tags',$tags);
    }

    public function tagPosts($tagId)
    {
        $tag=Tag::find($tagId);
        $posts=$tag->posts;
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
