<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Company\Webpage;
use App\Models\Page\Page;
use App\Notifications\NewRegistration;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Sentinel;

class signUpController extends Controller
{
   public function index()
   {

    $topImage = [];
    $topImage = Page::find(150)->PageSections()->first();

    $benefits = [];
    $benefits = Page::find(151)->PageSections()->get();
    $metatags = Webpage::where('page_name','=','register')->first();

    return view('frontend.register')->with('topImage',$topImage)->with('benefits',$benefits)->with('metatags',$metatags);
}

public function postRegister(Request $request)
{
   $this->validate($request, [
    'first_name' =>'required|max:255',
    'last_name' =>'required|max:255',
    'email' =>'required|email|unique:users,email',
    'password' =>'required|min:6',
    'confirmPassword' =>'required|same:password',
    ]);

   $reqUser=$request->all();
   $reqUser=array_add($reqUser,'ip_address',\Request::ip());
   $user=Sentinel::register($reqUser);

   $activation = Activation::create($user);

   $roleAssign='subscriber';
   $role = Sentinel::findRoleBySlug($roleAssign);
   $role->users()->attach($user);

   $this->sendEmail($user, $activation->code);
   
   if(Session::has('oldUrl')){
       
    $oldUrl=Session::get('oldUrl');
    Session::forget('oldUrl');
    Session::put('newUser',$user);
    return redirect()->to($oldUrl)->with('success','You have succesfully registered an account. Please activate the account from your email!');
    
}

        //Send Notification to all Super Admins
$role = Sentinel::findRoleBySlug('super-admin');
$users = $role->users()->with('roles')->get();
Notification::send($users, new NewRegistration($user,"backend"));

return back()->with('success','You have succesfully registered an account. Please activate the account from your email!');
}

private function sendEmail($user, $code){
    Mail::send('frontend.emails.activation', 
        ['user' => $user, 'code' => $code ],
        function($message) use ($user) {
            $message->to($user->email);
            $message->subject("Hello $user->first_name, activate your account.");
        }
        );
}
}
