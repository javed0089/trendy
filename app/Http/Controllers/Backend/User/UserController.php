<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Sentinel;

class UserController extends Controller
{
    
    public function index()
    {
        $backendUsers = User::where('backend_user', '=' , '1')->get();
        return view('backend.authentication.users')->with('backendUsers',$backendUsers);
    }

    public function edit($id){

        $user=Sentinel::findUserById($id);
        $roles = Sentinel::getRoleRepository()->whereNotIn('slug', ['subscriber'])->get();
        return view('backend.authentication.edit')->with('user',$user)->with('roles',$roles);
    }

    public function update(Request $request,$id){

        $this->validate($request, [
        'first_name' =>'required|max:255',
        'last_name' =>'required|max:255',
        'email' =>'required|email|unique:users,email,'.$id,

        ]);

        $user=Sentinel::findUserById($id);
        $reqUser=$request->all();
        $user=Sentinel::update($user,$reqUser);
 
        $role = Sentinel::findRoleBySlug($user->roles->first()->slug);
        $role->users()->detach($user);

        $newRole=$reqUser['role'];
        $role = Sentinel::findRoleBySlug($newRole);
        $role->users()->attach($user);

        return redirect(route('users.index'))->with('success','User Updated');

    }
}
