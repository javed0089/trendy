<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comments\Comment;
use App\Notifications\NewContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Sentinel;

class CommentController extends Controller
{
    public function store(Request $request)
    {
    	$this->validate($request, [
            'fullname' =>'required|max:255',
            'phone' =>'required|max:255',
            'email' =>'required|email',
            'message' =>'required|min:10|max:500',
            'g-recaptcha-response' => 'required|captcha'
            ],
            $messages= [
            'g-recaptcha-response.required' => 'Prove you are not a robot',
            'g-recaptcha-response.captcha' => 'Prove you are not a robot'
            
            ]);

    	$comment =  new Comment();
    	$comment->fullname = $request->fullname;
    	$comment->email = $request->email;
    	$comment->phone = $request->phone;
    	$comment->message = $request->message;
    	$comment->ip_address = $request->ip();
    	$comment->save();

        //Send Notification to Super admin
      //Get all super admins
      $role = Sentinel::findRoleBySlug('super-admin');
      $users = $role->users()->with('roles')->get();
      Notification::send($users, new NewContactMessage($comment,"backend"));

      return redirect()->route('frontend.contact')->with('success',__('Your message was sent succesfully!'));

  }
}
