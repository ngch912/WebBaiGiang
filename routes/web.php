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
use App\Http\Controllers\CourseController;

// =======================
// 📌 PUBLIC ROUTES
// =======================

Route::get('/', function () {
    return view('welcome');
})->name('home'); // Trang chủ

// Đăng ký
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Đăng nhập
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
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
    Route::get('/teacher/courses', [CourseController::class, 'index'])->name('teacher.courses.index');
    Route::get('/teacher/courses/create', [CourseController::class, 'create'])->name('teacher.courses.create');
    Route::post('/teacher/courses', [CourseController::class, 'store'])->name('teacher.courses.store');
    Route::get('/teacher/courses/{course_id}/students', [CourseController::class, 'manageStudents'])->name('teacher.courses.manage_students');
    Route::post('/teacher/courses/{course_id}/students', [CourseController::class, 'addStudent'])->name('teacher.courses.add_student');
    Route::post('/teacher/courses/{course_id}/students/{student_id}/approve', [CourseController::class, 'approveStudent'])->name('teacher.courses.approve_student');
});

// STUDENT Routes
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/student/profile', [StudentController::class, 'showProfile'])->name('student.profile');
    Route::post('/student/profile', [StudentController::class, 'updateProfile'])->name('student.profile.update');
    Route::get('/student/courses', [StudentController::class, 'courses'])->name('student.courses');
});

use App\Http\Controllers\HomeController;

// Trang chủ
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Khóa học theo môn
Route::get('/courses/subject/{subject}', [HomeController::class, 'subjectCourses'])->name('subject.courses');

