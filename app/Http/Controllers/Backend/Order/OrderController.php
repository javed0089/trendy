<?php

namespace App\Http\Controllers\Backend\Order;

use App\Http\Controllers\Controller;
use App\Models\Order\DocumentType;
use App\Models\Order\Order;
use App\Models\Order\OrderComment;
use App\Models\Order\OrderFile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Sentinel;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders=[];        
        if(User::isSupervisor())
            $orders = Order::all();
        elseif(User::isSalesExecutive()){
            $user=Sentinel::getUser();
            $orders = Order::where('assign_to_id','=',$user->id)->get();
        }


        return view('backend.orders.index')->with('orders',$orders);

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
        $order = Order::find($id);
        $document_types = DocumentType::all();

        $flag=false;
        if(User::isSalesExecutive()){
            if(User::getId() == $order->assign_to_id)
                $flag=true;
        }
        if(User::isSupervisor() || $flag){

            $role = Sentinel::findRoleById(4);
            $users = $role->users()->get();
            return view('backend.orders.show')->with('order',$order)->with('users',$users)->with('document_types',$document_types);
        }
        else
            return redirect('backoffice/login');
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
     $order = Order::find($id);
     $submitReq = $request->submit;
     if($submitReq =="assignSalesRep"){
        $this->validate($request, [
            'assign_to_id' =>   'required',
            ]);
        if($request->assign_to_id>0){
            $order->assign_to_id = $request->assign_to_id;
            $order->status = '4';
            $order->save();

            return redirect()->route('orders.show',$id)->with('success','Record updated successfully!');
        }
    }
    elseif($submitReq =="orderProcessed"){
        $order->status = '2';
        $order->save();
        return redirect()->route('orders.show',$id)->with('success','Record updated successfully!');
    }
    elseif($submitReq =="addComment"){
        $orderComment = new OrderComment;
        $orderComment->comment_type = '1';
        $orderComment->order_id = $id;
        $orderComment->user_id = User::getId();
        $orderComment->comment = $request->comment;
        $orderComment->save();
        return redirect()->route('orders.show',$id)->with('success','Comment added successfully!');
    }
    elseif($submitReq =="uploadDocument"){

      $this->validate($request, [
         'order_document' => 'required|mimes:pdf|max:10000',
         'document_type' => 'required'
         ]);

      $file = $request->file('order_document');
      $filename = rand(1,100).time().'.'. 'pdf';
      $location="order-docs/";
      if($file){

        Storage::disk('local')->put($location.$filename,  File::get($file));

        $orderFile = new OrderFile;
        $orderFile->filename=$filename;
        $orderFile->document_type = $request->document_type;
        $orderFile->mime=$file->getClientMimeType();
        $orderFile->original_filename=$file->getClientOriginalName();
        $orderFile->user_id = Sentinel::check()->id;

        $order->OrderFiles()->save($orderFile);


        return redirect()->route('orders.show',$id)->with('success','File Uploaded successfully!');
        }    
    }
    elseif($submitReq == "confirmPi"){
        $order->payment_status = '1';
        $order->save();
        return redirect()->route('orders.show',$id)->with('success','Payment confirmed!');
    }
    return back();
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function getOrderFile($id)
    {
        $orderFile = OrderFile::find($id);
        if($orderFile){
            $filename = $orderFile->filename;

            $flag=false;
            if(User::isSalesExecutive()){
                if(User::getId() == $orderFile->Order->assign_to_id)
                    $flag=true;
            }
            if(User::isSupervisor() || $flag){

                $location="order-docs/";
                $file = Storage::disk('local')->get( $location.$filename);
                $response = Response($file, 200);
                $response->header("Content-Type", 'application/pdf');
                return $response;
            }}
            else
                return redirect('backoffice/login');

        }
    }
