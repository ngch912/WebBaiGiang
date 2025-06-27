<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Document;

class DocumentController extends Controller
{
    // Hiển thị form để upload tài liệu cho 1 khóa học
    public function create($course_id)
    {
        $course = Course::findOrFail($course_id);
        return view('documents.create', compact('course'));
    }

    // Lưu tài liệu vào database
    public function store(Request $request, $course_id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|file',
            'type' => 'required|in:video,pdf,docx,image'
        ]);

        $file = $request->file('file');
        $filePath = $file->store('documents', 'public');

        Document::create([
            'course_id' => $course_id,
            'title' => $request->title,
            'file_path' => $filePath,
            'type' => $request->type
        ]);

        return redirect()->route('teacher.courses.index')->with('success', 'Tải tài liệu lên thành công!');
    }
}
