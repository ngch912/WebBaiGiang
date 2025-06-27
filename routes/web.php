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
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DocumentController;

// =======================
// \u{1F4CC} PUBLIC ROUTES
// =======================
Route::get('/', fn () => redirect('/home'));

// Trang chủ cho cả giáo viên và học sinh sau đăng nhập
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

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
// \u{1F512} PROTECTED ROUTES (Auth + Role)
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
    Route::get('/teacher/courses', [CourseController::class, 'index'])->name('teacher.courses.index');
    Route::get('/teacher/courses/create', [CourseController::class, 'create'])->name('teacher.courses.create');
    Route::post('/teacher/courses', [CourseController::class, 'store'])->name('teacher.courses.store');
    Route::get('/teacher/courses/{course_id}/students', [CourseController::class, 'manageStudents'])->name('teacher.courses.manage_students');
    Route::post('/teacher/courses/{course_id}/students', [CourseController::class, 'addStudent'])->name('teacher.courses.add_student');
    Route::post('/teacher/courses/{course_id}/students/{student_id}/approve', [CourseController::class, 'approveStudent'])->name('teacher.courses.approve_student');
    Route::delete('/teacher/courses/{course_id}/students/{student_id}', [CourseController::class, 'removeStudent'])->name('teacher.courses.remove_student');
    Route::get('/teacher/courses/{course}', [CourseController::class, 'showForTeacher'])->name('teacher.courses.show');
});

// STUDENT
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/student/profile', [StudentController::class, 'showProfile'])->name('student.profile');
    Route::post('/student/profile', [StudentController::class, 'updateProfile'])->name('student.profile.update');
    Route::get('/student/courses', [StudentController::class, 'courses'])->name('student.courses');
    Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');
});

// =======================
// \u{1F4DA} Trang khóa học theo môn
// =======================
Route::get('/subject/{subject}', [HomeController::class, 'coursesBySubject'])->name('subject.courses');

// =======================
// \u{1F4CB} Tất cả khóa học
// =======================
Route::get('/courses/all', [CourseController::class, 'allCourses'])->name('courses.all');
Route::get('/courses', [CourseController::class, 'allCourses']); // Alias

// =======================
// \u{1F4CE} Tài liệu (Documents)
// =======================
Route::get('/courses/{course}/documents/create', [DocumentController::class, 'create'])->name('documents.create');
Route::post('/courses/{course}/documents', [DocumentController::class, 'store'])->name('documents.store');
// web.php
Route::post('/teacher/courses/{course_id}/students/{student_id}/remove', [CourseController::class, 'removeStudent'])
    ->name('teacher.courses.remove_student');
Route::post('/courses/{course}/join', [CourseController::class, 'requestJoinCourse'])->name('courses.request_join');
