<?php

namespace App\Http\Controllers\Language;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use LaravelLocalization;

class LanguageController extends Controller
{
    public function change($value)
    {
    	if(Session::get('lang')=='en'){
            LaravelLocalization::setLocale('ar');
    		App::setlocale('ar');
        }
       	else{
    		App::setlocale('en');
            LaravelLocalization::setLocale('en');

        }
    	
		Session::set('lang', App::getLocale());

    	return back();
    }
}
