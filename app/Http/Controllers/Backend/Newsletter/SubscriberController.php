<?php

namespace App\Http\Controllers\Backend\Newsletter;

use App\Http\Controllers\Controller;
use App\Models\Subscriber\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index()
    {
    	$subscribers = Subscriber::orderBy('created_at','desc')->paginate(15);
    	return view('backend.newsletter.index')->with('subscribers',$subscribers);
    }
}
