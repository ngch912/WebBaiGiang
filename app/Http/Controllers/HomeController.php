<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class HomeController extends Controller
{
    public function index()
{
    $highlightedCourses = Course::latest()->take(3)->get();

    $subjects = [
        'Toán',
        'Văn',
        'Khoa học',
        'Lịch sử',
        'Địa lý',
        'Sinh học',
        'Hóa học',
        'Vật lý',
        'Tiếng Anh',
    ];

    $coursesBySubject = [];

    foreach ($subjects as $subject) {
        $coursesBySubject[$subject] = Course::where('subject', $subject)->take(4)->get();
    }

    return view('home', compact('highlightedCourses', 'coursesBySubject'));
}
    public function subjectCourses($subject)
    {
        // Lấy tất cả các khóa học có subject tương ứng
        $courses = Course::where('subject', $subject)->get();

        return view('courses.subject', compact('subject', 'courses'));
    }
}
