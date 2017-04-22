<?php 

namespace App\Http\ViewComposers;
use App\Models\Block\Block;
use App\Models\Product\Category;
use App\Models\Product\Product;
use App\Models\Quotation\QuoteOption;
use App\Models\Service\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Sentinel;
class SidebarComposer{

	public function compose(View $view)
	{
		$data=$view->getData();
		
		$activeLink="";
		if(!empty($data['activeLink']))
			$activeLink=$data['activeLink'];

		
		$locale=Session::get('lang');
		
		$header_blocks=Block::where('block_type','=','header')->get();
		$social_blocks=Block::where('block_type','=','social')->get();
		$footer_blocks=Block::where('block_type','=','footer')->get();

		$menuParentCats= Category::where('parent_id','=','0')->get();
		$menuSubCats= Category::where('parent_id','!=','0')->get();
		$menuProducts= Product::where('discontinued','=','0')->get();
		$menuServices= Service::where('status','=','1')->get();



		if(Session::has('cart')){
			$cart = Session::has('cart')? Session::get('cart') : null;

		}
		else{
			$cart =[];

		}
		$units =QuoteOption::where('option_type','=','3')->get();
		$orders=[];
		if(Sentinel::check()){
			$user=User::find(Sentinel::check()->id);
			if($user)
				$orders = $user->Orders()->get();
		}
		$myquotes=[];
		if(Sentinel::check()){
			$user=User::find(Sentinel::check()->id);
			if($user)
				$myquotes = $user->Quotes()->get();
		}
if(count($cart)>0)
	$cart=$cart->items;
    	
		$view->with('activeLink',$activeLink)->with('locale',$locale)->with('header_blocks',$header_blocks)->with('social_blocks',$social_blocks)->with('footer_blocks',$footer_blocks)->with('menuParentCats',$menuParentCats)->with('menuSubCats',$menuSubCats)->with('menuProducts',$menuProducts)->with('menuServices',$menuServices)->with('cart',$cart)->with('units',$units)->with('orders',$orders)->with('myquotes',$myquotes);
	}
}