<?php

namespace App\Http\Controllers\Backend\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Sentinel;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;

class LoginController extends Controller
{
     public function index(){

    	return view('backend.authentication.backofficeLogin');
    }

     public function postLogin(Request $request){
        try {
        	
            $rememberMe=isset($request->remember);
            $user=Sentinel::authenticate($request->all(),$rememberMe?true:false);
            if($user)
                if(!($user->inRole('super-admin')) && !($user->inRole('admin')))
                    return redirect()->back()->with(['error' => 'Restriced for admins only']);
            
        	if(Sentinel::check()){
        		return redirect('backoffice/');
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
    	
    	return redirect('/backoffice/login');
    }
}
