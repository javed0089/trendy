<?php

namespace App\Http\Controllers\Backend\Quotes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Quotation\Quote;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotes = Quote::all();
        return view('backend.quotes.index')->with('quotes',$quotes);
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
        $quote = Quote::find($id);
        $role = Sentinel::findRoleById(4);
        $users = $role->users()->get();
        return view('backend.quotes.show')->with('quote',$quote)->with('users',$users);
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
        
            'assign_to_id' =>   'required',
        
        ]);

        $quote = Quote::find($id);
        $submitReq = $request->submit;

        if($submitReq =="assignSalesRep"){
            if($request->assign_to_id>0){
                $quote->assign_to_id = $request->assign_to_id;
                $quote->status = '2';
                $quote->save();

                return redirect()->route('quote-requests.show',$id)->with('success','Record updated successfully!');
            }
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
