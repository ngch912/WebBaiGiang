<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class HomeController extends Controller
{
    public function index()
    {
        // Các khóa học nổi bật (ví dụ: lấy 3 khóa mới nhất)
        $highlightedCourses = Course::latest()->take(3)->get();

        // Các khóa học theo môn
        $mathCourses       = Course::where('subject', 'Toán')->take(4)->get();
        $literatureCourses = Course::where('subject', 'Ngữ Văn')->take(4)->get();
        $scienceCourses    = Course::where('subject', 'Khoa Học')->take(4)->get();

        return view('home', compact(
            'highlightedCourses',
            'mathCourses',
            'literatureCourses',
            'scienceCourses'
        ));
    }

    public function subjectCourses($subject)
    {
        $courses = Course::where('subject', $subject)->paginate(8);

        return view('courses.by_subject', compact('courses', 'subject'));
    }
}
