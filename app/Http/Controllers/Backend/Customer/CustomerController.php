<?php

namespace App\Http\Controllers\Backend\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Sentinel;
use Activation;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customerRole=Sentinel::findRoleBySlug(['subscriber']);
       // $customers = $customerRole->users()->with('roles')->paginate(15);

        $customers = $customerRole->users()->with('roles')->where(function($query){
                $term = request('term')?request('term'):null;
               
                if(isset($term)){
                    $query->where('first_name','like','%'.$term.'%')
                    ->orWhere('last_name','like','%'.$term.'%')
                    ->orWhere('country','like','%'.$term.'%')
                    ->orWhere('city','like','%'.$term.'%')
                    ->orWhere('email','like','%'.$term.'%');

                }
              
               // $query->where('first_name','!=','');
            })->paginate(15)->appends(['term'=> request('term')]);


        return view('backend.customer.index')->with('customers',$customers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = User::find($id);
        
        return view('backend.customer.show')->with('customer',$customer);
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
        //
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
