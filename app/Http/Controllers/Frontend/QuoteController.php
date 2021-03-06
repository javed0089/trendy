<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use App\Models\Quotation\Cart;
use App\Models\Quotation\Quote;
use App\Models\Quotation\QuoteDetail;
use App\Models\Quotation\QuoteOption;
use App\Notifications\NewQuoteRequest;
use App\Notifications\QuoteRequestMade;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Sentinel;
use Session;
class QuoteController extends Controller
{
  public function index(Request $request)
  {
        //$this->confirmCart('1');

    $delivery_terms =QuoteOption::where('option_type','=','1')->get();
    $payment_methods =QuoteOption::where('option_type','=','2')->get();
    $units =QuoteOption::where('option_type','=','3')->get();

    if(Session::has('cart')){
      $cart = Session::has('cart')? Session::get('cart') : null;
      return view('frontend.quoterequest')->with('cart',$cart->items)->with('delivery_terms',$delivery_terms)->with('payment_methods',$payment_methods)->with('units',$units);
    }
    else{
      $cart =[];
      return view('frontend.quoterequest')->with('cart',$cart)->with('delivery_terms',$delivery_terms)->with('payment_methods',$payment_methods)->with('units',$units);
    }

  }

  public function addToCart(Request $request, $id)
  {
    try{
    $product = Product::find($id);
    $oldCart = Session::has('cart')? Session::get('cart') : null;

    if($oldCart)
    {
      if(!array_key_exists($id, $oldCart->items))
      {
        $cart = new cart($oldCart);
        $cart->add($product, $product->id);
        Session::put('cart', $cart);
        $msg = __('Product added to quote!');
      }
      else  
        $msg = __('Product already added!');
    }
    else
    {

      $cart = new cart($oldCart);
      $cart->add($product, $product->id);
      Session::put('cart', $cart);
      $msg = __('Product added to quote!');
    }
        //return redirect()->back();

    if(Session::has('cart'))
    {
      $response = array(
        'status' => 'success',
        'count' => Session::has('cart')? count(Session::get('cart')->items):'',
        'cartItem' => Session::has('cart')?Session::get('cart')->items[$product->id]:'',
        'msg' => $msg,
        );
    }
    else
    {
      $response = array(
        'status' => 'error',
        'msg' => 'There was an error!',
        );
    }
  }
     catch (ErrorException $e) {
             $response = array(
        'status' => 'error',
        'msg' => 'There was an error!',
        );
            return response()->json($response);
        }

    return response()->json($response);
  }



  public function removeCartItem(Request $request, $id)
  {

    $oldCart = Session::has('cart')? Session::get('cart') : null;
    $cart = new cart($oldCart);
    $cart->delete($id);

    Session::put('cart', $cart);
    $msg = __('Product removed from quote!');


    if($msg){
      $response = array(
        'status' => 'success',
        'prodId' => $id,
        'count' => Session::has('cart')? count(Session::get('cart')->items):'',
        'msg' => $msg,
        );
    }
    else
    {
      $response = array(
        'status' => 'error',
        'msg' => 'There was an error!',
        );
    }

    return response()->json($response);
  }

  public function updateCartItem(Request $request,$id)
  {

    $podNotReq = array('ExWorks','FOB');
    if((!in_array($request['delivery_terms'],$podNotReq ) && $request['port_of_delivery']=="") || $request['quantity']=="")
    {
      $this->validate($request, [
        'port_of_delivery' =>'required',
        'quantity' =>'required|numeric|min:16.50'
        ],$messages = [
        'port_of_delivery.required' => __('Port of delivery required!'),
        'quantity.required' => __('Quantity required!'),
        'quantity.min' => __('Quantity value not correct!'),
        ]);
    }

    $product = Product::find($id);
    $oldCart = Session::has('cart')? Session::get('cart') : null;
    $cart = new cart($oldCart);
    $cart->update($product, $product->id, $request->quantity,$request->unit,$request->port_of_delivery,$request->delivery_terms,$request->payment_method,$request->invoice,$request->packing_list,$request->co,$request->others,$request->others_text);
    Session::put('cart', $cart);

    if(Session::has('cart'))
    {
      $response = array(
        'status' => 'success',
        'msg' => __('Quote item updated!'),
        );
    }
    else
    {
      $response = array(
        'status' => 'error',
        'msg' => 'There was an error!',
        );
    }

    return response()->json($response);
  }





  public function sendQuoteRequest(Request $request)
  {
    $cart = Session::has('cart')? Session::get('cart') : null;
    $cart = new cart($cart);
    if($cart)
    {
      if(count($cart->items)>0)
      {
        foreach ($cart->items as $item) 
        {

          $podNotReq = array('ExWorks','FOB');
          if(!(in_array($item['delivery_terms'],$podNotReq )) && $item['port_of_delivery']=="")
          {
            Session::put('cart', $cart);
            return redirect()->back()->with('error',"Port of Delivery cannot be empty!");
          }
        }
        if(!Sentinel::check() && !Session::has('newUser'))
        {
          Session::put('oldUrl',URL::current());
          return redirect()->back()->with('error_code', 5);
        }
        else{


          $user=User::getUser();
          $userQuotes=$user->Quotes()->whereDate('created_at', '=', date('Y-m-d'))->get();
          if(count($userQuotes)>=3)
          {
            return redirect()->route('message')->with('error', __('Sorry! Your can only send 3 quotes a day. Please try again tomorrow. Thank you!'));
          }

          $quote = new Quote;
          if(Session::has('newUser'))
            $quote->user_id = Session::get('newUser')->id;
          elseif(Sentinel::check())
            $quote->user_id = Sentinel::check()->id;


          $quote->quote_validity = null;
          $quote->status = 1;
          $quote->save();

          $quote->quote_no='SQ/GAP/'.date("Y").'/'.$quote->id;
          $quote->save();


          foreach ($cart->items as $key=>$item) 
          {
            $quoteDetail = new QuoteDetail;
            $quoteDetail->product_id = $key;
            $quoteDetail->quantity = $item['quantity'];
            $quoteDetail->unit = $item['unit'];
            $quoteDetail->port_of_delivery = $item['port_of_delivery'];
            $quoteDetail->delivery_terms = $item['delivery_terms'];
            $quoteDetail->payment_method = $item['payment_method'];
            $quoteDetail->shipping_doc_invoice = $item['invoice'];
            $quoteDetail->shipping_doc_packing_list = $item['packing_list'];
            $quoteDetail->shipping_doc_co = $item['co'];
            $quoteDetail->shipping_doc_others = $item['others'];
            $quoteDetail->shipping_doc_others_text = $item['others_text'];
            $quoteDetail->status = '1';
            $quote->QuoteDetails()->save($quoteDetail);
          }


          Session::forget('cart');
          $newReg = Session::get('newUser');
          Session::forget('newUser');
          Session::forget('oldUrl');

          $this->sendNotifications($quote);

          if($newReg)
            return redirect()->route('message')->with('success', __('Your quote was send succesfully, but you must activate your account to have your request processed.'));
          else
            return redirect()->route('message')->with('success', __('Your quote was send succesfully.'));
        }

      }
      else{
        return redirect()->back();
      }
    }
  }
  

  public function sendNotifications($quote)
  { 

    //Get all Supervisors
    $role = Sentinel::findRoleBySlug('supervisor');
    $users = $role->users()->with('roles')->get();

    //Send Notification
    Notification::send($users, new NewQuoteRequest($quote));
  }

}
