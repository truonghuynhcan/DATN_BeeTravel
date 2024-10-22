<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // lấy id và name đối tác
    public function getProviderAll()
    {
        $provider = Admin::select('id','name', 'role')->where('role','provider')->get();
        // trả kết quả
        $return = [
            'status' => true,
            'message' => 'Lấy dữ liệu tours thành công!',
            'data' => $provider,
        ];
        return response()->json($return, 200);
    }



    // Get all admins or selectively based on query parameters
    public function index(Request $request)
    {
        $query = Admin::query();

        // Apply selective filters if any are present in the request
        if ($request->has('role')) {
            $query->where('role', $request->input('role'));
        }

        if ($request->has('is_block')) {
            $query->where('is_block', $request->input('is_block'));
        }

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        // Fetch data based on the query or return all admins if no filters are applied
        $admins = $query->get();

        return response()->json($admins, 200);
        // /api/admins to fetch all admins.
        // /api/admins?role=admin to filter admins by role.
        // /api/admins?is_block=false to filter non-blocked admins.
        // /api/admins?name=John to filter admins whose name contains "John".
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
