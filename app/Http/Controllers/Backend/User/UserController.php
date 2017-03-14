<?php

namespace App\Http\Controllers\Backend\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Sentinel;
use Illuminate\Support\Collection;

class UserController extends Controller
{
    
    public function index()
    {
        $superAdminRole=Sentinel::findRoleBySlug(['super-admin']);
        $adminRole=Sentinel::findRoleBySlug(['admin']);
        $supervisorRole=Sentinel::findRoleBySlug(['supervisor']);
        $salesRepRole=Sentinel::findRoleBySlug(['sales-rep']);
        
        $allUsers=new Collection;
        if($superAdminRole){
            $superAdminUsers = $superAdminRole->users()->with('roles')->get();
            $allUsers=$allUsers->merge($superAdminUsers);    
        }

        if($adminRole){
            $adminUsers = $adminRole->users()->with('roles')->get();
            $allUsers=$allUsers->merge($adminUsers);
        }
        
        if($supervisorRole){
            $supervisorUsers = $supervisorRole->users()->with('roles')->get();
            $allUsers=$allUsers->merge($supervisorUsers);
        }

        if($salesRepRole){
            $salesRepUsers = $salesRepRole->users()->with('roles')->get();
            $allUsers=$allUsers->merge($salesRepUsers);
        }
        
        return view('backend.authentication.users')->with('allUsers',$allUsers);
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
