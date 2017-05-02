<?php

namespace App\Http\Controllers\Backend\Quotes;

use App\Http\Controllers\Controller;
use App\Models\Quotation\Quote;
use App\Models\Quotation\QuoteComment;
use App\Models\Quotation\QuoteDetail;
use App\Models\Quotation\QuoteOption;
use App\Models\Status\Status;
use App\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;

class QuoteController extends Controller
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

        $quotes=[];        
        if(User::isSupervisor()){
/*$queries =[];
$columns = ['status','assign_to_id'];
foreach ($columns as $column) {
    if(request()->has($column)){
        $quotes = Quote::where($column,request($column));
        $queries[$column] = request($column);
    }
}
}
if($queries)
$quotes = $quotes->paginate(2)->appends($queries);
else
$quotes = Quote::paginate(2);
*/


            $quotes = Quote::where(function($query){
                $status = request('status')?request('status'):null;
                $assigned = request('assign_to_id')?request('assign_to_id'):null;

                if(isset($status)){
                    $query->where('status','=',$status);
                }
                if(isset($assigned)){
                    $query->where('assign_to_id','=',$assigned);
                }

                $query->where('status','>','0');
            })->paginate(15)->appends(['status'=> request('status'),'assign_to_id'=> request('assign_to_id')]);
        }
        elseif(User::isSalesExecutive()){
            $user=Sentinel::getUser();
            $quotes = Quote::where(function($query) use ($user){
                $status = request('status')?request('status'):null;
                if(isset($status)){
                    $query->where('status','=',$status)
                    ->where('assign_to_id','=',$user->id);
                }

                $query->where('status','>','0')
                ->where('assign_to_id','=',$user->id);
            })->paginate(15)->appends('status',request('status'));
        }

        return view('backend.quotes.index')->with('quotes',$quotes)->with('statuses',$statuses)->with('salesExecutives',$salesExecutives);
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

        $flag=false;
        if(User::isSalesExecutive()){
            if(User::getId() == $quote->assign_to_id)
                $flag=true;
        }
        if(User::isSupervisor() || $flag){

            $delivery_terms =QuoteOption::where('option_type','=','1')->get();
            $payment_methods =QuoteOption::where('option_type','=','2')->get();
            $units =QuoteOption::where('option_type','=','3')->get();
            $currencies =QuoteOption::where('option_type','=','4')->get();
            $statuses =Status::where('status_type','=','2')->get();

            $role = Sentinel::findRoleById(4);
            $users = $role->users()->get();
            return view('backend.quotes.show')->with('quote',$quote)->with('users',$users)->with('delivery_terms',$delivery_terms)->with('payment_methods',$payment_methods)->with('units',$units)->with('statuses',$statuses)->with('currencies',$currencies);
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


        $quote = Quote::find($id);
        $submitReq = $request->submit;

        if($submitReq =="assignSalesRep"){
            $this->validate($request, [
                'assign_to_id' =>   'required',
                ]);
            if($request->assign_to_id>0){
                $quote->assign_to_id = $request->assign_to_id;
                $quote->status = '4';
                $quote->save();

                return redirect()->route('quote-requests.show',$id)->with('success','Record updated successfully!');
            }
        }
        elseif($submitReq =="saveProduct"){

            $podNotReq = array('ExWorks','FOB');
            if((!in_array($request->delivery_terms,$podNotReq ) && $request->port_of_delivery==""))
            {
                $this->validate($request, [
                    'port_of_delivery' =>   'required',
                    ]);
            }
            if(in_array($request->delivery_terms,$podNotReq )) 
            {
                $request->port_of_delivery="";
            }
            $this->validate($request, [
                'quantity' =>   'required',
                'price' =>   'required',
                ]);

            $quoteDetail = QuoteDetail::find($id);
            $quoteDetail->quantity = $request->quantity;
            $quoteDetail->unit = $request->unit;
            $quoteDetail->price = $request->price;
            $quoteDetail->currency = $request->currency;
            $quoteDetail->port_of_delivery =$request->port_of_delivery;
            $quoteDetail->delivery_terms = $request->delivery_terms;
            $quoteDetail->payment_method = $request->payment_method;
            $quoteDetail->shipping_doc_invoice = isset($request->invoice) ? '1':'0';
            $quoteDetail->shipping_doc_packing_list = isset($request->packing_list) ? '1':'0';
            $quoteDetail->shipping_doc_co = isset($request->co) ? '1':'0';
            $quoteDetail->shipping_doc_others = isset($request->others) ? '1':'0';
            $quoteDetail->shipping_doc_others_text = $request->others_text;
            $quoteDetail->status = !empty($request->status)?$request->status : $quoteDetail->status;
            $quoteDetail->save();
            return redirect()->route('quote-requests.show',$quoteDetail->quote_id)->with('success','Record updated successfully!');
        }
        elseif($submitReq =="quoteProcessed"){
           $quote->status = '2';
           $quote->save();

           foreach ($quote->QuoteDetails as $quoteProduct) {
               if($quoteProduct->status == '4')
                $quoteProduct->status = '2';
            $quoteProduct->save();
        }
        return redirect()->route('quote-requests.show',$id)->with('success','Record updated successfully!');
    }
    elseif($submitReq =="setValidity"){
       $quote->quote_validity = $request->quote_validity;
       $quote->save();

       return redirect()->route('quote-requests.show',$id)->with('success','Record updated successfully!');
   }
   elseif($submitReq =="sendQuote"){
       $quote->status = '3';
       $quote->save();

       foreach ($quote->QuoteDetails as $quoteProduct) {
           if($quoteProduct->status == '2')
            $quoteProduct->status = '3';
        $quoteProduct->save();
    }
    return redirect()->route('quote-requests.show',$id)->with('success','Record updated successfully!');

}
elseif($submitReq =="addComment"){
    $quoteComment = new QuoteComment;
    $quoteComment->comment_type = '1';
    $quoteComment->quote_id = $id;
    $quoteComment->user_id = User::getId();
    $quoteComment->comment = $request->comment;

    $quoteComment->save();

    return redirect()->route('quote-requests.show',$id)->with('success','Comment added successfully!');

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
