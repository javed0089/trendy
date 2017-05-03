<?php

namespace App\Http\Controllers\Backend\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog\BlogCategory;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $blogCategories=BlogCategory::all();
       return view('backend.blog.blogCategory.index')->with('blogCategories',$blogCategories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request,[
            'name_en'=>   'required|max:255',
            'name_ar' =>   'required|max:255',
            'slug' =>   'required|alpha_dash|min:5|max:255|unique:blog_categories,slug'

            ]);
        
        $blogCategory=new BlogCategory;
        $blogCategory->name_en=$request->name_en;
        $blogCategory->name_ar=$request->name_ar;
        $blogCategory->slug=$request->slug;
        
        $blogCategory->save();
        return back()->with('success','Blog Category added succesfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blogCategory=BlogCategory::find($id);
        $blogCategories=BlogCategory::all();
       return view('backend.blog.blogCategory.index')->with('blogCategory',$blogCategory)->with('blogCategories',$blogCategories);
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
         $this->validate($request,[
            'name_en'=>   'required|max:255',
            'name_ar' =>   'required|max:255',
            'slug' =>   'required|alpha_dash|min:5|max:255|unique:blog_categories,slug,'.$id
            ]);
        
        $blogCategory=BlogCategory::find($id);
        $blogCategory->name_en=$request->name_en;
        $blogCategory->name_ar=$request->name_ar;
        $blogCategory->slug=$request->slug;

        $blogCategory->save();
        return redirect()->route('blogcategory.index')->with('success','Blog Category updated succesfully!');
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
}
