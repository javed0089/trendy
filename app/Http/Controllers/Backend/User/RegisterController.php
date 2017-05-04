<?php

namespace App\Http\Controllers\Backend\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Sentinel;

class RegisterController extends Controller
{
    //
     public function index()
    {

        $roles = Sentinel::getRoleRepository()->where('slug','!=','subscriber')->get();
    	return view('backend.authentication.registerUser')->with('allroles',$roles);
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
        $reqUser=array_add($reqUser,'backend_user','1');
        $reqUser=array_add($reqUser,'ip_address',\Request::ip());
        
        dd($reqUser);
        $user=Sentinel::registerAndActivate($reqUser);

        $userRole=$reqUser['role'];
        $role = Sentinel::findRoleBySlug($userRole);
        $role->users()->attach($user);
    	
    	return redirect(route('users.index'))->with('success','User created sucessfully!');
    }
}
