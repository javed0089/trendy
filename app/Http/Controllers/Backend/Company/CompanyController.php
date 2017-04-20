<?php

namespace App\Http\Controllers\Backend\Company;

use App\Http\Controllers\Controller;
use App\Models\Company\Company;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return view('backend.company.index')->with('companies',$companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.company.create');
        
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
            'company_logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'company_profile' => "mimes:pdf|max:10000",
            'company_qrcode' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

        $company = new Company;
        $company->company_name=$request->company_name;


        if ($request->hasFile('company_logo')){
            $company_logo=$request->file('company_logo');
            $company->company_logo=$this->saveImage($company_logo,'');
        }

         if ($request->hasFile('company_profile')){

            $company_profile = $request->file('company_profile');
            $new_filename = 'Gap-Polymers-Profile'.'.pdf';
            $location="downloads/company/";
            Storage::disk('public')->put($location.$new_filename,  File::get($company_profile));

            $company->company_profile=$location.$new_filename; 

        }

        if ($request->hasFile('company_qrcode')){
            $company_qrcode=$request->file('company_qrcode');
            $company->company_qrcode=$this->saveImage($company_qrcode,'');
        }

        $company->save();
        return redirect(route('company.index'))->with('success','Record saved successfully!');
    
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
        $company = Company::find($id);
        return view('backend.company.edit')->with('company', $company);
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
         $this->validate($request, [
            'company_logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'company_profile' => "mimes:pdf|max:10000",
            'company_qrcode' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

        $company = Company::find($id);
      
               
        $company->company_name=$request->company_name;
      
        if ($request->hasFile('company_logo')){
            $company_logo=$request->file('company_logo');
            if($company->company_logo)
                $company->company_logo=$this->saveImage($company_logo,$company->company_logo);
            else
                $company->company_logo=$this->saveImage($company_logo,'');
        }

        if ($request->hasFile('company_profile')){

            $company_profile = $request->file('company_profile');
            $new_filename = 'Gap-Polymers-Profile'.'.pdf';
            $location="downloads/company/";
            Storage::disk('public')->put($location.$new_filename,  File::get($company_profile));

            $company->company_profile=$location.$new_filename; 

        }


        if ($request->hasFile('company_qrcode')){
            $company_qrcode=$request->file('company_qrcode');
            if($company->company_qrcode)
                $company->company_qrcode=$this->saveImage($company_qrcode,$company->company_qrcode);
            else
                $company->company_qrcode=$this->saveImage($company_qrcode,'');
        }

        $company->save();
        return redirect(route('company.index'))->with('success','Record updated successfully!');
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

    $location='downloads/company/';

    if (!file_exists(public_path($location))) 
        File::makeDirectory(public_path($location));

    Image::make($image)->save(public_path($location.$filename));
    return $location.$filename;

   }
}
