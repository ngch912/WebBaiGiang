<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
        $courses = Course::withCount('documents')->get();
        return view('admin.courses.index', compact('courses'));
    } else {
        $courses = Course::where('teacher_id', Auth::id())->get();
        return view('teacher.courses.index', compact('courses'));
    }
    }

    public function create()
    {
        $subjects = ['Toán', 'Văn', 'Khoa học', 'Lịch sử', 'Địa lý', 'Sinh học', 'Hóa học', 'Vật lý', 'Tiếng Anh'];
        return view('teacher.courses.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'subject' => 'required|string',
        ]);

        $course = new Course();
        $course->teacher_id = Auth::id();
        $course->title = $request->name;
        $course->description = $request->description;
        $course->subject = $request->subject;
        $course->save();

        return redirect()->route('teacher.courses.index')->with('success', 'Khóa học đã được tạo thành công!');
    }

    public function manageStudents($course_id)
    {
        $course = Course::with(['students', 'studentsPending'])->findOrFail($course_id);
        return view('teacher.courses.students', compact('course'));
    }

    public function approveStudent($course_id, $student_id)
    {
        DB::table('course_members')
            ->where('course_id', $course_id)
            ->where('student_id', $student_id)
            ->update(['status' => 'approved']);

        return back()->with('success', 'Sinh viên đã được duyệt.');
    }

    public function removeStudent($course_id, $student_id)
    {
        DB::table('course_members')
            ->where('course_id', $course_id)
            ->where('student_id', $student_id)
            ->delete();

        return back()->with('success', 'Đã xoá học viên khỏi khoá học.');
    }


    public function addStudent(Request $request, $course_id)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
        ]);

        $course = Course::findOrFail($course_id);
        $student = User::findOrFail($request->student_id);

        $existing = CourseMember::where('course_id', $course->id)
            ->where('student_id', $student->id)
            ->first();

        if ($existing) {
            return redirect()->route('teacher.courses.manage_students', $course->id)
                ->with('error', 'Học sinh đã gửi yêu cầu hoặc đã được duyệt.');
        }

        CourseMember::create([
            'user_id' => $student->id,
            'course_id' => $course->id,
            'student_id' => $student->id,
            'status' => 'pending',
        ]);

        return redirect()->route('teacher.courses.manage_students', $course->id)
            ->with('success', 'Học sinh đã gửi yêu cầu tham gia khóa học.');
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.show', compact('course'));
    }

    public function allCourses()
    {
        $courses = Course::with('teacher')->get();
        $groupedCourses = $courses->groupBy('subject');
        return view('courses.all', compact('groupedCourses'));
    }

    public function showForTeacher($id)
    {
        $course = Course::with([
            'documents',
            'students',
            'studentsPending'
        ])->findOrFail($id);

        return view('teacher.courses.show', [
            'course' => $course,
            'documents' => $course->documents,
            'students' => $course->students,
            'pendingStudents' => $course->studentsPending,
        ]);
    }
    

public function requestJoinCourse($course_id)
{
    $user = Auth::user();

    // Kiểm tra đã gửi yêu cầu trước đó chưa
    $existing = CourseMember::where('course_id', $course_id)
        ->where('student_id', $user->id)
        ->first();

    if ($existing) {
        return back()->with('info', 'Bạn đã gửi yêu cầu hoặc đã tham gia khóa học này.');
    }

    CourseMember::create([
         'user_id' => $user->id,
        'course_id' => $course_id,
        'student_id' => $user->id,
        'status' => 'pending',
        'joined_at' => now(),
    ]);

    return back()->with('success', 'Đã gửi yêu cầu tham gia khóa học. Vui lòng chờ phê duyệt.');
}

}
