<?php

namespace App\Http\Controllers\Backend\Newsletter;

use App\Http\Controllers\Controller;
use App\Models\Subscriber\Subscriber;
use Illuminate\Http\Request;
use Excel;

class SubscriberController extends Controller
{
    public function index()
    {
    	$subscribers = Subscriber::orderBy('created_at','desc')->paginate(15);
    	return view('backend.newsletter.index')->with('subscribers',$subscribers);
    }

    public function exportToExcel()
    {
        $subscribers = Subscriber::select('email')->get();
        Excel::create('Subscribers', function($excel) use ($subscribers){
            $excel->sheet('Sheet 1', function($sheet) use ($subscribers){
                $sheet->fromArray($subscribers);
            });
        })->export('xlsx');
    }
}
