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


    public function index()
    {
        
        return view('backend.notifications.index');
    }
    
}
