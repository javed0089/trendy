<?php

namespace App\Http\Controllers\Backend\Team;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Team\Member;
use Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members= Member::all();
        return view('backend.member.index')->with('members',$members);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'name_en' =>'required|max:255|unique:categories,name_en',
        
        ]);
      
        $member = new Member;
        $member->name_en=$request->name_en;
        $member->name_ar=$request->name_ar;
        $member->designation_en=$request->designation_en;
        $member->designation_ar=$request->designation_ar;
        $member->facebook=$request->facebook;
        $member->twitter=$request->twitter;
        $member->linkedin=$request->linkedin;
        $member->status=(isset($request->status)) ? 1 : 0; 

        if ($request->hasFile('image')){
            $image=$request->file('image');
            $member->image=$this->saveImage($image,'');
        }

        $member->save();
        return redirect(route('members.index'))->with('success','Record saved successfully!');
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
        $member=Member::find($id);
        return view('backend.member.edit')->with('member',$member);
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
         $this->validate($request, [
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'name_en' =>'required|max:255|unique:categories,name_en,'.$id,
        
        ]);
      
        $member = Member::find($id);
        $submitReq = $request->submit;

        if($submitReq =="removeImage"){
            $image='image';
            $res=Storage::disk('public')->delete($member->$image);
            if($res){
                $member->$image="";
                $member->save();
                return back()->with('success','Image deleted successfully!');
            }
            else
                return back()->with('error','Image was not deleted!');
        }

        $member->name_en=$request->name_en;
        $member->name_ar=$request->name_ar;
        $member->designation_en=$request->designation_en;
        $member->designation_ar=$request->designation_ar;
        $member->facebook=$request->facebook;
        $member->twitter=$request->twitter;
        $member->linkedin=$request->linkedin;
        $member->status=(isset($request->status)) ? 1 : 0; 

        if ($request->hasFile('image')){
            $image=$request->file('image');
            if($member->image)
                $member->image=$this->saveImage($image,$member->image);
            else
                $member->image=$this->saveImage($image,'');
        }

        $member->save();
        return redirect(route('members.index'))->with('success','Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member=Member::find($id);
        $filename=$member->image;
        $res=Storage::disk('public')->delete($filename);
        $member->delete();
        return back()->with('success','Record deleted successfully!');
       }

     public function saveImage($image,$filename){

     if($filename=="")
        $filename = rand(1,100).time().'.'.$image->getClientOriginalExtension();
      else
        $filename = basename($filename);

      $location='images/members/';
     
      if (!file_exists(public_path($location))) 
        File::makeDirectory(public_path($location));

      Image::make($image)->save(public_path($location.$filename));

      return $location.$filename;
    }
}
