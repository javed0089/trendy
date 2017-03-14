<?php

namespace App\Http\Controllers\Backend\Block;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Block\Block;
use Illuminate\Support\Facades\File;
use Image;
use Illuminate\Support\Facades\Storage;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blocks=Block::where('block_type','=',$id)->get();
        return view('backend.block.show')->with('blocks',$blocks);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'title_ar'=>   'required|max:255',
            'value_en'=>   'required',
            'value_ar'=>   'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
        $block=Block::find($id);

        $submitReq = $request->submit;

        if($submitReq =="removeImage"){
            $image='image';
            $res=Storage::disk('public')->delete($block->$image);
            if($res){
                $block->$image="";
                $block->save();
                return back()->with('success','Image deleted successfully!');
            }
            else
                return back()->with('error','Image was not deleted!');
        }

        $block->title_en=$request->title_en;
        $block->title_ar=$request->title_ar;
        $block->value_en=$request->value_en;
        $block->value_ar=$request->value_ar;
       
        if ($request->hasFile('image')){
            $image=$request->file('image');
            if($block->image)
                $block->image=$this->saveImage($image,$block->image);
            else
                $block->image=$this->saveImage($image,'');
        }

        $block->save();
        return back()->with('success','Record saved successfully!');
    }

    public function saveImage($image,$filename){

     if($filename=="")
        $filename = rand(1,100).time().'.'.$image->getClientOriginalExtension();
      else
        $filename = basename($filename);

      $location='images/blocks/';
     
      if (!file_exists(public_path($location))) 
        File::makeDirectory(public_path($location));

      Image::make($image)->save(public_path($location.$filename));
      return $location.$filename;
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
