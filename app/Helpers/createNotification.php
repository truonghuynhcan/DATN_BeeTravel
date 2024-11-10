<?php

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

if (!function_exists('createNotification')) {
    /**
     * Tạo và lưu thông báo vào DB và gửi thông báo cho người dùng
     *
     * @param string $type - Loại thông báo
     * @param string $title - Tiêu đề thông báo
     * @param string $content - Nội dung thông báo
     * @param string|null $backgroundImage - Ảnh nền (URL)
     * @param int|null $userId - ID người dùng nhận thông báo (null nếu là user hiện tại)
     * @return Notification
     */
    function createNotification(string $type, string $title, string $content, ?string $backgroundImage = null)
    {
        // Lấy ID người dùng hiện tại nếu userId không được truyền vào
        $userId = $userId ?? Auth::id();

        // Tạo thông báo trong DB
        $notification = new Notification();
        $notification->type = $type;
        $notification->title = $title;
        $notification->description = $content;
        $notification->image_url = $backgroundImage;
        $notification->seen=0; // thông báo chưa được xem flase (0)
        $notification->user_id = Auth::id();
        $notification->save();

        // Gửi thông báo tới người dùng (nếu cần, bạn có thể tùy chỉnh thêm)
        notifyUser($userId, $notification);

        return $notification;
    }

    /**
     * Gửi thông báo cho người dùng
     *
     * @param int $userId - ID người dùng
     * @param Notification $notification - Thông báo đã tạo
     */
    function notifyUser(int $userId, Notification $notification)
    {
        // Ví dụ: có thể gửi in-app hoặc email notification
        // Notification::send(User::find($userId), new UserNotification($notification));
    }
}
