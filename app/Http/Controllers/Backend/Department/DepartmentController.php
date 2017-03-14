<?php

namespace App\Http\Controllers\Backend\Department;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments=Department::all();
        return view('backend.department.index')->with('departments',$departments);
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
        $this->validate($request,[
            'name_en'=>   'required|max:255',
            'name_ar' =>   'required|max:255',
            ]);
        
        $department=new Department;
        $department->name_en=$request->name_en;
        $department->name_ar=$request->name_ar;
       
        
        $department->save();
        return back()->with('success','Department added succesfully!');
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
        $department=Department::find($id);
        $departments=Department::all();
        return view('backend.department.index')->with('department',$department)->with('departments',$departments);
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
            'name_en'=>   'required|max:255',
            'name_ar' =>   'required|max:255',
            ]);
        
        $department=Department::find($id);
        $department->name_en=$request->name_en;
        $department->name_ar=$request->name_ar;
       
        
        $department->save();
        return redirect()->route('departments.index')->with('success','Department updated succesfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department=Department::find($id);
        $department->delete();
        return back()->with('success','Record deleted succesfully!');
    }
}
