<?php

namespace App\Http\Controllers;

use App\Helpers\createNotification;
use App\Models\Customer;
use App\Models\NgayDi;
use App\Models\Order;
use App\Models\Tour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserOrderController extends Controller
{

    public function viewThanhToanThanhCong($order_id)
    {
        $order = Order::where('user_id', Auth::id())->with('ngayDi', 'customer')->find($order_id);
        if (!$order) {
            // Nếu không có đơn hàng, quay lại trang trước
            return redirect()->route('home');
        } else {
            $tour = Tour::select('id', 'admin_id', 'title', 'slug', 'image_url', 'sub_title', 'duration')->with('admin:id,name')->find($order->ngayDi->tour_id);
            return view('client.thanh_toan_thanh_cong', compact('order', 'tour'));
        }
    }



    public function thanhToan_(Request $request)
    {
        $validated = $request->validate([
            // Thông tin chung
            'ngaykhoihanh' => 'required|exists:ngay_di,id',

            // Thông tin hành khách
            'adult-quydanh.*' => 'nullable|in:mr,mrs',
            'adult-name.*' => 'nullable|string|max:255',
            'adult-birthday.*' => 'nullable|date|before:today|after:' . now()->subYears(200)->toDateString(),

            'child-quydanh.*' => 'nullable|in:mr,mrs',
            'child-name.*' => 'nullable|string|max:255',
            'child-birthday.*' => 'nullable|date|before:' . now()->subYears(5)->toDateString() . '|after:' . now()->subYears(12)->toDateString(),

            'toddler-quydanh.*' => 'nullable|in:mr,mrs',
            'toddler-name.*' => 'nullable|string|max:255',
            'toddler-birthday.*' => 'nullable|date|before:' . now()->subYears(2)->toDateString() . '|after:' . now()->subYears(5)->toDateString(),

            'infant-quydanh.*' => 'nullable|in:mr,mrs',
            'infant-name.*' => 'nullable|string|max:255',
            'infant-birthday.*' => 'nullable|date|after:' . now()->subYears(2)->toDateString(),

            // Thông tin người dùng
            'user-quydanh' => 'required|in:mr,mrs',
            'user-fullname' => 'required|string|max:255',
            'user-email' => 'nullable|email',
            'user-phone' => 'required|numeric|digits_between:9,11',
            'user-address' => 'required|string|max:255',

            // Mã giảm giá
            'voucher_code' => 'nullable|string|max:50',

            // Phương thức thanh toán
            'user-payment' => 'required|in:0,1',
            'tongtien' => 'required|numeric|min:0',
        ], [
            // Thông báo lỗi
            'ngaykhoihanh.required' => 'Vui lòng chọn ngày khởi hành.',
            'ngaykhoihanh.exists' => 'Ngày khởi hành không hợp lệ.',

            'adult-quydanh.*.in' => 'Quý danh người lớn phải là "mr" hoặc "mrs".',
            'adult-name.*.string' => 'Tên người lớn phải là chuỗi ký tự.',
            'adult-name.*.max' => 'Tên người lớn không được vượt quá 255 ký tự.',
            'adult-birthday.*.date' => 'Ngày sinh của người lớn phải là ngày hợp lệ.',
            'adult-birthday.*.before' => 'Ngày sinh của người lớn phải trước ngày hôm nay.',
            'adult-birthday.*.after' => 'Ngày sinh của người lớn không hợp lệ (phải lớn hơn 12 tuổi).',

            'child-quydanh.*.in' => 'Quý danh trẻ em phải là "mr" hoặc "mrs".',
            'child-name.*.string' => 'Tên trẻ em phải là chuỗi ký tự.',
            'child-name.*.max' => 'Tên trẻ em không được vượt quá 255 ký tự.',
            'child-birthday.*.date' => 'Ngày sinh của trẻ em phải là ngày hợp lệ.',
            'child-birthday.*.before' => 'Ngày sinh của trẻ em không hợp lệ (phải nhỏ hơn 12 tuổi).',
            'child-birthday.*.after' => 'Ngày sinh của trẻ em không hợp lệ (phải lớn hơn 5 tuổi).',

            'toddler-quydanh.*.in' => 'Quý danh trẻ nhỏ phải là "mr" hoặc "mrs".',
            'toddler-name.*.string' => 'Tên trẻ nhỏ phải là chuỗi ký tự.',
            'toddler-name.*.max' => 'Tên trẻ nhỏ không được vượt quá 255 ký tự.',
            'toddler-birthday.*.date' => 'Ngày sinh của trẻ nhỏ phải là ngày hợp lệ.',
            'toddler-birthday.*.before' => 'Ngày sinh của trẻ nhỏ không hợp lệ (phải nhỏ hơn 5 tuổi).',
            'toddler-birthday.*.after' => 'Ngày sinh của trẻ nhỏ không hợp lệ (phải lớn hơn 2 tuổi).',

            'infant-quydanh.*.in' => 'Quý danh em bé phải là "mr" hoặc "mrs".',
            'infant-name.*.string' => 'Tên em bé phải là chuỗi ký tự.',
            'infant-name.*.max' => 'Tên em bé không được vượt quá 255 ký tự.',
            'infant-birthday.*.date' => 'Ngày sinh của em bé phải là ngày hợp lệ.',
            'infant-birthday.*.after' => 'Ngày sinh của em bé không hợp lệ (phải nhỏ hơn 2 tuổi).',

            'user-quydanh.required' => 'Vui lòng chọn quý danh cho người dùng.',
            'user-quydanh.in' => 'Quý danh người dùng phải là "mr" hoặc "mrs".',
            'user-fullname.required' => 'Vui lòng nhập họ và tên.',
            'user-fullname.string' => 'Họ và tên phải là chuỗi ký tự.',
            'user-fullname.max' => 'Họ và tên không được vượt quá 255 ký tự.',
            'user-email.email' => 'Email không đúng định dạng.',
            'user-phone.required' => 'Vui lòng nhập số điện thoại.',
            'user-phone.numeric' => 'Số điện thoại phải là số.',
            'user-phone.digits_between' => 'Số điện thoại có độ dài từ 9 đến 11 số.',
            'user-address.required' => 'Vui lòng nhập địa chỉ.',
            'user-address.string' => 'Địa chỉ phải là chuỗi ký tự.',
            'user-address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',

            'voucher_code.string' => 'Mã giảm giá phải là chuỗi ký tự.',
            'voucher_code.max' => 'Mã giảm giá không được vượt quá 50 ký tự.',

            'user-payment.required' => 'Vui lòng chọn phương thức thanh toán.',
            'user-payment.in' => 'Phương thức thanh toán không hợp lệ.',
            'tongtien.required' => 'Vui lòng nhập tổng tiền.',
            'tongtien.numeric' => 'Tổng tiền phải là số.',
            'tongtien.min' => 'Tổng tiền phải lớn hơn hoặc bằng 0.',
        ]);

        // nhập thông tin
        $order = new Order();
        $order->ngaydi_id = $validated['ngaykhoihanh']; // lấy id ngày khởi hành
        $order->user_id = $validated['user_id'] ?? null;
        $order->gender = $validated['user-quydanh'];
        $order->fullname = $validated['user-fullname'];
        $order->phone = $validated['user-phone'];
        $order->email = $validated['user-email'] ?? null;
        $order->address = $validated['user-address'];
        $order->is_paid = $validated['user-payment'];
        $order->voucher_code = $validated['voucher_code'] ?? null;
        $order->total_price = $validated['tongtien'];
        $order->save();

        // người lớn, trẻ em, trẻ nhỏ, em bé
        $customer_type = ['adult', 'child', 'toddler', 'infant'];
        $count = [
            'adult' => 0,
            'child' => 0,
            'toddler' => 0,
            'infant' => 0,
        ];
        foreach ($customer_type as $type) {
            if (isset($validated["{$type}-quydanh"])) {
                foreach ($validated["{$type}-quydanh"] as $key => $quydanh) {
                    if ($quydanh !== null && $validated["{$type}-name"][$key] !== null && $validated["{$type}-birthday"][$key] !== null) {
                        $customer = new Customer();
                        $customer->order_id = $order->id;
                        $customer->gender = $quydanh;
                        $customer->name = $validated["{$type}-name"][$key];
                        $customer->birth_date = $validated["{$type}-birthday"][$key];
                        $customer->save();
                        $count[$type] += 1;
                    }
                }
            }
        }
        $order->adult_count = $count['adult'];
        $order->child_count = $count['child'];
        $order->toddler_count = $count['toddler'];
        $order->infant_count = $count['infant'];
        $order->save();
        // Kiểm tra nếu chưa đăng nhập thif không cần thêm thông báo
        if (Auth::check()) {
            // lấy id tour từ ngày đi người dùng đã chọn
            $ngaydi = NgayDi::select('start_date', 'tour_id')->find($order->ngaydi_id);
            $tour_title = Tour::select('title')->find($ngaydi->tour_id);
            $noti = createNotification(
                'success',
                'Đặt tour thành công',
                'Tour: ' . $tour_title . ' </br>Khởi hành: ' . $ngaydi->start_date,
                'imrs2.png',  // hoặc null nếu không có ảnh nền
            );
        }

        return redirect()->route('thanh_toan_thanh_cong', $order->id);
    }


    public function viewThanhToan($id_tour)
    {
        $now = Carbon::now();
        $tour = Tour::select('id', 'title', 'duration')
            ->with([
                'ngayDi' => function ($query) use ($now) {
                    $query->where('start_date', '>', $now) // Filter for future dates
                        ->orderBy('start_date'); // Order by date ascending
                }
            ])
            ->find($id_tour);

        return view('client.thanh_toan', compact('tour'));
    }
}
