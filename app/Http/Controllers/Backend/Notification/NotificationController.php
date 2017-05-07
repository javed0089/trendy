<?php

namespace App\Http\Controllers\Backend\Notification;

use App\Http\Controllers\Controller;
use App\Models\Quotation\Quote;
use App\Notifications\QuoteRequestMade;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function send()
    {
    	$quote = Quote::find('7');
    	//Multi
    	//$user = User::where('id','>','14')->get();

    	//Single
    	$user = User::find('15');
    	//dd($user);
    	//Notification::send($user, new QuoteRequestMade($quote));
    	$user->notify(new QuoteRequestMade($quote));

    	dd("Notification send");
    }
}
