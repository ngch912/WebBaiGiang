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
    use App\Http\Controllers\LectureController;
    use App\Models\Course;
    use App\Http\Controllers\Admin\DashboardController;
    
    
    // =======================
    // \u{1F4CC} PUBLIC ROUTES
    // =======================
    Route::get('/', function () {
    $highlightedCourses = Course::where('highlight', true)->get(); // Giả sử bạn có cột 'highlight'
    $mathCourses = Course::where('subject', 'Toán')->get();
    $literatureCourses = Course::where('subject', 'Văn')->get();
    $scienceCourses = Course::where('subject', 'Khoa học')->get();

    return view('home', compact('highlightedCourses', 'mathCourses', 'literatureCourses', 'scienceCourses'));
})->name('home');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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
   // routes/web.php
    Route::middleware(['auth', 'IsAdmin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
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

    // LECTURES Routes
    Route::middleware(['auth'])->group(function () {
    Route::get('/lectures', [LectureController::class, 'index'])->name('lectures.index');
    Route::get('/lectures/create', [LectureController::class, 'create'])->name('lectures.create');
    Route::post('/lectures', [LectureController::class, 'store'])->name('lectures.store');
    Route::get('/lectures/{id}', [LectureController::class, 'show'])->name('lectures.show');
    Route::get('/lectures/{lecture}/edit', [LectureController::class, 'edit'])->name('lectures.edit');
    Route::put('/lectures/{lecture}', [LectureController::class, 'update'])->name('lectures.update');
    Route::delete('/lectures/{lecture}', [LectureController::class, 'destroy'])->name('lectures.destroy');
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
    Route::get('/courses/subject/{subject}', [HomeController::class, 'subjectCourses'])->name('subject.courses');

    // =======================
    // \u{1F4CB} Tất cả khóa học
    // =======================
    Route::get('/courses/all', [CourseController::class, 'allCourses'])->name('courses.all');
    Route::get('/courses', [CourseController::class, 'allCourses']); // Alias

    Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('courses/{course}/documents/create', [DocumentController::class, 'create'])->name('documents.create');
    Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('/documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
    Route::delete('/documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');
});

    // =======================
    // \u{1F4CE} Tài liệu (Documents)
    // =======================
    Route::get('/courses/{course}/documents/create', [DocumentController::class, 'create'])->name('documents.create');
    Route::post('/courses/{course}/documents', [DocumentController::class, 'store'])->name('documents.store');
    // web.php
    Route::post('/teacher/courses/{course_id}/students/{student_id}/remove', [CourseController::class, 'removeStudent'])
        ->name('teacher.courses.remove_student');
    Route::post('/courses/{course}/join', [CourseController::class, 'requestJoinCourse'])->name('courses.request_join');
    
    

   Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});

    Route::middleware('auth', 'admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('courses', [CourseController::class, 'index'])->name('courses.index');
        Route::get('courses/{id}/documents/create', [DocumentController::class, 'create'])->name('documents.create');
        Route::post('courses/{id}/documents', [DocumentController::class, 'store'])->name('documents.store');
});

    Route::prefix('admin')->middleware(['auth', 'IsAdmin'])->group(function () {
        Route::resource('departments', \App\Http\Controllers\Admin\DepartmentController::class);
        Route::resource('subjects', \App\Http\Controllers\Admin\SubjectController::class);
});

Route::prefix('admin')->middleware(['auth', 'role:IsAdmin'])->group(function () {
    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{id}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('admin.users.destroy');
});