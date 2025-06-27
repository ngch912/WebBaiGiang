<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function allCourses()
    {
        // Lấy tất cả khóa học có liên kết đến giáo viên
        $courses = Course::with('teacher')->get();

        // Gom nhóm theo môn học
        $groupedCourses = $courses->groupBy('subject');

        return view('courses.all', compact('groupedCourses'));
    }

    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Xử lý đăng nhập người dùng
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            // 👉 Sau khi đăng nhập, chuyển về trang chủ cho mọi vai trò
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ]);
    }

    // Hiển thị form đăng ký
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Xử lý đăng ký người dùng
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,teacher,student',
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $user = new User();
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->save();

            Auth::login($user);

            Session::flash('status', 'Đăng ký thành công, bạn đã đăng nhập!');

            // 👉 Sau khi đăng ký thành công, chuyển về trang chủ cho mọi vai trò
            return redirect()->route('home');
        } catch (\Exception $e) {
            Session::flash('error', 'Có lỗi xảy ra khi đăng ký. Vui lòng thử lại!');
            return redirect()->route('register')->withInput();
        }
    }
}
