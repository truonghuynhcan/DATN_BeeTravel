<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('client.user_booking');
    }
    public function settingNotificationsOrderView()
    {
        return view('client.user_notifications_order');
    }
}
