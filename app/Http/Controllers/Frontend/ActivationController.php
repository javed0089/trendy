<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\User;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;

class ActivationController extends Controller
{
    public function index($email,$activationCode)
    {
    	$user = User::where('email','=',$email)->first();
		
    	$sentinelUser = Sentinel::findById($user->id);

    	if(Activation::complete($sentinelUser,$activationCode)){
    		return redirect(route('frontend.login'))->with('success','Your account is activated!');
    	}
    	else{
            return redirect('/');
    	}
    }
}
