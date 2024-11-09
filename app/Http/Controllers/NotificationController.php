<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // trả về số lượng thông báo    
 public function getUserNotificationCount()
    {
        $userId = auth()->id();  // ID của người dùng hiện tại
        return Notification::where('user_id', $userId)->where('seen', 0) ->count(); 
    }

    public function seen($id)
    {
        // Lấy ID của người dùng hiện tại
        $userId = Auth::id();

        // đảm bảo thông báo thuộc về người dùng hiện tại.
        Notification::where('id', $id)->where('user_id', auth()->id())->update(['seen' => 1]);

        // Chuyển hướng lại trang hiện tại hoặc trang thông báo
        return redirect()->back();
    }
    
    public function seenAll()
    {
        // Lấy ID của người dùng hiện tại
        $userId = Auth::id();

        // Cập nhật tất cả các thông báo chưa đọc (seen = 0) thành đã đọc (seen = 1)
        Notification::where('user_id', $userId)
            ->where('seen', 0)
            ->update(['seen' => 1]);

        // Chuyển hướng lại trang hiện tại hoặc trang thông báo
        return redirect()->back()->with('status', 'Đã đánh dấu tất cả thông báo là đã đọc.');
    }
    
}
