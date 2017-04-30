<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Block\Block;
use App\Models\Careers\Job;
use App\Models\Careers\JobApplication;
use App\Models\Company\Webpage;
use App\Models\Department\Department;
use App\Models\Page\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CareerController extends Controller
{
    public function index()
    {
    	$jobs = Job::where('job_status','=','1')->get();

    	$departments= Department::all();

        $topImage = Page::find(70)->PageSections()->first();

        $section1 = [];
        $section1 = Page::find(71)->PageSections()->first();

        $work=Block::where('block_type','=','Career-Work')->first();
        $metatags = Webpage::where('page_name','=','career')->first();

        return view('frontend.careers')->with('jobs',$jobs)->with('departments',$departments)->with('topImage',$topImage)->with('section1',$section1)->with('work',$work)->with('metatags',$metatags);
    }

    public function job($slug)
    {
    	$job=Job::where('slug','=',$slug)->get();
     $topImage = Page::find(70)->PageSections()->first();

     return view('frontend.job')->with('job',$job->first())->with('topImage',$topImage);
 }

 public function postApplication(Request $request)
 {
     $this->validate($request, [
         'applicant_name' => 'required',
         'email' => 'required',
         'jobId' => 'required',
         'resume' => 'required|mimes:pdf|max:10000'
         ]);

     $jobApplication = new JobApplication;
     $jobApplication->job_id = $request->jobId;
     $jobApplication->applicant_name = $request->applicant_name;
     $jobApplication->email = $request->email;

     $file = $request->file('resume');
     $filename = rand(1,100).time().'.'. 'pdf';
     $location="resumes/".$request->jobId.'/';
     if($file)
     {
        Storage::disk('local')->put($location.$filename,  File::get($file));
        $jobApplication->resume=$filename;
    }
    $jobApplication->save();
    return redirect()->route('message')->with('success', 'Your application has been submitted. Thank you!');
}
}
