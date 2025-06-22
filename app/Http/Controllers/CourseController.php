<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Hiển thị danh sách khóa học của giáo viên.
     * Lấy tất cả các khóa học của giảng viên hiện tại.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Lấy tất cả các khóa học mà giảng viên đang giảng dạy
        $courses = Course::where('teacher_id', Auth::id())->get();

        // Trả về view với danh sách khóa học của giảng viên
        return view('teacher.courses.index', compact('courses'));
    }

    /**
     * Hiển thị form tạo khóa học mới.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Trả về view tạo khóa học mới
        return view('teacher.courses.create');
    }

    /**
     * Lưu thông tin khóa học mới.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate dữ liệu từ form
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Lưu thông tin khóa học mới
        Course::create([
            'name' => $request->name,
            'description' => $request->description,
            'teacher_id' => Auth::id(),  // Lưu giảng viên hiện tại làm chủ khóa học
        ]);

        // Chuyển hướng về trang danh sách khóa học của giảng viên với thông báo thành công
        return redirect()->route('teacher.courses.index')->with('success', 'Khóa học đã được tạo!');
    }

    /**
     * Quản lý học sinh trong khóa học (Duyệt học sinh).
     *
     * @param int $course_id
     * @return \Illuminate\View\View
     */
    public function manageStudents($course_id)
    {
        // Lấy khóa học theo ID
        $course = Course::findOrFail($course_id);

        // Lấy toàn bộ học sinh đã đăng ký vào khóa học (kèm trạng thái)
        $students = $course->students()->withPivot('status')->get();

        // Trả về view quản lý học sinh trong khóa học
        return view('teacher.courses.manage_students', compact('course', 'students'));
    }

    /**
     * Học sinh gửi yêu cầu đăng ký khóa học (status = pending).
     *
     * @param \Illuminate\Http\Request $request
     * @param int $course_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addStudent(Request $request, $course_id)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'student_id' => 'required|exists:users,id',
        ]);

        $course = Course::findOrFail($course_id);
        $student = User::findOrFail($request->student_id);

        // Kiểm tra nếu học sinh đã gửi yêu cầu hoặc đã được duyệt
        $existing = CourseMember::where('course_id', $course->id)
            ->where('student_id', $student->id)
            ->first();

        if ($existing) {
            return redirect()->route('teacher.courses.manage_students', $course->id)
                ->with('error', 'Học sinh đã gửi yêu cầu hoặc đã được duyệt.');
        }

        // Thêm học sinh vào khóa học với trạng thái chờ duyệt
        CourseMember::create([
            'course_id' => $course->id,
            'student_id' => $student->id,
            'status' => 'pending', // Mặc định trạng thái là chờ duyệt
        ]);

        return redirect()->route('teacher.courses.manage_students', $course->id)
            ->with('success', 'Học sinh đã gửi yêu cầu tham gia khóa học.');
    }

    /**
     * Hiển thị chi tiết khóa học.
     *
     * @param int $course_id
     * @return \Illuminate\View\View
     */
    public function show($course_id)
    {
        // Lấy thông tin khóa học
        $course = Course::findOrFail($course_id);

        // Trả về view chi tiết khóa học
        return view('courses.show', compact('course'));
    }

    /**
     * Giảng viên duyệt học sinh (chuyển trạng thái từ pending → approved).
     *
     * @param int $course_id
     * @param int $student_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approveStudent($course_id, $student_id)
    {
        // Tìm thành viên trong khóa học
        $member = CourseMember::where('course_id', $course_id)
            ->where('student_id', $student_id)
            ->first();

        if (!$member) {
            return back()->with('error', 'Không tìm thấy học sinh trong khóa học.');
        }

        // Cập nhật trạng thái thành "approved" (đã duyệt)
        $member->status = 'approved';
        $member->save();

        // Trở lại với thông báo thành công
        return back()->with('success', 'Học sinh đã được duyệt.');
    }
}
