<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Course;

class TeacherController extends Controller
{
    /**
     * Hiển thị trang Dashboard của giảng viên.
     * Lấy tất cả khóa học mà giảng viên đang giảng dạy.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        // Lấy tất cả các khóa học của giảng viên
        $courses = Course::where('teacher_id', Auth::id())->get();

        // Trả về view Dashboard và truyền danh sách khóa học vào
        return view('teacher.dashboard', compact('courses'));
    }

    /**
     * Hiển thị hồ sơ giảng viên.
     * Lấy thông tin người dùng đang đăng nhập.
     *
     * @return \Illuminate\View\View
     */
    public function showProfile()
    {
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        // Trả về view Hồ sơ giảng viên với thông tin người dùng
        return view('teacher.profile', compact('user'));
    }

    /**
     * Cập nhật thông tin hồ sơ giảng viên.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'username' => 'required|string|max:255',
            'email'    => 'required|email|max:255',
        ]);

        // Lấy người dùng hiện tại
        $user = User::findOrFail(Auth::id());

        // Cập nhật thông tin người dùng
        $user->username = $request->username;
        $user->email    = $request->email;

        // Lưu thông tin
        $user->save();

        // Chuyển hướng lại trang hồ sơ và hiển thị thông báo thành công
        return redirect()->route('teacher.profile')->with('success', 'Cập nhật thông tin thành công!');
    }
}
