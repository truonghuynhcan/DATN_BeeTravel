<?php

namespace App\Http\Controllers;

use App\Helpers\createNotification;
use App\Models\Customer;
use App\Models\NgayDi;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Tour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserOrderController extends Controller
{

    // ! TÌM ĐƠN HÀNG ĐÃ ĐẶT

    // ? GET
    public function orderFind()
    {
        return view('client.order_find');
    }

    // ? POST
    public function orderFind_(Request $request)
    {
        // Xác thực dữ liệu người dùng
        $validated = $request->validate([
            'madonghang' => ['nullable', 'regex:/^#?[A-Za-z0-9]*$/'], // Cho phép mã đơn hàng trống hoặc bắt đầu với dấu #
            'email' => 'nullable|email', // Email hợp lệ hoặc trống
            'confirm_email' => 'nullable|regex:/^[0-9]{6}$/', // Mã xác nhận gồm 6 số
            'phone' => ['nullable', 'regex:/^0[0-9]{9}$/'], // Số điện thoại hợp lệ
        ], [
            'confirm_email.regex' => 'Mã xác nhận phải là 6 chữ số.',
            'email.email' => 'Email không hợp lệ.',
            'phone.regex' => 'Số điện thoại không hợp lệ.',
        ]);

        // Kiểm tra nút nào được nhấn
        $action = $request->input('action');

        switch ($action) {
            case 'xacnhan':
                // Xử lý xác nhận tìm đơn hàng
                return $this->handleXacNhan($request);

            case 'guilai':
                return $this->handleGuiMoi($request);

            case 'guimoi':
                // Xử lý gửi mã xác nhận mới
                return $this->handleGuiMoi($request);

            default:
                // Trường hợp không hợp lệ
                return back()->withErrors(['msg' => 'Hành động không hợp lệ.']);
        }
    }

    protected function handleXacNhan($request)
    {
        // Loại bỏ dấu '#' khỏi mã đơn hàng (nếu có)
        $madonghang = str_replace('#', '', subject: $request->madonghang);

        $sessionCode = session('confirmation_code'); // lấy code ra để so sánh
        $inputCode = $request->confirm_email;

        if ($sessionCode != $inputCode) {
            return back()
                ->withInput()
                ->withErrors(['msg' => 'Hành động không hợp lệ.'])
                ->withErrors(['confirm_email' => 'Mã xác nhận không đúng.'])
                ->with('show_confirm_email', true);
            ;
        }

        if (!empty($madonghang)) {
            // nếu có thì chuyển thẳng qua trang chi tiết
            $order = Order::select('id')->find($madonghang);
            if ($order) {
                // ? nếu có dữ liệu -> chuyển sang page trang chi tiết.
                return redirect()->route("thanh_toan_thanh_cong", ['order_id' => $madonghang, 'key' => $inputCode]);
            } else {
                // ? nếu KO có dữ liệu -> back lại trang cùng với input.
                return back()
                    ->withInput()
                    ->withErrors(['msg' => 'Mã đơn hàng không tồn tại'])
                    ->with('show_confirm_email', true);
            }
        } else {
            $orders = Order::select('id', 'user_id', 'ngaydi_id', 'total_price', 'status', 'is_paid')
                ->with(['ngayDi.tour:id,image_url,title,slug'])
                ->where("email", $request->email)
                ->orderBy('id', 'desc')
                ->get();

            return back()->withInput()
                ->with('success', 'Xem danh sách tour phía dưới.')
                ->with('show_confirm_email', true)
                ->with('orders', $orders);

        }
    }

    protected function handleGuiLai($request)
    {
        // Logic xử lý gửi lại mã
        return back()->with('success', 'Mã đã được gửi lại.');
    }

    protected function handleGuiMoi($request)
    {
        // Tạo mã xác nhận và lưu vào session
        $confirmationCode = random_int(100000, 999999);
        session(['confirmation_code' => $confirmationCode, 'email' => $request->email]);

        // Gửi email mã xác nhận
        Mail::raw("$confirmationCode là mã xác nhận Bee Travel", function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Mã xác nhận');
        });

        // Thông báo cho người dùng
        return back()
            ->withInput()
            ->with('success', 'Mã xác nhận đã được gửi tới email của bạn.')
            ->with('show_confirm_email', true);
    }




    // key là key khóa trỏ từ bên tìm cho khách vãng lai
    public function viewThanhToanThanhCong($order_id, ?string $key = null)
    {
        // ? check id người dùng phải trùng với id trong db thì mới xem được phần của mình
        $order_raw = Order::find($order_id);
        
        if (!$order_raw) {
            # tour ko toonf taij
            return redirect()->route('home')->with('error', 'Tour không tồn tại');
        }


        $sessionCode = session('confirmation_code'); // lấy code ra để so sánh
        $email = session('email'); // lấy code ra để so sánh

        if ($key == $sessionCode && $email == $order_raw->email) {
            $order = Order::with('ngayDi', 'customer')->find($order_id);
            $tour = Tour::select('id', 'admin_id', 'title', 'slug', 'image_url', 'sub_title', 'duration')->with('admin:id,name')->find($order->ngayDi->tour_id);
            return view('client.thanh_toan_thanh_cong', compact('order', 'tour'));

        } else {
            if ($order_raw->user_id == null || $order_raw->user_id != Auth::id()) {
                // ? NẾU ID TỪ DB NULL HOẶC KO TRÙNG
                return redirect()->route('login')->with('error', 'Bạn cần phải đăng nhập để xem tour đã đặt');
            } else {
                // ? NẾU ĐÚNG người dùng đã đăng nhập tìm tour
                // LẤY INFO ORDER & TOUR
                $order = $order_raw->with('ngayDi', 'customer')->find($order_id);
                $tour = Tour::select('id', 'admin_id', 'title', 'slug', 'image_url', 'sub_title', 'duration')->with('admin:id,name')->find($order->ngayDi->tour_id);
                return view('client.thanh_toan_thanh_cong', compact('order', 'tour'));
            }
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
            'user-phone' => 'required|numeric|digits_between:9,10',
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

            'adult-quydanh.*.in' => 'Chọn Quý danh người lớn phải là "Quý ông" hoặc "Quý bà".',
            'adult-name.*.string' => 'Tên người lớn phải là chuỗi ký tự.',
            'adult-name.*.max' => 'Tên người lớn không được vượt quá 255 ký tự.',
            'adult-birthday.*.date' => 'Ngày sinh của người lớn phải là ngày hợp lệ.',
            'adult-birthday.*.before' => 'Ngày sinh của người lớn phải trước ngày hôm nay.',
            'adult-birthday.*.after' => 'Ngày sinh của người lớn không hợp lệ (phải lớn hơn 12 tuổi).',

            'child-quydanh.*.in' => 'Vui lòng chọn quý danh trẻ em phải là "Quý ông" hoặc "Quý bà".',
            'child-name.*.string' => 'Tên trẻ em phải là chuỗi ký tự.',
            'child-name.*.max' => 'Tên trẻ em không được vượt quá 255 ký tự.',
            'child-birthday.*.date' => 'Ngày sinh của trẻ em phải là ngày hợp lệ.',
            'child-birthday.*.before' => 'Ngày sinh của trẻ em không hợp lệ (phải nhỏ hơn 12 tuổi).',
            'child-birthday.*.after' => 'Ngày sinh của trẻ em không hợp lệ (phải lớn hơn 5 tuổi).',

            'toddler-quydanh.*.in' => 'Vui lòng chọn quý danh trẻ nhỏ phải là "Quý ông" hoặc "Quý bà".',
            'toddler-name.*.string' => 'Tên trẻ nhỏ phải là chuỗi ký tự.',
            'toddler-name.*.max' => 'Tên trẻ nhỏ không được vượt quá 255 ký tự.',
            'toddler-birthday.*.date' => 'Ngày sinh của trẻ nhỏ phải là ngày hợp lệ.',
            'toddler-birthday.*.before' => 'Ngày sinh của trẻ nhỏ không hợp lệ (phải nhỏ hơn 5 tuổi).',
            'toddler-birthday.*.after' => 'Ngày sinh của trẻ nhỏ không hợp lệ (phải lớn hơn 2 tuổi).',

            'infant-quydanh.*.in' => 'Vui lòng chọn quý danh em bé phải là "Quý ông" hoặc "Quý bà".',
            'infant-name.*.string' => 'Tên em bé phải là chuỗi ký tự.',
            'infant-name.*.max' => 'Tên em bé không được vượt quá 255 ký tự.',
            'infant-birthday.*.date' => 'Ngày sinh của em bé phải là ngày hợp lệ.',
            'infant-birthday.*.after' => 'Ngày sinh của em bé không hợp lệ (phải nhỏ hơn 2 tuổi).',

            'user-quydanh.required' => 'Vui lòng chọn quý danh cho người dùng.',
            'user-quydanh.in' => 'Vui lòng chọn quý danh người dùng phải là "Quý ông" hoặc "Quý bà".',
            'user-fullname.required' => 'Vui lòng nhập họ và tên.',
            'user-fullname.string' => 'Họ và tên phải là chuỗi ký tự.',
            'user-fullname.max' => 'Họ và tên không được vượt quá 255 ký tự.',
            'user-email.email' => 'Email không đúng định dạng.',
            'user-phone.required' => 'Vui lòng nhập số điện thoại.',
            'user-phone.numeric' => 'Số điện thoại phải là số.',
            'user-phone.digits_between' => 'Số điện thoại có độ dài từ 9 đến 10 số.',
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
        $order->user_id = Auth::id();
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
        $has_adult = false;
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

                        // Cần phải có ít nhất 1 người lớn
                        if ($type == "adult") {
                            $has_adult = true;
                        }
                    }
                }
            }
        }

        // nếu ko có ngườilớn
        if (!$has_adult) {
            $order->delete();
            return redirect()->back()->with('error', 'Cần phải có ít nhất 1 người lớn')->withInput();
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
                'Tour: ' . $tour_title->title . '.<br>Khởi hành lúc: ' . $ngaydi->start_date,
                'dattourthanhcong.jpg',  // hoặc null nếu không có ảnh nền
            );
        }

        $sessionCode = session('confirmation_code'); // lấy code ra để so sánh

        return redirect()->route('thanh_toan_thanh_cong', ['order_id' => $order->id, 'key' => $sessionCode]);
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

        //Nếu ngày đi không có thì ko cho đặt tour
        // Nếu tour không tồn tại
        if (!$tour) {
            return redirect()->back()->with('error', 'Tour không tồn tại!');
        }

        // Nếu ngày đi trống (ngayDi là một collection)
        if ($tour->ngayDi->isEmpty()) {
            return redirect()->back()->with('error', 'Hiện tour này chưa có lịch mới! Bạn có thể liên hệ Đối tác để biết thêm thông tin.');
        }

        // Hiển thị trang thanh toán
        return view('client.thanh_toan', compact('tour'));
    }
}
