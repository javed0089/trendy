<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comments\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
    	$this->validate($request, [
        'fullname' =>'required|max:255',
        'phone' =>'required|max:255',
        'email' =>'required|email',
        'message' =>'required|min:10',
        ]);

    	$comment =  new Comment();
    	$comment->fullname = $request->fullname;
    	$comment->email = $request->email;
    	$comment->phone = $request->phone;
    	$comment->message = $request->message;
    	$comment->ip_address = $request->ip();
    	$comment->save();

    	return redirect()->route('frontend.contact')->with('success',__('Your message was sent succesfully!'));
    		
    }
}
