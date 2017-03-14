<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Quotation\Quote;
use App\Models\Quotation\QuoteDetail;
use Sentinel;
use App\User;
class MyAccountController extends Controller
{
    public function index()
    {

    	$user=User::find(Sentinel::check()->id);
    	dd($user->Quotes()->get());
    	return view('frontend.myaccount');
    }
}
