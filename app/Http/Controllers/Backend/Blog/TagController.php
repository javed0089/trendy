<?php

namespace App\Http\Controllers\Backend\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $tags=Tag::all();
       return view('backend.blog.tag.index')->with('tags',$tags);
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
            'slug' =>   'required|alpha_dash|min:5|max:255|unique:tags,slug'

            ]);
        
        $tag=new Tag;
        $tag->name_en=$request->name_en;
        $tag->name_ar=$request->name_ar;
        $tag->slug=$request->slug;
       
        
        $tag->save();
        return back()->with('success','Tag added succesfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag=Tag::find($id);
        $tags=Tag::all();
       return view('backend.blog.tag.index')->with('tag',$tag)->with('tags',$tags);;
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
            'slug' =>   'required|alpha_dash|min:5|max:255|unique:tags,slug,'.$id

            ]);
        
        $tag=Tag::find($id);
        $tag->name_en=$request->name_en;
        $tag->name_ar=$request->name_ar;
        $tag->slug=$request->slug;
       
        
        $tag->save();
        return redirect()->route('tags.index')->with('success','Tag updated succesfully!');
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
