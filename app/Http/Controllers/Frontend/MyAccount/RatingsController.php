<?php

namespace App\Http\Controllers\Frontend\Myaccount;

use App\Http\Controllers\Controller;
use App\Models\Rating\Rating;
use Illuminate\Http\Request;
use Sentinel;

class RatingsController extends Controller
{
	public function show($id)
	{
		$rating = Rating::where([['user_id','=',Sentinel::check()->id],['rating_type','=','1']])->first();
		
			return view('frontend.account.rating.show')->with('rating',$rating);
	}

	public function update(Request $request, $id)
	{
		$rating = Rating::where('order_id','=',$id)->first();
		if(count($rating)>0){
			$rating->rating = $request->rating;
			$rating->save();
			return redirect()->back()->with(['success' => "Thank you for your feedback!"]);
		}
		else{
			$rating = new Rating;
			$rating->rating = $request->rating;
			$rating->rating_type = '2';
			$rating->order_id = $id;
			$rating->user_id = Sentinel::check()->id;
			$rating->save();
			return redirect()->back()->with(['success' => "Thank you for your feedback!"]);
		}
	}

	public function update2(Request $request)
	{
		//dd($request);
		$rating = Rating::where([['user_id','=',Sentinel::check()->id],['rating_type','=','1']])->first();
		//dd($rating);
		if(count($rating)>0){
			$rating->rating = $request->rating;
			$rating->save();
			return redirect()->back()->with(['success' => "Thank you for your feedback!"]);
		}
		else{
			$rating = new Rating;
			$rating->rating = $request->rating;
			$rating->rating_type = '1';
			$rating->order_id = 0;
			$rating->user_id = Sentinel::check()->id;
			$rating->save();
			return redirect()->back()->with(['success' => "Thank you for your feedback!"]);
		}
	}
}
