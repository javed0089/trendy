<?php

namespace App\Http\Controllers\Backend\News;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news= News::all();    
        return view('backend.news.index')->with('newsCol',$news);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.news.create');
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
            'title_en'=>   'required|max:255',
            ]);
        
        $news=new News;
        $news->title_en=$request->title_en;
        $news->title_ar=$request->title_ar;
        $news->desc_en=$request->desc_en;
        $news->desc_ar=$request->desc_ar;
        $news->status=(isset($request->status)) ? 1 : 0;

        $news->meta_title_en=$request->meta_title_en;
        $news->meta_title_ar=$request->meta_title_ar;
        $news->meta_description_en=$request->meta_description_en;
        $news->meta_description_ar=$request->meta_description_ar;
                
        $news->save();
        return redirect(route('news.index'))->with('success','Record saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news= News::find($id);
        return view('backend.news.show')->with('news',$news);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);
        return view('backend.news.edit')->with('news',$news);
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
            'title_en'=>   'required|max:255',
            ]);
        
        $news= News::find($id);
        $news->title_en=$request->title_en;
        $news->title_ar=$request->title_ar;
        $news->desc_en=$request->desc_en;
        $news->desc_ar=$request->desc_ar;
        $news->status=(isset($request->status)) ? 1 : 0;

        $news->meta_title_en=$request->meta_title_en;
        $news->meta_title_ar=$request->meta_title_ar;
        $news->meta_description_en=$request->meta_description_en;
        $news->meta_description_ar=$request->meta_description_ar;
                
        $news->save();
        return redirect(route('news.index'))->with('success','Record saved successfully!');
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
