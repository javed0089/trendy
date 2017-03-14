<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page\Page;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function index()
    {
    	$topImage = [];
    	$topImage = Page::find(80)->PageSections()->first();
    	return view('frontend.forgotpassword')->with('topImage',$topImage);
    }

    
}
