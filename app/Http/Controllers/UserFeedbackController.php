<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Order;
use Illuminate\Http\Request;

class UserFeedbackController extends Controller
{
    public function danhgia_(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'tour_id' => 'required|exists:tours,id',
            'user_id' => 'required|exists:users,id',
            'star' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        $feedback = new Feedback();
        $feedback->user_id = $request->user_id;
        $feedback->tour_id = $request->tour_id;
        $feedback->star = $request->star;
        $feedback->comment = $request->comment;
        $feedback->save();

        // Tạo thông báo
        $type = 'success';
        $title = 'Đánh giá mới';
        $content = 'Bạn đã gửi đánh giá ' . $request->star . ' sao cho tour #' . $request->tour_id;
        createNotification($type, $title, $content);

        // Redirect lại trang với thông báo thành công

        return redirect()->back()->with('success', 'Đánh giá của bạn đã được lưu thành công!');
    }
}
