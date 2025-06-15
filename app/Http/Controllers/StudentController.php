<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class StudentController extends Controller
{
    public function dashboard()
    {
        return view('student.dashboard');
    }

    public function showProfile()
    {
        $user = Auth::user();
        return view('student.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        ]);
        $user = User::find(Auth::id());
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->save();
        $user->save();

        return redirect()->route('student.profile')->with('success', 'Cập nhật thông tin thành công!');
    }
}
