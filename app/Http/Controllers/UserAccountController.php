<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Order;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAccountController extends Controller
{
    public function myProfileView()
    {
        return view('client.user_account_profile');
    }
    public function myPaymentView()
    {
        return view('client.user_account_payment');
    }
    public function settingNotificationView()
    {
        return view('client.user_setting_notification');
    }
    public function settingSecurityView()
    {
        return view('client.user_setting_security');
    }

    public function myTourView()
    {
        $orders = Order::select('id', 'ngaydi_id', 'user_id','status')
            ->with(['ngayDi.tour:id,image_url,title,slug'])
            ->where('user_id', Auth::id())
            ->orderBy('id','desc')
            ->get();
        // dd($orders);
        return view('client.user_booking', compact('orders'));
    }

    public function settingNotificationsOrderView()
    {
        $user_id = Auth::id();
        $notiList = Notification::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
        // dd($notiList);
        return view('client.user_notifications_order', compact('notiList'));
    }
}
