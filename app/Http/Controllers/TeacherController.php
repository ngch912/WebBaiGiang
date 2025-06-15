<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Course;

class TeacherController extends Controller
{
    public function dashboard()
    {
        $courses = Course::where('teacher_id', Auth::id())->get();
        return view('teacher.dashboard', compact('courses'));
    }

    public function showProfile()
    {
        $user = Auth::user();
        return view('teacher.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email'    => 'required|email|max:255',
        ]);

        $user = User::findOrFail(Auth::id());
        $user->username = $request->username;
        $user->email    = $request->email;
        $user->save();

        return redirect()->route('teacher.profile')->with('success', 'Cập nhật thông tin thành công!');
    }
}
