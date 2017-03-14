<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
use App\PageSection;
use Session;
use Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PageSectionController extends Controller
{
 public function show($id) {
  
  $pageSectionContent=Page::find($id);
  $activeLink=$this->getActiveLink($pageSectionContent);

  if($pageSectionContent->is_multi)
    return view('backend.pagecontentmulti')->with('pageContent',$pageSectionContent)->with('activeLink',$activeLink);
  else
    return view('backend.pagecontent')->with('pageContent',$pageSectionContent)->with('activeLink',$activeLink);
}


public function edit($id)
{   	
 $pageSectionContent = PageSection::find($id);
 //dd($pageSectionContent->Page);
 $activeLink=$this->getActiveLink($pageSectionContent->Page);
 return view('backend.pagecontentedit')->with('pageContent',$pageSectionContent)->with('activeLink',$activeLink);
}

public function create($id)
{
 $pageSectionContent=Page::find($id);
 $activeLink=$this->getActiveLink($pageSectionContent);
 return view('backend.pagecontentcreate')->with('pageContent',$pageSectionContent)->with('activeLink',$activeLink);
}

public function update($id,Request $request)
{

  $this->validate($request, [
    'image_en' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    'image_ar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);



  $pageContent = PageSection::find($id);
  $submitReq = $request->submit;

  if($submitReq =="removeImageEn" || $submitReq =="removeImageAr"){
    if($submitReq =="removeImageEn")
      $image='image_en';
    else
      $image='image_ar';
    $res=Storage::disk('public')->delete($pageContent->$image);
    if($res){
      $pageContent->$image="";
      $pageContent->save();
      return back()->with('success','Image deleted successfully!');
    }
     return back()->with('error','Image was not deleted!');
  }
  
  $pageSectionName=$pageContent->Page->page_sec_name;
  
  $pageContent->title_en=$request->title_en;
  $pageContent->heading1_en=$request->heading1_en;
  $pageContent->content_en=$request->content_en;
  
  if ($request->hasFile('image_en')){
    $image=$request->file('image_en');

    if($pageContent->image_en)
      $pageContent->image_en=$this->saveImage($image,$pageSectionName,$pageContent->image_en);
    else
      $pageContent->image_en=$this->saveImage($image,$pageSectionName,'');
  }


  $pageContent->title_ar=$request->title_ar;
  $pageContent->heading1_ar=$request->heading1_ar;
  $pageContent->content_ar=$request->content_ar;
  if ($request->hasFile('image_ar')){
    $image=$request->file('image_ar');

    if($pageContent->image_ar)
      $pageContent->image_ar=$this->saveImage($image,$pageSectionName,$pageContent->image_ar);
    else
      $pageContent->image_ar=$this->saveImage($image,$pageSectionName,'');
  }
  

  $pageContent->save();
  $activeLink=$this->getActiveLink($pageContent->Page);

  return redirect(route($activeLink,$pageContent->Page->id))->with('success','Record updated successfully!');
}




public function store($id,Request $request)
{
  $this->validate($request, [
    'image_en' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    'image_ar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

  $page=Page::find($id);
  $pageSectionName=$page->page_sec_name;

  $pageContent = new PageSection;
  $pageContent->page_id=$id;

  $pageContent->title_en=$request->title_en;
  $pageContent->heading1_en=$request->heading1_en;
  $pageContent->content_en=$request->content_en;

  if ($request->hasFile('image_en')){
    $image=$request->file('image_en');
    $pageContent->image_en=$this->saveImage($image,$pageSectionName,'');
  }

  $pageContent->title_ar=$request->title_ar;
  $pageContent->heading1_ar=$request->heading1_ar;
  $pageContent->content_ar=$request->content_ar;

  if ($request->hasFile('image_ar')){
    $imageAr=$request->file('image_ar');
    $pageContent->image_ar=$this->saveImage($imageAr,$pageSectionName,'');
  }


  $pageContent->save();
  $activeLink=$this->getActiveLink($pageContent->Page);
  
  return redirect(route($activeLink,$id))->with('success','Record saved successfully!');
}



public function getActiveLink($page){
  return $page->page_sec_name;
}



public function saveImage($image,$pageSectionName,$filename){

 if($filename=="")
    $filename = rand(1,100).time().'.'.$image->getClientOriginalExtension();
  else
    $filename = basename($filename);

  $location='images/pages/'.$pageSectionName.'/';
 
  if (!file_exists(public_path($location))) 
    File::makeDirectory(public_path($location));

  Image::make($image)->save(public_path($location.$filename));

  return $location.$filename;
}


}
