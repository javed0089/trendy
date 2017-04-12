<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Models\Order\Order;
use App\Models\Quotation\Quote;
use App\Models\Rating\Rating;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
    	$totalOrders = Order::count();
    	$totalQuotes = Quote::count();
    	$totalRegistrations = User::where(['backend_user' => 0])->count();


    	$ratings = new Rating();
    	    	
    	return view('backend.index')->with('totalOrders',$totalOrders)->with('totalQuotes',$totalQuotes)->with('totalRegistrations',$totalRegistrations)->with('ratings',$ratings);
    }
}
