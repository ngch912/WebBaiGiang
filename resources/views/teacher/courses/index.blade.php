@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>📚 Quản lý khóa học của bạn</h3>
        <a href="{{ route('teacher.courses.create') }}" class="btn btn-success">+ Tạo khóa học mới</a>
    </div>

    @if($courses->isEmpty())
        <div class="alert alert-warning">Bạn chưa tạo khóa học nào.</div>
    @else
        <div class="row">
            @foreach($courses as $course)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">
                    <a href="{{ route('teacher.courses.show', $course->id) }}" class="text-decoration-none">
                        {{ $course->name }}
                    </a>
                </h5>
                <p class="card-text"><strong>Mô tả:</strong> {{ Str::limit($course->description, 80) }}</p>
                <p class="card-text"><strong>Môn học:</strong> {{ $course->subject ?? 'Chưa cập nhật' }}</p>
                <p class="card-text text-muted">
                    <small>Tạo ngày: {{ $course->created_at->format('d/m/Y') }}</small><br>
                    <small>Cập nhật: {{ $course->updated_at->format('d/m/Y') }}</small>
                </p>
                <a href="{{ route('teacher.courses.show', $course->id) }}" class="btn btn-primary btn-sm mt-2">
                    🔍 Quản lý khóa học
                </a>
            </div>
        </div>
    </div>
@endforeach

        </div>
    @endif
</div>
@endsection
