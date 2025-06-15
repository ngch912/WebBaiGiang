<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Xử lý đăng nhập người dùng
    public function login(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Kiểm tra thông tin đăng nhập
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Nếu đăng nhập thành công, kiểm tra vai trò và chuyển hướng đến trang phù hợp
            $role = Auth::user()->role;

            // Điều hướng dựa trên vai trò người dùng
            if ($role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($role == 'teacher') {
                return redirect()->route('teacher.dashboard');
            } else {
                return redirect()->route('student.dashboard');
            }
        } else {
            // Nếu thông tin đăng nhập sai, quay lại trang đăng nhập với thông báo lỗi
            return back()->withErrors([
                'email' => 'Thông tin đăng nhập không chính xác.',
            ]);
        }
    }

    // Hiển thị form đăng ký
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Xử lý đăng ký người dùng
    public function register(Request $request)
    {
        // Validate dữ liệu
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,teacher,student',  // Kiểm tra vai trò hợp lệ
        ]);

        // Nếu validation thất bại, quay lại với lỗi
        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Lưu người dùng vào cơ sở dữ liệu
            $user = new User();
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);  // Mã hóa mật khẩu
            $user->role = $request->role; // Lưu vai trò người dùng (admin, teacher, student)
            $user->save();

            // Đăng nhập người dùng sau khi đăng ký thành công
            Auth::login($user);

            // Thêm thông báo thành công
            Session::flash('status', 'Đăng ký thành công, bạn đã đăng nhập!');

            // Chuyển hướng về trang Dashboard dựa trên vai trò
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role == 'teacher') {
                return redirect()->route('teacher.dashboard');
            } else {
                return redirect()->route('student.dashboard');
            }
        } catch (\Exception $e) {
            // Nếu có lỗi khi lưu người dùng, quay lại với thông báo lỗi
            Session::flash('error', 'Có lỗi xảy ra khi đăng ký. Vui lòng thử lại!');
            return redirect()->route('register')->withInput();
        }
    }
}
