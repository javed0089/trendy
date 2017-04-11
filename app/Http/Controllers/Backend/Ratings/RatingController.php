<?php

namespace App\Http\Controllers\Backend\Ratings;

use App\Http\Controllers\Controller;
use App\Models\Rating\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index()
    {
    	$ratings = Rating::all();
    	return view('backend.ratings.index')->with('ratings',$ratings);
    }
}
