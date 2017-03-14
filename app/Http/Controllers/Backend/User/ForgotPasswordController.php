<?php

namespace App\Http\Controllers\Backend\user;

use App\Http\Controllers\Controller;
use App\User;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function show()
    {
    	return view('backend.authentication.forgot-password');
    }

    public function sendCode(Request $request)
    {
    	$user = User::where('email', '=', $request->email)->first();

    	if(count($user) == 0){
    		return redirect()->back()->with(['success' => 'Reset code was sent to your email.']);
    	}

    	$sentinelUser=Sentinel::findById($user->id);
    	$reminder = Reminder::exists($sentinelUser)? : Reminder::create($sentinelUser);
    	$this->sendEmail($user,$reminder->code);
    	return redirect()->back()->with(['success' => 'Reset code was sent to your email.']);

    }

    public function reset($email, $code)
    {
    	$user = User::where('email', '=', $email)->first();
    	$sentinelUser=Sentinel::findById($user->id);

    	if(count($user) == 0)
    		abort(404);


    	if($reminder = Reminder::exists($sentinelUser)){
    		if($code == $reminder->code){
                 if($sentinelUser->inRole('subscriber'))
                    return view('frontend.reset-password');
                else
                   return view('backend.authentication.reset-password'); 
           }
    		else{
                if($sentinelUser->inRole('subscriber'))
    			     return redirect('/login');
                else
                    return redirect('backoffice/login');
            }
    	}
    	else
    		{
                if($sentinelUser->inRole('subscriber'))
                     return redirect('/login');
                else
                    return redirect('backoffice/login');
            }
    }

    public function resetPassword(Request $request, $email, $resetCode)
    {
    	$this->validate($request, [
    		'password' => 'confirmed|required|min:5|max:10',
    		'password_confirmation' => 'required|min:5|max:10'
    		]);

    	$user = User::where('email', '=', $email)->first();
    	$sentinelUser=Sentinel::findById($user->id);

    	if(count($user) == 0)
    		abort(404);


    	if($reminder = Reminder::exists($sentinelUser)){
    		if($resetCode == $reminder->code)
    		{
    			Reminder::complete($sentinelUser, $resetCode, $request->password);

                if($sentinelUser->inRole('subscriber'))
    				return redirect('/login')->with('success', 'Please login with your new password');
                else
                    return redirect('backoffice/login')->with('success', 'Please login with your new password');
    		}
    		else{
                if($sentinelUser->inRole('subscriber'))
                     return redirect('/login');
                else
                    return redirect('backoffice/login');
            }
    	}
    	else{
                if($sentinelUser->inRole('subscriber'))
                     return redirect('/login');
                else
                    return redirect('backoffice/login');
            }
    }

    private function sendEmail($user, $code){
    	Mail::send('emails.forgot-password', [
    			'user' => $user,
    			'code' => $code
    		], function($message) use ($user) {
    			$message->to($user->email);
    			$message->subject("Hello $user->first_name, reset your password.");
    		} );
    }
}
