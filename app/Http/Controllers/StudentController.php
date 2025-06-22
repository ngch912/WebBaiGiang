<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class StudentController extends Controller
{
    public function dashboard()
    {
        // Lấy học viên hiện tại
        $user = Auth::user();

        // Lấy tất cả các khóa học mà học viên tham gia
        $courses = $user->courses; // Quan hệ nhiều - nhiều (many-to-many) với khóa học

        // Trả về view và truyền dữ liệu khóa học vào
        return view('student.dashboard', compact('courses'));
    }



    public function showProfile()
    {
        // Lấy thông tin người dùng
        $user = Auth::user();

        // Trả về view với thông tin hồ sơ người dùng
        return view('student.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        // Validate dữ liệu cập nhật
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        // Lấy người dùng hiện tại và cập nhật thông tin
        $user = User::find(Auth::id());
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->save();


        // Chuyển hướng về trang hồ sơ với thông báo thành công
        return redirect()->route('student.profile')->with('success', 'Cập nhật thông tin thành công!');
    }
    public function courses()
    {
        $user = Auth::user();
        $courses = $user->courses; // hoặc Course::all() nếu là danh sách tất cả khóa học
        return view('student.dashboard', compact('courses'));
    }
}
