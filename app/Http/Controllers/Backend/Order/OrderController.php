<?php

namespace App\Http\Controllers\Backend\Order;

use App\Http\Controllers\Controller;
use App\Models\Order\DocumentType;
use App\Models\Order\Order;
use App\Models\Order\OrderComment;
use App\Models\Order\OrderFile;
use App\Models\Order\OrderShipment;
use App\Models\Order\OrderShipmentFiles;
use App\Models\Order\OrderShipmentStatus;
use App\Models\Rating\Rating;
use App\Models\Status\Status;
use App\Notifications\OrderAssigned;
use App\Notifications\OrderBlDraftConfirmation;
use App\Notifications\OrderDocumentUploaded;
use App\Notifications\OrderPaymentConfirmed;
use App\Notifications\OrderPiLoaded;
use App\Notifications\OrderProcessed;
use App\Notifications\OrderShipmentStarted;
use App\Notifications\OrderShipmentStatusUpdated;
use App\Notifications\OrderStartShipment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;
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
     $statuses = Status::all();
     $role = Sentinel::findRoleById(4);
     $salesExecutives = $role->users()->get();

     $orders=[];        
     if(User::isSupervisor()){
            //$orders = Order::all();
       $orders = Order::where(function($query){
        $status = request('status')?request('status'):null;
        $assigned = request('assign_to_id')?request('assign_to_id'):null;

        if(isset($status)){
          $query->where('status','=',$status);
        }
        if(isset($assigned)){
          $query->where('assign_to_id','=',$assigned);
        }

        $query->where('status','>','0');
      })->orderBy('created_at','Desc')->paginate(15)->appends(['status'=> request('status'),'assign_to_id'=> request('assign_to_id')]);
     }
     elseif(User::isSalesExecutive()){
      $user=Sentinel::getUser();
           // $orders = Order::where('assign_to_id','=',$user->id)->get();

      $orders = Order::where(function($query) use ($user){
        $status = request('status')?request('status'):null;
        if(isset($status)){
          $query->where('status','=',$status)
          ->where('assign_to_id','=',$user->id);
        }

        $query->where('status','>','0')
        ->where('assign_to_id','=',$user->id);
      })->orderBy('created_at','Desc')->paginate(15)->appends('status',request('status'));
    }


    return view('backend.orders.index')->with('orders',$orders)->with('statuses',$statuses)->with('salesExecutives',$salesExecutives);

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

      $document_types = DocumentType::where('doc_type_id','=','1')->get();

      $order_shipment_statuses = OrderShipmentStatus::whereNotIn('id',function($query) use($id){
        $query->select('order_shipment_status_id')->from(with(new OrderShipment)->getTable())->where('order_id','=',$id );

      })->get();



      $rating = Rating::where('order_id','=',$id)->first();

      $flag=false;
      if(User::isSalesExecutive()){
        if(User::getId() == $order->assign_to_id)
          $flag=true;
      }
      if(User::isSupervisor() || $flag){

        $role = Sentinel::findRoleById(4);
        $users = $role->users()->get();
        return view('backend.orders.show')->with('order',$order)->with('users',$users)->with('document_types',$document_types)->with('order_shipment_statuses',$order_shipment_statuses)->with('rating',$rating);
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
        if($order->status < 4)
          $order->status = '4';
        $order->save();

         //Send Notification to assigned User
        $user=$order->AssignedTo;
        $user->notify(new OrderAssigned($order,"backend"));

        return redirect()->route('orders.show',$id)->with('success','Record updated successfully!');
      }
    }
    elseif($submitReq =="orderProcessed"){
      $order->status = '2';
      $order->save();

      //Send Notification to Supervisors
        //Get all Supervisors
      $role = Sentinel::findRoleBySlug('supervisor');
      $users = $role->users()->with('roles')->get();
      Notification::send($users, new OrderProcessed($order,"backend"));

      return redirect()->route('orders.show',$id)->with('success','Record updated successfully!');
    }
    elseif($submitReq =="addCommentPrvt"){
      $orderComment = new OrderComment;
      $orderComment->comment_type = '1';
      $orderComment->order_id = $id;
      $orderComment->user_id = User::getId();
      $orderComment->comment = $request->comment;
      $orderComment->is_private = '1';

      //Send Notification to Supervisor or Sales Executive
      if(User::isSupervisor())
      {
       $user=$order->AssignedTo;
       $user->notify(new NewOrderMessage($order,"backend"));
     }
     elseif(User::isSalesExecutive())
     {
       $role = Sentinel::findRoleBySlug('supervisor');
       $users = $role->users()->with('roles')->get();
       Notification::send($users, new NewOrderMessage($order,"backend"));
     }


     $orderComment->save();
     return redirect()->route('orders.show',$id)->with('success','Private message added successfully!');
   }
   elseif($submitReq =="addCommentPub"){
    $orderComment = new OrderComment;
    $orderComment->comment_type = '1';
    $orderComment->order_id = $id;
    $orderComment->user_id = User::getId();
    $orderComment->comment = $request->comment;
    $orderComment->is_private = '0';
    $orderComment->save();

          //Send Notification Customer
    $customer=$order->User;
    $customer->notify(new NewOrderMessage($order,"frontend"));


    return redirect()->route('orders.show',$id)->with('success','Public message added successfully!');
  }
  elseif($submitReq =="uploadDocument"){

    $this->validate($request, [
     'order_document' => 'required|mimes:pdf|max:10000',
     'document_type' => 'required'
     ]);

    $file = $request->file('order_document');
    $filename = rand(1,100).time().'.'. 'pdf';
    $location="order-docs/".$order->id.'/';
    if($file){

      Storage::disk('local')->put($location.$filename,  File::get($file));

      $doc_name = DocumentType::find($request->document_type);
      $doc_name =str_replace(' ', '', $doc_name->document_type_en);
      $orderFile = new OrderFile;
      $orderFile->filename=$filename;
      $orderFile->document_type = $request->document_type;
      $orderFile->mime=$file->getClientMimeType();
      $orderFile->original_filename=$doc_name.'-'.$order->id.'.pdf';
      $orderFile->user_id = Sentinel::check()->id;

      $order->OrderFiles()->save($orderFile);

      if($request->document_type == 1)
      {
        $order->status='9';
        $order->pi_confirmed  ='0';
        $order->save();
      }

      //Send Notification Customer
      $customer=$order->User;
      $customer->notify(new OrderPiLoaded($order,"frontend"));



      return redirect()->route('orders.show',$id)->with('success','File Uploaded successfully!');
    }    
  }
  elseif($submitReq == "confirmPayment"){
    $order->payment_status = '1';
    $order->status='12';

    //Send Notification Customer
    $customer=$order->User;
    $customer->notify(new OrderPaymentConfirmed($order,"frontend"));

    $order->save();
    return redirect()->route('orders.show',$id)->with('success','Payment confirmed!');
  }
  elseif($submitReq == "shipment"){
    $order->status = '8';
    $order->save();

     //Send Notification Customer
    $customer=$order->User;
    $customer->notify(new OrderShipmentStarted($order,"frontend"));

    //Send Notification to Sales Executive
    if($order->AssignedTo)
    {
     $user=$order->AssignedTo;
     $user->notify(new OrderStartShipment($order,"backend"));
   }

   return redirect()->route('orders.show',$id)->with('success','Order status shipment.');
 }
 elseif($submitReq == "addShippingstatus"){
  $orderShipment = new OrderShipment;
  $orderShipment->order_shipment_status_id = $request->order_shipment_status;
  $order->OrderShipments()->save($orderShipment);
  if($request->order_shipment_status =='1')
   $order->status = '14';
 elseif($request->order_shipment_status =='2')
   $order->status = '15';
 elseif($request->order_shipment_status =='3')
   $order->status = '16';
 elseif($request->order_shipment_status =='4')
   $order->status = '17';
 elseif($request->order_shipment_status =='5')
   $order->status = '18';

 $order->save();
 
 //Send Notification Customer
 if($order->status == '17')
 {
  $customer=$order->User;
  $customer->notify(new OrderBlDraftConfirmation($order,"frontend",$order->Status->status_en));

}
else{
 $customer=$order->User;
 $customer->notify(new OrderShipmentStatusUpdated($order,"frontend",$order->Status->status_en));
}

return redirect()->route('orders.show',$id)->with('success','Order status added.');
}
elseif($submitReq == "shipmentStatusImage"){
 $this->validate($request, [
   'order_shipment_document' => 'required|mimes:jpeg,png,jpg,gif,pdf|max:20000'
   ]);

 $file = $request->file('order_shipment_document');
 $filename = rand(1,100).time().'.'. $file->getClientOriginalExtension();
 $location="order-docs/".$order->id.'/';
 if($file){

  Storage::disk('local')->put($location.$filename,  File::get($file));

  $orderShipmentFile = new OrderShipmentFiles;
  $orderShipmentFile->filename=$filename;
  $orderShipmentFile->mime=$file->getClientMimeType();
  $orderShipmentFile->original_filename=$file->getClientOriginalName();

  $OrderShipment =Ordershipment::find($request->order_shipment_id);

  $OrderShipment->OrderShipmentFiles()->save($orderShipmentFile);


  return redirect()->route('orders.show',$id)->with('success','File Uploaded successfully!');
}    
}

