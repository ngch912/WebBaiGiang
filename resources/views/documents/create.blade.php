@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Thêm tài liệu cho khóa học: {{ $course->name }}</h2>

    <form action="{{ route('documents.store', $course->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Tiêu đề tài liệu</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Loại tài liệu</label>
            <select name="type" class="form-control" required>
                <option value="video">Video</option>
                <option value="pdf">PDF</option>
                <option value="docx">DOCX</option>
                <option value="image">Hình ảnh</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">Chọn tập tin</label>
            <input type="file" name="file" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Tải lên</button>
    </form>
</div>
@endsection
