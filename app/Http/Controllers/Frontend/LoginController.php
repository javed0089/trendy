<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Company\Webpage;
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
        $metatags = Webpage::where('page_name','=','login')->first();

        if(!Sentinel::check())
    	   return view('frontend.login')->with('metatags',$metatags);
        else
            return redirect('/');
    }

    public function login(Request $request){
        
        try {
        	
        	$this->validate($request, [
        	'email' => 'required|email',
    		'password' => 'required|min:6',
    		]);


            $rememberMe=isset($request->remember);
            $user=Sentinel::authenticate($request->all(),$rememberMe?true:false);
            if($user)
                if(!($user->inRole('subscriber')))
                    return redirect()->back()->with('error',__('Restriced for visitors only!'));
            
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
                return redirect()->back()->with('error', __('Wrong Credentials'));

        } catch (ThrottlingException $e) {
            $delay= $e->getDelay();
             return redirect()->back()->with('error', __('You have been banned for '). $delay. __(' seconds'));
        } catch(NotActivatedException $e){
            return redirect()->back()->with('error', __('Your account is not activated'));
        }
    }

     public function logout()
    {
    	Sentinel::logout();
    	Session::forget('oldUrl');
    	return redirect('/');
    }
}
