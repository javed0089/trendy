<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Models\Order\Order;
use App\Models\Product\Category;
use App\Models\Product\Product;
use App\Models\Quotation\Quote;
use App\Models\Rating\Rating;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Sentinel;

class DashboardController extends Controller
{
	public function index()
	{
		$totalOrders = Order::count();
		$totalQuotes = Quote::count();
		$totalRegistrations = User::where(['backend_user' => 0])->count();
		$totalProducts = Product::count();


		$categories= Category::with('children')->where('parent_id','=','0')->get();
		$prodcount=[];
		foreach ($categories as $parent) {
			$counter;
			$cat=[];
			$counter = $parent->Products->count();

			if ($parent->children->count())
			{
				foreach ($parent->children as $child)
				{
					$counter += $child->Products->count();
				}
			}
			$cat=['name' =>$parent->name_en,'logo'=>$parent->logo,'prodCount'=>$counter];
			$prodcount[]=$cat;
		}
		$quotes=[];
		$quotesForApproval=[];
		if(User::isSupervisor())
		{
			$quotes = Quote::whereDate('created_at', '>=', Carbon::today()->subDays(10)->toDateString())->get();
			$quotesForApproval = Quote::where('status', '=', '2')->get();
		}
		elseif(User::isSalesExecutive())
		{
			$user=Sentinel::getUser();
			$quotes = Quote::whereDate('created_at', '>=', Carbon::today()->subDays(10)->toDateString())
			->where('assign_to_id','=',$user->id)->get();

		}

		$orders=[];
		if(User::isSupervisor())
		{
			$orders = Order::whereDate('created_at', '>=', Carbon::today()->subDays(10)->toDateString())->get();
		}
		elseif(User::isSalesExecutive())
		{
			$user=Sentinel::getUser();
			$orders = Order::whereDate('created_at', '>=', Carbon::today()->subDays(10)->toDateString())
			->where('assign_to_id','=',$user->id)->get();
		}



		$ratings = new Rating();


		return view('backend.index')->with('totalOrders',$totalOrders)->with('totalQuotes',$totalQuotes)->with('totalRegistrations',$totalRegistrations)->with('totalProducts',$totalProducts)->with('ratings',$ratings)->with('quotes',$quotes)->with('orders',$orders)->with('prodcount',$prodcount)->with('quotesForApproval',$quotesForApproval);
	}
}
