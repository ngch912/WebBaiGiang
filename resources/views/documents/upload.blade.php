@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Đăng video bài giảng</h2>
    <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="course_id" class="form-label">Khóa học:</label>
            <select name="course_id" class="form-control" required>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Tên video:</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">File video:</label>
            <input type="file" name="file" class="form-control" accept="video/*" required>
        </div>

        <button type="submit" class="btn btn-primary">Tải lên</button>
    </form>
</div>
@endsection
