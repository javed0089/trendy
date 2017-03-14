<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use App\Models\Quotation\Cart;
use App\Models\Quotation\Quote;
use App\Models\Quotation\QuoteDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Sentinel;
use Session;
use App\User;
class QuoteController extends Controller
{
    public function index(Request $request)
    {
        //$this->confirmCart('1');
        if(Session::has('cart')){
            $cart = Session::has('cart')? Session::get('cart') : null;
    		return view('frontend.cart')->with('cart',$cart->items)->with('step',$cart->step);
        }
        else{
            $cart =[];
            return view('frontend.cart')->with('cart',$cart)->with('step','1');
        }

    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart')? Session::get('cart') : null;
        $cart = new cart($oldCart);
        $cart->add($product, $product->id);
        Session::put('cart', $cart);

        return redirect()->back();
    }

    public function updateCart(Request $request, $id)
    {
    	$product = Product::find($id);
    	$submitReq = $request->submit;
        if($submitReq =="btn-update"){
	    	$oldCart = Session::has('cart')? Session::get('cart') : null;
	        $cart = new cart($oldCart);
	        $cart->update($product, $product->id, $request->quantity,$request->unit,$request->port_of_delivery,$request->delivery_terms,$request->payment_method,$request->invoice,$request->packing_list,$request->co,$request->others,$request->others_text);
	        Session::put('cart', $cart);
    	}
    	elseif($submitReq =="btn-delete"){
    		$oldCart = Session::has('cart')? Session::get('cart') : null;
	        $cart = new cart($oldCart);
	        $cart->delete($id);
            $cart->step='1';
	        Session::put('cart', $cart);
    	}

         return redirect()->back();
    }

    public function confirmCart($id)
    {
        $cart = Session::has('cart')? Session::get('cart') : null;
        $cart = new cart($cart);

        if($cart){
            if(count($cart->items)>0){
                $cart->step='2';
                if(Sentinel::check()){
                    $cart->step='3';
                    Session::put('cart', $cart);
                    return redirect()->route('cart');
                }
            }
            else
                $cart->step='1';
        }
        else
            $cart->step='1';

        Session::put('cart', $cart);
        if($id=='2'){
            Session::put('oldUrl',URL::current());
            return redirect()->route('frontend.login');
        }
                
        return redirect()->route('cart');
    }


    public function postConfirmCart(Request $request,$id)
    {
        $cart = Session::has('cart')? Session::get('cart') : null;
        $cart = new cart($cart);
        if($cart){
            if(count($cart->items)>0){
                $cart->step='2';
                if(Sentinel::check()){
                    $cart->step='3';
                    Session::put('cart', $cart);
                    return redirect()->route('cart');
                }
            }
            else
                $cart->step='1';
        }
        else
            $cart->step='1';

        Session::put('cart', $cart);

        if($id=='2'){
            if($request->radio1 == 'login'){
                Session::put('oldUrl',URL::current());
                return redirect()->route('frontend.login');
            }
            elseif($request->radio1 == 'register'){
                Session::put('oldUrl',URL::current());
                return redirect()->route('frontend.register');
            }
        }
        return redirect()->route('cart');
    }

    public function sendQuote(Request $request)
    {
        $cart = Session::has('cart')? Session::get('cart') : null;
        $cart = new cart($cart);

        if($cart){
            if(count($cart->items)>0){
                if(!Sentinel::check()){
                    $cart->step='2';
                    Session::put('cart', $cart);
                    return redirect()->route('cart');
                }
            }
            else{
                $cart->step='1';
                Session::put('cart', $cart);
                return redirect()->route('cart');
            }
        }
        else{
            $cart->step='1';
            Session::put('cart', $cart);
            return redirect()->route('cart');
        }


        $quote = new Quote;
        $quote->user_id = Sentinel::check()->id;
        $quote->quote_validity = null;
        $quote->status = 1;
        $quote->save();

        foreach ($cart->items as $key=>$item) {
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

        return redirect()->route('message')->with('success', 'Your quote was send succesfully.');
    }

    
    

}
