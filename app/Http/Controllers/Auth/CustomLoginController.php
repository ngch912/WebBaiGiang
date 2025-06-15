<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomLoginController extends Controller
{
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $role = Auth::user()->role;

            return match ($role) {
                'admin'   => redirect()->route('admin.dashboard'),
                'teacher' => redirect()->route('teacher.dashboard'),
                'student' => redirect()->route('student.dashboard'),
                default   => redirect('/'),
            };
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ]);
    }
}
