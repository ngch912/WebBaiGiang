<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\CustomLoginController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProfileController;

// =======================
// 📌 PUBLIC ROUTES
// =======================

// Trang chủ
Route::get('/', function () {
    return view('welcome');
});

// Đăng ký
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Đăng nhập (hiển thị form)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [CustomLoginController::class, 'store']);

// Đăng xuất
Route::post('/logout', function () {
    Auth::logout(); // Đăng xuất người dùng
    request()->session()->invalidate(); // Hủy session
    request()->session()->regenerateToken(); // Tạo lại CSRF token
    return redirect('/login'); // Chuyển hướng về trang đăng nhập
})->name('logout');

// Quên mật khẩu
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');

// =======================
// 🔐 PROTECTED ROUTES (Auth + Role)
// =======================

// ADMIN Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// TEACHER Routes
Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
    Route::get('/teacher/profile', [TeacherController::class, 'showProfile'])->name('teacher.profile');
    Route::post('/teacher/profile', [TeacherController::class, 'updateProfile'])->name('teacher.profile.update');
});

// STUDENT Routes
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/student/profile', [StudentController::class, 'showProfile'])->name('student.profile');
    Route::post('/student/profile', [StudentController::class, 'updateProfile'])->name('student.profile.update');
});

// =======================
// Profile Routes
// =======================
// Đảm bảo bạn có route cho trang hồ sơ học sinh và giáo viên
Route::middleware(['auth'])->group(function () {
    // Hồ sơ học sinh
    Route::get('/student/profile', [ProfileController::class, 'studentProfile'])->name('student.profile');

    // Hồ sơ giáo viên
    Route::get('/teacher/profile', [ProfileController::class, 'teacherProfile'])->name('teacher.profile');
});

