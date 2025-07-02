<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;


class DocumentController extends Controller
{
     public function index($course_id)
    {
        $course = Course::with('documents')->findOrFail($course_id);
        $documents = Document::with('course')->get();
        return view('documents.index', compact('documents'));
    }

    public function create($course_id)
    {
        $courses = Course::findOrFail($course_id);;
        return view('documents.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'file' => 'required|mimes:pdf,docx,doc,xlsx,xls,pptx,ppt,zip,rar|max:10240',
        ]);

        $path = $request->file('file')->store('documents', 'public');

        Document::create([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'type' => $request->type,
            'file_path' => $path,
        ]);

        return redirect()->route('admin.courses.index')->with('success', 'Tải tài liệu thành công');
    }

    // public function download(Document $document)
    // {
    //     return Storage::disk('public')->download($document->file_path);
    // }

    public function destroy(Document $document)
    {
        Storage::disk('public')->delete($document->file_path);
        $document->delete();

        return back()->with('success', 'Đã xóa tài liệu!');
    }
}