elseif($submitReq == "shipmentTrackingUpdate"){
  $order->shipping_tracking_id = $request->shipping_tracking_id;
  $order->shipping_tracking_hyperlink = $request->shipping_tracking_hyperlink;
  $order->save();
  return redirect()->route('orders.show',$id)->with('success','Shipment tracking updated.');
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

          $location="order-docs/".$orderFile->Order->id.'/';
          $file = Storage::disk('local')->get( $location.$filename);
          $response = Response($file, 200);
          $response->header("Content-Type", 'application/pdf');
          return $response;
        }}
        else
          return redirect('backoffice/login');

      }


      public function getOrderShipmentFile($id)
      {
        $orderShipmentFile = OrderShipmentFiles::find($id);
        if($orderShipmentFile){
          $filename = $orderShipmentFile->filename;

          $flag=false;
          if(User::isSalesExecutive()){
            if(User::getId() == $orderShipmentFile->Ordershipment->Order->assign_to_id)
              $flag=true;
          }
          if(User::isSupervisor() || $flag){

            $location="order-docs/".$orderShipmentFile->Ordershipment->Order->id.'/';
            $file = Storage::disk('local')->get( $location.$filename);
            $response = Response($file, 200);
            $response->header("Content-Type", $orderShipmentFile->mime);
            return $response;
          }}
          else
            return redirect('backoffice/login');

        }
      }
