<?php

namespace App\Http\Controllers\Backend\Notification;

use App\Http\Controllers\Controller;
use App\Models\Quotation\Quote;
use App\Notifications\QuoteRequestMade;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;

class NotificationController extends Controller
{


	public function index()
	{
		$notifications= User::getUser()->unReadNotifications;
		return view('backend.notifications.index')->with('notifications',$notifications);
	}

	public function allNotifications()
	{
		$notifications= User::getUser()->Notifications;
		return view('backend.notifications.index')->with('notifications',$notifications);
	}

	public function markAsRead($id)
	{
		$notification = User::getUser()->notifications()->findOrFail($id);
		$notification->markAsRead();
		return back();
	}

	public function markAllAsRead()
	{
		User::getUser()->unreadNotifications->markAsRead();
		return back();
	}

	public function delete()
	{
		$notifications=User::getUser()->notifications()->whereNotNull('read_at')->get();
		foreach ($notifications as $notification) {
			$notification->delete();
		}
		return back();
		
	}

	public function deleteNotification($id)
	{
		$notification = User::getUser()->notifications()->findOrFail($id);
		$notification->delete();
		return back();
		
	}


	public function evaluateNotification($notification)
	{

		try {
			$notification = User::getUser()->notifications()->findOrFail($notification);
			$notification->markAsRead();
			return redirect(route($notification->data['route-name'],$notification->data['Id']));
			
		} catch (\Exception $e) {
			return back();
		}

	}
}
