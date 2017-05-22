<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogCategory;
use App\Models\Blog\Post;
use App\Models\Blog\PostComment;
use App\Models\Blog\Tag;
use App\Models\Company\Webpage;
use App\Models\Page\Page;
use App\Notifications\NewPostComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Sentinel;

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
  $blogCategory = BlogCategory::where('slug','=',$slug)->first();
  $posts=$blogCategory->Posts()->paginate(6);
  $blogCategories=BlogCategory::all();
  $tags=Tag::all();
  $topImage = [];
  $topImage = Page::find(90)->PageSections()->first();

  $metatags = Webpage::where('page_name','=','blog')->first();

  return view('frontend.blog')->with('posts',$posts)->with('blogCategories',$blogCategories)->with('tags',$tags)->with('topImage',$topImage)->with('metatags',$metatags);
}

public function tagPosts($slug)
{
  $tag=Tag::where('slug','=',$slug)->first();
  $posts=$tag->posts()->paginate(6);
  $blogCategories=BlogCategory::all();
  $tags=Tag::all();
  $topImage = [];
  $topImage = Page::find(90)->PageSections()->first();

  $metatags = Webpage::where('page_name','=','blog')->first();


  return view('frontend.blog')->with('posts',$posts)->with('blogCategories',$blogCategories)->with('tags',$tags)->with('topImage',$topImage)->with('metatags',$metatags);
}


public function post($slug)
{
 $post=Post::where('slug','=',$slug)->first();

 $topImage = [];
 $topImage = Page::find(160)->PageSections()->first();

 $blogCategories=BlogCategory::all();
 return view('frontend.post')->with('post',$post)->with('blogCategories',$blogCategories)->with('topImage',$topImage);
}

public function postComment(Request $request,$post_id)
{

 $this->validate($request, [
  'name' =>'required|max:255',
  'email' =>'required|email',
  'message' =>'required|min:10|max:500',
  'g-recaptcha-response' => 'required|captcha'
  ],
  $messages= [
  'g-recaptcha-response.required' => 'Prove you are not a robot',
  'g-recaptcha-response.captcha' => 'Prove you are not a robot'

  ]);


 $postComment =  new PostComment();
 $postComment->post_id=$post_id;
 $postComment->name = $request->name;
 $postComment->email = $request->email;
 $postComment->website = $request->website;
 $postComment->message = $request->message;
 $postComment->ip_address = $request->ip();
 $postComment->save();

     //Send Notification to Super admin
      //Get all super admins
 $role = Sentinel::findRoleBySlug('super-admin');
 $users = $role->users()->with('roles')->get();
 Notification::send($users, new NewPostComment($postComment,"backend"));

 return redirect()->back()->with('success',__('Your comment was posted succesfully!'));

}


}
