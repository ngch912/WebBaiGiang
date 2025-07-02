@extends('layouts.admin')

@section('content')
<h2>Thêm tài liệu cho khóa học: {{ $course->title }}</h2>

<form method="POST" action="{{ route('admin.documents.store', $course->id) }}" enctype="multipart/form-data">
    @csrf
    <input type="text" name="title" class="form-control" placeholder="Tên tài liệu">
    <select name="type" class="form-control mt-2">
        <option value="pdf">PDF</option>
        <option value="docx">DOCX</option>
        <option value="video">Video</option>
        <option value="image">Ảnh</option>
    </select>
    <input type="file" name="file" class="form-control mt-2">
    <button class="btn btn-success mt-2">Tải lên</button>
</form>
@endsection
