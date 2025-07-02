<?php

namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Lecture;

class LectureController extends Controller
{
    public function index()
    {
        $lectures = Lecture::latest()->paginate(5);
        return view('lectures.index', compact('lectures'));
    }

      public function create()
    {
        $courses = Course::all();
        return view('lectures.create', compact('courses'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'nullable',
            'course_id' => 'required|exists:courses,id',
        ]);
                Lecture::create($request->all());
        return redirect()->route('lectures.index')->with('success', 'Thêm bài giảng thành công!');
    }

    public function show($id)
    {
        $lecture = Lecture::findOrFail($id);
        return view('lectures.show', compact('lecture'));
    }
     public function update(Request $request, Lecture $lecture)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'nullable',
            'course_id' => 'required|exists:courses,id',
        ]);

        $lecture->update($request->all());
        return redirect()->route('lectures.index')->with('success', 'Cập nhật bài giảng thành công!');
    }
    public function destroy(Lecture $lecture)
    {
        $lecture->delete();
        return redirect()->route('lectures.index')->with('success', 'Xóa bài giảng thành công!');
    }
    public function edit(Lecture $lecture)
{
    $courses = Course::all();
    return view('lectures.edit', compact('lecture', 'courses'));
}
}
