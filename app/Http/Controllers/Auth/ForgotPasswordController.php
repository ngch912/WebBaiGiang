<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ForgotPasswordController extends Controller
{
    // Hiển thị form yêu cầu mật khẩu
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');  // Đảm bảo rằng view 'auth.passwords.email' tồn tại
    }

    // Xử lý yêu cầu reset mật khẩu
    public function sendResetLinkEmail(Request $request)
    {
        // Validate email
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email', // Kiểm tra email hợp lệ và tồn tại trong cơ sở dữ liệu
        ]);

        if ($validator->fails()) {
            return redirect()->route('password.request')
                ->withErrors($validator)
                ->withInput();
        }

        // Gửi email reset mật khẩu
        $response = Password::sendResetLink(
            $request->only('email')
        );

        if ($response == Password::RESET_LINK_SENT) {
            // Thông báo thành công
            Session::flash('status', 'Link reset mật khẩu đã được gửi tới email của bạn.');
            return back();
        } else {
            // Nếu có lỗi, hiển thị lỗi
            Session::flash('error', 'Không thể gửi email reset mật khẩu. Vui lòng thử lại.');
            return back();
        }
    }
}
