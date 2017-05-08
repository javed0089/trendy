<?php

namespace App\Http\Controllers\Frontend\MyAccount;

use App\Http\Controllers\Controller;
use App\Models\Order\DocumentType;
use App\Models\Order\Order;
use App\Models\Order\OrderComment;
use App\Models\Order\OrderFile;
use App\Models\Order\OrderProduct;
use App\Models\Order\OrderShipmentFiles;
use App\Models\Quotation\Quote;
use App\Models\Rating\Rating;
use App\Notifications\NewOrder;
use App\Notifications\NewOrderMessage;
use App\Notifications\NewQuoteMessage;
use App\Notifications\OrderBlConfirmed;
use App\Notifications\OrderDocumentUploaded;
use App\Notifications\OrderPiConfirmed;
use App\User;
use Illuminate\Http\Request;
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
      $user=User::find(Sentinel::check()->id);
      $orders = $user->Orders()->orderBy('created_at','Desc')->paginate(10);
      return view('frontend.account.order.orders')->with('orders',$orders);
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

      $order=[];
      $user=User::getUser();
      $order=$user->Orders()->find($id);
      $document_types = DocumentType::where('doc_type_id','=','2')->get();
      $total = $order->OrderProducts()->selectRaw('SUM(price * quantity) as total')->pluck('total');

      $rating = Rating::where('order_id','=',$id)->first();

      if($order)
        return view('frontend.account.order.order')->with('document_types',$document_types)->with('order',$order)->with('total',$total[0])->with('rating',$rating);
      else
        abort(404);
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
     $submitReq = $request->submit;
     if($submitReq =="addComment")
     {
      $orderComment = new OrderComment;
      $orderComment->comment_type = '1';
      $orderComment->order_id = $id;
      $orderComment->user_id = User::getId();
      $orderComment->is_private = '0';
      $orderComment->comment = $request->comment;

      //Send Notification to Assigned Sales Executive
      $order=Order::find($id);
      if($order->AssignedTo)
      {
        $assignedUser=$order->AssignedTo;
        $assignedUser->notify(new NewOrderMessage($order,"backend"));
      }
      
      //Send Notification to Supervisors
      //Get all Supervisors
      $role = Sentinel::findRoleBySlug('supervisor');
      $users = $role->users()->with('roles')->get();
      Notification::send($users, new NewOrderMessage($order,"backend"));

      $orderComment->save();

      return redirect()->route('myorders.show',$id)->with('success','Comment added successfully!');
    }
    elseif($submitReq =="uploadDocument")
    {

      $this->validate($request, [
       'order_document' => 'required|mimes:pdf|max:10000',
       'document_type' => 'required'
       ]);
      $order = Order::find($id);
      $file = $request->file('order_document');
      $filename = rand(1,100).time().'.'. 'pdf';
      $location="order-docs/".$order->id.'/';
      if($file)
      {
        $doc_name = DocumentType::find($request->document_type);
        $doc_name =str_replace(' ', '', $doc_name->document_type_en);

        Storage::disk('local')->put($location.$filename,  File::get($file));
        $orderFile = new OrderFile;
        $orderFile->filename=$filename;
        $orderFile->document_type = $request->document_type;
        $orderFile->mime=$file->getClientMimeType();
        $orderFile->original_filename=$doc_name.'-'.$order->id.'.pdf';
        $orderFile->user_id = Sentinel::check()->id;
        $order->OrderFiles()->save($orderFile);

        if($request->document_type == 2)
        {
          $order->status='10';
          $order->save();
        }
        elseif($request->document_type == 3)
        {
          $order->status='11';
          $order->save();
        }

        //Send Notification to Assigned Sales Executive
        if($order->AssignedTo)
        {
          $assignedUser=$order->AssignedTo;
          $assignedUser->notify(new OrderDocumentUploaded($order,"backend"));
        }

      //Send Notification to Supervisors
      //Get all Supervisors
        $role = Sentinel::findRoleBySlug('supervisor');
        $users = $role->users()->with('roles')->get();
        Notification::send($users, new OrderDocumentUploaded($order,"backend"));

        return redirect()->route('myorders.show',$id)->with('success','File Uploaded successfully!');
      }
    }

    elseif($submitReq == "confirmPi")
    {
      $order = Order::find($id);
      $order->pi_confirmed = '1';
      $order->status='10';
      $order->save();

      //Send Notification to Assigned Sales Executive
      if($order->AssignedTo)
      {
        $assignedUser=$order->AssignedTo;
        $assignedUser->notify(new OrderPiConfirmed($order,"backend"));
      }

      //Send Notification to Supervisors
      //Get all Supervisors
      $role = Sentinel::findRoleBySlug('supervisor');
      $users = $role->users()->with('roles')->get();
      Notification::send($users, new OrderPiConfirmed($order,"backend"));


      return redirect()->route('myorders.show',$id)->with('success','You have confirmed Performa Invoice!');
    }

    elseif($submitReq == "confirmBl")
    {
      $order = Order::find($id);
      $order->bl_draft_confirmed = '1';
      $order->save();

      //Send Notification to Assigned Sales Executive
      if($order->AssignedTo)
      {
        $assignedUser=$order->AssignedTo;
        $assignedUser->notify(new OrderBlConfirmed($order,"backend"));
      }

      //Send Notification to Supervisors
      //Get all Supervisors
      $role = Sentinel::findRoleBySlug('supervisor');
      $users = $role->users()->with('roles')->get();
      Notification::send($users, new OrderBlConfirmed($order,"backend"));


      return redirect()->route('myorders.show',$id)->with('success','You have confirmed BL Draft!');
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

    public function createOrder($id)
    {
      $quote = Quote::find($id);

      $order = new Order;
      $order->user_id =  Sentinel::check()->id;
      $order->quote_id = $id;
      $order->status = 1;
      $order->save();

      $order->order_no='GAP/ORD/'.date("Y").'/'.$order->id;
      $order->save();

      foreach ($quote->QuoteDetails as $quoteProduct) {
        if($quoteProduct->status==3)
        {
          $orderProduct = new OrderProduct;
          $orderProduct->product_id = $quoteProduct->product_id;
          $orderProduct->product_name = $quoteProduct->Product->name_en;
          $orderProduct->quantity = $quoteProduct->quantity;
          $orderProduct->unit = $quoteProduct->unit;
          $orderProduct->price = isset($quoteProduct->price)?$quoteProduct->price:0;
          $orderProduct->currency = $quoteProduct->currency;
          $orderProduct->port_of_delivery = $quoteProduct->port_of_delivery;
          $orderProduct->delivery_terms = $quoteProduct->delivery_terms ;
          $orderProduct->payment_method =$quoteProduct->payment_method;
          $orderProduct->shipping_doc_invoice =$quoteProduct->shipping_doc_invoice;
          $orderProduct->shipping_doc_packing_list =$quoteProduct->shipping_doc_packing_list;
          $orderProduct->shipping_doc_co = $quoteProduct->shipping_doc_co;
          $orderProduct->shipping_doc_others = $quoteProduct->shipping_doc_others;
          $orderProduct->shipping_doc_others_text = $quoteProduct->shipping_doc_others_text;
          $order->OrderProducts()->save($orderProduct);
        }
      }

      //Send Notification to Assigned Sales Executive
      if($order->AssignedTo)
      {
        $assignedUser=$order->AssignedTo;
        $assignedUser->notify(new NewOrder($order,"backend"));
      }

      //Send Notification to Supervisors
      //Get all Supervisors
      $role = Sentinel::findRoleBySlug('supervisor');
      $users = $role->users()->with('roles')->get();
      Notification::send($users, new NewOrder($order,"backend"));


      return redirect()->route('myorders.show',$order->id)->with('success', 'Your have succesfully created the order.');
    }

    public function getOrderFile($id)
    {
      $orderFile = OrderFile::find($id);
      if($orderFile){
        $filename = $orderFile->filename;


        if(Sentinel::check()->id ==$orderFile->Order->user_id){

          $location="order-docs/".$orderFile->Order->id.'/';
          $file = Storage::disk('local')->get( $location.$filename);
          $response = Response($file, 200);
          $response->header("Content-Type", 'application/pdf');
          return $response;
        }
        else
          return redirect('/login');
      }
      else
        return redirect('/login');

    }


    public function getOrderShipmentFile($id)
    {
      $orderShipmentFile = OrderShipmentFiles::find($id);
      if($orderShipmentFile){
        $filename = $orderShipmentFile->filename;

        if(Sentinel::check()->id ==$orderShipmentFile->Ordershipment->Order->user_id){

          $location="order-docs/".$orderShipmentFile->Ordershipment->Order->id.'/';
          $file = Storage::disk('local')->get( $location.$filename);
          $response = Response($file, 200);
          $response->header("Content-Type", $orderShipmentFile->mime);
          return $response;
        }
        else
          return redirect('backoffice/login');
      }
      else
        return redirect('/login');

    }
  }


