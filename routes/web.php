<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\CustomLoginController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;

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

// Xử lý đăng nhập (Custom controller để redirect theo role)
Route::post('/login', [CustomLoginController::class, 'store']);

// Đăng xuất
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

// Quên mật khẩu
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Đặt lại mật khẩu
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');


// =======================
// 🔐 PROTECTED ROUTES (Auth + Role)
// =======================

// ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// TEACHER
Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
    Route::get('/teacher/profile', [TeacherController::class, 'showProfile'])->name('teacher.profile');
    Route::post('/teacher/profile', [TeacherController::class, 'updateProfile'])->name('teacher.profile.update');
});

// STUDENT
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/student/profile', [StudentController::class, 'showProfile'])->name('student.profile');
    Route::post('/student/profile', [StudentController::class, 'updateProfile'])->name('student.profile.update');
});
