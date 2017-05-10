<?php

namespace App\Http\Controllers\Backend\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog\Post;
use App\Models\Blog\BlogCategory;
use App\Models\Blog\Tag;
use Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::all();
        return view('backend.blog.post.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blogCategories=BlogCategory::all();
        $tags=Tag::all();
        return view('backend.blog.post.create')->with('blogCategories',$blogCategories)->with('tags',$tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $this->validate($request,[
            'title_en'=>   'required|max:255',
            'body_en' =>   'required',
            'slug' =>   'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'meta_description_en' => 'max:255',
            'meta_description_ar' => 'max:255',
            ]);
        
        $post=new Post;
        $post->title_en=$request->title_en;
        $post->title_ar=$request->title_ar;
        $post->slug=$request->slug;
        $post->blog_category_id=$request->blog_category_id;
        $post->body_en=$request->body_en;
        $post->body_ar=$request->body_ar;
        $post->author_en=$request->author_en;
        $post->author_ar=$request->author_ar;
        $post->featured=(isset($request->featured)) ? 1 : 0;

        $post->meta_title_en=$request->meta_title_en;
        $post->meta_title_ar=$request->meta_title_ar;
        $post->meta_description_en=$request->meta_description_en;
        $post->meta_description_ar=$request->meta_description_ar;

        if ($request->hasFile('image')){
            $image=$request->file('image');
            $post->image=$this->saveImage($image,'');
        }
        
        $post->save();
        $post->tags()->sync($request->tags, false);
        return redirect()->route('posts.index')->with('success','Post added succesfully!');
           
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::find($id);
        return view('backend.blog.post.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::find($id);
        $blogCategories=BlogCategory::all();
        $tags=Tag::all();
        //dd($post->tags()->pluck('tag_id'));
        return view('backend.blog.post.edit')->with('post',$post)->with('blogCategories',$blogCategories)->with('tags',$tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request);
        $this->validate($request,[
            'title_en'=>   'required|max:255',
            'body_en' =>   'required',
            'slug' =>   'required|alpha_dash|min:5|max:255|unique:posts,slug,'.$id,
            'meta_description_en' => 'max:255',
            'meta_description_ar' => 'max:255',
            ]);
        
        $post=Post::find($id);
        $submitReq = $request->submit;

        if($submitReq =="removeImage"){
            $image='image';
            $res=Storage::disk('public')->delete($post->$image);
            if($res){
                $posy->$image="";
                $post->save();
                return back()->with('success','Image deleted successfully!');
            }
            else
                return back()->with('error','Image was not deleted!');
        }

        $post->title_en=$request->title_en;
        $post->title_ar=$request->title_ar;
        $post->slug=$request->slug;
        $post->blog_category_id=$request->blog_category_id;
        $post->body_en=$request->body_en;
        $post->body_ar=$request->body_ar;
        $post->author_en=$request->author_en;
        $post->author_ar=$request->author_ar;
        $post->featured=(isset($request->featured)) ? 1 : 0;

        $post->meta_title_en=$request->meta_title_en;
        $post->meta_title_ar=$request->meta_title_ar;
        $post->meta_description_en=$request->meta_description_en;
        $post->meta_description_ar=$request->meta_description_ar;

        if ($request->hasFile('image')){
            $image=$request->file('image');
            if($post->image)
                $post->image=$this->saveImage($image,$post->image);
            else
                $post->image=$this->saveImage($image,'');
        }

        $post->save();
        if(isset($request->tags))
            $post->tags()->sync($request->tags);
        else
            $post->tags()->sync(array());

        return redirect()->route('posts.index')->with('success','Post updated succesfully!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function saveImage($image,$filename){

     if($filename=="")
        $filename = rand(1,100).time().'.'.$image->getClientOriginalExtension();
      else
        $filename = basename($filename);

      $location='images/posts/';
     
      if (!file_exists(public_path($location))) 
        File::makeDirectory(public_path($location));

      Image::make($image)->save(public_path($location.$filename));
      return $location.$filename;
    }
}
