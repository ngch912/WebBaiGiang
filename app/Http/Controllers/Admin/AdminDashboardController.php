<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    /**
     * Hiển thị trang dashboard dành cho admin.
     */
    public function index()
    {
        $admin = Auth::user(); // Lấy thông tin admin hiện tại

        return view('admin.dashboard', compact('admin'));
    }
}
