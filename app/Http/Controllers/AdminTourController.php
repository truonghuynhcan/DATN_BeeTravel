<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminTourController extends Controller
{

    // ! Tạo api lấy danh sách tour
    public function tours($admin_id)
    {
        // Lấy role của admin (chỉ lấy trường cần thiết để tiết kiệm tài nguyên)
        $role = Admin::where('id', $admin_id)->value('role');

        // Kiểm tra role để trả về tours tương ứng
        if ($role == 'admin') {
            // Lấy tất cả tours
            $tours = Tour::select('id', 'image_url', 'title', 'slug', 'admin_id', 'category_id')
                ->with(['admin:id,name', 'category:id,ten_danh_muc', 'ngayDi']) // khi sử dụng with ->luôn có cuột id
                ->get();
        } else {
            // Lấy tour thuộc về đối tác (admin_id)
            $tours = Tour::select('id', 'image_url', 'title', 'slug', 'category_id')
                ->with(['category', 'ngayDi'])
                ->where('admin_id', $admin_id)->get();
        }

        // trả kết quả
        $return = [
            'status' => true,
            'message' => 'Lấy dữ liệu tours thành công!',
            'data' => $tours,
        ];
        return response()->json($return, 200);
        // 200 - thành công
        // 404 - not found
        // 403 - forbidden thiếu quyền
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
