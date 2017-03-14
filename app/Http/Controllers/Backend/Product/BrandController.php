<?php

namespace App\Http\Controllers\Backend\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product\Brand;
use Image;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands=Brand::all();
        return view('backend.brand.index')->with('brands',$brands);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.brand.create');
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
        'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
      
        $brand = new Brand;
        $brand->name_en=$request->name_en;
        $brand->name_ar=$request->name_ar;
        $brand->slug=$request->slug;
     
        if ($request->hasFile('logo')){
            $image=$request->file('logo');
            $brand->logo=$this->saveImage($image,'');
        }

        $brand->save();
        return redirect(route('brands.index'))->with('success','Record saved successfully!');
      
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
        $brand=Brand::find($id);
        return view('backend.brand.edit')->with('brand',$brand);
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
        'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $brand = Brand::find($id);
        $submitReq = $request->submit;

        if($submitReq =="removeLogo"){
            $image='logo';
            $res=Storage::disk('public')->delete($brand->$image);
            if($res){
                $brand->$image="";
                $brand->save();
                return back()->with('success','Image deleted successfully!');
            }
            else
                return back()->with('error','Image was not deleted!');
        }
  
        $brand->name_en=$request->name_en;
        $brand->name_ar=$request->name_ar;
        $brand->slug=$request->slug;
      
        if ($request->hasFile('logo')){
            $image=$request->file('logo');
            if($brand->logo)
                $brand->logo=$this->saveImage($image,$brand->logo);
            else
                $brand->logo=$this->saveImage($image,'');
        }
      
        $brand->save();
        return redirect(route('brands.index'))->with('success','Record updated successfully!');
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

      $location='images/brands/';
     
      if (!file_exists(public_path($location))) 
        File::makeDirectory(public_path($location));

      Image::make($image)->save(public_path($location.$filename));

      return $location.$filename;
    }
}
