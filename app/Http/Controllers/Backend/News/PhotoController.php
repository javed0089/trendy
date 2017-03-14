<?php

namespace App\Http\Controllers\Backend\News;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News\Photo;
use App\Models\News\News;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Image;

class PhotoController extends Controller
{
   

    

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
       
        if ($request->hasFile('news_image')){

            $news_id=$request->news_id;
            $file = $request->file('news_image');
            $extension = $file->getClientOriginalExtension();
            $new_filename = rand(1,100).time().'.'. $extension;
            $location="images/news/";
            //Storage::disk('public')->put($location.$new_filename,  File::get($file));

            if (!file_exists(public_path($location))) 
                File::makeDirectory(public_path($location));

            Image::make($file)->save(public_path($location.$new_filename));


            $newsImage = new Photo;
            $newsImage->filename=$location.$new_filename;
            $newsImage->mime=$file->getClientMimeType();
            $newsImage->original_filename=$file->getClientOriginalName();
               
            $newsImage->save();

            $news=News::find($news_id);
            $news->Photos()->attach($newsImage->id);
            return redirect(route('news.show',$news_id))->with('success','Image uploaded successfully!');
        }
        else
            return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $photo=Photo::find($id);
        $filename=$photo->filename;
        $res=Storage::disk('public')->delete($filename);
        
        if($res){
            $news_id=$request->news_id;
            $photo->News()->detach($news_id);
            $photo->delete();
            return back()->with('success','Image deleted successfully!');
        }
        else
            return back()->with('error','Image was not deleted!');
    }
}
