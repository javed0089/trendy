<?php

namespace App\Http\Controllers\Frontend\MyAccount;

use App\Http\Controllers\Controller;
use App\Models\Order\DocumentType;
use App\Models\Order\Order;
use App\Models\Order\OrderComment;
use App\Models\Order\OrderFile;
use App\Models\Order\OrderProduct;
use App\Models\Quotation\Quote;
use App\User;
use Illuminate\Http\Request;
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
        $user=User::find(Sentinel::check()->id);
        $orders = $user->Orders()->get();
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
        $document_types = DocumentType::all();
        $total = $order->OrderProducts()->selectRaw('SUM(price * quantity) as total')->pluck('total');
        

        return view('frontend.account.order.order')->with('document_types',$document_types)->with('order',$order)->with('total',$total[0]);
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
       if($submitReq =="addComment"){
        $orderComment = new OrderComment;
        $orderComment->comment_type = '1';
        $orderComment->order_id = $id;
        $orderComment->user_id = User::getId();
        $orderComment->comment = $request->comment;

        $orderComment->save();

        return redirect()->route('myorders.show',$id)->with('success','Comment added successfully!');
    }
    elseif($submitReq =="uploadDocument"){

      $this->validate($request, [
       'order_document' => 'required|mimes:pdf|max:10000',
       'document_type' => 'required'
       ]);
      $order = Order::find($id);
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

        
        return redirect()->route('myorders.show',$id)->with('success','File Uploaded successfully!');
    }
}

elseif($submitReq == "confirmPi"){
    $order = Order::find($id);
    $order->pi_confirmed = '1';
    $order->save();
    return redirect()->route('myorders.show',$id)->with('success','You have confirmed Performa Invoice!');
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
        foreach ($quote->QuoteDetails as $quoteProduct) {
            $orderProduct = new OrderProduct;
            $orderProduct->product_id = $quoteProduct->product_id;
            $orderProduct->product_name = $quoteProduct->Product->name_en;
            $orderProduct->quantity = $quoteProduct->quantity;
            $orderProduct->unit = $quoteProduct->unit;
            $orderProduct->price = $quoteProduct->price;
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

        return redirect()->route('myorders.index')->with('success', 'Your have succesfully submitted your order.');
    }

    public function getOrderFile($id)
    {
        $orderFile = OrderFile::find($id);
        if($orderFile){
            $filename = $orderFile->filename;


            if(Sentinel::check()->id ==$orderFile->Order->user_id){

                $location="order-docs/";
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

}
