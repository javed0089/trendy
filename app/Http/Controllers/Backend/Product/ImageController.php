<?php

namespace App\Http\Controllers\Backend\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Product\Product;
use Image;

class ImageController extends Controller
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
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
       
        if ($request->hasFile('product_image')){

            $product_id=$request->product_id;
            $file = $request->file('product_image');
            $extension = $file->getClientOriginalExtension();
            $new_filename = rand(1,100).time().'.'. $extension;
            $location="images/products/";
            //Storage::disk('public')->put($location.$new_filename,  File::get($file));

            if (!file_exists(public_path($location))) 
                File::makeDirectory(public_path($location));

            Image::make($file)->save(public_path($location.$new_filename));


            $prodImage = new \App\Models\Product\Image;
            $prodImage->filename=$location.$new_filename;
            $prodImage->mime=$file->getClientMimeType();
            $prodImage->original_filename=$file->getClientOriginalName();
               
            $prodImage->save();

            $product=Product::find($product_id);
            $product->Images()->attach($prodImage->id);
            return redirect(route('products.show',$product_id))->with('success','Image uploaded successfully!');
        }
        else
            return back();

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $image=\App\Models\Product\Image::find($id);
        $filename=$image->filename;
        $res=Storage::disk('public')->delete($filename);
        
        if($res){
            $product_id=$request->product_id;
            $image->Products()->detach($product_id);
            $image->delete();
            return back()->with('success','Image deleted successfully!');
        }
        else
            return back()->with('error','Image was not deleted!');

    }
}
