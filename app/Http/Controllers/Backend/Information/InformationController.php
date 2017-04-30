<?php

namespace App\Http\Controllers\Backend\Information;

use App\Http\Controllers\Controller;
use App\Models\Information\Information;
use App\Models\Information\InformationType;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $informations = Information::all();
        
        return view('backend.information.index')->with('informations',$informations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $informationTypes = InformationType::all();
        return view('backend.information.create')->with('informationTypes',$informationTypes);
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
        'name_en' =>'required|max:255|unique:informations,name_en',
        'information_type_id' => 'required'
        ]);
      
        $information = new Information;
        $information->information_type_id = $request->information_type_id;
        $information->name_en=$request->name_en;
        $information->name_ar=$request->name_ar;
        $information->desc_en=$request->desc_en;
        $information->desc_ar=$request->desc_ar;
        $information->status=(isset($request->status)) ? 1 : 0;

        $information->meta_title_en=$request->meta_title_en;
        $information->meta_title_ar=$request->meta_title_ar;
        $information->meta_description_en=$request->meta_description_en;
        $information->meta_description_ar=$request->meta_description_ar;
           
        $information->save();
        return redirect(route('informations.index'))->with('success','Record saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $information = Information::find($id);
        return view('backend.information.show')->with('information',$information);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $information = Information::find($id);
         $informationTypes = InformationType::all();
        return view('backend.information.edit')->with('information',$information)->with('informationTypes',$informationTypes);
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
        'name_en' =>'required|max:255|unique:informations,name_en,'.$id,
        'information_type_id' => 'required'
        ]);
      
        $information = information::find($id);
        $information->information_type_id = $request->information_type_id;
        $information->name_en=$request->name_en;
        $information->name_ar=$request->name_ar;
        $information->desc_en=$request->desc_en;
        $information->desc_ar=$request->desc_ar;
        $information->status=(isset($request->status)) ? 1 : 0;

        $information->meta_title_en=$request->meta_title_en;
        $information->meta_title_ar=$request->meta_title_ar;
        $information->meta_description_en=$request->meta_description_en;
        $information->meta_description_ar=$request->meta_description_ar;
           
        $information->save();
        return redirect(route('informations.index'))->with('success','Record saved successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $information = Information::find($id);
        $information->delete();
        return back()->with('success','Record deleted successfully!');
    }
}
