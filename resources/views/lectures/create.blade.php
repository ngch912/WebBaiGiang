@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Thêm bài giảng</h2>
    <form method="POST" action="{{ route('lectures.store') }}">
        @csrf
        <div class="mb-3">
            <label>Tiêu đề</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nội dung</label>
            <textarea name="content" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Khóa học</label>
            <select name="course_id" class="form-control" required>
                @foreach($courses as $course)
                <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-success">Lưu</button>
    </form>
</div>
@endsection
