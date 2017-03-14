<?php

namespace App\Http\Controllers\Backend\Testimonial;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Testimonials\Testimonial;
use Illuminate\Support\Facades\App;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials= Testimonial::all();
        return view('backend.testimonial.index')->with('testimonials',$testimonials);
    }

   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.testimonial.create');
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
            'client_name_en'=>   'required|max:255',
            ]);
        
        $testimonial=new Testimonial;
        $testimonial->client_name_en=$request->client_name_en;
        $testimonial->client_name_ar=$request->client_name_ar;
        $testimonial->location_en=$request->location_en;
        $testimonial->location_ar=$request->location_ar;
        $testimonial->quote_en=$request->quote_en;
        $testimonial->quote_ar=$request->quote_ar;
        $testimonial->featured=(isset($request->featured)) ? 1 : 0;
        $testimonial->status=(isset($request->status)) ? 1 : 0;
        
        
        $testimonial->save();
        return redirect(route('testimonials.index'))->with('success','Record saved successfully!');
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
        $testimonial= Testimonial::find($id);
        return view('backend.testimonial.edit')->with('testimonial',$testimonial);
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
            'client_name_en'=>   'required|max:255',
            ]);
        
        $testimonial=Testimonial::find($id);
        $testimonial->client_name_en=$request->client_name_en;
        $testimonial->client_name_ar=$request->client_name_ar;
        $testimonial->location_en=$request->location_en;
        $testimonial->location_ar=$request->location_ar;
        $testimonial->quote_en=$request->quote_en;
        $testimonial->quote_ar=$request->quote_ar;
        $testimonial->featured=(isset($request->featured)) ? 1 : 0;
        $testimonial->status=(isset($request->status)) ? 1 : 0;
        
        
        $testimonial->save();
        return redirect(route('testimonials.index'))->with('success','Record upated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $testimonial=Testimonial::find($id);
        $testimonial->delete();
        return back()->with('success','Record deleted succesfully!');
    }
}
