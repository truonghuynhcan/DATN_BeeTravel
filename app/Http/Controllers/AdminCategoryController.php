<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cate = Category::all();

        $return = [
            'status' => true,
            'message' => 'Lấy dữ liệu category tours thành công!',
            'data' => $cate,
        ];
        return response()->json($return, 200);
    }
    public function index_tt()
    {
        $cate = NewsCategory::all();

        $return = [
            'status' => true,
            'message' => 'Lấy dữ liệu category tours thành công!',
            'data' => $cate,
        ];
        return response()->json($return, 200);
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
