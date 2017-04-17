<?php

namespace App\Http\Controllers\Backend\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Product\Product;

class FileController extends Controller
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
        'product_file' => "required|mimes:pdf|max:10000",
        'file_title' => "required",
        ]);

       
        if ($request->hasFile('product_file')){

            $product_id=$request->product_id;
            $file = $request->file('product_file');
            $extension = $file->getClientOriginalExtension();
            $new_filename = rand(1,100).time().'.'. $extension;
            $location="downloads/products/";
            Storage::disk('public')->put($location.$new_filename,  File::get($file));

            $prodFile = new \App\Models\Product\File;
            $prodFile->filename=$location.$new_filename;
            $prodFile->mime=$file->getClientMimeType();
            $prodFile->original_filename=$file->getClientOriginalName();
            $prodFile->file_title = $request->file_title;
            $prodFile->save();

            $product=Product::find($product_id);
            $product->Files()->attach($prodFile->id);
            return redirect(route('products.show',$product_id))->with('success','File uploaded successfully!');
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
         $file=\App\Models\Product\File::find($id);
         $file->file_title = $request->file_title;
         $file->save();
         return back()->with('success','File updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {

        $file=\App\Models\Product\File::find($id);
        $filename=$file->filename;
        $res=Storage::disk('public')->delete($filename);
        
        if($res){
            $product_id=$request->product_id;
            $file->Products()->detach($product_id);
            $file->delete();
            return back()->with('success','File deleted successfully!');
        }
        else
            return back()->with('error','File was not deleted!');


    }
}
