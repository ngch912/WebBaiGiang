<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    // Hiển thị thông tin hồ sơ học sinh
    public function studentProfile()
    {
        $user = Auth::user();
        return view('student.profile', compact('user'));  // Giả sử view là 'student.profile'
    }

    // Hiển thị thông tin hồ sơ giáo viên
    public function teacherProfile()
    {
        $user = Auth::user();
        return view('teacher.profile', compact('user'));  // Giả sử view là 'teacher.profile'
    }

    // Cập nhật thông tin cá nhân (học sinh và giáo viên)
    public function update(Request $request)
    {
        $user = User::find(Auth::id());
        $user->fill($request->all());
        $user->save();

        return redirect()->route('profile')->with('success', 'Thông tin đã được cập nhật!');
    }
}
