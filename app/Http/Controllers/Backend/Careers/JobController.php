<?php

namespace App\Http\Controllers\Backend\Careers;

use App\Http\Controllers\Controller;
use App\Models\Careers\Job;
use App\Models\Careers\JobApplication;
use App\Models\Department\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs=Job::all();
        return view('backend.jobs.index')->with('jobs',$jobs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     $departments=Department::all();
     return view('backend.jobs.create')->with('departments',$departments);
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
            'title_en'=>   'required|max:255',
            'slug' =>   'required|alpha_dash|min:5|max:255|unique:jobs,slug'
            ]);
        
        $job=new Job;
        $job->title_en=$request->title_en;
        $job->title_ar=$request->title_ar;
        $job->slug=$request->slug;
        $job->department_id=$request->department_id;
        $job->location_en=$request->location_en;
        $job->location_ar=$request->location_ar;
        $job->education_en=$request->education_en;
        $job->education_ar=$request->education_ar;
        $job->experience_en=$request->experience_en;
        $job->experience_ar=$request->experience_ar;
        $job->job_description_en=$request->job_description_en;
        $job->job_description_ar=$request->job_description_ar;
        $job->responsibilities_en=$request->responsibilities_en;
        $job->responsibilities_ar=$request->responsibilities_ar;
        $job->job_status=(isset($request->job_status)) ? 1 : 0;

        $job->meta_title_en=$request->meta_title_en;
        $job->meta_title_ar=$request->meta_title_ar;
        $job->meta_description_en=$request->meta_description_en;
        $job->meta_description_ar=$request->meta_description_ar;
        
        
        $job->save();
        return redirect(route('jobs.index'))->with('success','Record saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job=Job::find($id);

        $jobApplications = JobApplication::where('job_id','=',$id)->paginate(15);

        return view('backend.jobs.show')->with('job',$job)->with('jobApplications',$jobApplications);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job=Job::find($id);
        $departments=Department::all();
        return view('backend.jobs.edit')->with('job',$job)->with('departments',$departments);
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
            'title_en'=>   'required|max:255',
            'slug' =>   'required|alpha_dash|min:5|max:255|unique:jobs,slug,'.$id
            ]);
        
        $job=Job::find($id);
        $job->title_en=$request->title_en;
        $job->title_ar=$request->title_ar;
        $job->slug=$request->slug;
        $job->department_id=$request->department_id;
        $job->location_en=$request->location_en;
        $job->location_ar=$request->location_ar;
        $job->education_en=$request->education_en;
        $job->education_ar=$request->education_ar;
        $job->experience_en=$request->experience_en;
        $job->experience_ar=$request->experience_ar;
        $job->job_description_en=$request->job_description_en;
        $job->job_description_ar=$request->job_description_ar;
        $job->responsibilities_en=$request->responsibilities_en;
        $job->responsibilities_ar=$request->responsibilities_ar;
        $job->job_status=(isset($request->job_status)) ? 1 : 0;

        $job->meta_title_en=$request->meta_title_en;
        $job->meta_title_ar=$request->meta_title_ar;
        $job->meta_description_en=$request->meta_description_en;
        $job->meta_description_ar=$request->meta_description_ar;
        
        
        $job->save();
        return redirect(route('jobs.index'))->with('success','Record saved successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job=Job::find($id);
        $job->delete();
        return back()->with('success','Record deleted succesfully!');
    }


    public function getResume($applicationId)
    {
        $jobApplication = JobApplication::find($applicationId);
        if($jobApplication){
            $filename = $jobApplication->resume;
            $location="resumes/".$jobApplication->job_id.'/';
            $file = Storage::disk('local')->get( $location.$filename);
            $response = Response($file, 200);
            $response->header("Content-Type", 'application/pdf');
            return $response;
        }

    }

    public function deleteApplication($applicationId)
    {
        $jobApplication = JobApplication::find($applicationId);
        if($jobApplication){
            $filename = $jobApplication->resume;
            $location="resumes/".$jobApplication->job_id.'/';
            $res=Storage::disk('local')->delete($location.$filename);

            $jobApplication->delete();
            return back()->with('success','Record deleted successfully!');
        }
        return back()->with('error','Something went wrong!');
    }


}