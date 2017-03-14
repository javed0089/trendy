<?php

namespace App\Http\Controllers\Backend\Location;

use App\Http\Controllers\Controller;
use App\Models\Location\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::where('status','=','1')->get();
        return view('backend.locations.index')->with('locations',$locations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.locations.create');
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
        'country_en' =>'required|max:255|unique:locations,country_en',
        'address_en' =>'required',
        ]);
      
        $location = new Location;
        $location->country_en=$request->country_en;
        $location->country_ar=$request->country_ar;
        $location->address_en=$request->address_en;
        $location->address_ar=$request->address_ar;
        $location->telephone=$request->telephone;
        $location->fax=$request->fax;
        $location->email=$request->email;
        $location->latitude=$request->latitude;
        $location->longitude=$request->longitude;
        $location->status=(isset($request->status)) ? 1 : 0; 


        $location->save();
        return redirect(route('locations.index'))->with('success','Record saved successfully!');
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
        $location = Location::find($id);
        return view('backend.locations.edit')->with('location',$location);
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
        'country_en' =>'required|max:255|unique:locations,country_en,'.$id,
        'address_en' =>'required',
        ]);
      
        $location = Location::find($id);
        $location->country_en=$request->country_en;
        $location->country_ar=$request->country_ar;
        $location->address_en=$request->address_en;
        $location->address_ar=$request->address_ar;
        $location->telephone=$request->telephone;
        $location->fax=$request->fax;
        $location->email=$request->email;
        $location->latitude=$request->latitude;
        $location->longitude=$request->longitude;
        $location->status=(isset($request->status)) ? 1 : 0; 


        $location->save();
        return redirect(route('locations.index'))->with('success','Record saved successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location=Location::find($id);
        $location->delete();
        return back()->with('success','Record deleted successfully!');
    }
}
