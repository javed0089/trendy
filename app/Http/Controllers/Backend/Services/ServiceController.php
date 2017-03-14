<?php

namespace App\Http\Controllers\Backend\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return view('backend.service.index')->with ('services',$services);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.service.create');
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
        'name_en' =>'required|max:255|unique:services,name_en',
        'slug' =>   'required|alpha_dash|min:5|max:255|unique:services,slug',
        
        ]);
      
        $service = new Service;
        $service->name_en=$request->name_en;
        $service->name_ar=$request->name_ar;
        $service->slug=$request->slug;
        $service->desc_en=$request->desc_en;
        $service->desc_ar=$request->desc_ar;
        $service->status=(isset($request->status)) ? 1 : 0;
           
        $service->save();
        return redirect(route('services.index'))->with('success','Record saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::find($id);
        return view('backend.service.show')->with('service',$service);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);
        return view('backend.service.edit')->with('service',$service);
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
        'name_en' =>'required|max:255|unique:services,name_en,'.$id,
        'slug' =>   'required|alpha_dash|min:5|max:255|unique:services,slug,'.$id,
        
        ]);
      
        $service = Service::find($id);
        $service->name_en=$request->name_en;
        $service->name_ar=$request->name_ar;
        $service->slug=$request->slug;
        $service->desc_en=$request->desc_en;
        $service->desc_ar=$request->desc_ar;
        $service->status=(isset($request->status)) ? 1 : 0;
           
        $service->save();
        return redirect(route('services.index'))->with('success','Record saved successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);
        $service->delete();
        return back()->with('success','Record deleted successfully!');
    }
}
