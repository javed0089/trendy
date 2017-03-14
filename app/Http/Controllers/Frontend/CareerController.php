<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Block\Block;
use App\Models\Careers\Job;
use App\Models\Department\Department;
use App\Models\Page\Page;
use Illuminate\Http\Request;

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

    	return view('frontend.careers')->with('jobs',$jobs)->with('departments',$departments)->with('topImage',$topImage)->with('section1',$section1)->with('work',$work);
    }

    public function job($slug)
    {
    	$job=Job::where('slug','=',$slug)->get();
    	return view('frontend.job')->with('job',$job->first());
    }
}
