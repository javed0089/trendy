<?php

namespace App\Http\Controllers\Frontend\MyAccount;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Sentinel;
class UserController extends Controller
{
    
   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('frontend.account.user.show')->with('user',$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $this->validate($request, [
        'oldPassword' =>'required',
        'newPassword' =>'required|min:6',
        'confirmPassword' =>'required|same:newPassword',
        ]);

        $curUser = Sentinel::getUser();

        $credentials = [
            'email'    => $curUser->email,
            'password' => $request->oldPassword,
        ];

        $user = Sentinel::validateCredentials($curUser, $credentials);
        if(!$user)
            return redirect()->back()->with(['error' => 'Old password not correct']);
        else{
            $user = User::find($curUser->id);
            $user->password = Hash::make($request->newPassword);
            $user->save();
            return redirect()->back()->with(['success' => 'Password changed successfully']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
