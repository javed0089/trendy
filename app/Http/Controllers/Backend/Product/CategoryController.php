<?php

namespace App\Http\Controllers\backend\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product\Category;
use Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::where('parent_id','=','0')->get();
        $catString="";
        $cat;
        $cat=$this->getCategories($categories,$cat,$catString);
        return view('backend.category.index')->with('categories',$cat);
    }

     private function getCategories($categories,&$cat,&$catString){
        
            foreach ($categories as $category) {
                if($category->Parent){
                    $catString= $this->categoryParent($category->Parent,$catString);
                    $cat[]= (object)array('id'=>$category->id,'name_en'=>$catString.$category->name_en,'created_at'=>$category->created_at,'updated_at'=>$category->updated_at,'image'=>$category->image);
                    $catString="";
                }
                else
                    $cat[]= (object)array('id'=>$category->id,'name_en'=>$category->name_en,'created_at'=>$category->created_at,'updated_at'=>$category->updated_at,'image'=>$category->image);
              if($category->Children)
                $this->getCategories($category->Children,$cat,$catString);
         }
         return $cat;  
    }


    public function categoryParent($category,&$catString)
    {
        $catString=$category->name_en.' > '. $catString;
        if($category->Parent)
            $this->categoryParent($category->Parent,$catString);
        return $catString;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('backend.category.create')->with('Categories',$categories);
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
        'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'name_en' =>'required|max:255|unique:categories,name_en',
        'name_ar' =>'required|max:255|unique:categories,name_ar',
        'slug' =>   'required|alpha_dash|min:3|max:255|unique:categories,slug',
        
        ]);
      
        $category = new Category;
        $category->parent_id=$request->parent_id;
        $category->name_en=$request->name_en;
        $category->name_ar=$request->name_ar;
        $category->slug=$request->slug;
        $category->desc_en=$request->desc_en;
        $category->desc_ar=$request->desc_ar;
           
     
        if ($request->hasFile('image')){
            $image=$request->file('image');
            $category->image=$this->saveImage($image,'');
        }

        if ($request->hasFile('logo')){
            $logo=$request->file('logo');
            $category->logo=$this->saveImage($logo,'');
        }

        $category->save();
        return redirect(route('categories.index'))->with('success','Record saved successfully!');
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
        $category=Category::find($id);
        $categories=Category::where('id','!=',$id)->where('parent_id','!=',$id)->get();
        return view('backend.category.edit')->with('category',$category)->with('Categories',$categories);
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
        ]);

        $category = Category::find($id);
        $submitReq = $request->submit;

        if($submitReq =="removeImage"){
            $image='image';
            $res=Storage::disk('public')->delete($category->$image);
            if($res){
                $category->$image="";
                $category->save();
                return back()->with('success','Image deleted successfully!');
            }
            else
                return back()->with('error','Image was not deleted!');
        }
        elseif($submitReq =="removeLogo"){
            $image='logo';
            $res=Storage::disk('public')->delete($category->$image);
            if($res){
                $category->$image="";
                $category->save();
                return back()->with('success','Logo deleted successfully!');
            }
            else
                return back()->with('error','Logo was not deleted!');
        }
        
        $category->parent_id=$request->parent_id;
        $category->name_en=$request->name_en;
        $category->name_ar=$request->name_ar;
        $category->slug=$request->slug;
        $category->desc_en=$request->desc_en;
        $category->desc_ar=$request->desc_ar;


      
        if ($request->hasFile('image')){
            $image=$request->file('image');
            if($category->image)
                $category->image=$this->saveImage($image,$category->image);
            else
                $category->image=$this->saveImage($image,'');
        }

        if ($request->hasFile('logo')){
            $image=$request->file('logo');
            if($category->logo)
                $category->logo=$this->saveImage($image,$category->logo);
            else
                $category->logo=$this->saveImage($image,'');
        }
      
        $category->save();
        return redirect(route('categories.index'))->with('success','Record updated successfully!');
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

      $location='images/categories/';
     
      if (!file_exists(public_path($location))) 
        File::makeDirectory(public_path($location));

      Image::make($image)->save(public_path($location.$filename));
      return $location.$filename;

      /*---------For Shared Hosting----------*/
      /*
       if(!is_dir(Storage::disk('cust_public')->getDriver()->getAdapter()->getPathPrefix().$location))
        Storage::makeDirectory($location);
     
       $path = $image->storeAs($location,$filename, 'cust_public');
       return $path;
        */
       /*---------For Shared Hosting----------*/
    }
}
