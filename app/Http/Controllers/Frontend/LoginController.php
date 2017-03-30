<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class LoginController extends Controller
{
    public function index(Request $request)
    {

    	return view('frontend.login');
    }

    public function login(Request $request){
        try {
        	
        	$this->validate($request, [
        	'email' => 'required|email',
    		'password' => 'required|min:5|max:10',
    		]);


            $rememberMe=isset($request->remember);
            $user=Sentinel::authenticate($request->all(),$rememberMe?true:false);
            if($user)
                if(!($user->inRole('subscriber')))
                    return redirect()->back()->with(['error' => 'Restriced for visitors only!']);
            
        	if(Sentinel::check()){
                if(Session::has('oldUrl')){
                    $oldUrl=Session::get('oldUrl');
                    Session::forget('oldUrl');
                    return redirect()->to($oldUrl);
                }
                else
                    return redirect('/');
        	}
            else
                return redirect()->back()->with(['error' => 'Wrong Credentials']);

        } catch (ThrottlingException $e) {
            $delay= $e->getDelay();
             return redirect()->back()->with(['error' => "You have been banned for $delay seconds"]);
        } catch(NotActivatedException $e){
            return redirect()->back()->with(['error' => "Your account is not activated"]);
        }
    }

     public function logout()
    {
    	Sentinel::logout();
    	Session::forget('oldUrl');
    	return redirect('/');
    }
}
