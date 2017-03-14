<?php 

namespace App\Http\ViewComposers;
use App\Models\Block\Block;
use App\Models\Product\Category;
use App\Models\Product\Product;
use App\Models\Service\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

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
		$menuProducts= Product::all();
		$menuServices= Service::where('status','=','1')->get();
    	
		$view->with('activeLink',$activeLink)->with('locale',$locale)->with('header_blocks',$header_blocks)->with('social_blocks',$social_blocks)->with('footer_blocks',$footer_blocks)->with('menuParentCats',$menuParentCats)->with('menuSubCats',$menuSubCats)->with('menuProducts',$menuProducts)->with('menuServices',$menuServices);
	}
}